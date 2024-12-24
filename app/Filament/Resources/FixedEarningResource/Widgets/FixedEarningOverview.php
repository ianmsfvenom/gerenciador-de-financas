<?php

namespace App\Filament\Resources\FixedEarningResource\Widgets;

use App\Models\FixedEarning;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FixedEarningOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $total_gain = FixedEarning::query()->sum('value');
        $annual_gain = FixedEarning::where('created_at', '>=', now()->startOfYear())->sum('value');
        $monthly_gain = FixedEarning::where('created_at', '>=', now()->startOfMonth())->sum('value');
        

        return [
            Stat::make('Ganhos totais', 'R$ ' . number_format($total_gain,2,',','.'))
                ->description('Ganhos durante todo período')
                ->icon('heroicon-o-calendar-days')
                ->chart([7, 2, 10, 3, 15, 4, 12])
                ->color('success'),
            Stat::make('Ganho anual', 'R$ ' . number_format($annual_gain,2,',','.'))
                ->description('Ganhos durante todo o ano')
                ->icon('heroicon-o-calendar-days')
                ->chart([12, 14, 5, 11, 9, 1, 6])
                ->color('success'),
            Stat::make('Ganho mensal', 'R$ ' . number_format($monthly_gain,2,',','.'))
                ->description('Ganhos durante todo o mês')
                ->icon('heroicon-o-calendar-days')
                ->chart([6, 19, 13, 17, 10, 2, 15])
                ->color('success'),
        ];
    }
}
