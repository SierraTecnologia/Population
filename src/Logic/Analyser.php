<?php
namespace SiFinder\Logic;

use SiFinder\Logic\Output\AbstractOutput;
use SiFinder\Logic\Output\Filter\OutputFilterInterface;
use SiFinder\Logic\Output\TriggerableInterface;

/**
 * Run all script analysers and outputs their result.
 * @package qa
 */
class Analyser
{
    const EVENT_STARTING_ANALYSIS = 0;
    const EVENT_STARTING_TOOL = 1;
    const EVENT_FINISHED_TOOL = 2;
    const EVENT_FINISHED_ANALYSIS = 3;

    const VERSION = '0.7.1';

    protected $defaultLanguage = 'Php';

    /**
     * Composer binaries path.
     * @var string directory path.
     */
    protected $binariesPath;

    /**
     * Analysis target.
     * @var string[] file or directory path.
     */
    protected $analysedPaths;

    /**
     * Ignored paths.
     * @var string[] comma separated list of directories to ignore.
     */
    protected $ignoredPaths;

    /**
     * Output service.
     * @var AbstractOutput output instance.
     */
    protected $output;

    /**
     * Analysis result filter.
     * @var OutputFilterInterface filter instance.
     */
    protected $resultsFilter;

    /**
     * Set dependencies and initialize CLI.
     * @param AbstractOutput $output Output target.
     * @param string $binariesPath Composer binaries path.
     * @param string[] $analysedPaths target file or directory path.
     * @param string[] $ignoredPaths comma separated list of ignored directories.
     */
    public function __construct(AbstractOutput $output, $binariesPath, $analysedPaths, $ignoredPaths, $project = false)
    {
        $this->output = $output;
        $this->binariesPath = $binariesPath;
        $this->analysedPaths = $analysedPaths;
        $this->ignoredPaths = $ignoredPaths;

        if (!$project) {
            $this->languageClass = 'SiFinder\\Logic\\Language\\'.$this->defaultLanguage;
        }
    }

    /**
     * Run each configured PHP analysis tool.
     * @return boolean true if it didn't find code issues.
     */
    public function run()
    {
        $result = $this->createResult();
        $this->trigger(
            self::EVENT_STARTING_ANALYSIS,
            ['ignoredPaths' => $this->ignoredPaths]
        );

        foreach ($this->getAnalysisTools() as $tool) {
            $message = ['description' => $tool->getDescription()];
            $this->trigger(self::EVENT_STARTING_TOOL, $message);
            $tool->run($this->getAnalysedPaths());
            $result->mergeWith($tool->getAnalysisResult());
            $this->trigger(self::EVENT_FINISHED_TOOL);
        }

        if ($this->resultsFilter) {
            $result->setResultsFilter($this->resultsFilter);
        }

        $this->output->result($result);
        $this->trigger(self::EVENT_FINISHED_ANALYSIS);

        return !$result->hasIssues();
    }

    /**
     * Call an output trigger if supported.
     * @param int $event occurred event.
     * @param string|null $message optional message.
     * @return void
     */
    protected function trigger($event, $message = null)
    {
        if ($this->output instanceof TriggerableInterface) {
            $this->output->trigger($event, $message);
        }
    }

    /**
     * Get a list of paths to be ignored by the analysis.
     * @return string[] a list of file and/or directory paths.
     */
    public function getIgnoredPaths()
    {
        return $this->ignoredPaths;
    }

    /**
     * Analysis target path.
     * @return string[] target path.
     */
    public function getAnalysedPaths()
    {
        return $this->analysedPaths;
    }

    /**
     * Add an output filter to delegate to the analysis result object.
     * @param OutputFilterInterface $filter filter instance.
     */
    public function setResultsFilter(OutputFilterInterface $filter)
    {
        $this->resultsFilter = $filter;
    }

    /**
     * Set target files and/or directories to be analysed.
     * @param string[] $paths target paths.
     * @return void
     */
    public function setAnalysedPaths(array $paths)
    {
        $this->analysedPaths = $paths;
    }

    /**
     * List of PHP analys integration classes.
     * @return string[] array of class names.
     */
    protected function getAnalysisToolsClasses()
    {
        return $this->languageClass::getAnalysisToolsClasses();
    }

    /**
     * Set of PHP analys integration objects.
     * @return SiFinder\Logic\Tools\AbstractIntegrationTool[] set of objects.
     */
    protected function getAnalysisTools()
    {
        $objects = [];
        $tools = $this->getAnalysisToolsClasses();

        if (empty($tools)) {
            return $objects;
        }

        foreach ($tools as $className) {
            $tool = new $className($this->binariesPath, sys_get_temp_dir());
            $tool->setIgnoredPaths($this->getIgnoredPaths());
            $objects[] = $tool;
        }

        return $objects;
    }

    /**
     * Create an empty analysis result.
     * @return AnalysisResult instance.
     */
    protected function createResult()
    {
        return new AnalysisResult;
    }
}
