<?php
/**
 * Copyright (c) 2019
 * MIT License
 * Module AnassTouatiCoder_ReferrerTracker
 * Author Anass TOUATI anass1touati@gmail.com
 */
declare(strict_types=1);

namespace AnassTouatiCoder\ReferrerTracker\Controller\Index;

use AnassTouatiCoder\ReferrerTracker\Helper\Data;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Session\SessionManagerInterface;

class Index extends  Action
{
    /**
     * @var SessionManagerInterface
     */
    private SessionManagerInterface $sessionManager;

    /**
     * @var Data
     */
    private Data $helper;

    /**
     * @param Context $context
     * @param SessionManagerInterface $sessionManager
     * @param Data $helper
     */
    public function __construct(Context $context, SessionManagerInterface $sessionManager, Data $helper)
    {
        $this->sessionManager = $sessionManager;
        $this->helper = $helper;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $originalReferer = $this->getRequest()->getParam('origin_referer');
        if ($originalReferer && $this->getRequest()->isXmlHttpRequest() &&
            $this->getRequest()->isPost() &&
            $this->canTrackReferer()
        ) {
            $this->sessionManager->setData('atouati_external_host_referer', $originalReferer);
        }
    }

    /**
     * Check BO configurations
     * @return bool
     */
    private function canTrackReferer(): bool
    {
        return $this->helper->getIsRegistrationEnabled() || $this->helper->getIsOrderEnabled();
    }
}
