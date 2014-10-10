$.validator.addMethod(
    "required_with",
    function(value,el,fields) {

        var val,present = false;

        fields.forEach(function(field) {
            val = $("[name="+field+"]").val().trim();
            if (val) present=true;

        });

        return !(present && !value.trim());

    },
    "Please enter value for this field"
);