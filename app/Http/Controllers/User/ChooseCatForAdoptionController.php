<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Actions\User\ChooseCatForAdoptionAction;
use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\RedirectResponse;

class ChooseCatForAdoptionController extends Controller
{
    public function __invoke(Cat $cat, ChooseCatForAdoptionAction $action, AuthManager $auth): RedirectResponse
    {
        $this->authorize('choose-cat-for-adoption');

        $action->handle($cat->id, (int)$auth->id());

        return to_route('user.cats.index')
            ->with('success', __('You have chosen a cat for adoption :cat now wait for the admin\'s consideration', ['cat' => $cat->name]));
    }
}
