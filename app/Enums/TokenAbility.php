<?php

namespace App\Enums;

enum TokenAbility: string
{
    case ADMIN_ACCESS = 'admin:access';
    case USER_ACCESS = 'user:access';
    case ISSUE_ACCESS_TOKEN = 'issue_access_token';
}
