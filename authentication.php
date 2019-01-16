<?php

require_once 'common.php';
require_once 'utils.php';
require_once 'users.php';


function user_login ($user_details) {
    // Stores the information provided by the user as an argument in the session.
    //
    // For security reasons, the password is not stored as it is only required
    // during authentication and not for further identification.
    // Clear the session
    $_SESSION = array();
    $_SESSION['user'] = $user_details;
    $_SESSION['is_user_authenticated'] = true;
};


function destroy_session_and_cookies () {
    // Reset the data stored in the session
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        // Expire cookies in the user browser
        $yesterday = time() - (24 * 60 * 60);
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            $yesterday,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    };
    session_destroy();
}


function require_authentication() {
    if (!is_user_authenticated()) {
        redirect_to('forms/login.php');
    };
};


function require_admin_access() {
    if (!does_user_have_admin_access()) {
        redirect_to('forms/admin_access.php');
    };
};


function is_user_authenticated () {
    // Returns a boolean with the value true if the user is logged
    // into the system and false otherwise.
    //
    // Given the session information is stored by the server, it is
    // considerably secure to check for a value stored on it.
    $is_authenticated = false;
    if (!isset($_SESSION)) {
        session_start();
    };

    if (array_key_exists('is_user_authenticated', $_SESSION)) {
        $is_authenticated = $_SESSION['is_user_authenticated'];
    };
    return $is_authenticated;
};


function does_user_have_admin_access () {
    $has_admin_access = false;
    if (!isset($_SESSION)) {
        session_start();
    };

    if (array_key_exists('admin_access', $_SESSION)) {
        $has_admin_access = $_SESSION['admin_access'];
    };
    return $has_admin_access;
};


function get_user_details ($user_attributes, $user_record) {
    $n_of_attrs = count($user_attributes);
    $user_details = array();
    for ($i=0; $i<$n_of_attrs; $i++) {
        $attribute = $user_attributes[$i];
        $data_value = $user_record[$i];
        $user_details[$attribute] = $data_value;
    };
    return $user_details;
};


function is_password_valid ($password, $user_data) {
    // Returns a boolean on whether does the inputted password match
    // the one in the user records.
    $is_valid = $password == $user_data['password'];
    return $is_valid;
};


function validate_login ($username, $password) {
    // Validates user input in the login form.
    //
    // Clean whitespaces which may have been inputted with the username,
    // but not with the password.
    $data_to_clean = array(
        'username' => $username
    );
    $cleaned_data = clean_data($data_to_clean);

    // Then, append the inputted password to the filtered data
    $cleaned_data['password'] = $password;
    $errors = validate_empty_fields($cleaned_data);

    // If no field provided is empty, proceed to validate username and password
    if (count($errors) == 0) {
        $validated_login = get_and_validate_user_details(
            $cleaned_data['username'],
            $cleaned_data['password']
        );
    } else {
        $validated_login = array('errors' => $errors);
    };
    return $validated_login;
};


function get_and_validate_user_details($username, $password) {
    // Consults the data storage to check whether is this user registered
    // in the system. If they are, verify that the inputted password matches
    // the one stored.
    $result = array(
        'errors' => array()
    );

    $users_data = get_users_data();
    $user_attributes = get_user_attributes($users_data);
    $registered_users = get_registered_users($users_data);

    // First, check if the user is not registered
    $register_record = get_user_record($username, $registered_users);
    if (!$register_record['is_registered']) {
        $result['errors'][] = 'This user is not registered in the system.';
    } else {
        // If they are, proceed to validate the password
        $user_details = get_user_details(
            $user_attributes,
            $register_record['user_data']
        );
        if (!is_password_valid($password, $user_details)) {
            $result['errors'][] = 'Incorrect password.';
        } else {
            // Remove the password from the user details to be returned
            unset($user_details['password']);
            $result['user_details'] = $user_details;
        };
    };
    return $result;
};
?>
