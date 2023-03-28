<?php
/**
 * Copyright (c) 2019
 * MIT License
 * Module AnassTouatiCoder_ReferrerTracker
 * Author Anass TOUATI anass1touati@gmail.com
 */

declare(strict_types=1);

namespace AnassTouatiCoder\ReferrerTracker\Observer;

use AnassTouatiCoder\ReferrerTracker\Helper\Data;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Session\SessionManagerInterface;

class SaveRefererInOrder implements ObserverInterface
{
    /**
     * @var SessionManagerInterface
     */
    private SessionManagerInterface $sessionManager;
    private Data $data;

    /**
     * @param SessionManagerInterface $sessionManager
     * @param Data $data
     */
    public function __construct(
        SessionManagerInterface $sessionManager,
        Data $data
    )
    {
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
            $refererUrl = $this->sessionManager->getData('atouati_external_host_referer', true);
            if (!is_null($refererUrl)) {
                $order = $observer->getEvent()->getOrder();
                $order->setData('atouati_external_origin', $refererUrl);
            }
        }
    }
}
