<?php
/**
 * Created by PhpStorm.
 * User: matanya
 * Date: 10/4/14
 * Time: 8:55 PM
 */


namespace Fish\OneValidator\Convert;

use Illuminate\Foundation\Application as App;

class MessagesFetcher extends Rules{

    /**
    * @param $lang
     */
    public function __construct($lang) {
        $this->lang = $lang;
    }

    /**
    * fetch validation messages by current locale
    * @return bool|mixed
     */
    public function fetch() {

        $file = app_path()."/lang/{$this->lang}/validation.php";

        if (!file_exists($file)) return false;

        $messages = include($file);
        $messages = $this->convertRulesName($messages);

        return $messages;
    }



    /**
     * use the rules map to convert rules names where necessary
     * @param $messages
     * @return mixed
     */
    private function convertRulesName($messages) {

        foreach ($this->rulesMap as $phpRule=>$jsRule):

            $messages[$jsRule] = $messages[$phpRule];
            unset($messages[$phpRule]);
        endforeach;

        foreach ($this->dynamicRules as $rule):
            $m = $messages[$rule];
            $messages[$rule] = $m['numeric'];
            $messages[$rule."length"] = $m['string'];
        endforeach;

        return $messages;
    }

    /**
    * @param $data
     * @return string
     */
    public function getRemoteMessage($data) {

        extract($data);
        $ruleName = explode(":",$rule)[0];
        $trans = trans("validation.{$ruleName}");
        $attr = "validation.attributes.{$field}";

        $fieldName = trans($attr)==$attr?$field:trans($attr);

        $response = str_replace([":attribute","_"],[$fieldName," "],$trans);

        return $response;
    }

} 