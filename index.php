<?php 
class Tweets {
    public $matrix = array();
    public $mirror = array();
    public $counter = 0;

    private function compute($t) {

        if ($t === 'CLOSEALL') {
            $this->mirror = $this->matrix;
            $this->counter = 0;
        } else {
            $indx = intval(substr($t , 6));
            $this->mirror[$indx] = !$this->mirror[$indx];
            if ($this->mirror[$indx]) {
                ++$this->counter;
            } else {
                --$this->counter;
            }
        }
        
    }

    public function init() {
        $data = explode(' ', stream_get_line(STDIN, 100000000, PHP_EOL));
        $this->matrix = $this->mirror = array_fill(0, $data[1], false);
        for ($j=0; $j<$data[1]; $j++) {
            $tweet = stream_get_line(STDIN, 10000000, PHP_EOL);
            $this->compute($tweet);
            echo $this->counter . PHP_EOL;
        }
    }

}


$tweets = new Tweets();
$tweets->init();
?>