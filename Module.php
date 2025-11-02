<?php

namespace humhubContrib\auth\moodle;

use yii\helpers\Url;

/**
 * Moodle Authentication Module
 * 
 * This module provides OAuth 2.0 authentication using a Moodle instance.
 * 
 * @inheritdoc
 */
class Module extends \humhub\components\Module
{
    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        // TODO: Verify this route matches the controller structure
        return Url::to(['/auth-moodle/admin']);
    }
}
