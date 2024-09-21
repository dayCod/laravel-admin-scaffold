<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

final class ActivityLogger
{
    /**
     * Record an activity log for a specific action performed on a property.
     *
     * This method logs various actions such as create, read, update, delete, and sync
     * for a given property. The title of the activity log is generated based on the
     * action and the property name.
     *
     * @param string $action The action performed on the property.
     * @param string $prop The name of the property.
     * @return void
     */
    public function recordLogger($action, $prop)
    {
        switch ($action) {
            case "create":
                $this->createLogger(
                    title: "Creating the {$prop}",
                    action: $action,
                );
                break;
            case "read":
                $this->createLogger(
                    title: "Reading the {$prop}",
                    action: $action,
                );
                break;
            case "update":
                $this->createLogger(
                    title: "Updating the {$prop}",
                    action: $action,
                );
                break;
            case "delete":
                $this->createLogger(
                    title: "Deleting the {$prop}",
                    action: $action,
                );
                break;
            case "sync":
                $this->createLogger(
                    title: "Syncronize the {$prop}",
                    action: $action,
                );
                break;
        }
    }

    /**
     * Create a new activity log record.
     *
     * @param string $title The title of the activity log.
     * @param string $desc The description of the activity log.
     * @param string $action The action performed that is being logged.
     * @return void
     */
    public function createLogger(string $title, string $action)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'title' => $title,
            'description' => null,
            'action' => $action,
        ]);
    }
}
