$(document).ready(function(){
    initSidenav();

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

    if($('#calendar')) {
        var calendar = new Calendar();
        calendar.init();
    }
});

var SIDENAV_OPEN = true;
function initSidenav()
{
    $('.sidenav').sidenav();
    $('#collapse-sidebar').on('click', function () {
        $('header, main, footer, #collapse-sidebar').toggleClass('sidebar-closed');

        if (SIDENAV_OPEN) {
            $('.sidenav').sidenav('close');
        } else {
            $('.sidenav').sidenav('open');
        }

        SIDENAV_OPEN = !SIDENAV_OPEN;
    })
}
