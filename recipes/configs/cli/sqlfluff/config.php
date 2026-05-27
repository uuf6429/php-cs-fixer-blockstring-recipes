<?php declare(strict_types=1);

use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;

return (new PhpCsFixer\Config())
	->setRiskyAllowed(true)
	->registerCustomFixers([new BlockStringFixer()])
	->setRules([
		BlockStringFixer::NAME => BlockStringFixer::config(
			[
				'SQL' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'sqlfluff --version'],
					formatCommand: ['cmd' => 'sqlfluff format --dialect ansi -'],
					lineEndingNormalizer: new DefaultNormalizer(
						changeLinesTo: DefaultNormalizer::LF,
						changeFinalLineTo: DefaultNormalizer::STRIP
					),
				),
			]
		),
	]);
