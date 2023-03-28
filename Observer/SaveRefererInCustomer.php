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
use Magento\Customer\Model\ResourceModel\CustomerFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Session\SessionManagerInterface;

class SaveRefererInCustomer implements ObserverInterface
{
    /**
     * @var SessionManagerInterface
     */
    private SessionManagerInterface $sessionManager;

    private \Magento\Customer\Model\CustomerFactory $customerFactory;
    private CustomerFactory $customerResourceFactory;
    /**
     * @var Data
     */
    private Data $data;

    /**
     * @param SessionManagerInterface $sessionManager
     */
    public function __construct(
        SessionManagerInterface $sessionManager,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        CustomerFactory $customerResourceFactory,
        Data $data
    )
    {
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
            $refererUrl = $this->sessionManager->getData('atouati_external_host_referer', true);
            if (!is_null($refererUrl)) {
                /** @var \Magento\Customer\Api\Data\CustomerInterface $customerData */
                $customerData = $observer->getCustomer();
                $customer = $this->customerFactory->create()->load($customerData->getId());
                $customerData->setCustomAttribute('atouati_external_origin',$refererUrl);
                $customer->updateData($customerData);
                $customerResource = $this->customerResourceFactory->create();
                $customerResource->saveAttribute($customer, 'atouati_external_origin');
            }
        }
    }
}
