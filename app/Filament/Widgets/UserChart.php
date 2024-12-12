<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class UserChart extends ChartWidget
{
    protected static ?string $heading = 'Gráfic de Usuarios';

    protected function putDataDatos():array{
      return  [25, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89];
    }
    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' =>$this->putDataDatos(),
                    'backgroundColor' => '#08732d',
                    'borderColor' => '#ffffffdb',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
