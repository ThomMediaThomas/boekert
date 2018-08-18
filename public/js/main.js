$(document).ready(function(){
    $('.sidenav').sidenav();
    $('select').formSelect();
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoClose: true
    });
    $('table.sortable').tablesorter();

    if ($('#create-booking').length > 0 || $('#create-accommodation').length > 0) {
        $('select#type').on('change', function () {
            $('.input-field.show-on-change-type').hide();
            $('#show-for-' + this.value).show();
        }).trigger('change');
    }

    if($('.alert').length > 0) {
        $('.alert').on('click', function () {
            $(this).fadeOut();
        });
    }
});
