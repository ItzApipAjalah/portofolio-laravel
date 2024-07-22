<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class SkillsChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->labels(['HTML', 'CSS', 'JS', 'PHP', 'DART'])
             ->dataset('Keahlian Pemrograman', 'bar', [7, 4, 9, 8, 4])
             ->backgroundColor([
                 'rgba(255, 99, 132, 0.2)',
                 'rgba(54, 162, 235, 0.2)',
                 'rgba(255, 206, 86, 0.2)',
                 'rgba(75, 192, 192, 0.2)',
                 'rgba(0, 166, 255, 0.2)'
             ])
             ->color([
                 'rgba(255, 99, 132, 1)',
                 'rgba(54, 162, 235, 1)',
                 'rgba(255, 206, 86, 1)',
                 'rgba(75, 192, 192, 1)',
                 'rgba(0, 166, 255, 1)'
             ])
             ->options([
                 'scales' => [
                     'y' => ['beginAtZero' => true]
                 ],
                 'plugins' => [
                     'tooltip' => [
                         'callbacks' => [
                             'label' => function ($context) {
                                 $label = $context['dataset']['label'] . ': ' . $context['raw'];
                                 if ($context['label'] === 'PHP') {
                                     $label .= ' (terutama di framework Laravel)';
                                 }
                                 return $label;
                             }
                         ]
                     ]
                 ]
             ]);
    }
}
