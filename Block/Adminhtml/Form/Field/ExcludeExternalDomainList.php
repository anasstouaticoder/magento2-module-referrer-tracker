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
    protected $dataConfig = 'atouati_data_config_domain';
    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function _prepareToRender()
    {
        $this->addColumn('domain', [
            'label' => __('Domain Name'),
            'class' => 'required-entry'
        ]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add New Domain Name');
    }

    protected function getHeaders(): array
    {
        return ['Domain Name'];
    }
}
