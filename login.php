<?php

$pageTitle = 'Login';

require_once('header.php')

?>

<link rel="stylesheet" href="css/style.css" media="screen" />
<main class="container">
    <h1>Login Or Register</h1>
    <?php

    if (!empty($_GET['invalid']))

        echo '<div class="wrong" id="message">Your password was incorrect</div>';

    else

        echo '<div class="right" id="message">Please log into your account</div>'

    ?>



    <form method="post" action="validate.php">
        <div class="fieldseT">
            <fieldset>
                <legend>Your Login Details</legend>
                  <p><label for="email" class="field">Email:</label>
                      <input name="email"  required type="email" placeholder="email@email.com"></p>

                  <p><label for="password" class="field">Password:</label>
                      <input name="password" required type="password" placeholder="password"></p>

                <p><button style="background-color:steelblue;">Login</button></p>



    </fieldset>

        </div>



    </form>
        <style>






            html {
                background-image: url("images/player.png");
                height: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;

            }

        </style>

</main>
