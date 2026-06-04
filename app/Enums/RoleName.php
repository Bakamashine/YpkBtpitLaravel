<?php

namespace App\Enums;

enum RoleName: string
{
    case Admin = 'Администратор';
    case Manager = "Управляющий";
    case User = 'Обычный пользователь';

}
