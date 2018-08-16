$(document).ready(function(){
    $('.sidenav').sidenav();
    $('select').formSelect();
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoClose: true
    });

    if ($('#create-booking') || $('#create-accomodation')) {
        $('select#type').on('change', function () {
            $('.input-field.show-on-change-type').hide();
            $('#show-for-' + this.value).show();
        });
    }
});
