<?php

namespace Sixgweb\NotifyForms;

use Event;
use System\Classes\PluginBase;
use Sixgweb\Forms\Models\Form;
use Sixgweb\Forms\Models\Entry;
use RainLab\Notify\Classes\Notifier;

/**
 * Plugin Information File
 */
class Plugin extends PluginBase
{

    public $require = [
        'RainLab.Notify',
        'Sixgweb.Forms',
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'NotifyForms',
            'description' => 'Send entry notifications via RainLab.Notify',
            'author'      => 'Sixgweb',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {
        $this->bindNotificationEvents();
        $this->extendFormModel();
    }

    /**
     * Register RainLab.Notify rules
     *
     * @return array
     */
    public function registerNotificationRules(): array
    {
        return [
            'groups' => [
                'forms' => [
                    'label' => 'Forms',
                    'icon' => 'icon-check'
                ],
            ],
            'events' => [
                \Sixgweb\NotifyForms\NotifyRules\EntryCreatedEvent::class,
            ],
            'actions' => [],
            'conditions' => [
                \Sixgweb\NotifyForms\NotifyRules\EntryAttributeCondition::class,
                \Sixgweb\NotifyForms\NotifyRules\FormAttributeCondition::class,
            ],
            'presets' => '$/sixgweb/notifyforms/config/notify_presets.yaml',
        ];
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function registerMailTemplates(): array
    {
        return [
            'sixgweb.notifyforms::mail.entry',
        ];
    }

    protected function bindNotificationEvents()
    {
        Notifier::bindEvents([
            'sixgweb.forms.afterEntry' => \Sixgweb\NotifyForms\NotifyRules\EntryCreatedEvent::class,
        ]);
    }

    protected function extendFormModel()
    {
        Form::extend(function ($model) {
            $model->addDynamicMethod('getSenderEmailFieldOptions', function () use ($model) {
                return Entry::getAllFieldableFields()->pluck('name', 'code')->toArray();
            });
            $model->addDynamicMethod('getSenderNameFieldOptions', function () use ($model) {
                return Entry::getAllFieldableFields()->pluck('name', 'code')->toArray();
            });
            $model->addDynamicMethod('getSendNotificationsAttribute', function () use ($model) {
                return $model->settings['send_notifications'] ?? null;
            });
        });

        Event::listen('backend.form.extendFields', function ($widget) {
            if (
                !$widget->model instanceof Form ||
                $widget->isNested
            ) {
                return;
            }

            $settings = $widget->getField('settings');
            $fields = $settings->config['form']['secondaryTabs']['fields'];
            $icons = $settings->config['form']['secondaryTabs']['icons'];

            $fields['send_notifications'] = [
                'type' => 'checkbox',
                'tab' => 'Notification Settings',
                'label' => 'Send Notifications',
            ];

            $fields['sender_email_field'] = [
                'type' => 'dropdown',
                'tab' => 'Notification Settings',
                'label' => 'Sender Email Field',
                'emptyOption' => '-- select field --',
                'trigger' => [
                    'field' => 'send_notifications',
                    'condition' => 'checked',
                    'action' => 'show',
                ]
            ];

            $fields['sender_name_field'] = [
                'type' => 'dropdown',
                'tab' => 'Notification Settings',
                'label' => 'Sender Name Field',
                'emptyOption' => '-- select field --',
                'trigger' => [
                    'field' => 'send_notifications',
                    'condition' => 'checked',
                    'action' => 'show',
                ]
            ];

            $icons['Notification Settings'] = 'bi bi-bell';

            $settings->config['form']['secondaryTabs']['fields'] = $fields;
            $settings->config['form']['secondaryTabs']['icons'] = $icons;
        });
    }
}
