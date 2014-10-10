$.validator.addMethod(
    "size",
    function(value,el,number) {

        return !value.trim() || value==number;

    },
    ""
);