$.validator.addMethod(
    "required_if",
    function(value,el,params) {

        var fieldValue = $("[name="+params[0]+"]").val();

        return !(fieldValue==params[1] && !value.trim());

    },
    "Please enter value for this field"
);