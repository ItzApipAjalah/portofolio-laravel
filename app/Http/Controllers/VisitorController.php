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
        return response()->json(['visitor_count' => $visitorCount]);
    }
}
