<?php

namespace Fish\OneValidator\Convert;


abstract class Rules {



    /**
     * @var array of all supported rules
     */
    protected $supportedRules = [
        'accepted',
        'active_url',
        'alpha',
        'alpha_dash',
        'alpha_num',
        'array',
        'between',
        'boolean',
        'confirmed',
        'different',
        'digits',
        'digits_between',
        'email',
        'exists',
        'image',
        'in',
        'integer',
        'ip',
        'max',
        'min',
        'not_in',
        'numeric',
        'regex',
        'required',
        'required_if',
        'required_with',
        'required_with_all',
        'required_without',
        'required_without_all',
        'same',
        'size',
        'unique',
        'url'
    ];

    /**
     * @var array map php rules to their respective js rules
     */
    protected $rulesMap = [
        'digits'=>'digits_value',
        'in'=>'in_array',
        'integer'=>'digits',
        'not_in'=>'not_in_array',
        'numeric'=>'number',
        'between'=>'range'
    ];

    /**
     * @var array of rules which are translated
     * as length range or value range depending
     * on the field type (string or integer respectively)
     */
    protected $dynamicRules = [
        'range',
        'min',
        'max',
        'size'
    ];

    /**
     * @var array of remote rules
     */
    protected $remote = [
        'active_url',
        'exists',
        'unique'
    ];



    /**
     * @param $rule
     * @param $isNumericField
     * @return mixed
     */
    protected function convertRule($field, $rule, $remote, $isNumericField)
    {

        switch (true):
            case ($remote):
                $rule = $this->generateRemoteRule($field, $rule);
                break;
            case (count($rule) > 1):
                $params = explode(",", $rule[1]);
                if ($isNumericField) {
                    $params = array_map(function($param){
                        return intval($param);
                    },$params);
                }

                if (count($params) == 1) $params = $params[0];
                $rule = $params;

                break;
            case (count($rule) == 1):
                $rule =  $rule[0]=='confirmed'?"{$field}_confirmation":true;
                break;
        endswitch;

        return $rule;
    }

    /**
     * @param $field
     * @param $rule
     * @return array
     */
    protected function generateRemoteRule($field, $rule) {
        return  ["url"=>"validate",
                "data"=>[
                    "field"=>$field,
                    "rule"=>implode(":",$rule)
                ]
          ];

    }

    /**
     * @param $rule
     * @return mixed
     */
    protected function translateRule($rule, $isNumericField) {

        if (isset($this->rulesMap[$rule])):
            $rule = $this->rulesMap[$rule];
        endif;

        if (in_array($rule,$this->dynamicRules)):
           $rule = $this->generateDynamicRule($rule, $isNumericField);
        endif;


        return $rule;

    }

    /**
     * @param $rule
     * @param $isNumericField
     * @return mixed
     */
    protected function generateDynamicRule($rule, $isNumericField){
        if (!$isNumericField)
            $rule.="length";
        return $rule;
    }

    /**
     * @param $rules
     * @param $field
     * @param $isNumericField
     * @param $converted
     * @return mixed
     */
    protected function convertRules($rules, $field, $isNumericField)
    {
        $converted = [];

        foreach ($rules as $rule):

            if (!is_array($rule))
            $rule = explode(":", $rule);

            if (in_array($rule[0], $this->supportedRules)):

                $jsRule = $this->translateRule($rule[0], $isNumericField);

                $remote = in_array($jsRule,$this->remote);
                $jsRule = $remote?"remote":$jsRule;
                $converted[$field][$jsRule] = $this->convertRule($field, $rule, $remote, $isNumericField);

            endif;

        endforeach;

        return $converted;
    }


} 