<?php

declare(strict_types=1);

namespace App\Contracts;

final class Roles
{
    /**
     * Represents the 'admin' role.
     *
     * @var string
     */
    public const ADMIN = 'admin';

    /**
     * Represents the 'staff' role.
     *
     * @var string
     */
    public const STAFF = 'staff';

    /**
     * Represents the 'user' role.
     *
     * @var string
     */
    public const USER = 'user';

    /**
     * A collection of the available roles in the application.
     *
     * @var array
     */
    public const collection = [
        self::ADMIN,
        self::STAFF,
        self::USER
    ];
}
