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