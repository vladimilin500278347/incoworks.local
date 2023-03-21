<?php

class backendMessages extends cmsBackend {

    public $useDefaultOptionsAction = true;

    public $queue = [
        'queues'           => ['email'],
        'queue_name'       => LANG_EMAIL,
        'use_queue_action' => true
    ];

    public function __construct(cmsRequest $request) {

        parent::__construct($request);

        array_unshift($this->backend_menu,
            [
                'title' => LANG_OPTIONS,
                'url'   => href_to($this->root_url, 'options'),
                'options' => [
                    'icon' => 'cog'
                ]
            ],
            [
                'title' => LANG_PM_PMAILING,
                'url'   => href_to($this->root_url, 'pmailing'),
                'options' => [
                    'icon' => 'envelope-open-text'
                ]
            ]
        );

    }

    public function actionIndex() {
        $this->redirectToAction('options');
    }

}
