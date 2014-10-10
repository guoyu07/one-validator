<?php
/**
 * Created by PhpStorm.
 * User: matanya
 * Date: 10/2/14
 * Time: 8:25 PM
 */

namespace Fish\OneValidator\Convert;


class RulesConverter extends Rules {


    /**
     * @var array
     */
    protected $rules;

    /**
     * @param $rules
     */
    public function __construct(array $rules) {
        $this->rules = $rules;
    }

   /**
    * @return bool|string
    */
    public function convert() {

        $converted = [];

        foreach ($this->rules as $field=>$rules):

            // if the data is passed as a piped string transform it into an array
            if (!is_array($rules)) $rules = explode("|",$rules);

            // this is required for the dynamic rules (min,max, between, size), whose application depends on the field type
            $isNumericField = in_array('numeric',$rules) || in_array('integer', $rules);

            $converted = array_merge($converted,$this->convertRules($rules, $field, $isNumericField));

        endforeach;


        return $converted?:false;
    }


}

