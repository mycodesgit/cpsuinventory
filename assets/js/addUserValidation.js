$(function () {
    $('#addUser').validate({
        rules: {
            fname: {
                required: true
            },
            mname: {
                required: true
            },
            lname: {
                required: true
            },
            username: {
                required: true,
                minlength: 5
            },
            password: {
                required: true,
                minlength: 5
            },
            emp_gender: {
                required: true
            },
            usertype: {
                required: true
            },
        },
        messages: {
            fname: {
                required: "Please enter a First Name"
            },
            mname: {
                required: "Please enter a Middle Name"
            },
            lname: {
                required: "Please enter a Last Name"
            },
            username: {
                required: "Please enter a username",
                minlength: "Your username must be at least 5 characters long"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            emp_gender: {
                required: "Please select a Gender"
            },
            usertype: {
                required: "Please select a User Type"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-12').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            $(element).removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).addClass('is-valid');
        }
    });
    $('#username').on('keyup', function () {
        var username = $(this).val();
        var $usernameStatus = $('#usernameStatus');
        if (username !== '') {
            $.ajax({
                url: 'actions/check_username.php',
                type: 'POST',
                data: {username: username},
                success: function(response) {
                    if (response === 'available') {
                        $usernameStatus.text('Username is available').removeClass('text-danger').addClass('text-success');
                    } else {
                        $usernameStatus.text('Username is taken').removeClass('text-success').addClass('text-danger');
                    }
                }
            });
        } else {
            $usernameStatus.empty();
        }
    });
});