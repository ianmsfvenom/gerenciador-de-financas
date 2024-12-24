<?php

namespace App\Filament\Resources\VariableEarningResource\Widgets;

use App\Models\VariableEarning;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VariableEarningOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $total_earnings = VariableEarning::query()->sum('value');
        $annual_earnings = VariableEarning::where('created_at', '>=', now()->startOfYear())->sum('value');
        $monthly_earnings = VariableEarning::where('created_at', '>=', now()->startOfMonth())->sum('value');

        return [
            Stat::make('Ganhos totais', 'R$ ' . number_format($total_earnings,2,',','.'))
                ->description('Ganhos durante todo o período')
                ->icon('heroicon-o-calendar-days')
                ->chart([7, 2, 10, 3, 15, 4, 12])
                ->color('primary'),
            Stat::make('Ganhos anuais', 'R$ '. number_format($annual_earnings,2,',','.'))
                ->description('Ganhos durante todo o ano')
                ->icon('heroicon-o-calendar-days')
                ->chart([7, 2, 10, 3, 15, 4, 12])
                ->color('primary'),
            Stat::make('Ganhos mensais', 'R$ '. number_format($monthly_earnings,2,',','.'))
                ->description('Ganhos durante todo o mês')
                ->icon('heroicon-o-calendar-days')
                ->chart([7, 2, 10, 3, 15, 4, 12])
                ->color('primary'),
        ];
    }
}
