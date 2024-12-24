<?php

namespace App\Filament\Resources;

use App\EarningType;
use App\Filament\Resources\FixedEarningResource\Pages;
use App\Filament\Resources\FixedEarningResource\RelationManagers;
use App\Filament\Resources\FixedEarningResource\Widgets\FixedEarningOverview;
use App\Models\FixedEarning;
use Filament\Forms;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FixedEarningResource extends Resource
{
    protected static ?string $model = FixedEarning::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    protected static ?string $modelLabel = 'ganho fixo';
    protected static ?string $pluralModelLabel = 'ganhos fixos';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->translateLabel()
                    ->label('Nome')
                    ->required(),
                Forms\Components\TextInput::make('value')
                    ->label('Valor ganho')
                    ->translateLabel()
                    ->required()
                    ->numeric(),
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
                    ->label('Nome do ganho')
                    ->searchable(),
                Tables\Columns\TextColumn::make('value')
                    ->translateLabel()
                    ->label('Valor ganho')
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
            'index' => Pages\ListFixedEarnings::route('/'),
            'create' => Pages\CreateFixedEarning::route('/create'),
            'edit' => Pages\EditFixedEarning::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            FixedEarningOverview::class,
        ];
    }
}
