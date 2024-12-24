<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\VariableExpenseResource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use PhpParser\Node\Expr\Variable;

class LatestVariableExpenses extends BaseWidget
{
    protected static bool $isLazy = false;
    protected static ?string $pollingInterval = null;
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Últimos gastos';
    protected static ?string $description = 'Os gastos registrados recentemente';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                VariableExpenseResource::getEloquentQuery()
            )
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->sortable(),
                TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn ($state) => 'R$ ' . number_format($state, 2, ',', '.'))
                    ->sortable(),
                
            ]);
    }
}
