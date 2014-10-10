<?php
/**
 * Created by PhpStorm.
 * User: matanya
 * Date: 10/10/14
 * Time: 9:33 PM
 */

namespace Fish\OneValidator\Commands;
use Illuminate\Foundation\Application as App;
use Illuminate\Console\Command;

class MyCommand extends Command {

    /**
     * @return string
     */
    protected function laravelVersion() {
        $app = new App;
        return intval(substr($app::VERSION,0,1));
    }

} 