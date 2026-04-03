<?php declare(strict_types=1);

use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;

return (new PhpCsFixer\Config())
	->setRiskyAllowed(true)
	->registerCustomFixers([new BlockStringFixer()])
	->setRules([
		BlockStringFixer::NAME => [
			'formatters' => [
				'JSON' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'jq --version'],
					formatCommand: ['cmd' => 'jq --indent 4 --monochrome-output .'],
				),
			],
		],
	]);
