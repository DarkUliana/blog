$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('select[name="role"]').on('change', function () {

        $(this).closest('form').submit();
    });

    $("#image").on('change', function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result).removeClass('d-none');
            };

            reader.readAsDataURL(this.files[0]);
        }

        var fileName = $(this).val();
        var shortName = fileName.substring(fileName.lastIndexOf('\\') + 1);
        $(this).siblings('.custom-file-label').html(shortName);
    });

    $('.answer-comment').on('click', function () {

        $(this).addClass('d-none');
        var comment = $(this).closest('.col-12');
        var data = {};
        data.post_id = $(location).attr("href").split('/').pop();
        data.parent_id = comment.data('id');

        $.ajax({
            url: 'comment/create',
            method: 'GET',
            data: data,
            success: function (data) {

                comment.append(data);
            }
        });
    });

    $('.edit-comment').on('click', function () {

        $(this).addClass('d-none');
        var comment = $(this).closest('.col-12');
        var id = comment.data('id');
        var data = {};
        data.post_id = $(location).attr("href").split('/').pop();

        $.ajax({
            url: "comment/" + id + "/edit",
            method: 'GET',
            data: data,
            success: function (data) {

                comment.append(data);
            }
        });

    });

    $('#comment-form, .answer-form').on('submit', function (e) {

        e.preventDefault();

        var form = $(this);
        var data = $(this).serialize();

        var before;

        if (form.hasClass('answer-form')) {

            before = form.closest('.row');
        } else {

            before = form.closest('.card-body');
        }


        $.ajax({
            url: $(this).attr('url'),
            method: 'POST',
            data: data,
            success: function (data) {

                if (form.hasClass('answer-form')) {

                    before.find('.answer-comment').removeClass('d-none');
                    form.remove();
                } else {

                    form.find('textarea').empty();
                }

                before.after(data);
            }
        });
    });

    $('.delete-comment').on('click', function () {

        var comment = $(this).closest('.media-body');
        var id = comment.data('id');

        $.ajax({
            url: 'comment/' + id,
            method: 'DELETE',
            success: function () {

                comment.remove();
            }
        });
    });
});
