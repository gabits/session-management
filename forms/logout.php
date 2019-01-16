<?php

include_once 'authentication.php';


function display_logout_form() {
    $self = htmlentities($_SERVER['PHP_SELF']);
    $username = $_SESSION['user']['username'];
    echo "<div>";
    echo "  <form method=\"post\" action=\"$self\">";
    echo "      <p>";
    echo "          <span>Logged in as <b>$username</b>. ";
    echo "              <input type=\"submit\" name=\"logout\" value=\"Logout\">";
    echo "          </span>";
    echo "      </p>";
    echo "  </form>";
    echo "</div>";
};


function process_logout($logout) {
    if ($logout) {
        // Get session data
        destroy_session_and_cookies();
        redirect_to('index.php');
    } else {
        display_logout_form();
    };
};


function process_logout_or_display_navbar() {
    if (is_user_authenticated()) {
        $logout = false;
        if (isset($_POST['logout'])) {
            $logout = true;
        };
        process_logout($logout);
    }
};


process_logout_or_display_navbar();
?>
