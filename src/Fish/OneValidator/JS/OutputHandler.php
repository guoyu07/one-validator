<?php
/**
 * Created by PhpStorm.
 * User: matanya
 * Date: 10/8/14
 * Time: 4:18 PM
 */

namespace Fish\OneValidator\JS;


class OutputHandler {

    /**
     * @var
     */
    protected $rules;

    /**
     * @var
     */
    protected $target;

    public function __construct($rules, $target) {
        $this->rules = $rules;
        $this->target = $target;

    }

    public function get() {

        if ($this->target)
                file_put_contents($this->target, $this->rules);

        $output = $this->target?
            "The file was created at {$this->target}":
            $this->rules;

        return $output;
    }

} 