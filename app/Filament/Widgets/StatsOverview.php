<?php

namespace App\Filament\Widgets;

use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $userCount = \App\Models\User::count();
        $holidaysCount = \App\Models\Holiday::count();
        $calendarsCount = \App\Models\Calendar::count();
        $holidayApproved = \App\Models\Holiday::where('type', 'approved')->count();
        $holidayPending = \App\Models\Holiday::where('type', 'pending')->count();
        $holidayDeclined = \App\Models\Holiday::where('type', 'decline')->count();

        return [
            Stat::make('Total Employers', $userCount),
            Stat::make('Holidays', $holidaysCount),
            Stat::make('Holidays Approved', $holidayApproved)
                ->descriptionIcon('heroicon-m-battery-100', IconPosition::Before)
                ->description('These are holidays that have been APPROVED.')
                ->color('success'),
            Stat::make('Holidays Pending', $holidayPending)
                ->descriptionIcon('heroicon-m-battery-50', IconPosition::Before)
                ->description('These are holidays that have been PENDING.')
                ->color('warning'),
            Stat::make('Holidays Rejected', $holidayDeclined)
                ->descriptionIcon('heroicon-m-battery-0', IconPosition::Before)
                ->description('These are holidays that have been REJECTED.')
                ->color('danger'),
            Stat::make('Calendars', $calendarsCount),
        ];
    }
}
