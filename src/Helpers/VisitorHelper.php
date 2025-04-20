<?php

namespace MonishRoy\VisitorTracking\Helpers;

use MonishRoy\VisitorTracking\Models\Visitor;
use Illuminate\Support\Facades\DB;

class VisitorHelper
{
    public static function totalVisitors()
    {
        return Visitor::count();
    }

    public static function uniqueVisitors()
    {
        return Visitor::distinct('ip')->count('ip');
    }

    public static function topVisitedPages($limit = 5)
    {
        return Visitor::select('url', DB::raw('count(*) as total'))
            ->groupBy('url')
            ->orderByDesc('total')
            ->limit($limit)
            ->get();
    }

    public static function countryStats()
    {
        return Visitor::select('country', DB::raw('count(*) as total'))
            ->groupBy('country')
            ->orderByDesc('total')
            ->get();
    }

    public static function osStats()
    {
        return Visitor::select('os', DB::raw('count(*) as total'))
            ->groupBy('os')
            ->get();
    }

    public static function deviceStats()
    {
        return Visitor::select('device', DB::raw('count(*) as total'))
            ->groupBy('device')
            ->get();
    }
}
