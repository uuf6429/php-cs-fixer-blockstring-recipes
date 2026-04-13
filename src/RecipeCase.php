<?php declare(strict_types=1);

namespace uuf6429\PhpCsFixerBlockstringRecipes;

/**
 * @internal
 */
final readonly class RecipeCase
{
	public function __construct(
		public string $type,
		public string $configFile,
		public string $inputFile,
		public string $outputFile,
	) {
		if (!is_file($this->configFile)) {
			throw new \InvalidArgumentException("Invalid config file: $this->configFile");
		}
		if (!is_file($this->inputFile)) {
			throw new \InvalidArgumentException("Invalid input file: $this->inputFile");
		}
		if (!is_file($this->outputFile)) {
			throw new \InvalidArgumentException("Invalid output file: $this->outputFile");
		}
	}

	public static function create(mixed $value, string $recipesRoot): self
	{
		if (
			!is_array($value)
			|| !is_string($configFile = $value['configFile'] ?? null)
			|| !is_string($inputFile = $value['inputFile'] ?? null)
			|| !is_string($outputFile = $value['outputFile'] ?? null)
			|| !is_string($type = explode('/', $inputFile)[1] ?? null)
		) {
			throw new \InvalidArgumentException('Recipe case structure is not valid');
		}

		return new self(
			$type,
			$recipesRoot . ltrim($configFile, '\\/'),
			$recipesRoot . ltrim($inputFile, '\\/'),
			$recipesRoot . ltrim($outputFile, '\\/')
		);
	}
}
