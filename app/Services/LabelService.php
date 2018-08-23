<?php

namespace App\Services;

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

        return sprintf($template, $type, $camping_type, $chalet_type, $type, $camping_type, $chalet_type);
    }
}
