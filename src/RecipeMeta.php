<?php declare(strict_types=1);

namespace uuf6429\PhpCsFixerBlockstringRecipes;

/**
 * @internal
 */
final class RecipeMeta
{
	/**
	 * @param non-empty-list<RecipeCase> $cases
	 * @param array<non-empty-string, non-empty-string> $requirements
	 */
	public function __construct(
		public readonly string $configFile,
		public readonly string $name,
		public readonly string $integrationType,
		public readonly array  $cases,
		public readonly array  $requirements,
	) {
	}

	public static function fromJsonFile(string $recipeFilePath, string $recipesPath): self
	{
		$data = (array)json_decode((string)file_get_contents($recipeFilePath), true, 512, JSON_THROW_ON_ERROR);
		$casesRoot = rtrim($recipesPath, '\\/') . DIRECTORY_SEPARATOR;

		try {
			return new self(
				dirname($recipeFilePath) . DIRECTORY_SEPARATOR . 'config.php',
				// @phpstan-ignore argument.type
				$data['name'] ?? basename(dirname($recipeFilePath)),
				basename(dirname($recipeFilePath, 2)),
				self::loadCases(
					$data['cases'] ?? throw new \InvalidArgumentException('The "cases" field must exist'),
					$casesRoot
				),
				// @phpstan-ignore argument.type
				$data['require'],
			);
		} catch (\Throwable $ex) {
			throw new \RuntimeException("Could not load recipe at $recipeFilePath: {$ex->getMessage()}", 0, $ex);
		}
	}

	/**
	 * @return non-empty-list<RecipeCase>
	 */
	private static function loadCases(mixed $cases, string $casesRoot): array
	{
		if (!is_array($cases)) {
			throw new \InvalidArgumentException('The "cases" field must contain an array');
		}

		$result = [];
		foreach ($cases as $index => $casePaths) {
			if (!is_array($casePaths) || count($casePaths) !== 2 || !is_string($casePaths[0]) || !is_string($casePaths[1])) {
				throw new \InvalidArgumentException("Case at index $index must be an array containing two paths as strings");
			}
			$result[] = new RecipeCase(
				explode('/', $casePaths[0])[1],
				$casesRoot . ltrim($casePaths[0], '\\/'),
				$casesRoot . ltrim($casePaths[1], '\\/'),
			);
		}

		if (count($result) === 0) {
			throw new \InvalidArgumentException('The "cases" field must contain at least one item');
		}

		return $result;
	}
}
