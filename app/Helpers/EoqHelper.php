<?php



use App\Models\EOQSetting;
use Carbon\Carbon;

if (!function_exists('formatNumber')) {
    function formatNumber($number)
    {
        return explode('.', $number)[0];
    }
}
if (!function_exists('getEoq')) {
    function getEoq($product)
    {
        $now = Carbon::now();
        $bulanIni = $now->format('Y-m');
        $startDate = $now->copy()->subMonths(5)->startOfMonth();
        $endDate = $now->copy()->endOfMonth();
        $cost = EOQSetting::first();
        if (!$cost) {
            return false;
        }
    }
}
