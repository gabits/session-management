<?php

define('STORAGE_DIR', __DIR__ . '/storage');
define('USERS_DATA_FILE', 'users.txt');


function get_file_contents($data_file) {
    // Get an array of each line of the file.
    $file_contents = array();
    if (is_file($data_file) && is_readable($data_file)) {
        $file = fopen($data_file, 'r');
        if ($file !== false) {
            // Get each line of the file and store on an array
            while (!feof($file)) {
                $line = fgets($file);
                if ($line != '') {
                    $file_contents[] = $line;
                };
            };
        fclose($file);
        };
    };
    return $file_contents;
};


function get_data_from_file($file_requested) {
    // Gets the respective data from the file requested.
    // If it cannot be found, returns an error to the user.
    //
    // Arguments:
    //  $file_requested: a string indicating the name of the file
    //
    // Returns:
    //  string: file contents separated by "\n" characters.
    $data = array();

    $error_message = "<p>An error occurred in the server. Try again later.<p>";

    // Check if we can get files from the given directory name
    if (is_dir(STORAGE_DIR)) {
        $storage_dir = opendir(STORAGE_DIR);
    } else {
        echo $error_message;
        return;
    };

    // Then, check if directory is empty
    if (readdir($storage_dir) === false) {
        echo $error_message;
        return;
    };

    // If not empty, attempt to get the data file where users data is stored
    while (false !== ($file_name = readdir($storage_dir))) {
        if ($file_name == $file_requested) {
            $file_path = STORAGE_DIR . "/$file_name";
            $data = get_file_contents($file_path);
        };
    };
    closedir();

    return $data;
};
?>
