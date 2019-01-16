<link rel="stylesheet" type="text/css" href="css/main.css">
<main>
    <h3>Log in</h3>
    <p>Please log in as a staff user to get access to module results.</p>

<?php

require '../includes/header.php';
require_once '../utils.php';
include_once '../authentication.php';


function parse_login_form($post, $is_submitted) {
    $errors = array();
    $user_details = array();

    if ($is_submitted) {
        $username = $post['username-field'];
        $password = $post['password-field'];
        // Validate data inputted
        $validation_result = validate_login($username, $password);
        $errors = $validation_result['errors'];
        if (isset($validation_result['user_details'])) {
            $user_details = $validation_result['user_details'];
        };
    };

    // If form was submitted and is valid, redirect the user and log them in
    if ($is_submitted == true && count($errors) == 0) {
        user_login($user_details);
        if (is_user_authenticated()) {
            redirect_to('../intranet.php');
        };
    } elseif ($is_submitted == true && count($errors) > 0) {
        foreach ($validation_result['errors'] as $error) {
            echo "<p>$error</p>";
        };
    };
    display_login_form();
};


function display_login_form() {
    // Render the HTML form with the action submission to itself
    $self = htmlentities($_SERVER['PHP_SELF']);
    echo "<div id=\"login-form\">";
    echo "  <form method=\"post\" action=\"$self\">";
    echo "      <div>";
    echo "          <label for=\"username\">";
    echo "                <input type=\"text\" name=\"username-field\" id=\"username\" />";
    echo "        </label>";
    echo "      </div>";
    echo "      <div>";
    echo "          <label for=\"user-password\">";
    echo "              <input type=\"password\" name=\"password-field\" id=\"user-password\" />";
    echo "          </label>";
    echo "      </div>";
    echo "    <div>";
    echo "      <input type=\"submit\" name=\"submit\" value=\"Log in\">";
    echo "    </div>";
    echo "  </form>";
    echo "</div>";
};


$form_is_submitted = false;
// If post is set, perform validation
if (isset($_POST['submit'])) {
    $form_is_submitted = true;
};
parse_login_form($_POST, $form_is_submitted);


include '../includes/footer.php';
?>

</main>
