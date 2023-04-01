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
use Magento\Customer\Model\ResourceModel\CustomerFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Session\SessionManagerInterface;

class SaveReferrerInCustomer implements ObserverInterface
{
    /**
     * @var SessionManagerInterface
     */
    private SessionManagerInterface $sessionManager;

    private \Magento\Customer\Model\CustomerFactory $customerFactory;
    private CustomerFactory $customerResourceFactory;
    /**
     * @var Config
     */
    private Config $data;

    /**
     * @param SessionManagerInterface $sessionManager
     */
    public function __construct(
        SessionManagerInterface $sessionManager,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        CustomerFactory $customerResourceFactory,
        Config $data
    ) {
        $this->sessionManager = $sessionManager;
        $this->customerFactory = $customerFactory;
        $this->customerResourceFactory = $customerResourceFactory;
        $this->data = $data;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        if ($this->data->getIsRegistrationEnabled()) {
            $referrerUrl = $this->sessionManager->getData('atouati_external_host_referrer', true);
            if ($referrerUrl !== null) {
                /** @var \Magento\Customer\Api\Data\CustomerInterface $customerData */
                $customerData = $observer->getCustomer();
                $customer = $this->customerFactory->create()->load($customerData->getId());
                $customerData->setCustomAttribute('atouati_external_origin', $referrerUrl);
                $customer->updateData($customerData);
                $customerResource = $this->customerResourceFactory->create();
                $customerResource->saveAttribute($customer, 'atouati_external_origin');
                $this->data->removeCookie();
            }
        }
    }
}
