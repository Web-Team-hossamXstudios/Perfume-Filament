<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Filament\Resources\OrderResource\Pages\ListOrders;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class OrderOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListOrders::class;
    }
    protected function getStats(): array
    {
        
        return [
            Stat::make('Total Orders', Order::count()),
        ];
    }
}
