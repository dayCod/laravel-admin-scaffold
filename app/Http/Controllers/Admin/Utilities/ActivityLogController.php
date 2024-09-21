<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Utilities;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class ActivityLogController extends Controller
{
    public function index(): View
    {
        $activityLogs = ActivityLog::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin.utilities.activity-log.index', compact('activityLogs'));
    }
}
