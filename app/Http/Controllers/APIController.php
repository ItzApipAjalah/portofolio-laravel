<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class APIController extends Controller
{
    private $githubUsername = 'ItzApipAjalah';
    private $discordUserId = '481734993622728715';
    private $portfolioRepo = 'ItzApipAjalah/portofolio-laravel';



    public function fetchGitHubProjects()
    {
        try {
            $response = Http::get("https://api.github.com/users/{$this->githubUsername}/repos");
            $data = $response->json();
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching GitHub projects'], 500);
        }
    }

    public function fetchLastCommitTitle()
    {
        try {
            $response = Http::get("https://api.github.com/repos/{$this->portfolioRepo}/commits");
            $data = $response->json();
            return response()->json(['lastCommitTitle' => $data[0]['commit']['message']]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching last commit title'], 500);
        }
    }

    public function fetchDiscordStatus()
    {
        try {
            $response = Http::get("https://api.lanyard.rest/v1/users/{$this->discordUserId}");
            $data = $response->json();
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching Discord status'], 500);
        }
    }

    public function fetchAnimeRecommendations()
    {
        try {
            $response = Http::get("https://api.jikan.moe/v4/recommendations/anime");
            $data = $response->json();
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching anime recommendations'], 500);
        }
    }

    public function fetchWaifuImage()
    {
        try {
            $response = Http::get('https://api.waifu.pics/sfw/waifu');
            $data = $response->json();
            return response()->json(['url' => $data['url']]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching waifu image'], 500);
        }
    }


}
