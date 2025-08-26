<?php

namespace App\Enums;

enum DeliveryOpsiEnum: string
{
    case menggunakan_pengiriman = 'menggunakan pengiriman';
    case tidak_menggunakan_pengiriman = 'tidak menggunakan pengiriman';

    public static function toArray(): array
    {
        return array_column(DeliveryOpsiEnum::cases(), 'value');
    }

    public static function badge($value)
    {
        switch ($value) {
            case 'menggunakan_pengiriman':
                $class = 'badge-success';
                break;
            case 'tidak_menggunakan_pengiriman':
                $class = 'badge-danger';
                break;
            default:
                $class = 'badge-info';
                break;
        }
        return '<span class="badge '.$class.'">'.$value.'</span>';
    }
}
