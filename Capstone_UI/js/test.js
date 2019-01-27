$("#toggleLogin").click(function () {
    if ($("#loginActive").val() == "1") {
        $("#loginActive").val("0");
        $("#loginModalTitle").html("Sign Up");
        $("#loginSignupButton").html("Sign Up");
        $("#toggleLogin").html("Login");
    } else {
        $("#loginActive").val("1");
        $("#loginModalTitle").html("Login");
        $("#loginSignupButton").html("Login");
        $("#toggleLogin").html("Sign up");
    }
});

$("#loginSignupButton").click(function () {
    $.ajax({
        type: "POST",
        url: "actions.php?action=loginSignup",
        data: "email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#loginActive").val(),
        success: function (result) {
            if (result == "1") {
                window.location.assign("#");
            } else {
                $("#loginAlert").html(result).show();
            }
        }
    })
});

$(".toggleFollow").click(function () {

    var id = $(this).attr("data-userId");
    $.ajax({
        type: "POST",
        url: "actions.php?action=toggleFollow",
        data: "userId=" + id,
        success: function (result) {
            if (result == "1") {
                $("a[data-userId='" + id + "']").html("Follow");
            } else if (result == "2") {
                $("a[data-userId='" + id + "']").html("Unfollow");
            }
        }
    })
});

$("#postTweetButton").click(function () {
    $.ajax({
        type: "POST",
        url: "actions.php?action=postTweet",
        data: "tweetContent=" + $("#tweetContent").val(),
        success: function (result) {
            if (result == "1") {
        $("#tweetSuccess").show();
                $("#tweetFail").hide();
            } else if (result != "") {
                $("#tweetFail").html(result).show();
                $("#tweetSuccess").hide();
            }
        }
    })
});
