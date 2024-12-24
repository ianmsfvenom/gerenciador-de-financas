<?php

namespace App\Filament\Resources\FixedExpenseResource\Pages;

use App\Filament\Resources\FixedExpenseResource;
use App\Filament\Resources\FixedExpenseResource\Widgets\FixedExpenseOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFixedExpenses extends ListRecords
{
    protected static string $resource = FixedExpenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            FixedExpenseOverview::class
        ];
    }
}
