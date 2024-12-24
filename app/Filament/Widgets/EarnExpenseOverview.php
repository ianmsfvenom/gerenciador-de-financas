<?php

namespace App\Filament\Widgets;

use App\Models\FixedEarning;
use App\Models\FixedExpense;
use App\Models\VariableEarning;
use App\Models\VariableExpense;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EarnExpenseOverview extends BaseWidget
{
    protected static bool $isLazy = false;
    protected static ?string $pollingInterval = null;
    protected static ?int $sort = 0;


    protected function getStats(): array
    {
        $total_liquid_recept = (FixedEarning::query()->sum('value') + VariableEarning::query()->sum('value')) - 
            (FixedExpense::query()->sum('value') + VariableExpense::query()->sum('value'));

        $annual_liquid_recept = (FixedEarning::where('created_at', '>=', now()->startOfYear())->sum('value') + VariableEarning::where('created_at', '>=', now()->startOfYear())->sum('value')) - 
            (FixedExpense::where('created_at', '>=', now()->startOfYear())->sum('value') + VariableExpense::where('created_at', '>=', now()->startOfYear())->sum('value'));

        $monthly_liquid_recept = (FixedEarning::where('created_at', '>=', now()->startOfMonth())->sum('value') + VariableEarning::where('created_at', '>=', now()->startOfMonth())->sum('value')) - 
            (FixedExpense::where('created_at', '>=', now()->startOfMonth())->sum('value') + VariableExpense::where('created_at', '>=', now()->startOfMonth())->sum('value'));
        
        
        return [
            Stat::make('Receita total', 'R$ ' . number_format($total_liquid_recept,2,',','.'))
                ->description('Receita líquida durante todo o período')
                ->icon('heroicon-o-calendar-days')
                ->chart([7, 2, 10, 3, 15, 4, 12])
                ->color($total_liquid_recept > 0 ? 'success' : 'danger'),

            Stat::make('Receita anual', 'R$ '. number_format($annual_liquid_recept, 2,',','.'))
                ->description('Receita líquida durante todo o ano')
                ->icon('heroicon-o-calendar-days')
                ->chart([12, 3, 5, 10, 8, 10, 11])
                ->color($annual_liquid_recept > 0 ? 'success' : 'danger'),

            Stat::make('Receita mensal', 'R$ '. number_format($monthly_liquid_recept, 2,',','.'))
                ->description('Receita líquida durante todo o mês')
                ->icon('heroicon-o-calendar-days')
                ->chart([11, 6, 14, 12, 15, 9, 13])
                ->color($monthly_liquid_recept > 0 ? 'success' : 'danger')
        ];
    }
}
