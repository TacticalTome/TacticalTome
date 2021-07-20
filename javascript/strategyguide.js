/*
    Get Properties 
*/
const strategyGuideId = getMeta("strategyguideid"); // ID of the strategy guide (in database)
const baseURL = getMeta("baseurl"); // The base URL of the website i.e. https://www.tacticaltome.com/
const gameURL = getMeta("gameurl"); // The URL of the game i.e. https://www.tacticaltome.com/game/view/1/

/*
    User (owner of strategy guide) deletes strategy guide
*/
function deleteStrategyGuide() {
    if (confirm("Are you sure you want to delete this strategy guide?\n\nThis will not be able to be reverted")) {
        $.ajax({ 
                url: baseURL + "ajax/deletestrategyguide/",
                data: {
                    strategyGuideID: strategyGuideId
                },
                type: "POST",
                success: function(data) {
                    alert(data);
                    if (data == "Successfully deleted") window.location.href = gameURL;
                }
        });
    }
}

/*
    Show/hide reply container functions
*/
$("#showReplyContainer").on("click", function() {
    $("#replyId").val("");
    $("#replyContainer").fadeIn();
});

$("#closeReplyContainer").on("click", function() {
    $("#replyId").val("");
    $("#replyContainer").fadeOut();
});

function openReplyContainer(replyId) {
    $("#replyId").val(replyId);
    $("#replyContainer").fadeIn();
}

/*
    User (owner of reply) deletes reply
*/
function deleteReply(replyId) {
    $.ajax({
        url: baseURL + "ajax/deletereply/",
        data: {
            replyID: replyId
        },
        type: "POST",
        success: function(data) {
            alert(data);
            if (data == "Successfully deleted") window.location.reload();
        }
    });
}

/*
    When the user clicks the reply submit button
    Relay to server
*/
$("#replySubmit").on("click", function() {
    const replyContent = $("#replyContent").val();
    const replyId = $("#replyId").val();
    if (replyContent && /\S/.test(replyContent)) {
        $.ajax({
            url: baseURL + "ajax/reply/",
            data: {
                strategyGuideID: strategyGuideId,
                replyContent: replyContent,
                replyID: replyId
            },
            type: "POST",
            success: function(data) {
                alert(data);
                if (data == "Successfully posted") window.location.reload();
            }
        });
    } else {
        alert("Your reply is empty");
    }
});

/*
    Moderator Functions
*/
function forceDeleteStrategyGuide() {
    if (confirm("Are you sure you want to delete this strategy guide?\n\nThis is not reversible!")) {
        const reason = prompt("What is the reason?");
        if (reason === "" || !reason) return;
        $.ajax({
            url: baseURL + "ajax/forceDeleteStrategyGuide/",
            data: {
                strategyGuideID: strategyGuideId, 
                reason: reason
            },
            type: "POST",
            success: function(data) {
                alert(data);
                if (data == "Successfully deleted") window.location.href = gameURL;
            }
        });
    }
}

function forceDeleteReply(replyId) {
    if (confirm("Are you sure you want to delete this reply?\n\nThis is not reversible!")) {
        const reason = prompt("What is the reason?");
        if (reason === "" || !reason) return;
        $.ajax({
            url: baseURL + "ajax/forcedeletereply/",
            data: {
                replyID: replyId,
                reason: reason
            },
            type: "POST",
            success: function(data) {
                alert(data);
                if (data == "Successfully deleted") window.location.reload();
            }
        });
    }
}