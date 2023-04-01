<?php
/**
 * Copyright (c) 2019
 * MIT License
 * Module AnassTouatiCoder_ReferrerTracker
 * Author Anass TOUATI anass1touati@gmail.com
 */

declare(strict_types=1);

namespace AnassTouatiCoder\ReferrerTracker\Observer;

use AnassTouatiCoder\ReferrerTracker\Model\Config;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Session\SessionManagerInterface;

class SaveReferrerInOrder implements ObserverInterface
{
    /**
     * @var SessionManagerInterface
     */
    private SessionManagerInterface $sessionManager;
    private Config $data;

    /**
     * @param SessionManagerInterface $sessionManager
     * @param Config $data
     */
    public function __construct(
        SessionManagerInterface $sessionManager,
        Config $data
    ) {
        $this->sessionManager = $sessionManager;
        $this->data = $data;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        if ($this->data->getIsOrderEnabled()) {
            $referrerUrl = $this->sessionManager->getData('atouati_external_host_referrer', true);
            if ($referrerUrl !== null) {
                $order = $observer->getEvent()->getOrder();
                $order->setData('atouati_external_origin', $referrerUrl);
                $this->data->removeCookie();
            }
        }
    }
}
