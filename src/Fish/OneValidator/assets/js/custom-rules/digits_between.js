$.validator.addMethod(
    "digits_between",
    function(value, el, param) {
        var val = parseInt(value);
        var isInt = val && isFinite(val) && value%1===0;
        return (value.length>=param[0] && value.length<=param[1] && isInt) || !value.trim();

    },
    "incorrect value"
);