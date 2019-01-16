<?php
require '../includes/header.php';
?>

<main>
    <h3>Administrator access</h3>
    <p>Provide admin password.</p>

<?php

include_once '../authentication.php';


// TODO: This could be written in a file to be kept separate from the codebase.
define('ADMIN_PASSWORD', 'DCSadmin01');


// Require admin password
function display_admin_access_form() {
    $self = htmlentities($_SERVER['PHP_SELF']);
    echo "<div>";
    echo "  <form method=\"post\" action=\"$self\">";
    echo "    <div>";
    echo "        <label for=\"admin-password\">";
    echo "            <input type=\"password\" name=\"admin-password-field\" id=\"admin-password\" />";
    echo "        </label>";
    echo "    </div>";
    echo "    <div>";
    echo "      <input type=\"submit\" name=\"submit\" value=\"Access\">";
    echo "    </div>";
    echo "  </form>";
    echo "</div>";
};


function attempt_admin_access ($is_submitted) {
    if ($is_submitted) {
        $is_password_correct = ADMIN_PASSWORD == $_POST['admin-password-field'];
        if ($is_password_correct) {
            $_SESSION['admin_access'] = true;
            redirect_to('../administrator.php');
        } else {
            echo '<p>Incorrect password.</p>';
        };
    };
    display_admin_access_form();
};


function process_admin_access_form () {
    $is_submitted = false;
    if (isset($_POST)) {
        if (isset($_POST['submit'])) {
            $is_submitted = true;
        };
    };
    attempt_admin_access($is_submitted);
};


process_admin_access_form();


require '../includes/footer.php';

?>
