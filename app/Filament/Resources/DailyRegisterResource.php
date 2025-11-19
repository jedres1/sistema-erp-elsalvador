<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyRegisterResource\Pages;
use App\Filament\Resources\DailyRegisterResource\RelationManagers;
use App\Models\DailyRegister;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DailyRegisterResource extends Resource
{
    protected static ?string $model = DailyRegister::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    
    protected static ?string $navigationLabel = 'Libro Diario';
    
    protected static ?string $modelLabel = 'Asiento';
    
    protected static ?string $pluralModelLabel = 'Asientos';
    
    protected static ?string $navigationGroup = 'Contabilidad';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\DatePicker::make('date_register')
                            ->label('Fecha de Registro')
                            ->required()
                            ->default(now()),
                            
                        Forms\Components\Select::make('mayor')
                            ->label('Estado en Mayor')
                            ->options([
                                'S' => 'Mayorizado',
                                'N' => 'Pendiente'
                            ])
                            ->default('N')
                            ->required(),
                    ]),
                    
                Forms\Components\Textarea::make('description')
                    ->label('Descripción')
                    ->required()
                    ->maxLength(500)
                    ->rows(3)
                    ->columnSpanFull(),
                    
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('mount_debit')
                            ->label('Monto Débito')
                            ->numeric()
                            ->step(0.01)
                            ->prefix('$')
                            ->default(0.00),
                            
                        Forms\Components\TextInput::make('mount_credit')
                            ->label('Monto Crédito')
                            ->numeric()
                            ->step(0.01)
                            ->prefix('$')
                            ->default(0.00),
                            
                        Forms\Components\TextInput::make('balance')
                            ->label('Balance')
                            ->numeric()
                            ->step(0.01)
                            ->prefix('$')
                            ->default(0.00)
                            ->readOnly(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date_register')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable()
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(50)
                    ->searchable()
                    ->tooltip(function (DailyRegister $record): string {
                        return $record->description;
                    }),
                    
                Tables\Columns\TextColumn::make('mount_debit')
                    ->label('Débito')
                    ->money('USD')
                    ->sortable()
                    ->alignEnd()
                    ->color('success'),
                    
                Tables\Columns\TextColumn::make('mount_credit')
                    ->label('Crédito')
                    ->money('USD')
                    ->sortable()
                    ->alignEnd()
                    ->color('danger'),
                    
                Tables\Columns\TextColumn::make('balance')
                    ->label('Balance')
                    ->money('USD')
                    ->sortable()
                    ->alignEnd()
                    ->weight('bold'),
                    
                Tables\Columns\BadgeColumn::make('mayor')
                    ->label('Estado')
                    ->colors([
                        'success' => 'S',
                        'warning' => 'N'
                    ])
                    ->enum([
                        'S' => 'Mayorizado',
                        'N' => 'Pendiente'
                    ]),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\DateFilter::make('date_register')
                    ->label('Fecha de Registro'),
                    
                Tables\Filters\SelectFilter::make('mayor')
                    ->label('Estado en Mayor')
                    ->options([
                        'S' => 'Mayorizado',
                        'N' => 'Pendiente'
                    ]),
                    
                Tables\Filters\Filter::make('mount_range')
                    ->label('Rango de Montos')
                    ->form([
                        Forms\Components\TextInput::make('from')
                            ->label('Desde')
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\TextInput::make('until')
                            ->label('Hasta')
                            ->numeric()
                            ->prefix('$'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->where('mount_debit', '>=', $data['from'])
                                    ->orWhere('mount_credit', '>=', $data['from']),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->where('mount_debit', '<=', $data['until'])
                                    ->orWhere('mount_credit', '<=', $data['until']),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('mayorize')
                    ->label('Mayorizar')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn (DailyRegister $record) => $record->update(['mayor' => 'S']))
                    ->visible(fn (DailyRegister $record) => $record->mayor === 'N'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('mayorize_bulk')
                    ->label('Mayorizar Seleccionados')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function ($records) {
                        $records->each(fn ($record) => $record->update(['mayor' => 'S']));
                    }),
            ])
            ->defaultSort('date_register', 'desc');
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
            'index' => Pages\ListDailyRegisters::route('/'),
            'create' => Pages\CreateDailyRegister::route('/create'),
            'edit' => Pages\EditDailyRegister::route('/{record}/edit'),
        ];
    }    
}
