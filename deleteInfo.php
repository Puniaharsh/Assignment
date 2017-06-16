<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Information</title>
</head>
<body>
<?php

if (!empty($_GET['userID']) ) {
    $userID = $_GET['userID'];
    //Step 1 - connect to the database
    $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200361570', 'gc200361570', '58cbFxWAZr');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // turn on the error handling


    //Step 2 - create the SQL statement
    $sql = " DELETE FROM tbl_users
            WHERE userId=:userID";


    //Step 3 - prepare and execute the sql statement
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':userID', $userID, PDO::PARAM_INT);
    $cmd->execute();


    //Step 4 - disconnect from the DB
    $conn = null;
}

//step 5 - redirect back to the albums.php page
header('location:users.php');
?>

</body>
</html>