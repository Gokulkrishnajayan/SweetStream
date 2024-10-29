$(function() {
    // Edit button functionality
    $("#edit-btn").click(function() {
        $("input, textarea").prop("disabled", false); // Enable inputs
        $("#edit-btn").hide();
        $("#save-btn, #cancel-btn").show();
    });

    // Cancel button functionality
    $("#cancel-btn").click(function() {
        $("input, textarea").prop("disabled", true); // Disable inputs
        $("#save-btn, #cancel-btn").hide();
        $("#edit-btn").show();
    });

    // Save button functionality with AJAX
    $("#save-btn").click(function() {
        const name = $("#name").val();
        const email = $("#email").val();
        const phone = $("#phone").val();
        const address = $("#address").val();

        $.ajax({
            type: "POST",
            url: "update_profile.php",
            data: {
                name: name,
                email: email,
                phone: phone,
                address: address
            },
            success: function(response) {
                alert(response); // Alert response message
                if (response.includes("successfully")) {
                    $("input, textarea").prop("disabled", true); // Disable inputs
                    $("#save-btn, #cancel-btn").hide();
                    $("#edit-btn").show();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error updating profile: " + errorThrown);
            }
        });
    });
});
