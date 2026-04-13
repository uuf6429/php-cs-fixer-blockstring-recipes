<?php declare(strict_types=1);

namespace uuf6429\PhpCsFixerBlockstringRecipesTests;

use Composer\InstalledVersions;
use Composer\Semver\Semver;
use JsonException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;
use Throwable;
use uuf6429\PhpCsFixerBlockstringRecipes\RecipeCase;
use uuf6429\PhpCsFixerBlockstringRecipes\RecipeMeta;
use uuf6429\PhpCsFixerBlockstringRecipes\RecipeRepository;

/**
 * @internal
 */
final class RecipeTest extends TestCase
{
	private const PCF_BINARY_PATH = __DIR__ . '/../vendor/bin/php-cs-fixer';

	private static ?bool $dockerRunning = null;
	private static ?string $dockerVersion = null;
	/** @var array<string, bool> */
	private static array $dockerImageExists = [];
	/** @var array<string, bool> */
	private static array $executableExists = [];

	/**
	 * @dataProvider provideRecipeCases
	 */
	public function testRecipe(RecipeMeta $recipe, RecipeCase $case): void
	{
		$this->verifyRequirements($recipe);

		$tempFile = tempnam(sys_get_temp_dir(), '');
		try {
			copy($case->inputFile, $tempFile);

			$process = new Process([
				'php',
				self::PCF_BINARY_PATH,
				'fix',
				'--using-cache=no',
				'--config=' . $case->configFile,
				'--sequential',
				'-vvv',
				'--diff',
				$tempFile,
			]);
			$process->mustRun();

			$this->assertFileEquals($case->outputFile, $tempFile);
		} finally {
			@unlink($tempFile);
		}
	}

	/**
	 * @return iterable<string, array{recipe: RecipeMeta, case: RecipeCase}>
	 * @throws JsonException
	 */
	public static function provideRecipeCases(): iterable
	{
		$recipeRepo = new RecipeRepository();
		foreach ($recipeRepo->getAll() as $recipe) {
			foreach ($recipe->cases as $case) {
				yield "{$recipe->integrationType} {$recipe->name} {$case->type}" => [
					'recipe' => $recipe,
					'case' => $case,
				];
			}
		}
	}

	private function verifyRequirements(RecipeMeta $recipe): void
	{
		foreach ($recipe->requirements as $requirement => $constraint) {
			if (!$this->verifyRequirement($requirement, $constraint)) {
				$this->markTestSkipped("Test requirement has not been met: $requirement:$constraint");
			}
		}
	}

	private function verifyRequirement(string $requirement, string $constraint): bool
	{
		return match (true) {
			$requirement === 'php'
			=> Semver::satisfies(PHP_VERSION, $constraint),

			$requirement === 'docker'
			=> $this->isDockerRunning() && Semver::satisfies($this->getDockerVersion(), $constraint),

			preg_match('/^docker-(.+)$/', $requirement, $match) === 1 && $constraint === '*'
			=> $this->isDockerRunning() && $this->dockerImageExists($match[1]),

			$requirement === 'windows' && $constraint === '*'
			=> $this->isWindows(),

			preg_match('/^bin-(.+)$/', $requirement, $match) === 1 && $constraint === '*'
			=> $this->executableExists($match[1]),

			preg_match('/^wsl-(.+)$/', $requirement, $match) === 1 && $constraint === '*'
			=> $this->isWindows() && $this->executableExists($match[1], inWsl: true),

			preg_match('/^ext-(.+)$/', $requirement, $match) === 1 && $constraint === '*'
			=> extension_loaded($match[1]),

			preg_match('/^[a-z0-9_.-]+\/[a-z0-9_.-]+$/', $requirement) === 1
			=> InstalledVersions::isInstalled($requirement)
				&& Semver::satisfies((string)InstalledVersions::getPrettyVersion($requirement), $constraint),

			default
			=> throw new \RuntimeException("Unsupported requirement/constraint: $requirement/$constraint"),
		};
	}

	private function isDockerRunning(): bool
	{
		if (self::$dockerRunning !== null) {
			return self::$dockerRunning;
		}

		try {
			Process::fromShellCommandline('docker info')->mustRun();
			return self::$dockerRunning = true;
		} catch (Throwable) {
			return self::$dockerRunning = false;
		}
	}

	private function getDockerVersion(): string
	{
		if (self::$dockerVersion !== null) {
			return self::$dockerVersion;
		}

		try {
			return self::$dockerVersion = trim(
				Process::fromShellCommandline('docker version --format \'{{.Client.Version}}\'')
					->mustRun()
					->getOutput(),
				"\r\n\t '\""
			);
		} catch (Throwable) {
			return self::$dockerVersion = '';
		}
	}

	private function dockerImageExists(string $image): bool
	{
		if (isset(self::$dockerImageExists[$image])) {
			return self::$dockerImageExists[$image];
		}

		$process = new Process(['docker', 'pull', $image], timeout: null);
		$process->run();

		return self::$dockerImageExists[$image] = $process->isSuccessful();
	}

	private function isWindows(): bool
	{
		return PHP_OS_FAMILY === 'Windows';
	}

	private function executableExists(string $name, bool $inWsl = false): bool
	{
		$cacheKey = $inWsl ? "wsl-$name" : "bin-$name";

		if (isset(self::$executableExists[$cacheKey])) {
			return self::$executableExists[$cacheKey];
		}

		$checkCommand = match (true) {
			$this->isWindows() && $inWsl
			=> ['wsl', 'bash', '-lc', "command -v $name"],

			$this->isWindows()
			=> ['where', $name],

			default
			=> ['command', '-v', $name],
		};

		$process = new Process($checkCommand);
		$process->run();

		return self::$executableExists[$cacheKey] = $process->isSuccessful();
	}
}
