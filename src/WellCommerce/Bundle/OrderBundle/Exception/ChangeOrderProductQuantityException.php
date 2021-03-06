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

namespace WellCommerce\Bundle\OrderBundle\Exception;

use WellCommerce\Bundle\OrderBundle\Entity\OrderProduct;

/**
 * Class ChangeOrderProductQuantityException
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ChangeOrderProductQuantityException extends \InvalidArgumentException
{
    const ERROR_MESSAGE = 'Cannot change quantity of item "%s". It does not belongs to order.';

    public function __construct(OrderProduct $orderProduct)
    {
        $message = sprintf(self::ERROR_MESSAGE, $orderProduct->getId());
        parent::__construct($message);
    }
}
