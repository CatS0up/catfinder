<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\Cat\CreateCatAction;
use App\Actions\Cat\DeleteCatAction;
use App\Actions\Cat\UpdateCatAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Cat\UpsertCatRequest;
use App\Models\Cat;
use App\ViewModels\User\Cat\GetCatsViewModel;
use App\ViewModels\User\Cat\ShowCatViewModel;
use App\ViewModels\User\Cat\UpdateCatViewModel;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function index(Request $request): View
    {
        return view('user.cats.index', [
            'model' => (new GetCatsViewModel($request->integer('page')))->toArray(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('user.cats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertCatRequest $request, CreateCatAction $action, AuthManager $auth): RedirectResponse
    {
        $cat = $action->handle($request->toDataObject(), (int)$auth->id());

        return to_route('user.cats.index')
            ->with('success', __('Cat :cat has been created', ['cat' => $cat->name]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cat $cat): View
    {
        return view('user.cats.show', [
            'model' => (new ShowCatViewModel($cat))->toArray(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cat $cat): View
    {
        $this->authorize('update-cat', $cat);

        return view('user.cats.edit', [
            'model' => (new UpdateCatViewModel($cat))->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Cat $cat, UpsertCatRequest $request, UpdateCatAction $action, AuthManager $auth): RedirectResponse
    {
        $this->authorize('update-cat', $cat);

        $cat = $action->handle($cat->id, $request->toDataObject());

        return to_route('user.cats.index')
            ->with('success', __('Cat :cat has been updated', ['cat' => $cat->name]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cat $cat, DeleteCatAction $action): RedirectResponse
    {
        $this->authorize('delete-cat', $cat);

        $action->handle($cat->id);

        return to_route('user.cats.index')
            ->with('info', __('Cat :cat has been deleted', ['cat' => $cat->name]));
    }
}
