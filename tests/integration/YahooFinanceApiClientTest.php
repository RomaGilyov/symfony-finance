<?php

namespace App\Tests\integration;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class YahooFinanceApiClientTest extends KernelTestCase
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        self::bootKernel();
    }

    /**
     * @test
     * @group integration
     */
    public function the_yahoo_finance_api_client_returns_the_correct_data()
    {
        // Setup
        // Need YahooFinanceApiClient
        $yahooFinanceApiClient = static::$kernel->getContainer()->get('yahoo-finance-api-client');

        // Do something
        $response = $yahooFinanceApiClient->fetchStockProfile('AMZN', 'US'); // symbol, region

        $stockProfile = json_decode($response->getContent());

        // Make assertions
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('AMZN', $stockProfile->symbol);
        $this->assertSame('Amazon.com, Inc.', $stockProfile->shortName);
        $this->assertSame('US', $stockProfile->region);
        $this->assertSame('NasdaqGS', $stockProfile->exchangeName);
        $this->assertSame('USD', $stockProfile->currency);
        $this->assertIsNumeric($stockProfile->price);
        $this->assertIsNumeric($stockProfile->previousClose);
        $this->assertIsNumeric($stockProfile->priceChange);
    }
}
