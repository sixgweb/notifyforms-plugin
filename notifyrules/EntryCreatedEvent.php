<?php

namespace Sixgweb\NotifyForms\NotifyRules;

use RainLab\Notify\Classes\EventBase;
use Backend;

class EntryCreatedEvent extends EventBase
{

    /**
     * @var array Local conditions supported by this event.
     */
    public $conditions = [
        \Sixgweb\NotifyForms\NotifyRules\FormAttributeCondition::class,
        \Sixgweb\NotifyForms\NotifyRules\EntryAttributeCondition::class
    ];

    /**
     * Returns information about this membership, including name and description.
     */
    public function eventDetails()
    {
        return [
            'name'        => 'Created',
            'description' => 'A new form entry has been created',
            'group'       => 'forms'
        ];
    }

    /**
     * Defines the usable parameters provided by this class.
     */
    public function defineParams()
    {
        return [
            'entry' => [
                'title' => 'Entry Object',
                'label' => 'The form entry object',
            ],
            'url' => [
                'title' => 'URL',
                'label' => 'The url to edit the entry',
            ],
        ];
    }

    public static function makeParamsFromEvent(array $args, $eventId = null)
    {
        $entry = array_get($args, 0);
        $sender = new \stdClass;
        $sender->email = $entry->field_values[$entry->form->sender_email_field] ?? null;
        $sender->name = $entry->field_values[$entry->form->sender_name_field] ?? null;

        return [
            'entry' => $entry,
            'sender' => $sender,
        ];
    }
}
