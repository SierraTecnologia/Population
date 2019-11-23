<?php
namespace SiFinder\Logic\Output\Filter;

/**
 * Output filters limit the data returned by a \SiFinder\Logic\AnalysisResult object.
 */
interface OutputFilterInterface
{
    /**
     * Filter data returned by a \SiFinder\Logic\AnalysisResult object.
     * @param $data array a list of the file paths and their issues.
     * @return array filtered data array.
     */
    public function filter($data);
}
