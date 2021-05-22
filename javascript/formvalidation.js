// Add Error Message
function addFormError(buttonID, text) {
    $("#" + buttonID).attr("data-color", "red");
    $("#outputContainer").append("<div class='output unselectable'>" + text +"</div>");
}

// Check if string contains special characters
function stringHasSpecialCharacters(string) {
    return /[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/g.test(string);
}

// user/login
function validateLogin() {
    // Reset Output Container
    $("#outputContainer").empty();

    // Grab all inputted variables
    var username = $("#username").val();
    var password = $("#password").val();

    // Validate inputted variables
    if (!username || !password) {
        addFormError("submitLogin", "Please fill out all the fields");
        return false;
    }
}

// user/register
function validateRegister() {
    // Reset Output Container
    $("#outputContainer").empty();

    // Grab all inputted variables
    var email = $("#email").val();
    var username = $("#username").val();
    var password = $("#password").val();
    var confirmpassword = $("#confirmpassword").val();

    // Validate inputted variables
    if (!email || !username || !password || !confirmpassword) {
        addFormError("submitRegister", "Please fill out all the fields");
        return false;
    } else {
        if (email.length > 100) {
            addFormError("submitRegister", "The email you provided is too long");
            return false;
        } else if (username.length > 25) {
            addFormError("submitRegister", "The username you provided is too long");
            return false;
        } else if (stringHasSpecialCharacters(username)) {
            addFormError("submitRegister", "You cannot have speical characters in your username");
            return false;
        } else if (password != confirmpassword) {
            addFormError("submitRegister", "Please make sure your passwords match");
            return false;
        }
    }
}

// user/account
function validateChangePassword() {
    // Reset Output Container
    $("#outputContainer").empty();

    // Grab all inputted variables
    var password = $("#password").val();
    var newpassword = $("#newpassword").val();
    var confirmnewpassword = $("#confirmnewpassword").val();

    if (!password || !newpassword || !confirmnewpassword) {
        addFormError("submitChangePassword", "Please fill out all the fields");
        return false;
    } else {
        if (newpassword != confirmnewpassword) {
            addFormError("submitChangePassword", "The new passwords do not match");
            return false;
        }
    }
}

// user/account
function validateChangeEmail() {
    // Reset Output Container
    $("#outputContainer").empty();

    // Grab all inputted variables
    var email = $("#newemail").val();

    // Confirmation
    if (!confirm("Are you sure you want to change your email?\nChange To: " + email)) return false;

    // Validate inputted variables
    if (!email) {
        addFormError("submitChangeEmail", "Please fill out all the fields");
        return false;
    } else {
        if (email.length > 100) {
            addFormError("submitChangeEmail", "The email you provided is too long");
            return false;
        }
    }
}

// game/submit
function validateSubmitGame() {
    // Reset Output Container
    $("#outputContainer").empty();

    // Grab all inputted variables
    var link = $("#steamLink").val();

    // Validate inputted variables
    if (!link) {
        addFormError("submitGame", "Please fill out all the fields");
        return false;
    } else {
        if (!link.includes("https://store.steampowered.com")) {
            addFormError("submitGame", "Please make sure the link you have provided is a steam link");
            return false;
        }
    }
}