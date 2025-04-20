<?php

namespace MonishRoy\VisitorTracking\Middleware;

use Closure;
use Illuminate\Http\Request;
use MonishRoy\VisitorTracking\Models\Visitor;
use Jenssegers\Agent\Agent;
use GeoIP;

class TrackVisitor
{
    public function boot()
    {
        // Register middleware alias
        $this->app['router']->aliasMiddleware('track.visitor', TrackVisitor::class);
    }
    
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $userAgent = $request->userAgent();

        // Get IP info from ipinfo.io
        $location = Http::get("https://ipinfo.io/{$ip}/json")->json();

        // Parse basic info from user agent
        $parsed = $this->parseUserAgent($userAgent);

        Visitor::create([
            'ip' => $ip,
            'country' => $location['country'] ?? null,
            'region' => $location['region'] ?? null,
            'city' => $location['city'] ?? null,
            'device' => $parsed['device'],
            'os' => $parsed['os'],
            'browser' => $parsed['browser'],
            'url' => $request->fullUrl(),
        ]);

        return $next($request);
    }

    private function parseUserAgent($ua)
    {
        $device = 'Desktop';
        $os = 'Unknown';
        $browser = 'Unknown';

        if (preg_match('/mobile/i', $ua)) {
            $device = 'Mobile';
        } elseif (preg_match('/tablet/i', $ua)) {
            $device = 'Tablet';
        }

        if (preg_match('/Windows NT/i', $ua)) $os = 'Windows';
        elseif (preg_match('/Mac OS X/i', $ua)) $os = 'macOS';
        elseif (preg_match('/Linux/i', $ua)) $os = 'Linux';
        elseif (preg_match('/Android/i', $ua)) $os = 'Android';
        elseif (preg_match('/iPhone|iPad/i', $ua)) $os = 'iOS';

        if (preg_match('/Chrome/i', $ua)) $browser = 'Chrome';
        elseif (preg_match('/Firefox/i', $ua)) $browser = 'Firefox';
        elseif (preg_match('/Safari/i', $ua) && !preg_match('/Chrome/i', $ua)) $browser = 'Safari';
        elseif (preg_match('/Edge/i', $ua)) $browser = 'Edge';
        elseif (preg_match('/MSIE|Trident/i', $ua)) $browser = 'Internet Explorer';

        return compact('device', 'os', 'browser');
    }
}
