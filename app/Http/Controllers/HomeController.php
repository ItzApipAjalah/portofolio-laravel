<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Visitor;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{

    private function getCountryFromIp($ip)
    {
        // Use ipapi.co as primary service
        $response = Http::get('https://ipapi.co/' . $ip . '/json/');
        if ($response->successful()) {
            $country = $response->json()['country_name'] ?? 'Unknown';
            if ($country !== 'Unknown') {
                return $country;
            }
        }

        // Fallback to ipinfo.io
        $response = Http::get("https://ipinfo.io/{$ip}/json");
        if ($response->successful()) {
            $country = $response->json()['country'] ?? 'Unknown';
            if ($country !== 'Unknown') {
                return $country;
            }
        }

        return 'Unknown';
    }

     private function standardizeCountry($country)
    {
        // Comprehensive map of country codes or alternative names to standardized country names
        $countryMap = [
            'JP' => 'Japan',
            'US' => 'United States',
            'GB' => 'United Kingdom',
            'DE' => 'Germany',
            'FR' => 'France',
            'IN' => 'India',
            'CN' => 'China',
            'RU' => 'Russia',
            'BR' => 'Brazil',
            'CA' => 'Canada',
            'AU' => 'Australia',
            'IT' => 'Italy',
            'ES' => 'Spain',
            'MX' => 'Mexico',
            'KR' => 'South Korea',
            'ID' => 'Indonesia',
            'TR' => 'Turkey',
            'NL' => 'Netherlands',
            'SA' => 'Saudi Arabia',
            'CH' => 'Switzerland',
            'SE' => 'Sweden',
            'NG' => 'Nigeria',
            'ZA' => 'South Africa',
            'AR' => 'Argentina',
            'CO' => 'Colombia',
            'TH' => 'Thailand',
            'MY' => 'Malaysia',
            'PH' => 'Philippines',
            'SG' => 'Singapore',
            'HK' => 'Hong Kong',
            'AE' => 'United Arab Emirates',
            'PL' => 'Poland',
            'BE' => 'Belgium',
            'VN' => 'Vietnam',
            'PK' => 'Pakistan',
            'IR' => 'Iran',
            'EG' => 'Egypt',
            'BD' => 'Bangladesh',
            'IQ' => 'Iraq',
            'UA' => 'Ukraine',
            'DZ' => 'Algeria',
            'KZ' => 'Kazakhstan',
            'PT' => 'Portugal',
            'GR' => 'Greece',
            'HU' => 'Hungary',
            'RO' => 'Romania',
            'CZ' => 'Czech Republic',
            'AT' => 'Austria',
            'IL' => 'Israel',
            'NO' => 'Norway',
            'DK' => 'Denmark',
            'FI' => 'Finland',
            'NZ' => 'New Zealand',
            'IE' => 'Ireland',
            'CL' => 'Chile',
            'PE' => 'Peru',
            'VE' => 'Venezuela',
            'EC' => 'Ecuador',
            'CU' => 'Cuba',
            'LK' => 'Sri Lanka',
            'MM' => 'Myanmar',
            'KH' => 'Cambodia',
            'NP' => 'Nepal',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe',
            'MA' => 'Morocco',
            'TN' => 'Tunisia',
            'SY' => 'Syria',
            'LY' => 'Libya',
            'SD' => 'Sudan',
            'YE' => 'Yemen',
            'JO' => 'Jordan',
            'LB' => 'Lebanon',
            'OM' => 'Oman',
            'QA' => 'Qatar',
            'KW' => 'Kuwait',
            'BH' => 'Bahrain',
            'CY' => 'Cyprus',
            'IS' => 'Iceland',
            'LU' => 'Luxembourg',
            'MT' => 'Malta',
            'MC' => 'Monaco',
            'SM' => 'San Marino',
            'VA' => 'Vatican City',
            'AM' => 'Armenia',
            'AZ' => 'Azerbaijan',
            'GE' => 'Georgia',
            'MD' => 'Moldova',
            'BY' => 'Belarus',
            'BG' => 'Bulgaria',
            'HR' => 'Croatia',
            'SI' => 'Slovenia',
            'BA' => 'Bosnia and Herzegovina',
            'ME' => 'Montenegro',
            'RS' => 'Serbia',
            'MK' => 'North Macedonia',
            'AL' => 'Albania',
            'XK' => 'Kosovo',
            'LT' => 'Lithuania',
            'LV' => 'Latvia',
            'EE' => 'Estonia',
            'SK' => 'Slovakia',
            'YU' => 'Yugoslavia', // Historical reference
            'CS' => 'Czechoslovakia', // Historical reference
            'ZR' => 'Zaire', // Historical reference
            'TP' => 'East Timor', // Historical reference
            'SU' => 'Soviet Union', // Historical reference
            'XX' => 'Unknown', // Catch-all for unknown codes
        ];

        return $countryMap[$country] ?? $country;
    }

    public function index(Request $request)
    {
        $ip = $request->ip();
        $existingVisitor = Visitor::where('ip_address', $ip)->first();

        if (!$existingVisitor) {
            $country = $this->getCountryFromIp($ip);
            $country = $this->standardizeCountry($country);

            // Create new visitor
            Visitor::create([
                'ip_address' => $ip,
                'country' => $country,
            ]);

            // Set cookie and localStorage
            Cookie::queue('visitor_recorded', 'true', 60*24*365); // 1 year expiration
        }

        $visitorCount = Visitor::count();
        $visitorsByCountry = Visitor::select('country', \DB::raw('count(*) as total'))
                                    ->groupBy('country')
                                    ->get();

        $countryData = [];
        foreach ($visitorsByCountry as $visitor) {
            $country = $visitor->country;
            $country = $this->standardizeCountry($country);
            if (isset($countryData[$country])) {
                $countryData[$country] += $visitor->total;
            } else {
                $countryData[$country] = $visitor->total;
            }
        }

        $countries = array_keys($countryData);
        $totals = array_values($countryData);

        $username = "ItzApipAjalah";
        $response = Http::get("https://api.github.com/users/{$username}/repos");
        $projects = $response->json();
        $projects = array_slice($projects, 0, 5);

        $discordUserId = '481734993622728715';
        $dcresponse = Http::get("https://api.lanyard.rest/v1/users/{$discordUserId}");
        $data = $dcresponse->json();

        $commitresponse = Http::get("https://api.github.com/repos/ItzApipAjalah/portofolio-laravel/commits");
        $commit = $commitresponse->json();
        $lastCommitTitle = $commit[0]['commit']['message'] ?? 'No recent changes found';

        return view('home', compact('projects', 'data', 'lastCommitTitle', 'visitorCount', 'countries', 'totals'));
    }

    private function getStatusColor($status)
    {
        switch ($status) {
            case 'online':
                return '#4b8';
            case 'idle':
                return '#fa1';
            case 'dnd':
                return '#f44';
            case 'offline':
                return '#778';
            default:
                return '#000';
        }
    }
}
