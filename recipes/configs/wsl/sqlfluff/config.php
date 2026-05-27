<?php declare(strict_types=1);

use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;

return (new PhpCsFixer\Config())
	->setRiskyAllowed(true)
	->registerCustomFixers([new BlockStringFixer()])
	->setRules([
		BlockStringFixer::NAME => BlockStringFixer::config(
			[
				'SQL' => new WslPipeFormatter(
					versionValueOrCommand: ['cmd' => 'sqlfluff --version'],
					formatCommand: ['cmd' => 'sqlfluff format --dialect ansi -'],
				),
			]
		),
	]);
