<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ProductOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListProducts::class;
    }
    protected function getStats(): array
    {
        
        return [
            Stat::make('Total Products', Product::count()),
        ];
    }
}
