<?php 

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $q = "SELECT * FROM users WHERE username = ? LIMIT 1";
    $stmt = $DB->prepare($q);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $check = $stmt->get_result();

    if ($check && $check->num_rows) {
        $user = $check->fetch_assoc();
        if ($user['status'] == 0) {
            set_message("Your account is not yet activated.", "danger");
            redirect(LOGIN_REDIRECT);
        } else if ($user['log_status'] == 0) {
            if (password_verify($password, $user['password'])) {
                $_SESSION[AUTH_ID] = $user['id'];
                $_SESSION[AUTH_NAME] = $user['username'];
                $_SESSION[AUTH_TYPE] = $user['usertype'];
                $_SESSION[AUTH_TOKEN] = $user['token'];
                set_message("Welcome back {$user['fname']}!", 'success');
                // Update user status to "logged in"
                $update = "UPDATE users SET log_status = ? WHERE id = ?";
                $stmt = $DB->prepare($update);
                $logged_in_status = 1; // "Logged in" status
                $stmt->bind_param("ii", $logged_in_status, $user['id']);
                $stmt->execute();
                redirect();
            } else {
                set_message("Invalid login, please try again.", "danger");
            }
        } else {
            set_message("Your account is already logged in.", "danger");
        }
    } else {
        set_message("Invalid login, please try again.", "danger");
    }
} else {
    set_message("You must specify the username and password.", "danger");
}

?>