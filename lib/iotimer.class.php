<?php

class iotimer {

    /**
     * Stores the start time of the timer.
     * @var int
     */
    var $start;

    /**
     * Contains the total time it took (in seconds) for the page to be generated.
     * @var int
     */
    var $total;

    /**
     * Starts a timer to display the PHP page generation time.
     * @return bool
     */
    public function start_watch() {
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $start = $time;
        $this->start = $start;
        return true;
    }

    /**
     * Stops the timer.
     * @return bool 
     */
    public function stop_watch() {
        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $finish = $time;
        $total_time = round(($finish - $this->start), 4);
        $this->total = $total_time;
        return true;
    }

}

?>
