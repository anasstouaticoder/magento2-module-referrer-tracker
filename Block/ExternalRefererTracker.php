<?php
/**
 * Copyright (c) 2019
 * MIT License
 * Module AnassTouatiCoder_ReferrerTracker
 * Author Anass TOUATI anass1touati@gmail.com
 */
declare(strict_types=1);

namespace AnassTouatiCoder\ReferrerTracker\Block;

use AnassTouatiCoder\ReferrerTracker\Helper\Data;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class ExternalRefererTracker extends Template
{
    /**
     *  We are restricting referer url tracking for specific pages example product, category cart ...
     */
    const ALLOWED_FULL_ACTION_NAME_LIST =  [
        'catalog_product_view', // Product Page
        'catalog_category_view', // Category Page
        'cms_index_index', // Home page
        'cms_page_view', // Custom CMS page
        'catalogsearch_result_index', // result search page
        'checkout_cart_index', // Cart page
    ];

    /**
     * @var Data
     */
    private Data $helper;

    /**
     * @param Context $context
     * @param Data $helper
     * @param array $data
     */
    public function __construct(Context $context, Data $helper, array $data = [])
    {
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * Get Update External Referer URL
     *
     * @return string
     */
    public function getUpdateExternalRefererURL(): string
    {
        return $this->getUrl('externalreferer/index/index');
    }

    /**
     * Check if we can use the logic
     *
     * @return bool
     */
    public function canRetrieveOriginReferer(): bool
    {
        return in_array($this->getRequest()->getFullActionName(), self::ALLOWED_FULL_ACTION_NAME_LIST) &&
            ($this->helper->getIsRegistrationEnabled() || $this->helper->getIsOrderEnabled());
    }
}
