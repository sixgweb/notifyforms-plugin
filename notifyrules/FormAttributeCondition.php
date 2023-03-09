<?php

namespace Sixgweb\NotifyForms\NotifyRules;

use RainLab\Notify\Classes\ModelAttributesConditionBase;

class FormAttributeCondition extends ModelAttributesConditionBase
{
    protected $modelClass = \Sixgweb\Forms\Models\Form::class;

    public function getGroupingTitle()
    {
        return 'Sixgweb Forms';
    }

    public function getTitle()
    {
        return 'Form Attribute';
    }

    /**
     * Checks whether the condition is TRUE for specified parameters
     * @param array $params Specifies a list of parameters as an associative array.
     * @return bool
     */
    public function isTrue(&$params)
    {
        $hostObj = $this->host;

        if (!$entry = array_get($params, 'entry')) {
            trace_log('$entry not provided to FormAttributeCondition');
            return false;
        }

        return parent::evalIsTrue($entry->form);
    }
}
