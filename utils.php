<?php

function trim_array_values($array_to_clean) {
    // Clean trailing whitespaces in each value of an array.
    $cleaned_array = array();
    foreach ($array_to_clean as $key => $value) {
        $cleaned_value = trim($value);
        $cleaned_array[$key] = $cleaned_value;
    };
    return $cleaned_array;
};


function clean_data ($data) {
    // Given an array, trims whitespaces
    $cleaned_data = trim_array_values($data);
    return $cleaned_data;
};


function redirect_to($redirect_url) {
    echo "$redirect_url/" . SID;
    header("Location: $redirect_url");
};


function validate_empty_fields ($cleaned_data) {
    // Given an array with cleaned strings, validates fields which might be empty
    // and return an array with the errors found, if any.
    $errors = array();
    foreach ($cleaned_data as $field => $value) {
        if (strlen($value) == 0) {
            $errors[] = "Please provide a $field.";
        };
    };
    return $errors;
};
?>
