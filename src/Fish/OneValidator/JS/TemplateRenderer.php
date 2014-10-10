<?php
/**
 * Created by PhpStorm.
 * User: matanya
 * Date: 10/2/14
 * Time: 8:36 PM
 */

namespace Fish\OneValidator\JS;


class TemplateRenderer {

    public function render($rules) {

        $rules = json_encode($rules, JSON_PRETTY_PRINT);
        $template = file_get_contents(__DIR__ . "/../templates/validator.template");

        $rendered = preg_replace("/{{rules}}/",$rules, $template);

        return $rendered;
    }
} 