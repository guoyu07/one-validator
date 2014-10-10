$.validator.addMethod(
    "alpha_num",
    function(value) {
        var regexp = new RegExp("^[A-Za-z0-9]+$");

        return !value.trim() || regexp.test(value);
    },
    "Please enter alphanumeric characters only"
);
