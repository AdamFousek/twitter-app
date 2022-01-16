<?php declare(strict_types=1);

namespace App\Twitter;

use Noweh\TwitterApi\AbstractController;

class Tweets extends AbstractController
{
    /** @var string[] $filteredIds */
    private array $filteredIds;

    /** @var bool $addUserDetails */
    private bool $addUserDetails = false;

    /** @var bool $addMetrics */
    private bool $addMetrics = false;

    /**
     * @param array<string> $settings
     * @throws \Exception
     */
    public function __construct(array $settings)
    {
        parent::__construct($settings);
        $this->setEndpoint('tweets');
    }

    /**
     * Matches the exact ids
     * @param array<string> $ids
     * @return Tweets
     */
    public function addFilterOnKeywordOrPhrase(array $ids): Tweets
    {
        $this->filteredIds = $ids;

        return $this;
    }

    /**
     * Show UserDetails in response
     * @return Tweets
     */
    public function showUserDetails(): Tweets
    {
        $this->addUserDetails = true;

        return $this;
    }

    /**
     * Show Metrics in response
     * @return Tweets
     */
    public function showMetrics(): Tweets
    {
        $this->addMetrics = true;

        return $this;
    }


    /**
     * Retrieve Endpoint value and rebuilt it with the expected parameters
     * @return string
     * @throws \JsonException
     * @throws \Exception
     */
    protected function constructEndpoint(): string
    {
        $endpoint = parent::constructEndpoint();

        if (empty($this->filteredIds)
        ) {
            $error = new \stdClass();
            $error->message = 'cURL error';
            $error->details = 'A filter on ids is required';

            throw new \Exception(json_encode($error, JSON_THROW_ON_ERROR), 403);
        }

        $endpoint .= '?ids=';

        if (!empty($this->filteredIds)) {
            $endpoint .= implode(',', $this->filteredIds);
        }

        $endpoint .= '&tweet.fields=public_metrics';
        $endpoint .= '&media.fields=url';

        if ($this->addUserDetails) {
            $endpoint .= '&expansions=author_id&user.fields=description';
        }
        //dd($endpoint);
        return $endpoint;
    }
}
