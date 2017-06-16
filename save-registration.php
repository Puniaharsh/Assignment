<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Saving User Registration</title>

</head>

<body>

<?php

//after the client side validation is complete,

//we need to perform server side validation as well.
$userID = $_POST['userID'];
$title = $_POST['title'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$dateOfBirth = $_POST['dateOfBirth'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$userName = $_POST['username'];

$ok = true;



if (empty($email)){

    echo 'email cannot be empty <br />';

    $ok = false;

}



if (strlen($password) < 8){

    echo 'password must be greater than or equal to 8 characters';

    $ok = false;

}



if ($password != $confirm){

    echo 'password must match';

    $ok = false;

}



//if it looks like an ok user, save to the DB

if ($ok) {
    $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200361570', 'gc200361570', '58cbFxWAZr');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!empty($userID)) {
        $sql = "UPDATE tbl_users  

                   SET title = :title,
                   
                        firstName = :firstName,
                        
                        lastName = :lastName,
                        
                        dateOfBirth = :dateOfBirth,
                        
                        gender= :gender, 
                        
                        email = :email,
                       
                       username = :username,
                       
                       password = :password
                       
                WHERE userID = :userID";
    } else {


        $sql = "Insert into tbl_users (title, firstName, lastName, dateOfBirth, gender, email, username, password)
                values(:title, :firstName, :lastName, :dateOfBirth, :gender, :email, :username, :password)";
    }
        //hash the password

        $password = password_hash($password, PASSWORD_DEFAULT);


        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':title', $title, PDO::PARAM_STR, 5);
        $cmd->bindParam(':firstName', $firstName, PDO::PARAM_STR, 30);
        $cmd->bindParam(':lastName', $lastName, PDO::PARAM_STR, 30);
        $cmd->bindParam(':dateOfBirth', $dateOfBirth, PDO::PARAM_STR, 9999 - 12 - 31);
        $cmd->bindParam(':gender', $gender, PDO::PARAM_STR, 6);
        $cmd->bindParam(':email', $email, PDO::PARAM_STR, 120);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
        if (!empty($userID)) {
            $cmd->bindParam(':userID', $userID, PDO::PARAM_INT);
        }


        $cmd->execute();






        //Step 4 - disconnect from the DB

        $conn = null;


        //Step 5 - redirect to the login page

          header('location:login.php');


}

?>

</body>
</html>