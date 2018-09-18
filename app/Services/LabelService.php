<?php

namespace App\Services;

use App\Booking;
use App\Customer;
use Illuminate\Http\Request;

class LabelService
{
    /**
     * @param $model
     * @return string
     */
    public function getTypeLabel($model) {
        $template = '<span class="badge type type-%s subtype-%s%s"><strong>%s</strong> | %s%s</span>';
        $type = $model->type;
        $camping_type = $model->camping_type;
        $chalet_type = $model->chalet_type;

        return sprintf(
            $template,
            $type->system_name,
            $camping_type ? $camping_type->system_name : '',
            $chalet_type ? $chalet_type->system_name : '',
            $type->name,
            $camping_type ? $camping_type->name : '',
            $chalet_type? $chalet_type->name : ''
        );
    }

    public function getCheckInLabel(Booking $booking) {
        $template = '<span class="badge checkstatus checkstatus-%s"><strong>%s</strong></span>';

        if ($booking->checked_in) {
            return sprintf($template, 'in', 'ingecheckt');
        }
    }

    public function getCheckOutLabel(Booking $booking) {
        $template = '<span class="badge checkstatus checkstatus-%s"><strong>%s</strong></span>';

        if ($booking->checked_out) {
            return sprintf($template, 'out', 'uitgecheckt');
        }
    }
}
