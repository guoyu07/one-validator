$(".my-form").validate({
    rules:
    {
        "accepted_field": {
            "accepted": true
        },
        "active_url_field": {
            "remote": {
                "url": "validate",
                "data": {
                    "field": "active_url_field",
                    "rule": "active_url"
                }
            }
        },
        "alpha_field": {
            "required": true,
            "alpha": true
        },
        "alpha_dash_field": {
            "alpha_dash": true
        },
        "array_field": {
            "array": true
        },
        "between_numeric_field": {
            "number": true,
            "range": [
                "5",
                "10"
            ]
        },
        "between_string_field": {
            "rangelength": [
                "10",
                "20"
            ]
        },
        "boolean_field": {
            "boolean": true
        },
        "confirmed_field": {
            "confirmed": true
        },
        "different_field": {
            "different": "alpha_field"
        },
        "digits_field": {
            "digits_value": "8"
        },
        "digits_between_field": {
            "digits|rangelength": [
                "4",
                "6"
            ]
        },
        "email_field": {
            "email": true,
            "required": true
        },
        "exists_field": {
            "remote": {
                "url": "validate",
                "data": {
                    "field": "exists_field",
                    "rule": "exists:users,email"
                }
            }
        },
        "integer_field": {
            "digits": true
        },
        "ip_field": {
            "ip": true
        },
        "max_numeric_field": {
            "digits": true
        },
        "max_string_field": {
            "maxlength": "14"
        },
        "mix_numeric_field": {
            "number": true
        },
        "mix_string_field": {
            "minlength": "14"
        },
        "not_in_field": {
            "not_in_array": [
                "10",
                "20",
                "30"
            ]
        },
        "numeric_field": {
            "number": true
        },
        "regex_field": {
            "regex": "\/ab.d\/"
        },
        "required_field": {
            "required": true
        },
        "required_if_field": {
            "required_if": "accepted_field"
        },
        "same_field": {
            "same": "digits_field"
        },
        "size_numeric_field": {
            "number": true,
            "size": "10"
        },
        "size_string_field": {
            "size": "5"
        },
        "unique_field": {
            "remote": {
                "url": "validate",
                "data": {
                    "field": "unique_field",
                    "rule": "unique:users,email"
                }
            }
        },
        "url_field": {
            "url": true
        }
    }
});