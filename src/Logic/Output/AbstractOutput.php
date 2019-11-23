<?php
namespace SiFinder\Logic\Output;

use League\CLImate\CLImate;
use SiFinder\Logic\AnalysisResult;

abstract class AbstractOutput
{
    /**
     * CLI tool.
     * @var CLImate CLImate instance.
     */
    protected $cli;

    /**
     * Output directory path.
     * @var string directory path.
     */
    protected $outputDirectory;

    /**
     * Set dependencies.
     * @param CLImate $climate CLImate instance.
     * @param string $outputDirectory directory where files will be created.
     */
    public function __construct(CLImate $climate, $outputDirectory)
    {
        $this->cli = $climate;
        $this->outputDirectory = $outputDirectory;
    }

    /**
     * Outputs reduced analysis result.
     * @param  AnalysisResult $result reduced result data.
     * @return void
     */
    abstract public function result(AnalysisResult $result);
}
