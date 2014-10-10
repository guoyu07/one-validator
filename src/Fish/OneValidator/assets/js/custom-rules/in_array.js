$.validator.addMethod(
    "in_array",
    function(value,el,params) {

        return (!value.trim() || $.inArray(value, params)>=0);
    },
    ""
);