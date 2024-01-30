<?php

namespace App\Filament\Resources\ClientResource\Widgets;

use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Filament\Resources\ClientResource\Pages\ListClients;
use App\Models\Client;

class ClientOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListClients::class;
    }
    protected function getStats(): array
    {
        
        return [
            Stat::make('Total Clients', Client::count()),
        ];
    }
}
