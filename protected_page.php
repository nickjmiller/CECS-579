<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Protected Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="stylesheets/main.css" />
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
            <div class="info">
            <p>Welcome <?php echo htmlentities($_SESSION['voterID']); ?>!</p>
                <?php if(voted_check($mysqli) == true): ?>
                    <p>Thanks for voting. View the results here!</p>
                <?php else : ?>
                    <p> You still have to vote! </p>
            </div>
            <div class="form">
                    <form action="includes/process_vote.php" method="post" name="vote_form">
                        <fieldset>
                            <h2> Choice for President</h2>
                            <input type="radio" name="pres" value="1"> Candidate 1<br>
                            <input type="radio" name="pres" value="2"> Candidate 2<br>
                            <input type="radio" name="pres" value="0"> Abstain <br><br>
                        </fieldset>
                        <fieldset>
                            <h2> Choice for Propsition 1 </h2>
                            <input type="radio" name="prop" value="1"> Yes <br>
                            <input type="radio" name="prop" value="2"> No <br>
                            <input type="radio" name="prop" value="0"> Abstain<br>
                        </fieldset><br>
                    <input type="submit"
                           value="Vote" /><br><br>
                    </form>
                    <?php endif;?>
        </div>
        <div class="info">
            
            <p><a href="includes/logout.php">Log out</a></p>
            <p>Return to <a href="index.php">login page</a></p>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
        </div>
    </body>
</html>
