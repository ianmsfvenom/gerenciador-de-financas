<?php

namespace App\Filament\Resources\VariableEarningResource\Pages;

use App\Filament\Resources\VariableEarningResource;
use App\Filament\Resources\VariableEarningResource\Widgets\VariableEarningOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVariableEarnings extends ListRecords
{
    protected static string $resource = VariableEarningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array {
        return [
            VariableEarningOverview::class,
        ];
    }
}
