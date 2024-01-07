<?php

declare(strict_types=1);

namespace App\ViewModels\Admin;

use App\DataObjects\CatData;
use App\Models\Cat;
use App\ViewModels\BaseViewModel;
use Illuminate\Pagination\Paginator;

class DashboardViewModel extends BaseViewModel
{
    private const PER_PAGE = 1;

    public function __construct(private readonly int $currentPage)
    {
    }

    /** @return \Illuminate\Pagination\Paginator<CatData> */
    public function catsForApproval(): Paginator
    {
        $items = Cat::query()
            ->latest()
            ->get()
            ->map(fn (Cat $cat): CatData => $cat->getData())
            ->slice(self::PER_PAGE * ($this->currentPage - 1));

        return new Paginator(
            $items,
            self::PER_PAGE,
            $this->currentPage,
            [
                'path' => route('admin.dashboard'),
            ],
        );
    }

    public function availableCatsAmount(): int
    {
        return Cat::available()->count();
    }

    public function adoptedCatsAmount(): int
    {
        return Cat::adopted()->count();
    }
}
