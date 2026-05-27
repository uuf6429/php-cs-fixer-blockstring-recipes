<?php declare(strict_types=1);

use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\AbstractStringFormatter;
use uuf6429\PhpCsFixerBlockstring\InterpolationCodec\CodecInterface;
use uuf6429\PhpCsFixerBlockstring\InterpolationCodec\PlainStringCodec;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\NormalizerInterface;

class NativeJsonFormatter extends AbstractStringFormatter
{
	public function __construct(?CodecInterface $interpolationCodec = null, ?NormalizerInterface $lineEndingNormalizer = null)
	{
		parent::__construct(self::class . ' (PHP ' . PHP_VERSION . ')', $interpolationCodec, $lineEndingNormalizer);
	}

	protected function formatContent(string $original): string
	{
		return json_encode(
			json_decode($original, false, 512, JSON_THROW_ON_ERROR),
			JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT,
		);
	}
}

return (new PhpCsFixer\Config())
	->setRiskyAllowed(true)
	->registerCustomFixers([new BlockStringFixer()])
	->setRules([
		BlockStringFixer::NAME => BlockStringFixer::config(
			[
				'JSON' => new NativeJsonFormatter(interpolationCodec: new PlainStringCodec()),
			]
		),
	]);
