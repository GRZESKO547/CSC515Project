<?php
    echo ("ur mom");
    function validate_form($input) {
        $input = trim($input);
        $input = trimslashes($input);
        $input = htmlspecialchars($input);
        echo ($input);
        return $input;
    }

    if (isset($_POST['form_submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $qualifications = $_POST['qualifications'];
        $password = $_POST['password'];
    }
    echo ("ur mom");
?>

