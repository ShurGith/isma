<?php

namespace App\Filament\Personal\Resources\TimesheetResource\Pages;

use App\Filament\Personal\Resources\TimesheetResource;
use App\Models\Calendar;
use App\Models\Timesheet;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;


class ListTimesheets extends ListRecords
{
    protected static string $resource = TimesheetResource::class;


    protected function getDatoTipo($tipo): bool
    {
        $salida = Timesheet::query()
            ->where('user_id', auth()->id())
            ->where('type', $tipo)
            ->whereNull('day_out')
            ->count();
        return ($salida > 0);
    }

    protected function newRegister($tipo)
    {
        $calendarId = Calendar::where('active', 1)->value('id');
        $record =  New Timesheet();
        $record->type = $tipo;
        $record->day_in = now();
        $record->user_id = auth()->id();
        $record->calendar_id = $calendarId;
        $record->save();
    }

    protected function getHeaderActions(): array
    {

        return [
            /*** INICIAR NUEVA ENTRADA ***/
            // Actions\CreateAction::make('crear_nueva_entrada')
            Action::make('crear_nueva_entrada')
                ->label('Nueva Entrada')
                ->hidden($this->getDatoTipo('pause') || $this->getDatoTipo('work'))
                ->color('primary')
                ->requiresConfirmation()
                ->action(function (Action $action, $record) {
                    $this->newRegister('work');
                }),
            /*** FIN DE LA JORNADA  ***/
            Action::make('ending_time')
                ->label('Fin de la jornada')
                ->icon('heroicon-s-building-storefront')
                ->color('warning')
                ->requiresConfirmation()
                ->hidden(!$this->getDatoTipo('work'))
                ->action(function (Action $action, $record) {
                    $record =  Timesheet::query()
                        ->where(function ($query) {
                            $query->whereNull('day_out')
                                ->orWhere('day_out', ''); // Comprobar si está vacío
                        })
                        ->where('user_id', auth()->id())
                        ->where('type', 'work')
                        ->first();
                    $record->day_out = now();
                    $record->save();
            }),
            /*** FINALIZAR PAUSA  ***/
            Action::make('to_pause')
                ->label('Fin Pausa')
                ->icon('heroicon-m-pencil-square')
                ->color('info')
                ->requiresConfirmation()
                ->hidden(!$this->getDatoTipo('pause'))
                ->action(function (Action $action, $record) {
                    $record =  Timesheet::query()
                        ->where(function ($query) {
                            $query->whereNull('day_out')
                                ->orWhere('day_out', ''); // Comprobar si está vacío
                        })
                        ->where('user_id', auth()->id())
                        ->where('type', 'pause')
                        ->first();
                    $record->day_out = now();
                    $record->save();
                    $this->newRegister('work');
                }),
            /*** INICIAR PAUSA  ***/
            Action::make('make_pause')
                ->label('Iniciar Pausa')
                ->icon('heroicon-m-pencil-square')
                ->color('info')
                ->requiresConfirmation()
                ->hidden(!$this->getDatoTipo('work'))
                ->action(function (Action $action, $record) {
                    $record =  Timesheet::query()
                        ->where(function ($query) {
                            $query->whereNull('day_out')
                                ->orWhere('day_out', ''); // Comprobar si está vacío
                        })
                        ->where('user_id', auth()->id())
                        ->where('type', 'work')
                        ->first();
                    $record->day_out = now();
                    $record->save();
                    $this->newRegister('pause');
                }),
        ];
    }
}
