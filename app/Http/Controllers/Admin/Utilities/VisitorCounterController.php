<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Utilities;

use App\Http\Controllers\Controller;
use App\Models\VisitorCounter;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class VisitorCounterController extends Controller
{
    public function index(): View
    {
        $visitorCounters = VisitorCounter::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.utilities.visitor-counter.index', compact('visitorCounters'));
    }
}
