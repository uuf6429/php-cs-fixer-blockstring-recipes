<?php declare(strict_types=1);

namespace uuf6429\PhpCsFixerBlockstringRecipes;

use FilesystemIterator;
use JsonException;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

/**
 * @internal
 */
final class RecipeRepository
{
	public const string RECIPES_PATH = __DIR__ . '/../recipes/';

	/**
	 * @return iterable<RecipeMeta>
	 * @throws JsonException
	 */
	public function getAll(): iterable
	{
		$recipesPath = (string)realpath(self::RECIPES_PATH);

		/** @var array<string, SplFileInfo> $files */
		$files = iterator_to_array(
			new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($recipesPath, FilesystemIterator::SKIP_DOTS)
			)
		);
		ksort($files);

		foreach ($files as $file) {
			if ($file->isFile() && $file->getBasename() === 'meta.json') {
				yield RecipeMeta::fromJsonFile($file->getPathname(), $recipesPath);
			}
		}
	}

	/**
	 * @param iterable<RecipeMeta> $recipes
	 * @return iterable<string, list<RecipeMeta>>
	 */
	public function groupByCaseTypes(iterable $recipes): iterable
	{
		$result = [];
		foreach ($recipes as $recipe) {
			foreach ($recipe->cases as $case) {
				if (!isset($result[$case->type])) {
					$result[$case->type] = [];
				}
				$result[$case->type][] = $recipe;
			}
		}
		ksort($result);
		return $result;
	}

	/**
	 * @param iterable<RecipeMeta> $recipes
	 * @return iterable<string, list<RecipeMeta>>
	 */
	public function groupByName(iterable $recipes): iterable
	{
		$result = [];
		foreach ($recipes as $recipe) {
			if (!isset($result[$recipe->name])) {
				$result[$recipe->name] = [];
			}
			$result[$recipe->name][] = $recipe;
		}
		ksort($result);
		return $result;
	}
}
