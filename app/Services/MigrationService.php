<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class MigrationService
{
    protected PendingRequest $http;

    public function __construct()
    {
        $this->http = Http::withHeaders([
            'accept' => 'application/json',
            'AuthToken' => config('api-mm.auth_key')
        ])->baseUrl(config('api-mm.base_url'));
    }

    public function evaluate(array $data): Response
    {
        return $this->http->post('/internal/evaluate', $data);
    }

    public function parsePoints(array $data): Response
    {
        return $this->http->post('/internal/evaluate/fsw_score|fsw_crs_score', $data);
    }

    public function findAssessment(string $email): Response
    {
        return $this->http->post('/internal/assessments/search', [
            "email" => $email
        ]);
    }

    public function getAssessmentById(string $assessmentId): Response
    {
        $url = '/internal/assessments/{token}/object';
        return $this->http->get(strtr($url, ['{token}' => $assessmentId]));
    }
}
