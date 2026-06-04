<?php

namespace App\Enums\Enum;

enum StatusProductEnum: string
{
    case Editing = "Черновик";
    case Deleted = "Удалён";
    case Publish = "Опубликован";

}
