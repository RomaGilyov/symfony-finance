<?php

namespace App\Http;

use Symfony\Component\HttpFoundation\JsonResponse;

class FakeYahooFinanceApiClient implements FinanceApiClientInterface
{
    /**
     * @var int
     */
    public static int $statusCode = 200;

    /**
     * @var string
     */
    public static string $content = '';

    /**
     * @param string $symbol
     * @param string $region
     * @return JsonResponse
     */
    public function fetchStockProfile(string $symbol, string $region): JsonResponse
    {
        return new JsonResponse(self::$content, self::$statusCode, [], true);
    }
}
