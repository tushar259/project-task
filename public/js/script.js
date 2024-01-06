$(document).ready(function() {
    $('#createRepoButton').click(function() {
        $('#errorSuccessMsg').html("");
        $.ajax({
            url: '/api/post-data', 
            method: 'POST',
            data: {
                repName: $('#repName').val(),
                repDesc: $('#repDesc').val(),
                gitToken: $('#gitToken').val()
            }, 
            success: function(response) {
                $('#errorSuccessMsg').html(response.message);
                if(response.success == false){
                    $('#errorSuccessMsg').css('color', 'red');
                }
                else if(response.success == true){
                    $('#errorSuccessMsg').css('color', 'green');
                    $('#repName').val("");
                    $('#repDesc').val("");
                    $('#gitToken').val("");
                }
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
});