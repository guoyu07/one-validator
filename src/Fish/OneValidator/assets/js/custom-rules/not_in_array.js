$.validator.addMethod(
    "not_in_array",
    function(value,el,params) {

        value = value.trim();

        return ($.inArray(value, params)==-1) || !value;
    },
    ""
);
