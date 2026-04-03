<?php declare(strict_types=1);

use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;

return (new PhpCsFixer\Config())
	->setRiskyAllowed(true)
	->registerCustomFixers([new BlockStringFixer()])
	->setRules([
		BlockStringFixer::NAME => [
			'formatters' => [
				'BLADE' => new WslPipeFormatter(
					versionValueOrCommand: ['cmd' => 'blade-formatter --version'],
					formatCommand: ['cmd' => 'blade-formatter --stdin'],
				),
			],
		],
	]);
