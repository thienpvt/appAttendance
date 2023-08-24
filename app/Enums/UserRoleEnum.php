<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserRoleEnum extends Enum
{
    public const lecturer =   0;
    public const admin =   1;

    public static function getRole(): array
    {
        return [
            'admin' =>self::admin,
            'lecturer' =>self::lecturer,
        ];
    }

}
