<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case pending = 'pending';
    case processing = 'processing';
    case submission = 'submission';
    case completed = 'completed';
    case cancelled = 'cancelled';

    public static function toArray(): array
    {
        return array_column(OrderStatusEnum::cases(), 'value');
    }

    public static function badge($value)
    {
        switch ($value) {
            case 'completed':
                $class = 'badge-success';
                break;
            case 'submission':
                $class = 'badge-info';
                break;
            case 'processing':
                $class = 'badge-secondary';
                break;
            case 'pending':
                $class = 'badge-warning';
                break;
            default:
                $class = 'badge-danger';
                break;
        }
        return '<span class="badge '.$class.'">'.$value.'</span>';
    }
}
