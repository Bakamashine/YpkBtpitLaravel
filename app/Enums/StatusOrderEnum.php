<?php

namespace App\Enums;

enum StatusOrderEnum: string
{
    case New = 'Новый';
    case Confirmed = 'Подтверждён';
    case Completed = 'Выполнен';
    case Cancelled = 'Отменён';
}
