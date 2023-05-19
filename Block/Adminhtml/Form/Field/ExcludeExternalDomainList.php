<?php
/**
 * Copyright (c) 2023
 * MIT License
 * Module AnassTouatiCoder_ReferrerTracker
 * Author Anass TOUATI anass1touati@gmail.com
 */
declare(strict_types=1);

namespace AnassTouatiCoder\ReferrerTracker\Block\Adminhtml\Form\Field;

use AnassTouatiCoder\Base\Block\Adminhtml\Form\FieldArray;

class ExcludeExternalDomainList extends FieldArray
{
    /**
     * @var string
     */
    protected $dataConfig = 'atouati_data_config_domain';
}
