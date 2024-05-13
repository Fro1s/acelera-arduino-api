<?php

namespace App\Helper\Paginate;

class PageRuleHelper

{

    public static function rule(): array
    {
        return [
            'page' => 'required|integer'
        ];
    }
}
