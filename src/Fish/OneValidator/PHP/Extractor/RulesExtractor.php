<?php
/**
 * Created by PhpStorm.
 * User: matanya
 * Date: 10/2/14
 * Time: 7:52 PM
 */

namespace Fish\OneValidator\PHP\Extractor;

use Fish\OneValidator\PHP\Extractor\Exceptions\RulesArrayNotFoundException;

class RulesExtractor {

    /**
     * @var
     */
    protected $fileContent;

    const RULES_ARRAY_REGEX='/\$rules\s*\=\s*(\[|(array\s*\())[^(=>)]+?=>.+(\]|\))/s';
    /**
     * @param $fileContent
     */
    public function __construct($fileContent) {

        $this->fileContent = $fileContent;

    }

    /**
     * @return bool|mixed
     * @throws Exceptions\RulesArrayNotFoundException
     */
    public function extract() {

        $rules = $this->getRules();


        return $rules?:false;
    }

    /**
     * @return bool|mixed
     */
    private function getRules() {

        $hasRules = preg_match(self::RULES_ARRAY_REGEX,$this->fileContent, $match);
        return $hasRules?$this->toArray($match[0]):false;
    }

    /**
     * @param $rules
     * @return mixed
     */
    private function toArray($rules) {

        file_put_contents("rules.tmp","<?php return " .$rules . ";");

        $rules = include('rules.tmp');

       // unlink("rules.tmp");

        return $rules;
    }
} 