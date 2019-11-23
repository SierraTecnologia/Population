<?php
namespace SiFinder\Logic\Language;

use SiFinder\Logic\Output\AbstractOutput;
use SiFinder\Logic\Output\Filter\OutputFilterInterface;
use SiFinder\Logic\Output\TriggerableInterface;

/**
 * Run all script analysers and outputs their result.
 */
class Php
{
    /**
     * List of PHP analys integration classes.
     * @return string[] array of class names.
     */
    public static function getAnalysisToolsClasses()
    {
        return [
            'SiFinder\Logic\Tools\CodeSniffer',
            'SiFinder\Logic\Tools\CopyPasteDetector',
            'SiFinder\Logic\Tools\MessDetector',
        ];
    }
}