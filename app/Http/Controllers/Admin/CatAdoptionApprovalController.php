<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\ApproveCatAdoptionAction;
use App\Actions\Admin\CancelCatAdoptionAction;
use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CatAdoptionApprovalController extends Controller
{
    public function index(): View
    {
        return view('admin.cats-approve.index');
    }

    public function approve(Cat $cat, ApproveCatAdoptionAction $action): RedirectResponse
    {
        $action->handle($cat->id);

        return back()
            ->with('success', __('The adoption of the cat :cat has been approved', ['cat' => $cat->name]));
    }

    public function cancel(Cat $cat, CancelCatAdoptionAction $action): RedirectResponse
    {
        $action->handle($cat->id);

        return back()
            ->with('success', __('The adoption of the cat :cat has been cancelled', ['cat' => $cat->name]));
    }
}
