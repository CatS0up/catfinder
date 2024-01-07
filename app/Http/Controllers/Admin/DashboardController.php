<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ViewModels\Admin\DashboardViewModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.dashboard', [
            'model' => (new DashboardViewModel($request->integer('page', 1)))->toArray(),
        ]);
    }
}
