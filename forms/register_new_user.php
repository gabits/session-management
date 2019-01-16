<?php

require '../includes/header.php';
require '../utils.php';
require '../users.php';
require '../authentication.php';


require_admin_access();


function parse_new_staff_user_form($post, $is_submitted) {
    $errors = array();

    if ($is_submitted) {
        // Validate data inputted
        $validation_result = validate_new_staff_user($_POST);
        $errors = $validation_result['errors'];
        if (isset($validation_result['new_staff_details'])) {
            $new_staff_details = $validation_result['new_staff_details'];
        };
    };

    // If form was submitted and is valid, redirect the user and log them in
    if ($is_submitted == true && count($errors) == 0) {
        register_new_staff($new_staff_details);
        echo "<p>User registered successfully!</p>";
    } elseif ($is_submitted == true && count($errors) > 0) {
        foreach ($validation_result['errors'] as $error) {
            echo "<p>$error</p>";
        };
    };
    display_new_staff_user_form();
};


function display_new_staff_user_form() {
    // Render the HTML form with the action submission to itself
    $self = htmlentities($_SERVER['PHP_SELF']);
    echo "<h3>Register a new user</h3>";
    echo "<div id=\"admin-form\">";
    echo "  <form method=\"post\" action=\"$self\">";
    echo "    <div>";
    echo "      <label for=\"first-name\">First name";
    echo "          <input type=\"text\" name=\"first-name-field\" id=\"first-name\" />";
    echo "      </label></div>";
    echo "    <div>";
    echo "      <label for=\"surname\">Surname";
    echo "          <input type=\"text\" name=\"surname-field\" id=\"surname\" />";
    echo "      </label></div>";
    echo "    <div>";
    echo "      <label for=\"email\">Email";
    echo "          <input type=\"text\" name=\"email-field\" id=\"email\" />";
    echo "      </label></div>";
    echo "    <div>";
    echo "      <label for=\"username\">Username";
    echo "          <input type=\"text\" name=\"username-field\" id=\"username\" />";
    echo "      </label></div>";
    echo "    <div>";
    echo "      <label for=\"user-password\">User password";
    echo "          <input type=\"password\" name=\"password-field\" id=\"user-password\" />";
    echo "      </label></div>";
    echo "    <div>";
    echo "      <input type=\"submit\" name=\"submit\" value=\"Create\">";
    echo "    </div>";
    echo "  </form>";
    echo "</div>";
};


$form_is_submitted = false;
// If post is set, perform validation
if (isset($_POST['submit'])) {
    $form_is_submitted = true;
};
parse_new_staff_user_form($_POST, $form_is_submitted);


include '../includes/footer.php';
?>
