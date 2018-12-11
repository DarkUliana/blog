$(document).ready(function () {

    $('#image').on('change', function () {
        var fileName = $(this).val();
        var shortName = fileName.substring(fileName.lastIndexOf('\\') + 1);
        $(this).siblings('.custom-file-label').html(shortName);
    });

    $('select[name="role"]').on('change', function () {

        $(this).closest('form').submit();
    });
});