<?php
/**
 * Copyright (c) 2019
 * MIT License
 * Module AnassTouatiCoder_ReferrerTracker
 * Author Anass TOUATI anass1touati@gmail.com
 */
declare(strict_types=1);

namespace AnassTouatiCoder\ReferrerTracker\Helper;

use AnassTouatiCoder\SitemapRemoveItem\Model\Config;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    /**
     * XML paths
     */
    public const XML_PATH_TRACK_REFERRER_IN_REGISTRATION = 'anasstouaticoder_trackreferrerorigin/general/registration';
    public const XML_PATH_TRACK_REFERRER_IN_ORDER = 'anasstouaticoder_trackreferrerorigin/general/order';
    public const XML_PATH_EXCLUDE_DOMAIN_LIST = 'anasstouaticoder_trackreferrerorigin/general/exclude_external_domains';

    /**
     * Registration tracking is enabled
     *
     * @return bool
     */
    public function getIsRegistrationEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_TRACK_REFERRER_IN_REGISTRATION,
            Config::SCOPE_TYPE_STORES
        );
    }

    /**
     * Order tracking is enabled
     *
     * @return bool
     */
    public function getIsOrderEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_TRACK_REFERRER_IN_REGISTRATION,
            Config::SCOPE_TYPE_STORES
        );
    }
    public function getExcludedDomainList(): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_EXCLUDE_DOMAIN_LIST,
            Config::SCOPE_TYPE_STORES,
        );
    }
}
