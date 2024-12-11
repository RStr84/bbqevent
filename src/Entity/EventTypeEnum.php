<?php

namespace App\Entity;

enum EventTypeEnum :string
{
    case Party = 'Party';
    case Concert = 'Concert';
    case StandUpComedy = 'StandUp Comedy';
}