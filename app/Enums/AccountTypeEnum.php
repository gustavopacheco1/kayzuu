<?php

namespace App\Enums;

enum AccountTypeEnum: int
{
    case NORMAL           = 1;
    case TUTOR            = 2;
    case SENIORTUTOR      = 3;
    case GAMEMASTER       = 4;
    case COMMUNITYMANAGER = 5;
    case GOD              = 6;
}
