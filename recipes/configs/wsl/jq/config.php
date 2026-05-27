<?php declare(strict_types=1);

use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;

return (new PhpCsFixer\Config())
	->setRiskyAllowed(true)
	->registerCustomFixers([new BlockStringFixer()])
	->setRules([
		BlockStringFixer::NAME => BlockStringFixer::config(
			[
				'JSON' => new WslPipeFormatter(
					versionValueOrCommand: ['cmd' => 'jq --version'],
					formatCommand: ['cmd' => 'jq --indent 4 --monochrome-output .'],
				),
			]
		),
	]);
