<?php
include_once 'db_connect.php';
include_once 'db_config.php';

$error_msg = "";

if (isset($_POST['voterID'], $_POST['k'])) {
    // Sanitize and validate the data passed in
    $voterID = filter_input(INPUT_POST, 'voterID', FILTER_SANITIZE_STRING);

    $voterKey = filter_input(INPUT_POST, 'k', FILTER_SANITIZE_STRING);
    if (strlen($voteKey) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid key configuration.</p>';
    }

    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //

    $prep_stmt = "SELECT voterID FROM voters WHERE voterID = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

   // check existing email
    if ($stmt) {
        $stmt->bind_param('s', $voterID);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $error_msg .= '<p class="error">A user with this ID already exists.</p>';
                        $stmt->close();
        }
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt->close();
    }


    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.

    if (empty($error_msg)) {

        // Create hashed password using the password_hash function.
        // This function salts it with a random salt and can be verified with
        // the password_verify function.
        $voterKey = password_hash($voterKey, PASSWORD_BCRYPT);
        $hasLoggedIn = true;
        // Insert the new user into the database
        if ($insert_stmt = $mysqli->prepare("INSERT INTO voters (voterID, voterKey, hasLoggedIn) VALUES (?, ?, ?)")) {
            $insert_stmt->bind_param('sss', $voterID, $voterKey, $hasLoggedIn);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }
        header('Location: ./register_success.php');
    }
}
?>
