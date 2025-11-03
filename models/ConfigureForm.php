<?php

namespace humhubContrib\auth\moodle\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use humhubContrib\auth\moodle\Module;

/**
 * Moodle Authentication Module Configuration Model
 * 
 * This model handles the configuration settings for Moodle OAuth authentication.
 */
class ConfigureForm extends Model
{
    /**
     * @var bool Enable this authclient
     */
    public $enabled;

    /**
     * @var string the client id provided by Moodle OAuth configuration
     */
    public $clientId;

    /**
     * @var string the client secret provided by Moodle OAuth configuration
     */
    public $clientSecret;

    /**
     * @var string readonly - The redirect URI that must be configured in Moodle
     */
    public $redirectUri;

    // TODO: Consider adding Moodle-specific fields:
    // - Moodle instance URL (base URL)
    // - Custom OAuth endpoint URLs (if different from defaults)
    // - User field mappings (if Moodle provides different field names)

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientId', 'clientSecret'], 'required'],
            [['enabled'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'enabled' => Yii::t('AuthMoodleModule.base', 'Enabled'),
            'clientId' => Yii::t('AuthMoodleModule.base', 'Client ID'),
            'clientSecret' => Yii::t('AuthMoodleModule.base', 'Client secret'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            // TODO: Add helpful hints for Moodle configuration
        ];
    }

    /**
     * Loads the current module settings
     */
    public function loadSettings()
    {
        /** @var Module $module */
        // TODO: Verify module ID matches the one in config.php
        $module = Yii::$app->getModule('auth-moodle');

        $settings = $module->settings;

        $this->enabled = (bool)$settings->get('enabled');
        $this->clientId = $settings->get('clientId');
        $this->clientSecret = $settings->get('clientSecret');

        // TODO: Test that this redirect URI format works with Moodle OAuth
        $this->redirectUri = Url::to(['/user/auth/external', 'authclient' => 'moodle'], true);
    }

    /**
     * Saves module settings
     */
    public function saveSettings()
    {
        /** @var Module $module */
        // TODO: Verify module ID matches the one in config.php
        $module = Yii::$app->getModule('auth-moodle');

        $module->settings->set('enabled', (bool)$this->enabled);
        $module->settings->set('clientId', $this->clientId);
        $module->settings->set('clientSecret', $this->clientSecret);

        return true;
    }

    /**
     * Returns a loaded instance of this configuration model
     */
    public static function getInstance()
    {
        $config = new static();
        $config->loadSettings();

        return $config;
    }

}
