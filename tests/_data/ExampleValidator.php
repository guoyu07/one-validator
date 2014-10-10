<?php
/**
 * Created by PhpStorm.
 * User: matanya
 * Date: 10/3/14
 * Time: 10:33 AM
 */

namespace _data;


class ExampleValidator {

    protected $rules = [
        "accepted_field"=>"accepted",
        "active_url_field"=>"active_url",
        "alpha_field"=>"required|alpha",
        "alpha_dash_field"=>"alpha_dash",
        "alpha_num_field"=>"alpha_num",
        "array_field"=>"array",
        "between_numeric_field"=>"numeric|between:5,10",
        "between_string_field"=>"between:10,20",
        "boolean_field"=>"boolean",
        "confirmed_field"=>"confirmed",
        "different_field"=>"different:alpha_field",
        "digits_field"=>"digits:8",
        "digits_between_field"=>"digits_between:4,6",
        "email_field"=>"email|required",
        "exists_field"=>"exists:users,email",
        "in_field"=>"in:some,array,values",
        "integer_field"=>"integer",
        "ip_field"=>"ip",
        "max_numeric_field"=>"integer|max:10",
        "max_string_field"=>"max:14",
        "min_numeric_field"=>"numeric|min:10",
        "min_string_field"=>"min:14",
        "not_in_field"=>"not_in:10,20,30",
        "numeric_field"=>"numeric",
        "regex_field"=>"regex:/ab.d/",
        "required_field"=>"required",
        "required_if_field"=>"required_if:email_field,matfish2@gmail.com",
        "required_with_field"=>"required_with:ip_field,digits_field",
        "required_with_all_field"=>"required_with_all:ip_field,max_string_field",
        "required_without_field"=>"required_without:integer_field,numeric_field",
        "required_without_all_field"=>"required_without_all:active_url_field,min_string_field",
        "same_field"=>"same:digits_field",
        "size_numeric_field"=>"numeric|size:10",
        "size_string_field"=>"size:5",
        "unique_field"=>"unique:users,email",
        "url_field" => "url"
        ];
} 