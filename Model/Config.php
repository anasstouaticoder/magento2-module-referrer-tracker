<?php
/**
 * Copyright (c) 2019
 * MIT License
 * Module AnassTouatiCoder_ReferrerTracker
 * Author Anass TOUATI anass1touati@gmail.com
 */
declare(strict_types=1);

namespace AnassTouatiCoder\ReferrerTracker\Model;

use AnassTouatiCoder\Base\Model\Config as BaseConfig;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\Stdlib\Cookie\FailureToSendException;
use Magento\Framework\Stdlib\CookieManagerInterface;

class Config
{
    /**
     * XML paths
     */
    public const XML_PATH_TRACK_REFERRER_IN_REGISTRATION = 'anasstouaticoder_trackreferrerorigin/general/registration';
    public const XML_PATH_TRACK_REFERRER_IN_ORDER = 'anasstouaticoder_trackreferrerorigin/general/order';
    public const XML_PATH_EXCLUDE_DOMAIN_LIST = 'anasstouaticoder_trackreferrerorigin/general/exclude_external_domains';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var CookieManagerInterface
     */
    protected $cookieManager;

    /**
     * @var CookieMetadataFactory
     */
    protected $cookieMetadataFactory;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param CookieManagerInterface $cookieManager
     * @param CookieMetadataFactory $cookieMetadataFactory
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        CookieManagerInterface $cookieManager,
        CookieMetadataFactory $cookieMetadataFactory
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->cookieManager = $cookieManager;
        $this->cookieMetadataFactory = $cookieMetadataFactory;
    }

    /**
     * Registration tracking is enabled
     *
     * @return bool
     */
    public function getIsRegistrationEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_TRACK_REFERRER_IN_REGISTRATION,
            BaseConfig::SCOPE_TYPE_STORES
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
            self::XML_PATH_TRACK_REFERRER_IN_ORDER,
            BaseConfig::SCOPE_TYPE_STORES
        );
    }

    /**
     * @return string
     */
    public function getExcludedDomainList(): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_EXCLUDE_DOMAIN_LIST,
            BaseConfig::SCOPE_TYPE_STORES,
        );
    }

    /**
     * Remove atouati_referrer cookie
     *
     * @return void
     */
    public function removeCookie(): void
    {
        $cookieName = 'atouati_referrer';
        if ($this->cookieManager->getCookie($cookieName)) {
            try {
                $this->cookieManager->deleteCookie(
                    $cookieName,
                    $this->cookieMetadataFactory->createCookieMetadata(
                        [
                            'path' => '/',
                            'secure' => false,
                            'http_only' => false
                        ]
                    )
                );
            } catch (InputException $e) {
            } catch (FailureToSendException $e) {
                // Silence is golden
            }
        }
    }
}
