<?php

if (!function_exists('resourceNames')) {
    function resourceNames($prefix)
    {
        return [
            'index' => "{$prefix}.index",
            'create' => "{$prefix}.create",
            'store' => "{$prefix}.store",
            'show' => "{$prefix}.show",
            'edit' => "{$prefix}.edit",
            'update' => "{$prefix}.update",
            'destroy' => "{$prefix}.destroy",
        ];
    }
}
