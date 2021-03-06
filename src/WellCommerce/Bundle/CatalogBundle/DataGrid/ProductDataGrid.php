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
namespace WellCommerce\Bundle\CatalogBundle\DataGrid;

use WellCommerce\Bundle\CoreBundle\DataGrid\AbstractDataGrid;
use WellCommerce\Component\DataGrid\Column\Column;
use WellCommerce\Component\DataGrid\Column\ColumnCollection;
use WellCommerce\Component\DataGrid\Column\Options\Appearance;
use WellCommerce\Component\DataGrid\Column\Options\Filter;
use WellCommerce\Component\DataGrid\Configuration\EventHandler\LoadedEventHandler;
use WellCommerce\Component\DataGrid\Configuration\EventHandler\ProcessEventHandler;
use WellCommerce\Component\DataGrid\Configuration\EventHandler\UpdateRowEventHandler;
use WellCommerce\Component\DataGrid\Options\OptionsInterface;

/**
 * Class ProductDataGrid
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ProductDataGrid extends AbstractDataGrid
{
    /**
     * @var CategoryFilter
     */
    protected $categoryFilter;
    
    public function __construct(CategoryFilter $categoryFilter)
    {
        $this->categoryFilter = $categoryFilter;
    }
    
    public function configureColumns(ColumnCollection $collection)
    {
        $collection->add(new Column([
            'id'         => 'id',
            'caption'    => 'common.label.id',
            'appearance' => new Appearance([
                'width'   => 90,
                'visible' => false,
            ]),
            'filter'     => new Filter([
                'type' => Filter::FILTER_BETWEEN,
            ]),
        ]));
        
        $collection->add(new Column([
            'id'         => 'name',
            'caption'    => 'common.label.name',
            'appearance' => new Appearance([
                'width' => 200,
            ]),
        ]));
        
        $collection->add(new Column([
            'id'       => 'sku',
            'editable' => true,
            'caption'  => 'common.label.sku',
        ]));
        
        $collection->add(new Column([
            'id'      => 'category',
            'caption' => 'common.label.categories',
            'filter'  => new Filter([
                'type'                => Filter::FILTER_TREE,
                'filtered_column'     => 'categoryId',
                'options'             => $this->categoryFilter->getOptions(),
                'load_children_route' => 'admin.category.ajax.get_children',
            ]),
        ]));
        
        $collection->add(new Column([
            'id'       => 'grossAmount',
            'caption'  => 'common.label.gross_price',
            'editable' => true,
            'filter'   => new Filter([
                'type' => Filter::FILTER_BETWEEN,
            ]),
        ]));
        
        $collection->add(new Column([
            'id'       => 'stock',
            'caption'  => 'common.label.stock',
            'editable' => true,
            'filter'   => new Filter([
                'type' => Filter::FILTER_BETWEEN,
            ]),
        ]));
        
        $collection->add(new Column([
            'id'       => 'weight',
            'caption'  => 'common.label.dimension.weight',
            'editable' => true,
            'filter'   => new Filter([
                'type' => Filter::FILTER_BETWEEN,
            ]),
        ]));
    }
    
    public function configureOptions(OptionsInterface $options)
    {
        parent::configureOptions($options);
        
        $eventHandlers = $options->getEventHandlers();
        
        $eventHandlers->add(new UpdateRowEventHandler([
            'function' => $this->getJavascriptFunctionName('update'),
            'route'    => $this->getActionUrl('update'),
        ]));
        
        $eventHandlers->add(new ProcessEventHandler([
            'function' => $this->getJavascriptFunctionName('process'),
        ]));
        
        $eventHandlers->add(new LoadedEventHandler([
            'function' => $this->getJavascriptFunctionName('loaded'),
        ]));
    }
    
    public function getIdentifier(): string
    {
        return 'product';
    }
}
