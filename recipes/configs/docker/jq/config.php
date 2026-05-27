<?php declare(strict_types=1);

use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\DockerPipeFormatter;

return (new PhpCsFixer\Config())
	->setRiskyAllowed(true)
	->registerCustomFixers([new BlockStringFixer()])
	->setRules([
		BlockStringFixer::NAME => BlockStringFixer::config(
			[
				'JSON' => new DockerPipeFormatter(
					image: 'ghcr.io/jqlang/jq',
					command: ['--indent', '4', '--monochrome-output', '.'],
					pullMode: 'missing',
				),
			]
		),
	]);
