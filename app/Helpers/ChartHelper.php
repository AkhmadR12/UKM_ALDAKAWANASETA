<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class ChartHelper
{
    public static function safeData($data, string $periodType): array
    {
        if (!$data || !($data instanceof Collection) || $data->isEmpty()) {
            return [
                'labels' => [],
                'datasets' => []
            ];
        }

        // Logika pengolahan data
        $labels = [];
        $datasets = [];

        // Implementasi sesuai periodType
        switch ($periodType) {
            case 'daily':
                // Logika untuk daily
                break;
            case 'weekly':
                // Logika untuk weekly
                break;
            case 'monthly':
                // Logika untuk monthly
                break;
            case 'yearly':
                // Logika untuk yearly
                break;
        }

        return [
            'labels' => $labels,
            'datasets' => $datasets
        ];
    }
}
