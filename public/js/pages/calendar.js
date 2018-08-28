var Calendar = function () {
    var self = this;

    self.$calendar = null;
    self.$calendarHolder = null;
    self.$calendarBookings = null;

    self.init = function () {
        self.$calendar = $('#calendar');
        self.$calendarHolder = $('#calendar-holder');
        self.$calendarBookings = $('#calendar-bookings');

        self.renderBookings();
        $('.attached-booking').tooltip();

        self.bindEvents();
    };

    self.bindEvents = function () {
        $(window).on('resize', _.debounce(self.renderBookings, 500));
    };

    self.renderBookings = function () {
        $('a.attached-booking').each(function () {
            var $booking = $(this);
            var $from = self.getDateFromTd($booking.attr('data-accommodation_id'), $booking.attr('data-from')),
                $to = self.getDateToTd($booking.attr('data-accommodation_id'), $booking.attr('data-to')),
                holderOffset = self.$calendarHolder.offset(),
                fromOffset = $from.offset(),
                toOffset = $to.offset(),
                posLeft = fromOffset.left - holderOffset.left + ($from.outerWidth()/2),
                posRight = toOffset.left - holderOffset.left + ($from.outerWidth()/2),
                posTop = fromOffset.top - holderOffset.top,
                width = (posRight != posLeft) ? (posRight - posLeft) : ($from.outerWidth()/2);

            var style = 'top: ' + posTop + 'px; left: ' + posLeft + 'px;' + 'width: ' + width + 'px;';

            $booking.attr('style', style);
        });
    };

    self.getDateFromTd = function (accommodation_id, date_from) {
        var accommodation_id = accommodation_id ? accommodation_id : 'null';
            $from = $('td.date[data-acc_id="' + accommodation_id + '"][data-date="' + date_from + '"]');

        if ($from.length <= 0) {
            $from = $('td.date[data-acc_id="' + accommodation_id + '"]').first();
        }

        return $from;
    };

    self.getDateToTd = function (accommodation_id, date_to) {
        var accommodation_id = accommodation_id ? accommodation_id : 'null';
        var $to = $('td.date[data-acc_id="' + accommodation_id + '"][data-date="' + date_to + '"]');

        if ($to.length <= 0) {
            $to = $('td.date[data-acc_id="' + accommodation_id + '"]').last();
        }

        return $to;
    };
};
