<?php

namespace humhubContrib\auth\moodle;

use humhub\components\Event;
use humhub\modules\user\authclient\Collection;
use humhubContrib\auth\moodle\authclient\MoodleAuth;
use humhubContrib\auth\moodle\models\ConfigureForm;

/**
 * Event handlers for Moodle authentication module
 */
class Events
{
    /**
     * Register the Moodle authentication client
     * 
     * This method is called when the auth client collection is initialized.
     * It adds the Moodle auth client if the module is enabled in settings.
     * 
     * @param Event $event
     */
    public static function onAuthClientCollectionInit($event)
    {
        /** @var Collection $authClientCollection */
        $authClientCollection = $event->sender;

        // Only add the Moodle auth client if it's enabled in module settings
        if (!empty(ConfigureForm::getInstance()->enabled)) {
            // TODO: Test that the 'moodle' identifier works correctly in the auth flow
            $authClientCollection->setClient('moodle', [
                'class' => MoodleAuth::class,
                'clientId' => ConfigureForm::getInstance()->clientId,
                'clientSecret' => ConfigureForm::getInstance()->clientSecret,
            ]);
        }
    }

}
