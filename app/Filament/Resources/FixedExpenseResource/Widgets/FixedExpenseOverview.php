<?php

namespace App\Filament\Resources\FixedExpenseResource\Widgets;

use App\Models\FixedExpense;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FixedExpenseOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $total_expenses = FixedExpense::query()->sum('value');
        $annual_expenses = FixedExpense::where('created_at', '>=', now()->startOfYear())->sum('value');
        $monthly_expenses = FixedExpense::where('created_at', '>=', now()->startOfMonth())->sum('value');


        return [
            Stat::make('Despesas totais', 'R$ ' . number_format($total_expenses,2, ',','.'))
                ->description('Despesas durante todo o período')
                ->icon('heroicon-o-calendar-days')
                ->chart([7, 2, 10, 3, 15, 4, 12])
                ->color('danger'),
            Stat::make('Despesas anuais', 'R$ ' . number_format($annual_expenses, 2,',','.'))
                ->description('Despesas durante todo o ano')
                ->icon('heroicon-o-calendar-days')
                ->chart([12, 14, 5, 11, 9, 1, 6])
                ->color('danger'),
            Stat::make('Despesas mensais', 'R$ ' . number_format($monthly_expenses, 2,',','.'))
                ->description('Despesas durante todo o mês')
                ->icon('heroicon-o-calendar-days')
                ->chart([6, 19, 13, 17, 10, 2, 15])
                ->color('danger'),
        ];
    }
}