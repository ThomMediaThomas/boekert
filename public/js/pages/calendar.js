var Calendar = function () {
    var self = this;

    self.bookings = null;
    self.$calendar = null;
    self.$calendarHolder = null;
    self.$calendarBookings = null;

    self.init = function () {
        if (typeof BOOKINGS !== 'undefined') {
            self.bookings = BOOKINGS;
        }
        self.$calendar = $('#calendar');
        self.$calendarHolder = $('#calendar-holder');
        self.$calendarBookings = $('#calendar-bookings');

        self.renderBookings();
        self.bindEvents();
    };

    self.bindEvents = function () {
        $(window).on('resize', _.debounce(self.renderBookings, 500));
    };

    self.renderBookings = function () {
        self.$calendarBookings.html('');

        _.each(self.bookings, function (booking) {
            var $from = self.getDateFromTd(booking),
                $to = self.getDateToTd(booking),
                holderOffset = self.$calendarHolder.offset(),
                fromOffset = $from.offset(),
                toOffset = $to.offset(),
                posLeft = fromOffset.left - holderOffset.left,
                posRight = toOffset.left - holderOffset.left,
                posTop = fromOffset.top - holderOffset.top,
                width = posRight - posLeft + $to.outerWidth();

            var style = 'top: ' + posTop + 'px; left: ' + posLeft + 'px;' + 'width: ' + width + 'px;';

            var bookingHtml = '<a data-id="' + booking.id + '" title="' + self.getBookingHover(booking) + '" class="' + self.getBookingClass(booking) + '" href="' + self.getBookingLink(booking) + '" style="' + style +'">';
            bookingHtml += self.getBookingTitle(booking);
            bookingHtml += '</a>';

                self.$calendarBookings.append(bookingHtml);
        });
    };

    self.getBookingTitle = function (booking) {
        var text = '';

        if (booking.customer) {
            text += booking.customer.firstname[0] + '. ' + booking.customer.lastname;
        } else {
            text += booking.boekert_id;
        }

        return text;
    };

    self.getBookingLink = function (booking) {
        return '/bookings/' + booking.id + '/edit';
    };

    self.getBookingClass = function (booking) {
        return 'attached-booking type-' + booking.type;
    };

    self.getBookingHover = function (booking) {
        var title = self.getBookingTitle(booking);

        title += ' (' + booking.date_from + ' - ' + booking.date_to + ')';

        return title;

    };

    self.getDateFromTd = function (booking) {
        var $from = $('td.date[data-acc_id="' + booking.accommodation_id + '"][data-date="' + booking.date_from + '"]');

        if ($from.length <= 0) {
            $from = $('td.date[data-acc_id="' + booking.accommodation_id + '"]').first();
        }

        return $from;
    };

    self.getDateToTd = function (booking) {
        var $to = $('td.date[data-acc_id="' + booking.accommodation_id + '"][data-date="' + booking.date_to + '"]');

        if ($to.length <= 0) {
            $to = $('td.date[data-acc_id="' + booking.accommodation_id + '"]').last();
        }

        return $to;
    };
};
