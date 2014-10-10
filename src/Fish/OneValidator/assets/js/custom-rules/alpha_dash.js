$.validator.addMethod(
    "alpha_dash",
    function(value) {


        var regexp = new RegExp("^[A-Za-z0-9 _-]+$");

        return !value.trim() || regexp.test(value);
    },
    "Please enter alphanumeric characters only."
);
