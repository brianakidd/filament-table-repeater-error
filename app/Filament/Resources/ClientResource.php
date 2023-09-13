<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Client;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
//                Forms\Components\Repeater::make('clientContacts')
//                    ->label('Contacts')
//                    ->relationship()
//                    ->schema([
//                        Forms\Components\Select::make('contact_id')
//                            ->relationship('contact', 'name')
//                            ->required()
//                            ->searchable()
//                            ->createOptionForm([
//                                Forms\Components\TextInput::make('name')
//                                    ->required(),
//                            ])->createOptionModalHeading('Create Contact'),
//                    ]),
                TableRepeater::make('clientContacts')
                    ->label('Contacts')
                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('contact_id')
                            ->relationship('contact', 'name')
                            ->required()
                            ->searchable()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                            ])->createOptionModalHeading('Create Contact'),

                    ])->hideLabels()->emptyLabel('No associated contacts.')
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
