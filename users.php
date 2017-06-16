<?php

$pageTitle = 'User List';

require_once('header.php');

?>
<link rel="stylesheet" href="css/style.css" media="screen" />

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
    html {
        background-color: lightgoldenrodyellow;
    }

</style>
<main class="container">

    <h1>User List</h1>

    <?php



    //step 1 - connect to the database

    $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200361570', 'gc200361570', '58cbFxWAZr');



    //step 2 - create a SQL command

    $sql = "SELECT * FROM tbl_users";



    //step 3 - prepare the SQL command

    $cmd = $conn->prepare($sql);



    //step 4 - execute and store the results

    $cmd->execute();

    $tbl_users = $cmd->fetchAll();



    //step 5 - disconnect from the DB

    $conn = null;



    //create a table and display the results

    echo '<table>

            <tr><th>Title</th>

                <th>First Name</th>

                <th>Last Name</th>

                <th>Date Of Birth</th>
                
                <th>Gender</th>

                <th>Email</th>';



    if (!empty($_SESSION['email'])){

        echo '<th>Edit</th>

                  <th>Delete</th>';

    }



    echo '</tr>';



    foreach($tbl_users as $user)

    {

        echo '<tr><td>'.$user['title'].'</td>

                      <td>'.$user['firstName'].'</td>

                      <td>'.$user['lastName'].'</td>

                      <td>'.$user['dateOfBirth'].'</td>
                      
                      <td>'.$user['gender'].'</td>
                      
                      <td>'.$user['email'].'</td>';



        //only show the edit and delete links if these are valid, logged in users

        if (!empty($_SESSION['email'])){

            echo '<td><a href="registration.php?userID='.$user['userID'].'"><button>Edit</button></a></td>

                      <td><a href="deleteInfo.php?userID='.$user['userID'].'" 

                             <a href="deletelink" onclick="return confirm(\'Are you sure you want to delete ?\')"><button>Delete</button></a></a></td>';

        }

        echo '</tr>';

    }



    echo '</table></main>';




    ?>

</main>