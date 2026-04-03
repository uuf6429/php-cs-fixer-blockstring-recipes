<?php declare(strict_types=1);

use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\CliPipeFormatter;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\DefaultNormalizer;

return (new PhpCsFixer\Config())
	->setRiskyAllowed(true)
	->registerCustomFixers([new BlockStringFixer()])
	->setRules([
		BlockStringFixer::NAME => [
			'formatters' => [
				'JS' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'prettier --version'],
					formatCommand: ['cmd' => 'prettier --parser babel'],
					lineEndingNormalizer: new DefaultNormalizer(
						changeLinesTo: DefaultNormalizer::LF,
						changeFinalLineTo: DefaultNormalizer::STRIP
					),
				),
				'JSX' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'prettier --version'],
					formatCommand: ['cmd' => 'prettier --parser babel'],
					lineEndingNormalizer: new DefaultNormalizer(
						changeLinesTo: DefaultNormalizer::LF,
						changeFinalLineTo: DefaultNormalizer::STRIP
					),
				),
				'VUE' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'prettier --version'],
					formatCommand: ['cmd' => 'prettier --parser vue'],
					lineEndingNormalizer: new DefaultNormalizer(
						changeLinesTo: DefaultNormalizer::LF,
						changeFinalLineTo: DefaultNormalizer::STRIP
					),
				),
				'TS' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'prettier --version'],
					formatCommand: ['cmd' => 'prettier --parser typescript'],
					lineEndingNormalizer: new DefaultNormalizer(
						changeLinesTo: DefaultNormalizer::LF,
						changeFinalLineTo: DefaultNormalizer::STRIP
					),
				),
				'CSS' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'prettier --version'],
					formatCommand: ['cmd' => 'prettier --parser css'],
					lineEndingNormalizer: new DefaultNormalizer(
						changeLinesTo: DefaultNormalizer::LF,
						changeFinalLineTo: DefaultNormalizer::STRIP
					),
				),
				'SCSS' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'prettier --version'],
					formatCommand: ['cmd' => 'prettier --parser scss'],
					lineEndingNormalizer: new DefaultNormalizer(
						changeLinesTo: DefaultNormalizer::LF,
						changeFinalLineTo: DefaultNormalizer::STRIP
					),
				),
				'HTML' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'prettier --version'],
					formatCommand: ['cmd' => 'prettier --parser html'],
					lineEndingNormalizer: new DefaultNormalizer(
						changeLinesTo: DefaultNormalizer::LF,
						changeFinalLineTo: DefaultNormalizer::STRIP
					),
				),
				'JSON' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'prettier --version'],
					formatCommand: ['cmd' => 'prettier --parser json'],
					lineEndingNormalizer: new DefaultNormalizer(
						changeLinesTo: DefaultNormalizer::LF,
						changeFinalLineTo: DefaultNormalizer::STRIP
					),
				),
				'GQL' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'prettier --version'],
					formatCommand: ['cmd' => 'prettier --parser graphql'],
					lineEndingNormalizer: new DefaultNormalizer(
						changeLinesTo: DefaultNormalizer::LF,
						changeFinalLineTo: DefaultNormalizer::STRIP
					),
				),
				'MD' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'prettier --version'],
					formatCommand: ['cmd' => 'prettier --parser markdown'],
					lineEndingNormalizer: new DefaultNormalizer(
						changeLinesTo: DefaultNormalizer::LF,
						changeFinalLineTo: DefaultNormalizer::STRIP
					),
				),
				'YAML' => new CliPipeFormatter(
					versionValueOrCommand: ['cmd' => 'prettier --version'],
					formatCommand: ['cmd' => 'prettier --parser yaml'],
					lineEndingNormalizer: new DefaultNormalizer(
						changeLinesTo: DefaultNormalizer::LF,
						changeFinalLineTo: DefaultNormalizer::STRIP
					),
				),
			],
		],
	]);
