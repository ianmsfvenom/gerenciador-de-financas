<?php

namespace App\Filament\Widgets;

use App\Models\FixedEarning;
use App\Models\FixedExpense;
use App\Models\VariableEarning;
use App\Models\VariableExpense;
use Filament\Widgets\ChartWidget;

class ExpensesChart extends ChartWidget
{
    protected static ?string $heading = 'Média de gastos/ganhos durante o ano';
    protected static bool $isLazy = false;
    protected static ?string $pollingInterval = null;

    protected static ?int $sort = 1;


    protected function getData(): array
    {
        $fixed_exp = FixedExpense::query()->sum('value');
        $fixed_ear = FixedEarning::query()->sum('value');
        $exp_arr = [];
        $ear_arr = [];
        
        for($i = 1; $i <= 12; $i++) {
            $exp_arr[] = $fixed_exp + VariableExpense::whereMonth('created_at', $i)->whereYear('created_at', date('Y'))->sum('value');
            $ear_arr[] = $fixed_ear + VariableEarning::whereMonth('created_at', $i)->whereYear('created_at', date('Y'))->sum('value');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Gastos por mês',
                    'data' => $exp_arr,
                    'fill' => 'start',
                    'borderColor' => '#f87171',
                ],
                [
                    'label' => 'Ganhos por mês',
                    'data' => $ear_arr,
                    'fill' => 'start',
                    'borderColor' => '#3b82f6',
                ],
            ],
            'labels' => ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'min' => 0,
                    'max' => 10000
                ],
            ],
        ];
    }
}
