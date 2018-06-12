$(document).ready(function() {
    $('#amount').focus(function() {
        this.value = "";
      });

    $('#amount').blur(function() {
        if($(this).val() == ""){
            this.value = "100";
         }
    });

    $('#curr-select').focus(function() {
        this.value = "";
      });

    $('#curr-select').blur(function() {
        if($(this).val() == ""){
            this.value = "Australian Dollar";
         }
    });

    //validation methods
    $.validator.addMethod('valPwd', function(value, element) {
        return value.length >=6;
    }, 'Password must contain atleast 6 characters');

    $("#userLogin").validate({
       rules: {
           username: {
               required: true,
               nowhitespace: true
           },
           pwd: {
                required: true,
                nowhitespace: true,
                valPwd: true
           }
       },
       messages: {
           email: {
               required: 'Please enter an email address',
               email: 'Please enter a valid email address'
           },
           confirm_pwd: "Password does not match"
       },
       errorClass:'d5 errormsg'
       
   });

    $("#reg-form").validate({
       rules: {
           email: {
               required: true,
               nowhitespace: true,
               email: true
           },
           username: {
               required: true,
               nowhitespace: true
           },
           pwd: {
                required: true,
                nowhitespace: true,
                valPwd: true
           },
           confirm_pwd: {
               required: true,
               equalTo: "#pwd"
           },
           fName: {
               required: true,
               nowhitespace: true,
               lettersonly: true
           },
           lName: {
               required: true,
               nowhitespace: true,
               lettersonly: true
           },
           address: {
               required: true
           },
           city: {
               required: true,
               lettersonly: true
           },
           postcode: {
               required: true
           }
       },
       messages: {
           email: {
               required: 'Please enter an email address',
               email: 'Please enter a valid email address'
           },
           confirm_pwd: "Password does not match"
       },
       errorClass:'d5 errormsg'
       
   });
});