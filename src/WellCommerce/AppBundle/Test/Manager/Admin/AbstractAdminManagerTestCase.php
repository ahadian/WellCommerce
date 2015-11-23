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

namespace WellCommerce\AppBundle\Test\Manager\Admin;

use WellCommerce\AppBundle\Test\AbstractTestCase;

/**
 * Class AbstractAdminManagerTestCase
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
abstract class AbstractAdminManagerTestCase extends AbstractTestCase
{
    /**
     * @return \WellCommerce\AppBundle\Manager\Admin\AdminManagerInterface
     */
    abstract protected function get();

    /**
     * @return string
     */
    abstract protected function getServiceClassName();

    /**
     * @return string
     */
    abstract protected function getFormBuilderClassName();

    /**
     * @return string
     */
    abstract protected function getDataGridClassName();

    /**
     * @return string
     */
    abstract protected function getRepositoryInterfaceName();

    public function testManagerServiceIsValid()
    {
        $manager = $this->get();
        $this->assertInstanceOf($this->getServiceClassName(), $manager);
    }

    public function testManagerReturnsValidFormBuilder()
    {
        $manager = $this->get();
        $this->assertInstanceOf($this->getFormBuilderClassName(), $manager->getFormBuilder());
    }

    public function testManagerReturnsValidRepository()
    {
        $manager = $this->get();
        $this->assertInstanceOf($this->getRepositoryInterfaceName(), $manager->getRepository());
    }

    public function testManagerReturnsValidDataGrid()
    {
        $manager = $this->get();
        $this->assertInstanceOf($this->getDataGridClassName(), $manager->getDataGrid());
    }
}