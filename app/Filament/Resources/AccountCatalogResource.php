<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountCatalogResource\Pages;
use App\Filament\Resources\AccountCatalogResource\RelationManagers;
use App\Models\AccountCatalog;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccountCatalogResource extends Resource
{
    protected static ?string $model = AccountCatalog::class;

    protected static ?string $navigationIcon = 'heroicon-o-calculator';
    
    protected static ?string $navigationLabel = 'Catálogo de Cuentas';
    
    protected static ?string $modelLabel = 'Cuenta';
    
    protected static ?string $pluralModelLabel = 'Cuentas';
    
    protected static ?string $navigationGroup = 'Contabilidad';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->label('Código')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20)
                            ->placeholder('Ej: 1.1.01.001'),
                            
                        Forms\Components\Select::make('type_account')
                            ->label('Tipo de Cuenta')
                            ->required()
                            ->options([
                                'ACTIVO' => 'Activo',
                                'PASIVO' => 'Pasivo',
                                'PATRIMONIO' => 'Patrimonio',
                                'INGRESOS' => 'Ingresos',
                                'GASTOS' => 'Gastos',
                                'COSTOS' => 'Costos'
                            ]),
                    ]),
                    
                Forms\Components\TextInput::make('description')
                    ->label('Descripción')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                    
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Select::make('type_naturaled')
                            ->label('Naturaleza')
                            ->required()
                            ->options([
                                'D' => 'Deudora',
                                'A' => 'Acreedora'
                            ]),
                            
                        Forms\Components\Select::make('accept_transaction')
                            ->label('Acepta Transacciones')
                            ->required()
                            ->options([
                                'S' => 'Sí',
                                'N' => 'No'
                            ])
                            ->default('S'),
                    ]),
                    
                Forms\Components\TextInput::make('group')
                    ->label('Grupo')
                    ->maxLength(100)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Código')
                    ->sortable()
                    ->searchable()
                    ->copyable()
                    ->weight('bold'),
                    
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->searchable()
                    ->limit(50),
                    
                Tables\Columns\BadgeColumn::make('type_account')
                    ->label('Tipo')
                    ->colors([
                        'success' => 'ACTIVO',
                        'danger' => 'PASIVO',
                        'primary' => 'PATRIMONIO',
                        'warning' => 'INGRESOS',
                        'secondary' => 'GASTOS',
                        'info' => 'COSTOS'
                    ]),
                    
                Tables\Columns\BadgeColumn::make('type_naturaled')
                    ->label('Naturaleza')
                    ->colors([
                        'success' => 'D',
                        'primary' => 'A'
                    ])
                    ->enum([
                        'D' => 'Deudora',
                        'A' => 'Acreedora'
                    ]),
                    
                Tables\Columns\IconColumn::make('accept_transaction')
                    ->label('Acepta Trans.')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->getStateUsing(fn ($record) => $record->accept_transaction === 'S'),
                    
                Tables\Columns\TextColumn::make('group')
                    ->label('Grupo')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type_account')
                    ->label('Tipo de Cuenta')
                    ->options([
                        'ACTIVO' => 'Activo',
                        'PASIVO' => 'Pasivo',
                        'PATRIMONIO' => 'Patrimonio',
                        'INGRESOS' => 'Ingresos',
                        'GASTOS' => 'Gastos',
                        'COSTOS' => 'Costos'
                    ]),
                    
                Tables\Filters\SelectFilter::make('type_naturaled')
                    ->label('Naturaleza')
                    ->options([
                        'D' => 'Deudora',
                        'A' => 'Acreedora'
                    ]),
                    
                Tables\Filters\SelectFilter::make('accept_transaction')
                    ->label('Acepta Transacciones')
                    ->options([
                        'S' => 'Sí',
                        'N' => 'No'
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('code');
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
            'index' => Pages\ListAccountCatalogs::route('/'),
            'create' => Pages\CreateAccountCatalog::route('/create'),
            'edit' => Pages\EditAccountCatalog::route('/{record}/edit'),
        ];
    }    
}
