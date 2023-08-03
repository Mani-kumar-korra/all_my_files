define(function (require) {
    return {
        checkUserSession: function () {
            alert("Working");
            // var $ = require("./code.jquery.com_jquery-3.7.0.min");
            console.log($("#search-form"));
            //todo: send ajax request from here to a php file where it checks if the user has signed in or not.
            $.ajax({
                url: window.location.origin+'/checkUserSession.php',
                type:'POST',
                cache:false,
                async:false,
                success:function(response){
                    alert(response);
                },
                error:function(response){
                    alert(response);
                }
            })
            //tODO: we will do the redirection here itself
            //TODO: we can print the customer name using the
        }
    };
});
