$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});


$(document).on('change', 'select[name="role"]', function () {

    $(this).closest('form').submit();
});

$(document).on('change', '#image', function () {
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


$(document).on('click', '.edit-comment', function () {

    $(this).addClass('d-none');
    var comment = $(this).closest('.col-12');
    var id = comment.data('id');
    var data = {};
    data.post_id = $(location).attr("href").split('/').pop();

    $.ajax({
        url: 'comment/' + id + '/edit',
        method: 'GET',
        data: data,
        success: function (data) {

            comment.append(data);
        }
    });

});


$(document).on('click', '.update-comment', function (e) {


    e.preventDefault();

    var form = $(this).closest('form');
    var text = form.find('textarea').val();
    var comment = form.closest('.col-12');
    var id = comment.data('id');
    var data = form.serialize();

    $.ajax({
        url: 'comment/' + id,
        method: 'PATCH',
        data: data,
        success: function () {

            comment.find('span').text(text);
            form.remove();
            comment.find('.edit-comment').removeClass('d-none');
        }
    });
});


$(document).on('click', '.answer-comment', function () {

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
            comment.find('button').removeClass('comment-form');
            comment.find('button').addClass('answer-form');

        }
    });
});

$(document).on('click', '.comment-form, .answer-form', function (e) {

    e.preventDefault();

    var button = $(this);
    var form = button.closest('form');
    var data = form.serialize();

    var point;

    if (button.hasClass('answer-form')) {

        point = button.closest('.col-12');
    } else {

        point = $('#comments>.card-body>.row');
    }


    $.ajax({
        url: 'comment',
        method: 'POST',
        data: data,
        success: function (data) {

            if (button.hasClass('answer-form')) {

                point.find('.answer-comment').removeClass('d-none');
                form.remove();
                point.after(data);
                var level = point.data('level');
                point.next().removeClass('tab-0');
                point.next().addClass('tab-' + (level + 1));
                point.next().data('level', level + 1);
            } else {

                form.find('textarea').val('');
                point.append(data);
            }



        }
    });
});


$(document).on('click', '.delete-comment', function () {

    var comment = $(this).closest('.col-12');
    var id = comment.data('id');

    $.ajax({
        url: 'comment/' + id,
        method: 'DELETE',
        success: function () {

            comment.remove();
        },
        error: function (data) {

            alert(data.responseText);
        }
    });
});



