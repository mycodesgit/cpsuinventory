$(document).ready(function() {
    // Event listener for username input
    $('#username').on('input', function() {
        var username = $(this).val();
        if (username !== '') {
            // Send AJAX request to check username availability
            $.ajax({
                url: 'actions/check_username.php',
                type: 'POST',
                data: {username: username},
                success: function(response) {
                    if (response === 'available') {
                        $('#usernameStatus').text('Username is available');
                        $('#addUser input[type="submit"]').prop('disabled', false);
                        $('#usernameStatus').removeClass('text-danger').addClass('text-success');
                    } else {
                        $('#usernameStatus').text('Username is taken');
                        $('#addUser input[type="submit"]').prop('disabled', true);
                        $('#usernameStatus').removeClass('text-success').addClass('text-danger');
                    }
                }
            });
        } else {
            $('#usernameStatus').empty();
            $('#addUser input[type="submit"]').prop('disabled', true);
        }
    });
});