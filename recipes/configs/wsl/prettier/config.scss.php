<?php declare(strict_types=1);

use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\WslPipeFormatter;

return (new PhpCsFixer\Config())
	->setRiskyAllowed(true)
	->registerCustomFixers([new BlockStringFixer()])
	->setRules([
		BlockStringFixer::NAME => [
			'formatters' => [
				'SCSS' => new WslPipeFormatter(
					versionValueOrCommand: ['cmd' => 'prettier --version'],
					formatCommand: ['cmd' => 'prettier --parser scss'],
				),
			],
		],
	]);
