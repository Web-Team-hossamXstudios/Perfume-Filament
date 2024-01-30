<?php

namespace App\Filament\Resources\CategoryResource\Widgets;

use App\Filament\Resources\CategoryResource\Pages\ListCategories;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class CategoryOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListCategories::class;
    }
    protected function getStats(): array
    {
        
        return [
            Stat::make('Total Categories', Category::count()),
        ];
    }
}
