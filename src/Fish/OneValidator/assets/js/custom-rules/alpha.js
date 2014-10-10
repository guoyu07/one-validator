$.validator.addMethod(
    "alpha",
    function(value) {

        var regexp = new RegExp("^[A-Za-z ]+$");
        return !value || regexp.test(value);
    },
    "Please enter letters only"
);
