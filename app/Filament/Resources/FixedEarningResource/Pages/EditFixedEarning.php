<?php

namespace App\Filament\Resources\FixedEarningResource\Pages;

use App\Filament\Resources\FixedEarningResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFixedEarning extends EditRecord
{
    protected static string $resource = FixedEarningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
