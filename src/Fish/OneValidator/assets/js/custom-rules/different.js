$.validator.addMethod(
    "different",
    function(value, el, param) {

        var otherVal = $("[name=" +param+ "]").val().trim();
        value = value.trim();
        return (otherVal!=value) || (!value && !otherVal);

    },
    ""
);