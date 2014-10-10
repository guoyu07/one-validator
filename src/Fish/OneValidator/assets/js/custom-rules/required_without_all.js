$.validator.addMethod(
    "required_without_all",
    function(value,el,fields) {

        var val,ctr = 0, numFields = fields.length;

        fields.forEach(function(field) {
            val = $("[name="+field+"]").val().trim();
            if (!val) ctr++;

        });

        var allNotPresent = ctr==numFields;

        return !(allNotPresent && !value.trim());

    },
    "Please enter value for this field"
);
