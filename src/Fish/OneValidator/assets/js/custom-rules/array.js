$.validator.addMethod(
    "array",
    function(value) {

        return (!value.trim()) ||
            (value instanceof Array);
    },
    "the field must be an array"
);