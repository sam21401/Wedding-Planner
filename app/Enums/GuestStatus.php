<?php

namespace App\Enums;

enum GuestStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case DECLINED = 'declined';

}
