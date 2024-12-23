<?php

namespace App;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum EarningType: string implements HasColor, HasIcon, HasLabel
{
    case SalaryBonus = 'Bonus de salário';
    case ExternalService = 'Serviço externo';
    case Other = 'Outros';


    public function getLabel(): string|null {
        return match ($this) {
            self::SalaryBonus => 'Bonus de salário',
            self::ExternalService => 'Serviço externo',
            self::Other => 'Outros'
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::SalaryBonus => 'success',
            self::ExternalService => 'info',
            self::Other => 'warning'
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::SalaryBonus => 'heroicon-o-circle-stack',
            self::ExternalService => 'heroicon-o-arrow-top-right-on-square',
            self::Other => 'heroicon-o-ellipsis-horizontal-circle'
        };
    }
}
