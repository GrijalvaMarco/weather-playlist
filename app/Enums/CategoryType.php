<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class CategoryType = Values are the id's of the category table
 * @package App\Enums
 */
final class CategoryType extends Enum
{
    const PARTY =   1;
    const POP =   2;
    const ROCK = 3;
    const CLASSICAL = 4;
}
