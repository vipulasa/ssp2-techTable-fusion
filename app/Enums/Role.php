<?php

namespace App\Enums;

enum Role : int
{
    case Admin = 1;

    case Manager = 2;

    case Sales = 3;

    case DeliveryPersonal = 4;

    case Server = 5;

    case Customer = 6;
}
