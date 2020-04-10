<?php

return [
    'sections' => [
        'app' => [
            'title' => 'General Settings',
            'descriptions' => 'Application general settings.',
            'icon' => 'fa fa-cog',
            'inputs' => [
                [
                    'name' => 'app_name',
                    'type' => 'text',
                    'label' => 'App Name',
                    'placeholder' => 'MiMedio',
                    'class' => 'form-control',
                    'style' => '',
                    'rules' => 'required',
                    'value' => 'MiMedio',
                    'hint' => 'You can set the site name here'
                ],
                [
                    'name' => 'logo',
                    'type' => 'image',
                    'label' => 'Logo',
                    'rules' => 'image|max:500',
                    'disk' => 'public',
                    'path' => 'app',
                    'preview_class' => 'img-fluid',
                ],
                [
                    'name' => 'join_video',
                    'type' => 'text',
                    'label' => 'Join-With-Us video ID',
                    'placeholder' => 'R6WTH65n0iQ',
                    'class' => 'form-control',
                    'style' => '',
                    'rules' => 'required',
                    'value' => 'R6WTH65n0iQ',

                ],
            ]
        ],
        'email' => [
            'title' => 'Email Settings',
            'descriptions' => 'How app email will be sent.',
            'icon' => 'fa fa-envelope',

            'inputs' => [
                [
                    'name' => 'from_email',
                    'type' => 'email',
                    'label' => 'From Email',
                    'placeholder' => 'Application from email',
                    'rules' => 'required|email',
                ]
            ]
        ],
        'youtube' => [
            'title' => 'Youtube',
            'icon' => 'fab fa-youtube collapsed-card', // (optional)
            'inputs' => [
                [
                    'name' => 'youtube_playlist',
                    'type' => 'repeater',
                    'label' => 'Youtube videos playlist',
                    'mutator' => 'YoutubeRepeaterMutator',
                    'accessor' => 'YoutubeRepeaterAccessor',
                ]
            ]
        ]
    ],

    'url' => '/admin-panel/settings',
    'middleware' => ['admin'],

    'setting_page_view' => 'admin.settings',
    'flash_partial' => 'app_settings::_flash',

    'section_class' => 'card mb-3',
    'section_heading_class' => 'card-header',
    'section_body_class' => 'card-body',

    'input_wrapper_class' => 'form-group',
    'input_class' => 'form-control',
    'input_error_class' => 'has-error',
    'input_invalid_class' => 'is-invalid',
    'input_hint_class' => 'form-text text-muted',
    'input_error_feedback_class' => 'text-danger',

    'submit_btn_text' => 'Save',
    'submit_success_message' => 'Settings has been saved.',

    'remove_abandoned_settings' => false,

    'controller' => '\QCod\AppSettings\Controllers\AppSettingController',

    'setting_group' => function () {
        // return 'user_'.auth()->id();
        return 'default';
    }
];
