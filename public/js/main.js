$(document).ready(function(){
    $('.sidenav').sidenav();
    $('select').formSelect();
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoClose: true
    });

    if ($('#create-booking').length > 0 || $('#create-accomodation').length > 0) {
        $('select#type').on('change', function () {
            $('.input-field.show-on-change-type').hide();
            $('#show-for-' + this.value).show();
        });
    }
});
