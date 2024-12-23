<?php

namespace App\Filament\Resources;

use App\ExpenseType;
use App\Filament\Resources\FixedExpenseResource\Pages;
use App\Filament\Resources\FixedExpenseResource\RelationManagers;
use App\Models\FixedExpense;
use Filament\Forms;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FixedExpenseResource extends Resource
{
    protected static ?string $model = FixedExpense::class;
    protected static ?string $modelLabel = 'despesa fixa';
    protected static ?string $pluralModelLabel = 'despesas fixas';
    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->translateLabel()
                    ->label('Nome')
                    ->required(),
                Forms\Components\TextInput::make('value')
                    ->label('Valor da despesa')
                    ->translateLabel()
                    ->required()
                    ->numeric(),
                ToggleButtons::make('type')
                    ->label('Tipo')
                    ->options(ExpenseType::class)
                    ->inline()
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Descrição')
                    ->translateLabel()
                    ->required()
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel()
                    ->label('Nome da despesa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('value')
                    ->translateLabel()
                    ->label('Valor da despesa')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->translateLabel()
                    ->label('Descrição'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')  
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFixedExpenses::route('/'),
            'create' => Pages\CreateFixedExpense::route('/create'),
            'edit' => Pages\EditFixedExpense::route('/{record}/edit'),
        ];
    }
}
