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
				'JSON' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'jq --version'],
					formatCommand: ['cmd' => 'jq --indent 4 --monochrome-output .'],
					lineEndingNormalizer: new DefaultNormalizer(
						changeLinesTo: DefaultNormalizer::LF,
						changeFinalLineTo: DefaultNormalizer::STRIP
					),
				),
			]
		),
	]);
