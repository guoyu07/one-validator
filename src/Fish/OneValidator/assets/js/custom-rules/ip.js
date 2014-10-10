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