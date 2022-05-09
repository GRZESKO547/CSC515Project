<?php
if ($_SERVER['REQUEST_METHOD']=="POST"){

  $servername = "localhost";
  $username = "root";
  $password = "";
  $database="myDB";
  $table="Users";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password,$database);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected successfully";
  echo "<br>";
  
  if($result=$conn->query("SHOW TABLES LIKE '".$table."'")){
    if($result->num_rows==1){
      print("Getting Inputs");
      $firstname=$_POST['firstname'];
      $lastname=$_POST['lastname'];
      $email=$_POST['email'];
      $phone=$_POST['mobile'];
      $gender=$_POST['gender'];
      
      if ($gender=='Male'){
        
        $gender=1;
      }else{
        
        $gender=2;
      }
      $city=$_POST['city'];
      $state=$_POST['state'];
      
      switch ($_POST['qual']){
        case "GRADUATION":
          $qualification=1;
          break;
        
      case "BTECH":
        $qualification=2;
        break;

      case "MTECH":
        $qualification=3;
        break;

      case "MCA":
        $qualification=4;
        break;

      case "BCA":
        $qualification=5;
        break;
    
      }
      $password=$_POST['password'];

      // echo "<br>";
      // echo $firstname;
      // echo "<br>";
      // echo $lastname;
      // echo "<br>";
      // echo $email;
      // echo "<br>";
      // echo $phone;
      // echo "<br>";
      // echo $gender;
      // echo "<br>";
      // echo $city;
      // echo "<br>";
      // echo $state;
      // echo "<br>";
      // echo $qualification;
      // echo "<br>";
      // echo $password;

      // database insert SQL code
      $sql = "INSERT INTO $table (`firstname`, `lastname`, `email`, `phone`,`gender`,`city`,`state`,`qualification`,`password`) VALUES 
      ('$firstname', '$lastname', '$email','$phone','$gender','$city','$state','$qualification','$password')";
      
      // insert in database 
      $rs = mysqli_query($conn, $sql);

      if($rs)
      {
	      echo "Contact Records Inserted";
      }
      
    }
    else{
      // sql to create table
      $sql = "CREATE TABLE $table (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(255) NOT NULL,
        lastname VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone INT(20) NOT NULL,
        gender ENUM('MALE','FEMALE') NOT NULL,
        city VARCHAR(255) NOT NULL,
        state VARCHAR(255) NOT NULL,
        qualification ENUM('GRADUATE','BTECH','MTECH','MCA','BCA') NOT NULL,
        password VARCHAR(40) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

      if (mysqli_query($conn, $sql)) {
        echo "Table"+$table+"created successfully";
        echo "<br>";
      } else {
        echo "Error creating table: " . mysqli_error($conn);
        echo "<br>";
      }
      
    }
    mysqli_close($conn);
  }
  
}

?>