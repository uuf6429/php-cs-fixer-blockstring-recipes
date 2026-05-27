<?php declare(strict_types=1);

use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\DockerPipeFormatter;

return (new PhpCsFixer\Config())
	->setRiskyAllowed(true)
	->registerCustomFixers([new BlockStringFixer()])
	->setRules([
		BlockStringFixer::NAME => BlockStringFixer::config(
			[
				'SQL' => new DockerPipeFormatter(
					image: 'sqlfluff/sqlfluff',
					command: ['format', '--dialect', 'ansi', '-'],
					pullMode: 'missing',
				),
			]
		),
	]);
