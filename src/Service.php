<?php

namespace Kodjunkie\OnesignalPhpSdk;

use Kodjunkie\OnesignalPhpSdk\Clients\GuzzleHttpClient;

abstract class Service
{
    /**
     * @var string
     */
    private $config;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * Build the endpoint
     * @param $endpoint
     * @return mixed
     */
    protected function build($endpoint)
    {
        $Endpoint = "\\Kodjunkie\\OnesignalPhpSdk\\Endpoints\\" . ucfirst($endpoint);

        if (!class_exists($Endpoint))
            throw new \InvalidArgumentException("Endpoint not found: " . $endpoint);

        return new $Endpoint(new GuzzleHttpClient, $this->config);
    }
}