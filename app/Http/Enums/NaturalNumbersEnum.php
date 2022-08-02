<?php

namespace App\Http\Enums;

enum NaturalNumbersEnum: string
{
    case MultiplesOfXOrY = 'MultiplesOfXOrY';
    case MultiplesOfXAndY = 'MultiplesOfXAndY';
    case MultiplesOfXOrYAndZ = 'MultiplesOfXOrYAndZ';
}
