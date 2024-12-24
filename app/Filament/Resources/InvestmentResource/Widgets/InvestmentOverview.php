<?php

namespace App\Filament\Resources\InvestmentResource\Widgets;

use App\Models\Investment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InvestmentOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $total_investments = Investment::query()->sum('value');
        $annual_investments = Investment::where('created_at', '>=', now()->startOfYear())->sum('value');
        $monthly_investments = Investment::where('created_at', '>=', now()->startOfYear())->sum('value');
        return [
            Stat::make('Investimentos totais', 'R$ ' . number_format($total_investments,2,',','.'))
                ->description('Investimentos durante todo o período')
                ->icon('heroicon-o-calendar-days')
                ->chart([7, 2, 10, 3, 15, 4, 12])
                ->color('info'),
            Stat::make('Investimentos anuais', 'R$ '. number_format($annual_investments,2,',','.'))
                ->description('Investimentos durante todo o ano')
                ->icon('heroicon-o-calendar-days')
                ->chart([7, 2, 10, 3, 15, 4, 12])
                ->color('info'),
            Stat::make('Investimentos mensais', 'R$ '. number_format($monthly_investments,2,',','.'))
                ->description('Investimentos durante todo o mês')
                ->icon('heroicon-o-calendar-days')
                ->chart([7, 2, 10, 3, 15, 4, 12])
                ->color('info'),
        ];
    }
}
