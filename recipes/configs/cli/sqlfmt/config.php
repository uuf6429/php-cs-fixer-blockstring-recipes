<?php declare(strict_types=1);

use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;

return (new PhpCsFixer\Config())
	->setRiskyAllowed(true)
	->registerCustomFixers([new BlockStringFixer()])
	->setRules([
		BlockStringFixer::NAME => [
			'formatters' => [
				'SQL' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'sqlfmt --version'],
					formatCommand: ['cmd' => 'sqlfmt -'],
					lineEndingNormalizer: new DefaultNormalizer(
						changeLinesTo: DefaultNormalizer::LF,
						changeFinalLineTo: DefaultNormalizer::STRIP
					),
				),
			],
		],
	]);
