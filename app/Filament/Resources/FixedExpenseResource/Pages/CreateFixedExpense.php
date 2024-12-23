<?php

namespace App\Filament\Resources\FixedExpenseResource\Pages;

use App\Filament\Resources\FixedExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFixedExpense extends CreateRecord
{
    protected static string $resource = FixedExpenseResource::class;
}
