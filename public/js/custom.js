$(document).ready(function() {

    $('#next-appointment-modal').modal('show');

    /**
     * This function takes care of hiding the specialty input field in the 
     * user register should the registering user select the social worker option 
     */
    $("#level").change(function() {

        var level = $(this).val();
        if (level == 'sw') {
            $("#specialty").hide();
        } else {
            $("#specialty").show();
        }

    });



    $("#sms-send").click(function() {
        alert('a');

        // var values = $("#sms-form :input").serialize();
        $.post("http://localhost:8000/sms/store", data, function(json) {
            if (json.status == "fail") {
                alert(json.message);
            }
            if (json.status == "success") {
                alert(json.message);
                clearInputs();
            }
        }, "json");

        // $.post("http://localhost:8000/sms/store",
        // {
        //     send:values
        // },
        // function(data, status){
        //     alert("Data: " + data + "\nStatus: " + status);
        // });

        // $("#result").load("http://localhost:8000/sms/store");

    });


    function clearInputs() {
        $("#sms-form :input").each(function() {
            $(this).val('');
        });
    }


})

/**
 * This function blocks the default submit action of the send sms form such that 
 * nothing occurs when a link (mostly buttons) is clicked within the form (which)
 * is what has been happening. This function fixes that problem. 
 */
// $("#sms-form").submit(function(){
//     return false;
// });