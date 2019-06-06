$(document).ready(function() {
    // ajaax call will submit the form for us
    //button for  profile post
    
    $('#submit_profile_post').click(function(){
        console.log('success');
        $.ajax({
            type: "POST",
            url: "includes/handlers/ajax_submit_profile_post.php",
            data: $('form.profile_post').serialize(),
            success: function(msg) {
                // alert(msg);
                $("#post_form").modal('hide');
                location.reload();
            },
            error: function() {
                alert('failure');
            }
        });
    });
});

function getUser(value, user) {
    //send a request to this page , with the values
    $.post("includes/handlers/ajax_friend_search.php", {$query:value , userLoggedIn:user}, function(data) {
        //and when it retusn it going to appends the value of data to results
        $(".results").html(data);
    });
}