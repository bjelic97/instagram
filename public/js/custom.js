$(document).ready(function () {

    $('.summernote').summernote();

    setTimeout(function () {
        $('#flash-message').hide();
    }, 3000);

    $(".like-comment").hover(function () {
        $(this).css("color", "darkred");
    }, function () {
        $(this).css("color", "gray");
    });


    // $("body").on("click", ".follow-toggle", function (e) {
    //     e.preventDefault();
    //     let userId = $(this).data("id");
    //     console.log(userId);
    //
    //     // // AJAX CALL
    //
    //     $.ajax({
    //         method: "POST",
    //         url: `/follow/${userId}`,
    //         data: {
    //             user: userId
    //
    //         },
    //         dataType: "json",
    //         success: function (data, status, request) {
    //             console.info(data);
    //             console.info(status);
    //             console.info(request);
    //             console.info(request.responseJSON);
    //             // let successElement = $("#success");
    //             // $("#container-login").before(successElement);
    //             // printSuccess("Success!", "You have successfully followed user.");
    //             setTimeout(window.location.replace(`/profile/${userId}`), 3000);
    //         },
    //         error: showErrors
    //     });
    //
    // });

    // ajax is not a function error


    // edit comment form manipulation
    $("body").on("click", ".edit-comment", function () {
        let commentId = $(this).data("id");
        let value = $(`#comment-field-${commentId}`).html();

        $(`.edit-comment-form-${commentId}`).removeClass('dissapear');
        $(`#edit-field-${commentId}`).summernote('pasteHTML', value);
        $(`.comment-${commentId}`).addClass('dissapear');
    });

    $("body").on("click", ".close-edit-comment", function () {
        let commentId = $(this).attr("id");

        $(`#edit-field-${commentId}`).summernote('reset');
        $(`.edit-comment-form-${commentId}`).addClass('dissapear');
        $(`.comment-${commentId}`).removeClass('dissapear');
    });


    $("#filter").keyup(function () {

        let filter = $(this).val();
        if (filter == "") {
            $("#autocomplete-list").html('');
        } else {
            $.ajax({
                url: `/profile?username=${filter}`,
                method: "GET",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    printProfiles(data);

                },
                error: showErrors
            });
        }
    });



    // $("body").on("click", ".toggle", function () {
    //     let val = $(this).attr("id");
    //     switch(val){
    //         case 'followers':
    //             $('#include-following').addClass('dissapear');
    //             $('#include-followers').removeClass('dissapear');
    //             break;
    //         case 'following':
    //             $('#include-followers').addClass('dissapear');
    //             $('#include-following').removeClass('dissapear');
    //             break;
    //     }
    // });


    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }

    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function(){
        readURL(this);
    });


    // $("body").on("click", ".sugested", function () {
    //     id = $(this).attr("id");
    //     window.location.replace(`${getBaseUrl()}/profile/${id}`);
    // });

    // $("#filter").blur(function () {
    //
    //     $(this).val('');
    //     $('#autocomplete-list').html('');
    // });


});


function printProfiles(profiles) {

    let html = "";
    for (let profile of profiles) {
        let image = profile.image ? profile.image : 'profile/WmL1pTG3i4SMUmBSCmReweKSoJqvvT5DBJKtfdwa.jpeg';

    //
    //   cuz blur on input will not allow to click  so i improvised
        html += `

                     <a href="${getBaseUrl()}/profile/${profile.id}" class="text-dark text-decoration-none"> <div>

                        <img src="/storage/${image}" alt="${profile.title}" style="width:25px">
                        <strong class="pl-2">${profile.title}</strong>
                        <input type="hidden" value="${profile.id}">

                    </div></a>
            `;
    }

    $("#autocomplete-list").html(html);
}

function getBaseUrl() {
    return window.location.protocol + "//" + window.location.host;
}

function showErrors(error, status, statusText) {
    console.error(status);
    console.error(error.responseText);
    console.error(error.responseJSON);

    printErrors(error.responseJSON);

    switch (error.status) {
        case 400:
            console.error(`${error.status}: ${statusText}`);
            break;
        case 403:
            console.error(`${error.status}: ${statusText}`);
            break;
        case 404:
            console.error(`${error.status}: ${statusText}`);
            break;
        case 405:
            console.error(`${error.status}: ${statusText}`);
            break;
        case 409:
            console.error(`${error.status}: ${statusText}`);
            break;
        case 415:
            console.error(`${error.status}: ${statusText}`);
            break;
        case 422:
            console.error(`${error.status}: ${statusText}`);
            break;
        case 500:
            console.error(`${error.status}: ${statusText}`);

            break;
    }
}

function printErrors(errors) {
    let errorElement = $("#errors");
    errorElement.removeClass("elementDissapear");
    let html = `<div class="text-center"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></div>`;
    for (let error of errors) {
        html += `
      <div class="text-center">
      ${error}
      </div>
    `;
    }
    $("#errors").html(html);
}

function isNullOrWhitespace(input) {
    if (typeof input === "undefined" || input == null) return true;

    return input.replace(/\s/g, "").length < 1;
}
