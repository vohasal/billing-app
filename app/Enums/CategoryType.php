<?php

namespace App\Enums;

enum CategoryType: string
{
    case INCOME = 'income';
    case EXPENSE = 'expense';

    // для отображения enum полей в требующем виде
    public function label(): string
    {
        return match($this) {
            self::INCOME => 'Доход',
            self::EXPENSE => 'Расход'
        };
    }

}
