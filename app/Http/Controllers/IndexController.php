<?php

namespace App\Http\Controllers;

use App\Services\TwitterService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
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
     * Display a settings for Twitter account
     */
    public function index()
    {
        return view('index');
    }

    public function tweets(Request $request): View
    {
        // Get query parameters
        $removeTag = $request->get('remove');
        $search = $request->get('search');
        $limit = $request->get('limit') ?? 100;

        // Get phrases from session (last searchs)
        $phrases = Session::get('phrases', collect([]));
        if ($removeTag) {
            $phrases = $phrases->reject(function ($value, $key) use ($removeTag) {
                return $value == $removeTag;
            });
        }
        // Push new search phrase
        if ($search && !$phrases->contains($search)) {
            $phrases->push($search);
        }
        Session::put('phrases', $phrases);

        $tweets = [];

        if ($phrases->count() > 0) {
            $client = $this->twitterService->getClient();
            // Get recent tweets by giving query values
            $apiData = $client->tweetSearch()
                ->addMaxResults(intval($limit))
                ->addFilterOnKeywordOrPhrase($phrases->toArray())
                ->showUserDetails()
                ->performRequest();

            if (isset($apiData->data)) {
                $tweets = array_map(function ($tweet) use ($apiData) {
                    foreach ($apiData?->includes?->users as $user) {
                        if ($tweet->author_id === $user->id) {
                            $tweet->author = $user;
                            return $tweet;
                        }
                    }
                    return $tweet;
                }, $apiData->data);
            }
        }

        return view('tweets', compact('tweets', 'phrases'));
    }
}
