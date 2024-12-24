<?php

namespace App\Filament\Widgets;


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
        
        $bill_exp = VariableExpense::where('type', 'Conta')->sum('value');
        $food_exp = VariableExpense::where('type', 'Alimentação')->sum('value');
        $transport_exp = VariableExpense::where('type', 'Transporte')->sum('value');
        $health_exp = VariableExpense::where('type', 'Saúde e bem-estar')->sum('value');
        $invoice_exp = VariableExpense::where('type', 'Fatura do cartão')->sum('value');
        $others_exp = VariableExpense::where('type', 'Outros')->sum('value');

        return [
            'labels' => [ 'Contas', 'Alimentação', 'Transporte', 'Saúde e bem-estar', 'Fatura do cartão', 'Outros' ],
            'datasets' => [
                'data' => [$bill_exp, $food_exp, $transport_exp, $health_exp, $invoice_exp, $others_exp],
                'backgroundColor' => ['#ff5252', '#fffc29', '#0042ff', '#00ff9b', '#8700ff', '#ffae00'],
                'hoverOffset' => 4
            ]
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
