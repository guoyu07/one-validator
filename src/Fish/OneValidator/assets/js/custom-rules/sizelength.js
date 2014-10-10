$.validator.addMethod(
    "sizelength",
    function(value,el,length) {

        return !value.trim() || value.length==length;

    },
    ""
);