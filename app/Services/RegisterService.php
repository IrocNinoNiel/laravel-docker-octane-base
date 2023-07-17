<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use GuzzleHttp\Client;

final class RegisterService
{
    private readonly string $secretToken;

    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->secretToken = $this->generateRandomToken();
        $this->httpClient = $httpClient;
    }

    public function registerService(): void
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->secretToken,
            'Accept' => 'application/json',
        ];

        try {
            $response = $this->httpClient->request('POST', env('SERVICE_REGISTRY_URL'), [
              'headers' => $headers,
              'json' => [
                  'name' => 'project_projection',
                  'endpoint' => 'http://' . env('APP_HOST') . ':' . env('EXPOSE_PORT') . '/api',
                  'health_check_url' => 'http://' . env('APP_HOST') . ':' . env('EXPOSE_PORT') . '/api/health',
              ],
            ]);

            echo "\nService registered with response code " . $response->getStatusCode() . "\n";
            info($response->getBody()->getContents());
        } catch (Exception $e) {
            echo "\nError with exception: " . $e->getMessage() . "\n";
        }
    }

    private function generateRandomToken(): string
    {
        $tokens = explode(',', env('SECRET_TOKEN'));
        $randomToken = $tokens[array_rand($tokens)];

        return trim($randomToken);
    }
}
