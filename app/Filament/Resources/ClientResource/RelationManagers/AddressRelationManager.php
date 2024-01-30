<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('city')
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('city')
            ->columns([
                TextColumn::make('city'),
                TextColumn::make('area'),
                TextColumn::make('type')->searchable(),
                TextColumn::make('buliding'),
                TextColumn::make('appartment'),
                TextColumn::make('floor'),
                TextColumn::make('street'),
                TextColumn::make('additional_directions'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
