<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\ViewModels\User\Cat\GetCatsViewModel;
use Illuminate\Contracts\View\View;
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
    public function store(Request $request): void
    {
        // TODO: Logic
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        return view('user.cats.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        return view('user.cats.show');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void
    {
        // TODO: Logic
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        // TODO: Logic
    }
}
