<?php

namespace App\Helper\Paginate;

class PerPageRuleHelper
{
    public static function rule(): array
    {
        return [
            'per_page' => 'required|integer'
        ];
    }
}