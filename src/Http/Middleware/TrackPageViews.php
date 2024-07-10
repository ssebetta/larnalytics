<?php
namespace Ssebetta\Larnalytics\Http\Middleware;

use Closure;
use Ssebetta\Larnalytics\Models\PageView;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class TrackPageViews
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $client = new Client();
        $publicIp = $client->get('https://api.ipify.org')->getBody()->getContents();
        $location = $this->getLocationFromIp($publicIp);
        $agent = new Agent();
        $agent->setUserAgent($request->userAgent());
        $device = $this->getDeviceFromAgent($agent);

        PageView::create([
            'user_id' => Auth::id() ?? 'visitor',
            'page_url' => $request->fullUrl(),
            'viewed_at' => Carbon::now(),
            'ip_address' => $publicIp,
            'location' => $location,
            'user_agent' => $request->userAgent(),
            'device' => $device,
        ]);

        return $response;
    }

    protected function getLocationFromIp($publicIp)
    {
        $client = new Client();
        $response = $client->get("http://ipinfo.io/{$publicIp}/json");
        $data = json_decode($response->getBody(), true);
        return ($data['city']??'-') . ', ' . ($data['region']??'-') . ', ' . ($data['country']??'-');
    }

    protected function getDeviceFromAgent($agent)
    {
        if ($agent->isMobile()) {
            return 'Mobile';
        } elseif ($agent->isTablet()) {
            return 'Tablet';
        } elseif ($agent->isDesktop()) {
            return 'Desktop';
        } else {
            return 'Other';
        }
    }
}
