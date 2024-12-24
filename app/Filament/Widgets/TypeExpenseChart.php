<?php

namespace App\Filament\Widgets;

use App\Models\FixedExpense;
use App\Models\VariableExpense;
use Filament\Widgets\ChartWidget;

class TypeExpenseChart extends ChartWidget
{
    protected static ?string $heading = 'Gastos com base na categoria';
    protected static bool $isLazy = false;
    protected static ?string $pollingInterval = null;
    protected static ?int $sort = 1;


    protected function getData(): array
    {
        
        $bill_exp = FixedExpense::where('type', 'Conta')->sum('value') + VariableExpense::where('type', 'Conta')->sum('value');
        $food_exp = FixedExpense::where('type', 'Alimentação')->sum('value') + VariableExpense::where('type', 'Alimentação')->sum('value');
        $transport_exp = FixedExpense::where('type', 'Transporte')->sum('value') + VariableExpense::where('type', 'Transporte')->sum('value');
        $health_exp = FixedExpense::where('type', 'Saúde e bem-estar')->sum('value') + VariableExpense::where('type', 'Saúde e bem-estar')->sum('value');
        $invoice_exp = FixedExpense::where('type', 'Fatura do cartão')->sum('value') + VariableExpense::where('type', 'Fatura do cartão')->sum('value');
        $others_exp = FixedExpense::where('type', 'Outros')->sum('value') + VariableExpense::where('type', 'Outros')->sum('value');

        return [
            'labels' => [ 'Contas', 'Alimentação', 'Transporte', 'Saúde e bem-estar', 'Fatura do cartão', 'Outros' ],
            'datasets' => [
                'data' => [$bill_exp, $food_exp, $transport_exp, $health_exp, $invoice_exp, $others_exp],
                'backgroundColor' => ['#f87171', '#3b82f6', '#4b5568', '#f59e0b', '#f59e0b', '#f59e0b'],
                'hoverOffset' => 4
            ]
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
