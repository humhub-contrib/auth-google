<?php

namespace humhubContrib\auth\google\authclient;

use Yii;
use yii\authclient\clients\Google;

/**
 * Google allows authentication via Google OAuth.
 */
class GoogleAuth extends Google
{
    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fa fa-google',
            'buttonBackgroundColor' => '#e0492f',
        ];
    }

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        $attributes = parent::initUserAttributes();

        // An email address which is not verified by Google must not be used to identify a user
        $verified = $attributes['verified_email'] ?? $attributes['email_verified'] ?? null;
        if ($verified !== null && !filter_var($verified, FILTER_VALIDATE_BOOLEAN)) {
            unset($attributes['email']);
        }

        // The name or the email may contain characters which are not allowed in a username (e.g. spaces)
        $username = (string)($attributes['name'] ?? '');
        if ($username === '' && !empty($attributes['email'])) {
            $username = (string)strstr($attributes['email'], '@', true);
        }
        $username = preg_replace('/[^\p{L}\d_\-@.]+/u', '.', $username);
        $username = mb_substr(trim($username, '.'), 0, Yii::$app->getModule('user')->maximumUsernameLength);
        if ($username !== '') {
            $attributes['username'] = $username;
        }

        return $attributes;
    }

    /**
     * @inheritdoc
     */
    protected function defaultNormalizeUserAttributeMap()
    {
        return [
            'id' => 'sub',
            'firstname' => 'given_name',
            'lastname' => 'family_name',
            'email' => 'email',
        ];
    }
}
