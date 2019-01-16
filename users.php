<?php

require_once 'common.php';
require_once 'utils.php';


function get_user_record ($username, $registered_users) {
    // Returns an array with a boolean on whether is the user registered and
    // the records found for them.
    // First, check if user is registered
    $register_record = array(
        'is_registered' => false,
    );
    $user_record = array();
    foreach ($registered_users as $registered_user) {
        $row_data = explode("|", $registered_user);
        $user_record = trim_array_values($row_data);
        // Check if the 'username' column contains the user inputted string
        if ($user_record[4] == $username) {
            $register_record = array(
                'is_registered' => true,
                'user_data' => $user_record
            );
            break;
        };
    };
    return $register_record;
};


function get_users_data () {
    // Returns an array with all users registered in the system.
    $users_data = get_data_from_file(USERS_DATA_FILE);
    return $users_data;
};


function get_user_attributes ($users_data) {
    // Returns an array with user attributes stored (strings)
    $file_header = $users_data[0];
    $attributes = explode("|", $file_header);
    $attributes = trim_array_values($attributes);
    return $attributes;
};


function get_registered_users ($users_data) {
    // Returns an array of user records (strings)
    $registered_users_record = array_slice($users_data, 1, count($users_data));
    return $registered_users_record;
};


function does_username_exist_already() {
    $users_data = get_users_data();
    $user_attributes = get_user_attributes($users_data);
    $registered_users = get_registered_users($users_data);

    // First, check if the user is not registered
    $register_record = get_user_record($username, $registered_users);
    if ($register_record['is_registered'] == true) {
        $errors[] = 'This username already exists.';
    };
};


function validate_new_staff_user($data) {
    $data_without_password = $data;
    unset($data_without_password['password']);
    $cleaned_data = clean_data($data_without_password);
    $errors = validate_empty_fields($cleaned_data);
    // If no field provided is empty, proceed to validate input type
    $validated_result = array(
        'errors' => $errors,
        'new_staff_details' => $cleaned_data
    );
    return $validated_result;
};


function register_new_staff($new_staff_details) {
    $new_user_record = '';
    $new_user_record .= $new_staff_details['first-name-field'];
    $new_staff_details = array_slice($new_staff_details, 1, count($new_staff_details));
    foreach ($new_staff_details as $detail) {
        $new_user_record .= '   |   ';
        $new_user_record .= $detail;
    };
    $file_path = STORAGE_DIR . "/" . USERS_DATA_FILE;
    $users_file = fopen($file_path, "w");
    fwrite($users_file, $new_user_record);
    fclose($users_file);
};
?>
