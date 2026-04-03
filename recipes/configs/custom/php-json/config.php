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
				'JSON' => new class (
					version: PHP_VERSION,
					interpolationCodec: new PlainStringCodec(),
				) extends AbstractCodecFormatter {
					protected function formatContent(string $original): string
					{
						return json_encode(
							json_decode($original, false, 512, JSON_THROW_ON_ERROR),
							JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT,
						);
					}
				},
			],
		],
	]);
