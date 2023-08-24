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
    public const LECTURER =   0;
    public const ADMIN =   1;
    public static function getRolesForRegister(): array
    {
        return [
            'lecturer' => self::LECTURER,
            'admin'        => self::ADMIN,
        ];
    }

}
