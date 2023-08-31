<?php

return [
    'plugin' => [
        'description' => 'Send notifications using RainLab.Notify when an entry is created',
    ],
    'tabs' => [
        'notifying' => 'Notifying',
    ],
    'send_notifications' => 'Send Notifications',
    'send_notifications_description' => 'Send notifications using RainLab.Notify',
    'sender_email_field' => 'Sender Email Field',
    'sender_email_field_description' => 'To use the "Sender user email address" options in RainLab.Notify actions, you must have an email field in your form and select it here',
    'select_field' => '-- select field --',
    'sender_name_field' => 'Sender Name Field',
    'sender_name_field_description' => '(optional) Used as the "Sender" user name in RainLab.Notify actions',
    'notifyrules' => [
        'group' => [
            'forms' => 'Forms',
        ],
        'form_attribute' => [
            'title' => 'Form Attribute',
        ],
        'entry_attribute' => [
            'title' => 'Entry Attribute',
            'form' => 'Form',
            'name' => 'Name',
        ],
        'entry_created' => [
            'name' => 'Entry Created',
            'description' => 'A new form entry has been created',
            'group' => 'forms',
            'params' => [
                'entry' => [
                    'title' => 'Entry',
                    'label' => 'The form entry object',
                ],
                'url' => [
                    'title' => 'URL',
                    'label' => 'The url to edit the entry',
                ],
            ],
        ],
    ]
];
