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

namespace Plugin\RecentlyPurchaseItem\ServiceProvider;

use Eccube\Application;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

class RecentlyPurchaseItemServiceProvider implements ServiceProviderInterface
{
    public function register(BaseApplication $app)
    {

      $app['eccube.plugin.repository.order_detail'] = $app->share(function () use ($app) {
    return $app['orm.em']->getRepository('Plugin\RecentlyPurchaseItem\Entity\RecentlyPurchaseItemOrderDetail');
});

    }

    public function boot(BaseApplication $app)
    {
    }
}
