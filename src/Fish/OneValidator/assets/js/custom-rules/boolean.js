$.validator.addMethod(
    "boolean",
    function(value) {
        return (!value.trim()) ||
                ($.inArray(value, ['0','1',0,1,true,false])>-1);
    },
    "the field must be a true or false"
);
