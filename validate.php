<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Validating user</title>

</head>

<body>



<?php

$email = $_POST['email'];

$password = $_POST['password'];




//Step 1 - connect to the DB

$conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200361570', 'gc200361570', '58cbFxWAZr');
echo 'made established DB connection';



//Step 2 - create SQL query

$sql = "SELECT email,password FROM tbl_users WHERE email = :email";



//Step 3 - prepare and execute query

$cmd = $conn->prepare($sql);

$cmd->bindParam(':email', $email, PDO::PARAM_STR, 120);

$cmd->execute();

$user = $cmd->fetch();



//Step 4 - validate the user

if (password_verify($password, $user['password']))

{

    session_start();

    $_SESSION['email'] = $user['email'];


   header('location:users.php');

}

else

{

   header('location:login.php?invalid=true');

}



//Step 5 - disconnect from the DB

?>



</body>

</html>