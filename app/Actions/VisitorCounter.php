<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\VisitorCounter as VisitorCounterModel;

final class VisitorCounter
{
    /**
     * Records a visitor's information in the database.
     *
     * @param array $dto An associative array containing the visitor's information, including:
     * - `user_id`: The ID of the user.
     * - `session_id`: The ID of the user's session.
     * - `ip_address`: The IP address of the visitor.
     * - `user_agent`: The user agent string of the visitor.
     */
    public function recordVisitor(array $dto)
    {
        VisitorCounterModel::create([
            'user_id' => $dto['user_id'],
            'session_id' => $dto['session_id'],
            'ip_address' => $dto['ip_address'],
            'user_agent' => $dto['user_agent'],
        ]);
    }
}
