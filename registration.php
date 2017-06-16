<?php

$pageTitle = 'Registration';

require_once('header.php')

?>

<link rel="stylesheet" href="css/style.css" media="screen" />
<main class="container">
    <?php

    if (!empty($_GET['errorMessage']))

        echo '<div class="alert alert-danger" id="message">Email address already exists</div>';

    else

        echo '<div class="alert alert-info" id="message">Please create your account</div>';



    if (!empty($_GET['userID']))

        $userID = $_GET['userID'];

    else

        $userID = null;



    $titlePicked = null;

    $firstName = null;

    $lastName = null;

    $dateOfBirth = null;

    $username = null;
    $gender = null;

    $email = null;

    $password = null;



    // if the albumID exists, it is an edit situation and we need to

    //load the album from the DB

    if (!empty($userID))

    {

        $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200361570', 'gc200361570', '58cbFxWAZr');



        $sql = "SELECT * FROM tbl_users WHERE userID = :userID";

        $cmd = $conn->prepare($sql);

        $cmd->bindParam(':userID', $userID, PDO::PARAM_INT);

        $cmd->execute();

        $user = $cmd->fetch();

        $conn = null;



        $titlePicked = $user['title'];

        $firstName = $user['firstName'];

        $lastName = $user['lastName'];

        $dateOfBirth = $user['dateOfBirth'];




        $username = $user['username'];

        $gender = $user['gender'];

    }

    ?>





    <form method="post" action="save-registration.php">
        <p class="required">* Required</p>
        <div class="fieldSet">
          <fieldset>
            <legend>Your Details</legend>


              <p><label for="title" class="field"><span>*</span>Title:</label>

              <select id="title" name="title">
                  <?php

                  //Step 1 - connect to the DB
                  $conn = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200361570', 'gc200361570', '58cbFxWAZr');
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  //Step 2 - create the SQL statement
                  $sql = "SELECT * FROM titles";

                  //Step 3 - prepare & execute the SQL statement
                  $cmd = $conn->prepare($sql);
                  $cmd->execute();
                  $titles = $cmd->fetchAll();

                  //Step 4 - loop over the results to build the list with <option> </option>
                  foreach ($titles as $title)
                  {
                      if ($titlePicked == $title['title']){
                          echo '<option selected>'.$title['title'].'</option>';
                      }

                      else{
                          echo '<option>'.$title['title'].'</option>';
                      }
                  }

                  //Step 5 - disconnect from the DB
                  $conn = null;
                  ?>


              </select></p>
              <p><label for="firstName" class="field"><span>*</span>First name:</label>
                 <input  type="text" required name="firstName"
                 value="<?php echo $firstName?>"></p>
              <p><label for="lastName" class="field"><span>*</span>Last name:</label>
                  <input  type="text" required name="lastName"
                          value="<?php echo $lastName?>"></p>
              <p><label for="dateOfBirth" class="field"><span>*</span>Date Of Birth:</label>
                  <input  type="date" required name="dateOfBirth"
                          value="<?php echo $dateOfBirth?>"></p>
              <p><label for="gender" class="field"><span>*</span>Gender:</label>
                  <select id="gender" name="gender">
                      <option value="choose">Please choose…</option>
                      <option value="M">Male</option>
                      <option value="F">Female</option>
                  </select></p>
              <p><label for="email" class="field"><span>*</span>Email:</label>
                  <input type="email" required  name="email"
                         value="<?php echo $email?>"></p>
              <p><label for="username" class="field"><span>*</span>Username:</label>
                  <input type="text" required  name="username"
                         value="<?php echo $username?>"></p>
              <p><label for="password" class="field"><span>*</span>Password:</label>
                  <input type="password" required name="password"  pattern="(?=.*\d)(?=.*[A-Z].{8,}" ></p>
              <p><label for="confirm" class="field"><span>*</span>Confirm Password:</label>
                  <input type="password" required name="confirm"  pattern="(?=.*\d)(?=.*[A-Z].{8,}" ></p>
              <input name="userID" id="userID" value="<?php echo $userID?>" type="hidden"/>
              <p><button style="background-color:blue; color:white;"">Register Now</button></p>
          </fieldset>
        </div>
    </form>
<style>

    html {
        background-image: url("images/2017.jpg");
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

</style>

</main>
</body>
</html>