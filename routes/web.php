<?php

use App\Models\PullRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $response = Http::get('https://api.github.com/repos/laravel/laravel/pulls?state=all');

    foreach ($response->json() as $value) {


        PullRequest::query()->create([
            'api_id' => $value['id'],
            'api_number' => $value['number'],
            'state' => $value['state'],
            'title' => $value['title'],
            'api_created_at' => Carbon::parse($value['created_at'])->format('Y-m-d H:i:s'),
            'api_updated_at' => Carbon::parse($value['updated_at'])->format('Y-m-d H:i:s'),
            'api_closed_at' => Carbon::parse($value['closed_at'])->format('Y-m-d H:i:s'),
            'api_merged_at' => Carbon::parse($value['merged_at'])->format('Y-m-d H:i:s'),
        ]);
    }
});
