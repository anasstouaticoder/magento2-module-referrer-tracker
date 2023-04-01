<?php
/**
 * Copyright (c) 2019
 * MIT License
 * Module AnassTouatiCoder_ReferrerTracker
 * Author Anass TOUATI anass1touati@gmail.com
 */
declare(strict_types=1);

namespace AnassTouatiCoder\ReferrerTracker\Controller\Index;

use AnassTouatiCoder\ReferrerTracker\Model\Config;
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
     * @var Config
     */
    private Config $helper;

    /**
     * @param Context $context
     * @param SessionManagerInterface $sessionManager
     * @param Config $helper
     */
    public function __construct(Context $context, SessionManagerInterface $sessionManager, Config $helper)
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
        $originalReferer = $this->getRequest()->getParam('origin_referrer');
        if ($originalReferer && $this->getRequest()->isXmlHttpRequest() &&
            $this->getRequest()->isPost() &&
            $this->canTrackReferrer()
        ) {
            $this->sessionManager->setData('atouati_external_host_referrer', $originalReferer);
        }
    }

    /**
     * Check BO configurations
     * @return bool
     */
    private function canTrackReferrer(): bool
    {
        return $this->helper->getIsRegistrationEnabled() || $this->helper->getIsOrderEnabled();
    }
}
