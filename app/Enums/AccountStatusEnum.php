<?php

namespace App\Enums;

enum AccountStatusEnum: string
{
    case active = 'active';
    case pending = 'pending';
    case nonactive = 'nonactive';

    public static function toArray(): array
    {
        return array_column(AccountStatusEnum::cases(), 'value');
    }

    public static function badge($value)
    {
        switch ($value) {
            case 'active':
                $class = 'badge-success';
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
