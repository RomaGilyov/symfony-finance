<?php

namespace App\Tests;

use App\Entity\Stock;

class StockTest extends DatabaseDependantTestCase
{
    /** @test */
    public function a_stock_record_can_be_created_in_the_database()
    {
        // Set up

        // Stock
        $stock = new Stock();
        $stock->setSymbol('AMZN');
        $stock->setShortName('Amazon Inc');
        $stock->setCurrency('USD');
        $stock->setExchangeName('Nasdaq');
        $stock->setRegion('US');

        $price = 1000 * 100;
        $previousClose = 1100 * 100;
        $priceChange = $price - $previousClose;

        $stock->setPrice($price);
        $stock->setPreviousClose($previousClose);
        $stock->setPriceChange($priceChange);

        $this->entityManager->persist($stock);

//        Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle::class => ['all' => true],

        // Commit record to DB
        $this->entityManager->flush();

        $stockRepository = $this->entityManager->getRepository(Stock::class);

        $stockRecord = $stockRepository->findOneBy(['symbol' => 'AMZN']);

        // Make assertions
        $this->assertEquals('Amazon Inc', $stockRecord->getShortName());
        $this->assertEquals('USD', $stockRecord->getCurrency());
        $this->assertEquals('Nasdaq', $stockRecord->getExchangeName());
        $this->assertEquals('US', $stockRecord->getRegion());
        $this->assertEquals(100000, $stockRecord->getPrice());
        $this->assertEquals(110000, $stockRecord->getPreviousClose());
        $this->assertEquals(-10000, $stockRecord->getPriceChange());
    }
}
