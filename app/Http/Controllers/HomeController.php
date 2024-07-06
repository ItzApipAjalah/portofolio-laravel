<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{
    public function index()
    {
        $username = "ItzApipAjalah";
        $response = Http::get("https://api.github.com/users/{$username}/repos");
        $projects = $response->json();

        usort($projects, function ($a, $b) {
            return strtotime($b['updated_at']) - strtotime($a['updated_at']);
        });

        $projects = array_slice($projects, 0, 5);


        $discordUserId = '481734993622728715';
        $dcresponse = Http::get("https://api.lanyard.rest/v1/users/{$discordUserId}");
        $data = $dcresponse->json();

        $commitresponse = Http::get("https://api.github.com/repos/ItzApipAjalah/portofolio-laravel/commits");
        $commit = $commitresponse->json();
        $lastCommitTitle = $commit[0]['commit']['message'] ?? 'No recent changes found';

        return view('home', compact('projects', 'data', 'lastCommitTitle'));


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
