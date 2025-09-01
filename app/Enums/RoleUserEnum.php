<?php

namespace App\Enums;

enum RoleUserEnum: string
{
    case admin = 'admin';
    case pic = 'pic';
    case customer = 'customer';

    public static function toArray(): array
    {
        return array_column(RoleUserEnum::cases(), 'value');
    }

    public static function badge($value)
    {
        switch ($value) {
            case 'admin':
                $class = 'badge-success';
                break;
            case 'pic':
                $class = 'badge-warning';
                break;
            default:
                $class = 'badge-info';
                break;
        }
        return '<span class="badge '.$class.'">'.$value.'</span>';
    }
}
