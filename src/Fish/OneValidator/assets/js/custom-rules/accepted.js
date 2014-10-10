$.validator.addMethod(
    "accepted",
    function(value) {

        return (value && $.inArray(value, ['1','on','yes'])>=0);
    },
    "Please accept the conditions"
);
