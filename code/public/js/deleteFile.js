$(document).ready(function () {
    $(".items").on('click', '.btn', function () {

        $('#success-message').hide();
        $('#error-message').hide();

        var elemId = $(this).data('elemid');

        jQuery.ajax({
            url: "deleteImage" + '/' + elemId,
            type: "GET",
            success: function (result) {
                $('#image-' + elemId).remove();
                $('#success-message').show();
                $("html").animate({ scrollTop: 0 }, "slow");
                $('#success-message').html('<div id="error-ico" class="fa">&#xf118</div>Image have been removed!');
            },
            error: function (xhr, stato, errori) {
                $("html").animate({ scrollTop: 0 }, "slow");
                $('#error-message').show();
                $('#error-message').html('<div id="error-ico" class="fa">&#xf119</div>Error!!!' + xhr.responseText);
            }
        });

    });
});