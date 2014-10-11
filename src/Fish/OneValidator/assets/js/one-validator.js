var OneValidator = (function(){

    var allMessages;

    return  {
        init:function() {
          $.get('validate/messages').success(function(messages) {
                allMessages = messages;
                for (message in messages) {
                    OneValidator.setMessage(message);
                }
            });


        },
        setMessage: function(rule) {
            $.validator.messages[rule] = function (param, input) {

               var min,max, name, value, values=[];

                  name = input.name;
                if (typeof allMessages.attributes[name]!='undefined'){
                    name = allMessages.attributes[name];
                }

                if ($.isArray(param)) {

                param.forEach(function(p) {
                    if (typeof allMessages.attributes[p]!='undefined'){
                        values.push(allMessages.attributes[p]);
                    } else {
                        values.push(p);
                     }

                });
                    values = values.toString();

            }
                if ($.inArray(rule,['min','minlength',])>-1) {
                    min = param;
                }
                    else if ($.inArray(rule,['max','maxlength'])>-1) {
                       max = param;

                } else if ($.inArray(rule,['range','rangelength','digits_between'])>-1) {
                    min = param[0];
                    max = param[1];
                } else if (rule=='required_if') {
                    value = param[1];
                    param = typeof allMessages.attributes[param[0]]!='undefined'?
                        allMessages.attributes[param[0]]:param[0];
                }

                param = param.toString();

                if ($.inArray(rule, ['required_with','required_without','required_with_all','required_without_all'])>-1) {
                   values =  values.replace(/,/," / ");
                }

                return allMessages[rule].replace(/:attribute/,name)
                    .replace(/:values/,values)
                    .replace(/:value/,value)
                    .replace(/:digits/,param)
                    .replace(/:size/,param)
                    .replace(/:other/,param)
                    .replace(/:min/,min)
                    .replace(/:max/,max)
                    .replace(/_/g,' ');

            };
        }
    };

})();

OneValidator.init();
$.validator.addMethod(
    "accepted",
    function(value) {

        return (value && $.inArray(value, ['1','on','yes'])>=0);
    },
    "Please accept the conditions"
);

$.validator.addMethod(
    "alpha",
    function(value) {

        var regexp = new RegExp("^[A-Za-z ]+$");
        return !value || regexp.test(value);
    },
    "Please enter letters only"
);

$.validator.addMethod(
    "alpha_dash",
    function(value) {


        var regexp = new RegExp("^[A-Za-z0-9 _-]+$");

        return !value.trim() || regexp.test(value);
    },
    "Please enter alphanumeric characters only."
);

$.validator.addMethod(
    "alpha_num",
    function(value) {
        var regexp = new RegExp("^[A-Za-z0-9]+$");

        return !value.trim() || regexp.test(value);
    },
    "Please enter alphanumeric characters only"
);

$.validator.addMethod(
    "array",
    function(value) {

        return (!value.trim()) ||
            (value instanceof Array);
    },
    "the field must be an array"
);
$.validator.addMethod(
    "boolean",
    function(value) {
        return (!value.trim()) ||
                ($.inArray(value, ['0','1',0,1,true,false])>-1);
    },
    "the field must be a true or false"
);

$.validator.addMethod(
    "confirmed",
    function(value, input) {
       var name = input.name + "_confirmation";
       var other = $("[name="+name + "]").val();
       return (!value.trim() || value.trim()==other);
    },
    "the field must be confirmed"
);

$.validator.addMethod(
    "different",
    function(value, el, param) {

        var otherVal = $("[name=" +param+ "]").val().trim();
        value = value.trim();
        return (otherVal!=value) || (!value && !otherVal);

    },
    ""
);
$.validator.addMethod(
    "digits_between",
    function(value, el, param) {
        var val = parseInt(value);
        var isInt = val && isFinite(val) && value%1===0;
        return (value.length>=param[0] && value.length<=param[1] && isInt) || !value.trim();

    },
    "incorrect value"
);
$.validator.addMethod(
    "digits_value",
    function(value, el, param) {

        var val = parseInt(value);
        var isInt = val && isFinite(val) && value%1===0;
        return (value.length==param && isInt) || !value.trim();

    },
    "incorrect value"
);
$.validator.addMethod(
    "in_array",
    function(value,el,params) {

        return (!value.trim() || $.inArray(value, params)>=0);
    },
    ""
);
$.validator.addMethod(
    "ip",
    function(value) {

        if (!value.trim()) return true;

        var blocks = value.split(".");
        if(blocks.length === 4) {
            return blocks.every(function(block) {
                return parseInt(block,10) >=0 && parseInt(block,10) <= 255;
            });
        }

        return false;

    },
    "Please enter a valid IP address"
);
$.validator.addMethod(
    "length",
    function(value,el,length) {
        $.validator.messages.length =  "The value must be " + length + " characters long";
        value = value.trim();
        return !value || value.length==length;
    },
    ""
);

$.validator.addMethod(
    "not_in_array",
    function(value,el,params) {

        value = value.trim();

        return ($.inArray(value, params)==-1) || !value;
    },
    ""
);

$.validator.addMethod(
    "regex",
    function(value,el,regexp) {
        value = value.trim();
        regexp = regexp.replace(/^\/(.+)\/$/g,"$1");
        var regex = new RegExp(regexp);
        return regex.test(value) || !value;

    },
    "Invalid value"
);

$.validator.addMethod(
    "required_if",
    function(value,el,params) {

        var fieldValue = $("[name="+params[0]+"]").val();

        return !(fieldValue==params[1] && !value.trim());

    },
    "Please enter value for this field"
);
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
$.validator.addMethod(
    "required_with_all",
    function(value,el,fields) {

        var val,present = true;

        fields.forEach(function(field) {
            val = $("[name="+field+"]").val().trim();
            if (!val) present=false;

        });

        return !(present && !value.trim());

    },
    "Please enter value for this field"
);
$.validator.addMethod(
    "required_without",
    function(value,el,fields) {

        var val,present = true;

        fields.forEach(function(field) {
            val = $("[name="+field+"]").val().trim();

            if (!val) present=false;

        });

        return !(!present && !value.trim());

    },
    "Please enter value for this field"
);
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

$.validator.addMethod(
    "same",
    function(value, el, param) {

        var otherVal = $("[name="+param+"]").val().trim();

        return (otherVal==value.trim());

    },
    ""
);
$.validator.addMethod(
    "size",
    function(value,el,number) {

        return !value.trim() || value==number;

    },
    ""
);
$.validator.addMethod(
    "sizelength",
    function(value,el,length) {

        return !value.trim() || value.length==length;

    },
    ""
);