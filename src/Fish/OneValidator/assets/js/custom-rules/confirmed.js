$.validator.addMethod(
    "confirmed",
    function(value, input) {
       var name = input.name + "_confirmation";
       var other = $("[name="+name + "]").val();
       return (!value.trim() || value.trim()==other);
    },
    "the field must be confirmed"
);
