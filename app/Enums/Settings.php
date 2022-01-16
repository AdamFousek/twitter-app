<?php

namespace App\Enums;

enum Settings: string
{
    case TWITTER_CONSUMER_KEY = 'consumer_key';
    case TWITTER_CONSUMER_SECRET = 'consumer_secret';
    case TWITTER_ACCESS_TOKEN = 'access_token';
    case TWITTER_ACCESS_TOKEN_SECRET = 'access_token_secret';
    case TWITTER_LIMIT = 'result_limit';
}
