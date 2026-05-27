<?php declare(strict_types=1);

use uuf6429\PhpCsFixerBlockstring\Fixer\BlockStringFixer;
use uuf6429\PhpCsFixerBlockstring\Formatter\AbstractStringFormatter;
use uuf6429\PhpCsFixerBlockstring\InterpolationCodec\CodecInterface;
use uuf6429\PhpCsFixerBlockstring\InterpolationCodec\PlainStringCodec;
use uuf6429\PhpCsFixerBlockstring\LineEndingNormalizer\NormalizerInterface;

class NativeHtmlFormatter extends AbstractStringFormatter
{
	public function __construct(?CodecInterface $interpolationCodec = null, ?NormalizerInterface $lineEndingNormalizer = null)
	{
		parent::__construct(self::class . ' (PHP ' . PHP_VERSION . ')', $interpolationCodec, $lineEndingNormalizer);
	}

	protected function formatContent(string $original): string
	{
		try {
			libxml_use_internal_errors(true);
			$dom = new DOMDocument();
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadHTML($original);
			return substr((string)$dom->saveHTML(), 0, -1);
		} finally {
			libxml_use_internal_errors(false);
		}
	}
}

return (new PhpCsFixer\Config())
	->setRiskyAllowed(true)
	->registerCustomFixers([new BlockStringFixer()])
	->setRules([
		BlockStringFixer::NAME => BlockStringFixer::config(
			[
				'HTML' => new NativeHtmlFormatter(interpolationCodec: new PlainStringCodec()),
			]
		),
	]);
