<!DOCTYPE html >
<html lang = "en" >
<head >
    <meta charset = "UTF-8" >
    <title ><?php echo $pageTitle ?></title >
<style>
ul{
    padding: 0;
    margin: 0;
    float: left;
    background-color: steelblue;
    width: 100%;
    list-style-type: none;
}
    li{
        float:left;
        position: relative;
    }
    li a{

        background-color: steelblue;
        display: block;
        padding: 2em;
        color: white;
        text-decoration: none;
    }
li a:hover {
    background-color: grey;
    color: white;
}
li:hover ul {
    left: auto;
}

</style>
</head >
<body>
<img src="images/Players_Logo1.png" alt="logo"/>
<nav>
    <ul>
        <li><a href="default.php" >Sports</a></li>
        <li><a href="users.php">Badminton Players</a></li>
        <?php
        session_start();
        //public(not logged in) links
        if(empty($_SESSION['email']))
        {
            echo' <li><a href="registration.php">Register</a></li>
                 <li><a href="login.php">Login</a></li>';
        }
        //private / logged in links
        else
        {

             echo'   <li><a href="logout.php">Logout</a></li>';
        }


        ?>

    </ul>
</nav>
