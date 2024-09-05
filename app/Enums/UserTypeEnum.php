<?php

namespace App\Enums;

enum UserTypeEnum: int
{
    case ROOT_ADMIN = 1;
    case MEMBER_ADMIN = 2;
}
