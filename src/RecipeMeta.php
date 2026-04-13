<?php declare(strict_types=1);

namespace uuf6429\PhpCsFixerBlockstringRecipes;

/**
 * @internal
 */
final readonly class RecipeMeta
{
	/**
	 * @param non-empty-list<RecipeCase> $cases
	 * @param array<string, string> $requirements
	 */
	public function __construct(
		public string $name,
		public string $integrationType,
		public array  $cases,
		public array  $requirements,
	) {
	}

	public static function fromJsonFile(string $recipeFilePath, string $recipesPath): self
	{
		try {
			if (($data = @file_get_contents($recipeFilePath)) === false) {
				throw new \InvalidArgumentException("Could not read meta file: $recipeFilePath");
			}
			$data = (array)json_decode($data, true, 512, JSON_THROW_ON_ERROR);
			$recipesRoot = rtrim($recipesPath, '\\/') . DIRECTORY_SEPARATOR;
			$name = $data['name'] ?? basename(dirname($recipeFilePath));
			$require = $data['require'] ?? null;
			assert(
				is_string($name)
				&& is_array($require)
				&& $require === array_filter(
					$require,
					static fn($k, $v) => is_string($k) && is_string($v),
					ARRAY_FILTER_USE_BOTH
				)
			);
			return new self(
				$name,
				basename(dirname($recipeFilePath, 2)),
				self::loadCases(
					$data['cases'] ?? throw new \InvalidArgumentException('The "cases" field must exist'),
					$recipesRoot
				),
				$require
			);
		} catch (\Throwable $ex) {
			throw new \RuntimeException("Could not load recipe at $recipeFilePath: {$ex->getMessage()}", 0, $ex);
		}
	}

	/**
	 * @return non-empty-list<RecipeCase>
	 */
	private static function loadCases(mixed $cases, string $recipesRoot): array
	{
		if (!is_array($cases)) {
			throw new \InvalidArgumentException('The "cases" field must contain an array');
		}

		if (count($cases) === 0) {
			throw new \InvalidArgumentException('The "cases" field must contain at least one item');
		}

		return array_map(
			RecipeCase::create(...),
			$cases,
			array_fill(0, count($cases), $recipesRoot),
		);
	}
}
