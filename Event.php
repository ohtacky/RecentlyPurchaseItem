<?php
/*
* This file is part of EC-CUBE
*
* Copyright(c) 2000-2015 LOCKON CO.,LTD. All Rights Reserved.
* http://www.lockon.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\RecentlyPurchaseItem;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class Event
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    // フロント：商品詳細画面に関連商品を表示
    public function recentlyPurchaseItem(FilterResponseEvent $event)
    {
      $app = $this->app;

      $OrderList = $app['eccube.plugin.repository.order_detail']
            ->findBy(
                array(),
                array('id' => 'DESC')
            );


        if (count($OrderList) > 0) {
            $twig = $app->renderView(
                'RecentlyPurchaseItem/Resource/template/recentl_purchase_item.twig',
                array(
                    'OrderList' => $OrderList,
                )
            );

            $response = $event->getResponse();

            $html = $response->getContent();
            $crawler = new Crawler($html);

            $oldElement = $crawler
                ->filter('#main');

            $oldHtml = $oldElement->html();
            $newHtml = $oldHtml.$twig;

            $html = $crawler->html();
            $html = str_replace($oldHtml, $newHtml, $html);

            $response->setContent($html);
            $event->setResponse($response);
        }
    }

}
