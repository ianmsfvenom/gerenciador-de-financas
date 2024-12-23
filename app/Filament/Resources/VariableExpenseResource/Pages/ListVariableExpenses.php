<?php

namespace App\Filament\Resources\VariableExpenseResource\Pages;

use App\Filament\Resources\VariableExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVariableExpenses extends ListRecords
{
    protected static string $resource = VariableExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
