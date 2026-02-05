<?php

namespace App\Enums;

enum CategoryTypeEnum: string
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
