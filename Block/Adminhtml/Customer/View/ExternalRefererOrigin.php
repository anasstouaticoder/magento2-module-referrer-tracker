<?php
/**
 * Copyright (c) 2019
 * MIT License
 * Module AnassTouatiCoder_ReferrerTracker
 * Author Anass TOUATI anass1touati@gmail.com
 */
declare(strict_types=1);

namespace AnassTouatiCoder\ReferrerTracker\Block\Adminhtml\Customer\View;

use Magento\Customer\Block\Adminhtml\Edit\Tab\View\PersonalInfo;

class ExternalRefererOrigin extends PersonalInfo
{
    /**
     * @var string
     */
    protected $externalReferrerOriginValue;

    /**
     * Get attribute value
     *
     * @return mixed|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getExternalReferrerOriginValue()
    {
        if ($this->externalReferrerOriginValue === null) {
            $attribute = $this->getCustomer()->getCustomAttribute('atouati_external_origin');
            $this->externalReferrerOriginValue = $attribute ?
                $attribute->getValue() : false;
        }

        return $this->externalReferrerOriginValue;
    }
}
