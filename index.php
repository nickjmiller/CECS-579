<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Secure Vote Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="stylesheets/main.css" />
        <script type="text/JavaScript" src="scripts/sha512.js"></script>
        <script type="text/JavaScript" src="scripts/forms.js"></script>
    </head>
    <body>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
        ?>
        <div class="form">
        <img src="stylesheets/securevote_logo.png" alt="logo"> 
        <form action="includes/process_login.php" method="post" name="login_form">
            VoterID: <input type="text" name="voterID" /> <br><br>
            VoterKey: <input type="password"
                             name="voterKey"
                             id="voterKey"/> <br><br><br>
            <input type="button"
                   value="Login"
                   onclick="formhash(this.form, this.form.voterKey);" /> <br><br>
        </form>
        </div>

<?php
        if (login_check($mysqli) == true) {
                        echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['voterID']) . '.</p>';
            echo '<div class="info"><p>Go to the <a href="protected_page.php">voting</a> page.</p>';
            echo '<p>Do you want to change user? <a href="includes/logout.php">Log out</a>.</p></div>';
        } else {
                        echo '<div class="info"><p>Currently logged ' . $logged . '.</p>';
                        echo "<p>If you don't have a login, please visit your DMV to register. </p></div>";
                }
?>
    </body>
</html>
