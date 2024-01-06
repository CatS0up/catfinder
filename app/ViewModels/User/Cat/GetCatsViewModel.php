<?php

declare(strict_types=1);

namespace App\ViewModels\User\Cat;

use App\DataObjects\CatData;
use App\Models\Cat;
use App\ViewModels\BaseViewModel;
use Illuminate\Pagination\Paginator;

class GetCatsViewModel extends BaseViewModel
{
    private const PER_PAGE = 21;

    public function __construct(private readonly int $currentPage)
    {
    }

    /** @return \Illuminate\Pagination\Paginator<CatData> */
    public function cats(): Paginator
    {
        $items = Cat::query()
            ->available()
            ->latest()
            ->get()
            ->map(fn (Cat $cat): CatData => $cat->getData())
            ->slice(self::PER_PAGE * ($this->currentPage - 1));

        return new Paginator(
            $items,
            self::PER_PAGE,
            $this->currentPage,
            [
                'path' => route('user.cats.index'),
            ],
        );
    }
}
