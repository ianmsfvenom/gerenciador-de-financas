<?php

namespace App\Filament\Resources;

use App\ExpenseType;
use App\Filament\Resources\VariableExpenseResource\Pages;
use App\Filament\Resources\VariableExpenseResource\RelationManagers;
use App\Filament\Resources\VariableExpenseResource\Widgets\VariableExpenseOverview;
use App\Models\VariableExpense;
use Filament\Forms;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VariableExpenseResource extends Resource
{
    protected static ?string $model = VariableExpense::class;
    protected static ?string $modelLabel = 'despesa variável';
    protected static ?string $pluralModelLabel = 'despesas variáveis';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->translateLabel()
                    ->label('Nome')
                    ->required(),
                Forms\Components\TextInput::make('value')
                    ->label('Valor')
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
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('value')
                    ->translateLabel()
                    ->label('Valor gasto')
                    ->formatStateUsing(fn ($state) => 'R$ ' . number_format($state, 2, ',', '.'))
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
            'index' => Pages\ListVariableExpenses::route('/'),
            'create' => Pages\CreateVariableExpense::route('/create'),
            'edit' => Pages\EditVariableExpense::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array {
        return [
            VariableExpenseOverview::class,
        ];
    }
}
