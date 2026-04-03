<?php declare(strict_types=1);

namespace uuf6429\PhpCsFixerBlockstringRecipes;

/**
 * @internal
 */
final class RecipeCase
{
	public function __construct(
		public readonly string $type,
		public readonly string $inputFile,
		public readonly string $outputFile,
	) {
	}
}
