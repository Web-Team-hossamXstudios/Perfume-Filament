<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Address;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AddressResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AddressResource\RelationManagers;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static ?string $navigationGroup = 'Clients';
    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('city')
                ->required()
                ->maxLength(255),
                TextInput::make('area')->required(),
                TextInput::make('type')->required(),
                TextInput::make('buliding')->required(),
                TextInput::make('appartment')->required(),
                TextInput::make('floor')->required(),
                TextInput::make('street')->required(),
                TextInput::make('additional_directions')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.name'),
                TextColumn::make('city'),
                TextColumn::make('type'),
                TextColumn::make('area'),
                TextColumn::make('buliding'),
                TextColumn::make('appartment'),
                TextColumn::make('floor'),
                TextColumn::make('street'),
                TextColumn::make('additional_directions'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListAddresses::route('/'),
            'create' => Pages\CreateAddress::route('/create'),
            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
    }
}
