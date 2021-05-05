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