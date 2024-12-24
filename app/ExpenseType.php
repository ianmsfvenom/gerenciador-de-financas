<?php

namespace App;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ExpenseType: string implements HasColor, HasIcon, HasLabel
{
    case Bill = 'Conta';
    case Food = 'Alimentação';
    case Health = 'Saúde e bem-estar';
    case Transport = 'Transporte';
    case Others = 'Outros';
    case Invoice = 'Fatura';


    public function getLabel(): string|null {
        return match ($this) {
            self::Bill => 'Conta',
            self::Food => 'Alimentação',
            self::Health => 'Saúde e bem-estar',
            self::Transport => 'Transporte',
            self::Invoice => 'Fatura do cartão',
            self::Others => 'Outros',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Bill => 'success',
            self::Food => 'warning',
            self::Health => 'info',
            self::Transport => 'danger',
            self::Others => 'warning',
            self::Invoice => 'danger'
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Bill => 'heroicon-o-document-currency-dollar',
            self::Food => 'heroicon-o-cake',
            self::Health => 'heroicon-o-heart',
            self::Transport => 'heroicon-o-truck',
            self::Others => 'heroicon-o-ellipsis-horizontal-circle',
            self::Invoice => 'heroicon-o-credit-card'
        };
    }
}
