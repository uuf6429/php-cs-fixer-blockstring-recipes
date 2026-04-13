<?php declare(strict_types=1);

use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\AbstractCodecFormatter;
use uuf6429\PhpCsFixerBlockstring\InterpolationCodec\PlainStringCodec;

return (new PhpCsFixer\Config())
	->setRiskyAllowed(true)
	->registerCustomFixers([new BlockStringFixer()])
	->setRules([
		BlockStringFixer::NAME => [
			'formatters' => [
				'HTML' => new class (
					version: PHP_VERSION,
					interpolationCodec: new PlainStringCodec(),
				) extends AbstractCodecFormatter {
					protected function formatContent(string $original): string
					{
						try {
							libxml_use_internal_errors(true);
							$dom = new DOMDocument();
							$dom->preserveWhiteSpace = false;
							$dom->formatOutput = true;
							$dom->loadHTML($original);
							return substr((string)$dom->saveHTML(), 0, -1);
						} finally {
							libxml_use_internal_errors(false);
						}
					}
				},
			],
		],
	]);
