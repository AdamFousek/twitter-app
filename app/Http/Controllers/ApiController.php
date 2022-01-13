<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Atymic\Twitter\Facade\Twitter;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * Return JSON twitter statuses
     */
    public function index(): JsonResponse
    {
        $params = [
            'max_results' => 100,
        ];

        $statuses = Twitter::forApiV2()->searchRecent('url:pilulka.cz OR #pilulka', $params);

        return JsonResponse::fromJsonString($statuses);
    }
}
