<?php
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <script type="text/JavaScript" src="scripts/sha512.js"></script>
        <script type="text/JavaScript" src="scripts/forms.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="stylesheets/main.css" />
    </head>
    <body>
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <h1>Register to Vote!</h1>
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>

        <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>"
                method="post"
                name="registration_form">
            VoterID: <input type='text'
                name='voterID'
                id='voterID' /><br>
            VoterKey: <input type="password"
                             name="voterKey"
                             id="voterKey"/><br>
            Confirm voterKey: <input type="password"
                                     name="confirmKey"
                                     id="confirmKey" /><br>
            <input type="button"
                   value="Register"
                   onclick="return regformhash(this.form,
                                   this.form.voterID,
                                   this.form.voterKey,
                                   this.form.confirmKey);" />
        </form>
        <p>Return to the <a href="index.php">login page</a>.</p>
    </body>
</html>
