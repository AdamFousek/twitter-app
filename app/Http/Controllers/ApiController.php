<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Settings;
use App\Services\TwitterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /** @var TwitterService */
    protected $twitterService;

    /**
     * Create a new controller instance.
     *
     * @param TwitterService $twitterService
     * @return void
     */
    public function __construct(TwitterService $twitterService)
    {
        $this->twitterService = $twitterService;
    }

    /**
     * Return JSON twitter statuses
     */
    public function index(Request $request): JsonResponse
    {
        $requestedValues = explode(',', $request->get('search'));

        $config = $this->twitterService->setConfig();
        $client = $this->twitterService->setClient($config);

        // Get recent tweets by giving query values
        $tweets = $client->tweetSearch()
            ->addMaxResults(intval($config[Settings::TWITTER_LIMIT->value]))
            ->addFilterOnKeywordOrPhrase($requestedValues)
            ->performRequest();
        /*
        // Get ids of tweets and get whole detail of tweets such as full url etc.
        $ids = [];
        foreach($tweets->data as $tweet) {
            array_push($ids, $tweet->id);
        }

        // $detailedTweets = $client->tweets()->addFilterOnKeywordOrPhrase($ids)->performRequest();
        */
        return JsonResponse::fromJsonString(json_encode($tweets));
    }
}
