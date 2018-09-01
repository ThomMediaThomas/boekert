$(document).ready(function () {
    initSidenav();
    initForms();
    initTables();
    initAlerts();
    initCalendar();
});

var SIDENAV_OPEN = true;
function initSidenav() {
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

function initForms() {
    $('select').formSelect();
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoClose: true,
        firstDay: 1,
        showClearBtn: true,
        onSelect: function (value)  {
            var currentName = this.$el.attr('name'),
                $dateTo = $('input.datepicker[name="date_to"]');

            if (currentName == 'date_from' && $dateTo.length > 0) {
                $dateTo.datepicker('setDate', value);
            }
        }
    });

    if ($('#create-booking').length > 0 || $('#create-accommodation').length > 0) {
        $('select#type').on('change', function () {
            $('.input-field.show-on-change-type').hide();
            $('#show-for-' + this.value).show();
        }).trigger('change');
    }
}

function initTables() {
    $('table.sortable').tablesorter();
}

function initAlerts() {
    if ($('.alert').length > 0) {
        $('.alert').on('click', function () {
            $(this).fadeOut();
        });
    }
}

function initCalendar() {
    if ($('#calendar')) {
        var calendar = new Calendar();
        calendar.init();
    }
}
