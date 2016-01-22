var Script = function () {

    $.validator.setDefaults({
        submitHandler: function() { alert("submitted!"); }
    });

    $().ready(function() {

        // validate signup form on keyup and submit
        $("#signupForm").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 5
                },
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                agree: "required"
            },
            messages: {
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password: {
                    required: "请输入登陆密码",
                    minlength: "密码长度至少为6位"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "两次密码输入不一致"
                },
                email: "Please enter a valid email address",
                agree: "Please accept our policy"
            }
        });
    });
}();