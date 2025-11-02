<?php

use humhub\modules\user\authclient\Collection;

// Moodle Authentication Module Configuration
return [
    'id' => 'auth-moodle',
    'class' => 'humhubContrib\auth\moodle\Module',
    'namespace' => 'humhubContrib\auth\moodle',
    'events' => [
        // Register the Moodle auth client when the auth client collection is initialized
        [Collection::class, Collection::EVENT_AFTER_CLIENTS_SET, ['humhubContrib\auth\moodle\Events', 'onAuthClientCollectionInit']],
    ],
];
