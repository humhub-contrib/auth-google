<?php

namespace humhubContrib\auth\moodle\authclient;

use yii\authclient\OAuth2;

/**
 * MoodleAuth allows authentication via Moodle OAuth 2.0.
 * 
 * This class implements OAuth 2.0 authentication flow for Moodle LMS.
 * 
 * IMPORTANT TODO ITEMS:
 * =====================
 * 1. Verify and update the OAuth endpoint URLs based on your Moodle installation
 * 2. Test the authorization flow with an actual Moodle instance
 * 3. Verify the user attribute mappings match your Moodle's API response
 * 4. Test user registration and login flows
 * 5. Update the scope if needed (Moodle may require different scopes)
 * 6. Verify that the icon and button styling are appropriate
 */
class MoodleAuth extends OAuth2
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://your-moodle-instance.com/admin/oauth2callback.php';
    
    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://your-moodle-instance.com/local/oauth/token.php';
    
    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://your-moodle-instance.com/local/oauth';

    // TODO: Verify these URLs with actual Moodle OAuth implementation
    // The URLs above are placeholders and may differ based on:
    // - Moodle version
    // - OAuth plugins installed (e.g., local_oauth, auth_oauth2)
    // - Custom OAuth configuration

    /**
     * @inheritdoc
     */
    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 860,
            'popupHeight' => 480,
            'cssIcon' => 'fa fa-graduation-cap', // TODO: Choose appropriate icon for Moodle
            'buttonBackgroundColor' => '#f98012', // TODO: Update to Moodle brand color
        ];
    }

    /**
     * @inheritdoc
     * 
     * Maps Moodle user attributes to HumHub user attributes.
     * 
     * TODO: Verify these mappings with actual Moodle API response!
     * The field names may differ based on your Moodle configuration.
     * 
     * Test by examining the response from initUserAttributes() after authentication.
     */
    protected function defaultNormalizeUserAttributeMap()
    {
        return [
            'id' => 'id',              // TODO: Verify - Moodle user ID field name
            'username' => 'username',   // TODO: Verify - Moodle username field
            'firstname' => 'firstname', // TODO: Verify - Moodle first name field
            'lastname' => 'lastname',   // TODO: Verify - Moodle last name field
            'email' => 'email',         // TODO: Verify - Moodle email field
        ];
    }

    /**
     * @inheritdoc
     * 
     * Initializes authenticated user attributes.
     * 
     * TODO: Update the API endpoint URL based on your Moodle OAuth configuration
     */
    protected function initUserAttributes()
    {
        // TODO: Verify this endpoint with your Moodle installation
        // Common possibilities:
        // - /webservice/rest/server.php (with appropriate parameters)
        // - /local/oauth/user_info.php
        // - Custom endpoint defined in OAuth plugin
        return $this->api('user_info.php', 'GET');
    }

    /**
     * @inheritdoc
     */
    protected function defaultScope()
    {
        // TODO: Verify required scopes for Moodle OAuth
        // Moodle may use different scope names than standard OAuth
        // Common Moodle scopes might include: 'user_info', 'email', 'profile'
        return 'openid profile email';
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'moodle';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Moodle';
    }
}
