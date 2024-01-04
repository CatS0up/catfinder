<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class CatApprovalController extends Controller
{
    public function index(): View
    {
        return view('admin.cats-approve.index');
    }

    public function show(): View
    {
        return view('admin.cats-approve.show');
    }

    public function accept(): void
    {
        // TODO: Logic
    }

    public function reject(): void
    {
        // TODO: Logic
    }
}
