<?php declare(strict_types=1);

namespace uuf6429\PhpCsFixerBlockstringRecipes\Readmerator;

use JsonException;
use RuntimeException;
use uuf6429\PhpCsFixerBlockstringRecipes\RecipeRepository;

/**
 * @internal
 */
final class Readmerator
{
	private const string PROJECT_ROOT = __DIR__ . '/../../';
	private const string README_TEMPLATE = __DIR__ . '/README.tpl.md';

	public static function render(): void
	{
		$projectRoot = self::normalizePath(self::PROJECT_ROOT);
		echo strtr(
			self::readFile(self::README_TEMPLATE),
			[
				'{{PROJECT_NAME}}' => 'uuf6429/php-cs-fixer-blockstring-recipes',
				'{{RECIPES}}' => implode("\n", [...self::renderRecipes($projectRoot)]),
			]
		);
	}

	private static function normalizePath(string $path): string
	{
		if (($normalized = realpath($path)) === false) {
			throw new RuntimeException("Could not normalize path: $path");
		}
		return $normalized;
	}

	private static function readFile(string $file): string
	{
		if (($content = file_get_contents($file)) === false) {
			throw new RuntimeException("Could not read file: $file");
		}
		return $content;
	}

	/**
	 * @return iterable<string>
	 * @throws JsonException
	 */
	private static function renderRecipes(string $projectRoot): iterable
	{
		$repository = new RecipeRepository();
		foreach ($repository->groupByCaseTypes($repository->getAll()) as $caseType => $caseRecipes) {
			yield "### $caseType";
			yield '';
			foreach ($repository->groupByName($caseRecipes) as $name => $recipes) {
				yield "<table><tr><td><code>$name</code></td>";
				foreach ($recipes as $recipe) {
					foreach ($recipe->cases as $case) {
						if ($case->type !== $caseType) {
							continue;
						}
						$configHtml = strtr(htmlspecialchars(self::readFile($recipe->configFile)), ["\t" => '&nbsp;&nbsp;&nbsp;&nbsp;', "\n\n" => "\n<br>\n"]);
						$inputHtml = strtr(htmlspecialchars(self::readFile($case->inputFile)), ["\t" => '───→', ' ' => '·', "\n\n" => "\n<br>\n"]);
						$outputHtml = strtr(htmlspecialchars(self::readFile($case->outputFile)), ["\t" => '───→', ' ' => '·', "\n\n" => "\n<br>\n"]);
						$configPath = strtr($recipe->configFile, [$projectRoot => '.', '\\' => '/']);
						$inputPath = strtr($case->inputFile, [$projectRoot => '.', '\\' => '/']);
						$outputPath = strtr($case->outputFile, [$projectRoot => '.', '\\' => '/']);

						yield '<td>';
						yield '<details>';
						yield "<summary>$recipe->integrationType</summary>";
						yield '<table>';
						yield "<tr><td colspan=\"2\">Configuration (<a href=\"$configPath\">source</a>):<pre lang=\"php\">$configHtml</pre></td></tr>";
						yield "<tr><td valign=\"top\">Example Input (<a href=\"$inputPath\">source</a>):<pre lang=\"php\">$inputHtml</pre></td><td>Formatted Output (<a href=\"$outputPath\">source</a>):<pre lang=\"php\">$outputHtml</pre></td></tr>";
						yield '</table>';
						yield '</details>';
						yield '</td>';
					}
				}
				yield '</tr></table>';
			}
			yield '';
		}
	}
}
