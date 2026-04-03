<?php declare(strict_types=1);

use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;

return (new PhpCsFixer\Config())
	->setRiskyAllowed(true)
	->registerCustomFixers([new BlockStringFixer()])
	->setRules([
		BlockStringFixer::NAME => [
			'formatters' => [
				'SQL' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'sqlformat --version'],
					formatCommand: ['cmd' => 'sqlformat -k upper -s -r -'],
				),
			],
		],
	]);
