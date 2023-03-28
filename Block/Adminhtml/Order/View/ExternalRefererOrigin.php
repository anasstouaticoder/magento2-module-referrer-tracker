<?php
/**
 * Copyright (c) 2019
 * MIT License
 * Module AnassTouatiCoder_ReferrerTracker
 * Author Anass TOUATI anass1touati@gmail.com
 */
declare(strict_types=1);

namespace AnassTouatiCoder\ReferrerTracker\Block\Adminhtml\Order\View;

use Magento\Sales\Block\Adminhtml\Order\AbstractOrder;

class ExternalRefererOrigin extends AbstractOrder
{
    /**
     * @var string
     */
    protected $externalRefererOriginValue;

    /**
     * @return mixed|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getExternalRefererOriginValue()
    {
        if (is_null($this->externalRefererOriginValue)) {
            $this->externalRefererOriginValue = $this->getOrder()->getData('atouati_external_origin');
        }

        return $this->externalRefererOriginValue;
    }
}
