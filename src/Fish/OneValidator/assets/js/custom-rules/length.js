$.validator.addMethod(
    "length",
    function(value,el,length) {
        $.validator.messages.length =  "The value must be " + length + " characters long";
        value = value.trim();
        return !value || value.length==length;
    },
    ""
);
