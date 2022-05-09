<?php
    function format_input($input) {
        $input = trim($input); //remove leading and trailing whitespace
        $input = htmlspecialchars($input); //formats special characters, prevent xss
        return $input;
    }

    if (isset($_POST['fname'])){
        echo (var_dump($_POST));
        $fname = format_input($_POST['fname']);
        $lname = format_input($_POST['lname']);
        $email = format_input($_POST['email']);
        $phone = format_input($_POST['phone']);
        $gender = format_input($_POST['gender']);
        $city = format_input($_POST['city']);
        $state = format_input($_POST['state']);
        $qualifications = format_input($_POST['qualifications']);
        $password = format_input($_POST['password']);

        if(!$fname or preg_match("/^[a-zA-Z'\s]{1,30}$/", $fname) < 1){
            echo "error with fname";
            return;
        }
        if(!$lname or preg_match("/^[a-zA-Z'\s]{1,30}$/", $lname) < 1){
            echo "error with lname";
            echo $lname;
            return;
        }
        if(!$email or preg_match("/[a-z0-9\-\_\.\']+@[a-z0-9]+\.com|edu/", $email) < 1){
            echo "error with email";
            return;
        }
        if(!$phone or strlen($phone) != 10){
            echo "error with phone";
            return;
        }
        if(!$gender){
            echo "error with gender";
            return;
        }
        if(!$city){
            echo "error with city";
            return;
        }
        if(!$state){
            echo "error with state";
            return;
        }
        if(!$qualifications){
            echo "error with qualifications";
            return;
        }
        if(!$password or preg_match("/\A(?=[^a-z]*[a-z])(?=(?:[^A-Z]*[A-Z]))(?=\D*\d).*/", $password) < 1){
            echo "error with password\n";
            return;
        }
        echo "Valid Input";
        $phone = intval($phone);
    }
    else{
        echo "No input recieved. Try again";
        exit;
    }
    
    //Upload to database
    $servername = "localhost";
    $username = "root";
    $pword = "";
    $dbname = "project";

    $conn = mysqli_connect($servername, $username, $pword, $dbname);

    if (!$conn) {
        die("Connection failed. ".mysqli_connect_error());
    }
    else{
        echo "conn is good.";
    }
    $sql = "INSERT INTO registered (fname, lname, email, phone, gender, city, state, qualification, password) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssisssss', $fname, $lname, $email, $phone, $gender, $city, $state, $qualifications, $password);

    mysqli_stmt_execute($stmt);

    mysqli_close($conn);
?>

