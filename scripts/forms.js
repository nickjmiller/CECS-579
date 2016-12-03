function formhash(form, voterKey) {
    // Create a new element input, this will be our hashed password field.
    var k = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(k);
    k.name = "k";
    k.type = "hidden";
    k.value = hex_sha512(voterKey.value);

    // Make sure the plaintext password doesn't get sent.
    voterKey.value = "";

    // Finally submit the form.
    form.submit();
}

function regformhash(form, voterID, voterKey, conf) {
     // Check each field has a value
    if (voterID.value == ''         ||
          voterKey.value == ''  ||
          conf.value == '') {

        alert('You must provide all the requested details. Please try again');
        return false;
    }


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
