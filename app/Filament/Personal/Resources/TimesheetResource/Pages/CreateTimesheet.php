<?php

namespace App\Filament\Personal\Resources\TimesheetResource\Pages;

use App\Filament\Personal\Resources\TimesheetResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTimesheet extends CreateRecord
{
    protected static string $resource = TimesheetResource::class;
//    protected function mutateFormDataBeforeCreate(array $data): array
//    {
//
//        $data['user_id'] = auth()->id();
//        $data['type'] = 'work';
//        $data['day_in'] = now();
//        $data['created_at'] = now();
//        $data['updated_at'] = now();
//        return $data;
//    }
}
