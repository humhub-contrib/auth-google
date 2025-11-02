# Testing Guide for Moodle OAuth Integration

This document outlines the testing requirements for the Moodle OAuth authentication module.

## Prerequisites

Before testing, ensure you have:

1. **HumHub Installation**: A working HumHub instance (v1.18+)
2. **Moodle Instance**: Access to a Moodle installation with admin privileges
3. **OAuth Plugin**: Moodle OAuth 2.0 service configured and enabled

## Moodle Configuration Steps

### 1. Enable OAuth 2.0 in Moodle

1. Log in to Moodle as administrator
2. Navigate to: `Site administration → Server → OAuth 2 services`
3. Create a new OAuth 2 service or use an existing one
4. Configure the service with the following settings:
   - **Name**: HumHub (or any descriptive name)
   - **Client ID**: Generate or note this value
   - **Client Secret**: Generate or note this value
   - **Service base URL**: Your HumHub installation URL
   - **Authorize endpoint**: (verify in MoodleAuth.php)
   - **Token endpoint**: (verify in MoodleAuth.php)
   - **User info endpoint**: (verify in MoodleAuth.php)

### 2. Note Critical Information

Document the following from your Moodle OAuth configuration:
- Authorization URL format
- Token URL format
- User Info API endpoint
- Required scopes
- User attribute field names in API response

## Code Updates Required

### 1. Update MoodleAuth.php

File: `authclient/MoodleAuth.php`

Update these properties based on your Moodle instance:

```php
public $authUrl = 'https://YOUR-MOODLE-URL/admin/oauth2callback.php';
public $tokenUrl = 'https://YOUR-MOODLE-URL/local/oauth/token.php';
public $apiBaseUrl = 'https://YOUR-MOODLE-URL/local/oauth';
```

**Action Items:**
- [ ] Replace `YOUR-MOODLE-URL` with your actual Moodle instance URL
- [ ] Verify endpoint paths match your Moodle OAuth plugin
- [ ] Update the scope in `defaultScope()` method if needed
- [ ] Verify user attribute mappings in `defaultNormalizeUserAttributeMap()`

### 2. Test User Attribute Mapping

The user attributes returned by Moodle may differ. To verify:

1. Enable debug mode in HumHub
2. Add logging in `MoodleAuth::initUserAttributes()`:
   ```php
   protected function initUserAttributes()
   {
       $attributes = $this->api('user_info.php', 'GET');
       \Yii::error('Moodle user attributes: ' . print_r($attributes, true));
       return $attributes;
   }
   ```
3. Perform a test login
4. Check HumHub logs for the actual attribute structure
5. Update `defaultNormalizeUserAttributeMap()` accordingly

## Testing Checklist

### Phase 1: Module Installation
- [ ] Module appears in HumHub module list
- [ ] Module can be enabled without errors
- [ ] Configuration page is accessible at `Administration → Modules → Moodle Auth → Settings`
- [ ] All form fields are displayed correctly

### Phase 2: Configuration
- [ ] Enable checkbox works
- [ ] Client ID field accepts input
- [ ] Client Secret field accepts input (should be password field)
- [ ] Redirect URI is displayed and copyable
- [ ] Configuration saves successfully
- [ ] Saved configuration persists after page reload

### Phase 3: OAuth Flow - New User Registration
- [ ] "Moodle" button appears on HumHub login page
- [ ] Button has correct icon and styling
- [ ] Clicking button opens Moodle OAuth popup/redirect
- [ ] User can log in with Moodle credentials
- [ ] Moodle redirects back to HumHub with auth code
- [ ] HumHub exchanges code for access token
- [ ] HumHub fetches user info from Moodle
- [ ] New user account is created in HumHub
- [ ] User attributes are mapped correctly:
  - [ ] Email address
  - [ ] First name
  - [ ] Last name
  - [ ] Username
- [ ] User is logged in to HumHub
- [ ] User profile is complete and accessible

### Phase 4: OAuth Flow - Existing User Login
- [ ] User with existing HumHub account (same email) can log in via Moodle
- [ ] Login completes without creating duplicate account
- [ ] User session is established correctly
- [ ] User is redirected to appropriate page after login

### Phase 5: Error Handling
- [ ] Test with invalid Client ID (should show error message)
- [ ] Test with invalid Client Secret (should show error message)
- [ ] Test with incorrect redirect URI in Moodle (should show error)
- [ ] Test canceling OAuth flow (user clicks "Cancel" in Moodle)
- [ ] Test with Moodle user missing required fields (email, name)
- [ ] Test with network timeout/connection issues

### Phase 6: Security Testing
- [ ] Client Secret is stored securely (not visible in HTML)
- [ ] OAuth state parameter is validated
- [ ] CSRF protection is working
- [ ] Access tokens are not exposed in URLs or logs
- [ ] Redirect URI validation prevents open redirects

### Phase 7: User Experience
- [ ] Button text is clear and appropriate
- [ ] Button icon matches Moodle branding
- [ ] Popup size is appropriate (860x480)
- [ ] Error messages are user-friendly
- [ ] Success flow is smooth without unnecessary steps

## Common Issues and Solutions

### Issue: "Invalid redirect URI"
**Solution**: Ensure the redirect URI in Moodle configuration exactly matches the one shown in HumHub module settings.

### Issue: "Invalid client credentials"
**Solution**: Verify Client ID and Client Secret are correctly copied from Moodle without extra spaces.

### Issue: User attributes not mapping correctly
**Solution**: Check Moodle API response format and update `defaultNormalizeUserAttributeMap()` in MoodleAuth.php.

### Issue: OAuth endpoints not found (404 errors)
**Solution**: Verify Moodle OAuth plugin is installed and endpoints match your Moodle version.

### Issue: "allow_url_fopen" error
**Solution**: Enable `allow_url_fopen` in PHP configuration.

## Debugging Tips

1. **Enable HumHub Debug Mode**:
   - Edit `protected/config/common.php`
   - Set `'debug' => true`

2. **Check HumHub Logs**:
   - Location: `protected/runtime/logs/app.log`
   - Look for OAuth-related errors

3. **Check Moodle Logs**:
   - Navigate to: `Site administration → Reports → Logs`
   - Filter for OAuth-related events

4. **Browser Developer Tools**:
   - Monitor Network tab during OAuth flow
   - Check for failed requests
   - Verify redirect URLs

5. **Test OAuth Endpoints Manually**:
   ```bash
   # Test authorization endpoint
   curl "https://your-moodle-url/admin/oauth2callback.php?client_id=YOUR_CLIENT_ID"
   
   # Test user info endpoint (with valid access token)
   curl -H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
        "https://your-moodle-url/local/oauth/user_info.php"
   ```

## Version Compatibility

| Component | Minimum Version | Tested Version | Notes |
|-----------|----------------|----------------|-------|
| HumHub | 1.18 | - | As specified in module.json |
| PHP | 7.4 | - | With allow_url_fopen enabled |
| Moodle | 3.x | - | With OAuth 2.0 support |

## Reporting Issues

When reporting issues, please include:

1. HumHub version
2. Moodle version
3. PHP version
4. Exact error message
5. Relevant log entries
6. Steps to reproduce
7. OAuth endpoint URLs being used
8. Whether the issue is reproducible

## Next Steps After Testing

After successful testing:

1. Update documentation with confirmed endpoint URLs
2. Remove TODO comments from code
3. Add proper translation files
4. Consider adding automated tests
5. Update module version to 1.0.0
6. Create release notes
