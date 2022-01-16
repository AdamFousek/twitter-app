<?php

namespace App\Twitter;

class Client extends \Noweh\TwitterApi\Client
{
    /**
     * Access to Tweets endpoints
     * @return Tweets
     * @throws \Exception
     */
    public function tweets(): Tweets
    {
        return new Tweets($this->settings);
    }
}
