<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 * 
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 * 
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\OrderBundle\Provider;

use WellCommerce\Bundle\CoreBundle\DependencyInjection\AbstractContainerAware;
use WellCommerce\Bundle\CoreBundle\Doctrine\Repository\RepositoryInterface;
use WellCommerce\Bundle\OrderBundle\Entity\Order;

/**
 * Class AbstractReportProvider
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
abstract class AbstractReportProvider extends AbstractContainerAware
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;
    
    /**
     * Constructor
     *
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    protected function convertAmount(Order $order): float
    {
        $amount       = $order->getSummary()->getGrossAmount();
        $baseCurrency = $order->getCurrency();
        
        return $this->getCurrencyHelper()->convert($amount, $baseCurrency);
    }
}
