$.validator.addMethod(
    "regex",
    function(value,el,regexp) {
        value = value.trim();
        regexp = regexp.replace(/^\/(.+)\/$/g,"$1");
        var regex = new RegExp(regexp);
        return regex.test(value) || !value;

    },
    "Invalid value"
);
