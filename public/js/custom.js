$(document).ready(function () {

    $('select[name="role"]').on('change', function () {

        $(this).closest('form').submit();
    });

    $("#image").on('change', function(){
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
});
