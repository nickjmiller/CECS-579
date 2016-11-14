function formhash(form, key) {
    // Create a new element input, this will be our hashed password field.
    var k = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(k);
    k.name = "k";
    k.type = "hidden";
    k.value = hex_sha512(key.value);

    // Make sure the plaintext password doesn't get sent.
    key.value = "";

    // Finally submit the form.
    form.submit();
}

function regformhash(form, voterID, voterKey, conf) {
     // Check each field has a value
    if (  voterID.value == ''     ||
          voterKey.value == ''  ||
          conf.value == '') {

        alert('You must provide all the requested details. Please try again');
        return false;
    }

    // Check the username

    re = /^\w+$/;
    if(!re.test(form.voterID.value)) {
        alert("VoterID must contain only letters, numbers and underscores. Please try again");
        form.voterID.focus();
        return false;
    }

    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (voterKey.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.voterKey.focus();
        return false;
    }

    // At least one number, one lowercase and one uppercase letter
    // At least six characters

    //var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    //if (!re.test(password.value)) {
    //    alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
    //    return false;
    //}

    // Check password and confirmation are the same
    if (voterKey.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.voterKey.focus();
        return false;
    }

    // Create a new element input, this will be our hashed password field.
    var k = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(k);
    k.name = "k";
    k.type = "hidden";
    k.value = hex_sha512(voterKey.value);

    // Make sure the plaintext password doesn't get sent. 
    voterKey.value = "";
    conf.value = "";

    // Finally submit the form.
    form.submit();
    return true;
}
