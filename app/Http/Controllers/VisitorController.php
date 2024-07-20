<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VisitorController extends Controller
{
    public function store(Request $request)
    {
        $ip = $request->ip();
        $existingVisitor = Visitor::where('ip_address', $ip)->first();

        if (!$existingVisitor) {
            // Fetch country from IP
            $response = Http::get('https://ipapi.co/' . $ip . '/json/');
            $country = $response->json()['country_name'] ?? 'Unknown';

            // Create new visitor
            Visitor::create([
                'ip_address' => $ip,
                'country' => $country,
            ]);
        }

        return response()->json(['message' => 'Visitor logged successfully.']);
    }

    public function count()
    {
        $visitorCount = Visitor::count();
        $visitorsByCountry = Visitor::select('country', \DB::raw('count(*) as total'))
                                    ->groupBy('country')
                                    ->get();

        $countries = [];
        foreach ($visitorsByCountry as $visitor) {
            $countries[] = [
                'country' => $visitor->country,
                'total' => $visitor->total,
                'percentage' => round(($visitor->total / $visitorCount) * 100, 2)
            ];
        }

        return response()->json([
            'visitor_count' => $visitorCount,
            'countries' => $countries
        ]);
    }
}
