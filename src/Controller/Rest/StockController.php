<?php

namespace App\Controller\Rest;

use App\Entity\Stock;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StockController extends AbstractFOSRestController
{
    /**
     * Creates a Stock resource
     * @Rest\Post("/stock")
     * @param Request $request
     * @return View
     */
    public function postArticle(Request $request): View
    {
        $stock = new Stock();
        $stock->setSymbol($request->get('symbol'));
        $stock->setShortName($request->get('short_name'));
        $stock->setCurrency($request->get('currency'));
        $stock->setExchangeName($request->get('exchange_name'));
        $stock->setRegion($request->get('region'));
        $stock->setPrice($request->get('price'));
        $stock->setPreviousClose($request->get('previous_close'));
        $stock->setPriceChange($request->get('previous_close'));

        $em = $this->getDoctrine()->getManager();

        $em->persist($stock);

        $em->flush();

        return View::create($stock, Response::HTTP_CREATED);
    }


}
