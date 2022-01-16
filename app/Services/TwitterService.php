<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Setting;
use App\Twitter\Client;

class TwitterService
{
    /** @var ?Client Twitter client */
    private ?Client $client = null;

    /** @var array Config array */
    private array $config;

    public function setConfig(): array
    {
        $config = [];
        $settings = Setting::all();

        foreach ($settings as $setting) {
            $config[$setting->key] = $setting->value;
        }

        $this->config = $config;

        return $config;
    }

    public function getConfig(): array
    {
        return $this->config ?? $this->setConfig();
    }

    public function setClient(array $config = null): Client
    {
        $clientConfig = $config ?? $this->setConfig();
        $this->client = new Client($clientConfig);

        return $this->client;
    }

    public function getClient(): Client
    {
        return $this->client ?? $this->setClient();
    }
}
