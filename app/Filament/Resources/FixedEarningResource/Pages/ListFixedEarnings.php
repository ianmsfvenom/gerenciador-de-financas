<?php

namespace App\Filament\Resources\FixedEarningResource\Pages;

use App\Filament\Resources\FixedEarningResource;
use App\Filament\Resources\FixedEarningResource\Widgets\FixedEarningOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFixedEarnings extends ListRecords
{
    protected static string $resource = FixedEarningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            FixedEarningOverview::class
        ];
    }
}
