$.validator.addMethod(
    "same",
    function(value, el, param) {

        var otherVal = $("[name="+param+"]").val().trim();

        return (otherVal==value.trim());

    },
    ""
);