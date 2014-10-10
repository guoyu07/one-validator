$.validator.addMethod(
    "digits_value",
    function(value, el, param) {

        var val = parseInt(value);
        var isInt = val && isFinite(val) && value%1===0;
        return (value.length==param && isInt) || !value.trim();

    },
    "incorrect value"
);