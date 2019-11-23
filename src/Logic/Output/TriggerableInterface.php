<?php
namespace SiFinder\Logic\Output;

/**
 * Methods for triggering output events (analysis started, analyses ended, etc.).
 */
interface TriggerableInterface
{
    /**
     * Output event messages.
     * @param integer $eventType Analyser class event constant.
     * @param mixed $data Optional message.
     * @return void
     */
    public function trigger($eventType, $data = null);
}
