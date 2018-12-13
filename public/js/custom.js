$(document).ready(function () {

    $('#image').on('change', function () {
        var fileName = $(this).val();
        var shortName = fileName.substring(fileName.lastIndexOf('\\') + 1);
        $(this).siblings('.custom-file-label').html(shortName);
    });

    $('select[name="role"]').on('change', function () {

        $(this).closest('form').submit();
    });

    function readURL(input) {


    }

    $("#imgInput").change(function(){
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image').attr('src', e.target.result);
            };

            reader.readAsDataURL(this.files[0]);
        }
    });
});