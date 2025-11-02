# Implementation Notes - Moodle OAuth Integration

This document provides detailed technical information about the changes made to adapt the auth-google module for Moodle OAuth authentication.

## Overview

This module was forked from `humhub-contrib/auth-google` and is being adapted to use Moodle as an OAuth 2.0 provider instead of Google.

## Architecture

### Module Structure

```
auth-moodle/
├── authclient/
│   └── MoodleAuth.php          # OAuth client implementation
├── controllers/
│   └── AdminController.php     # Admin configuration interface
├── models/
│   └── ConfigureForm.php       # Configuration model
├── views/
│   └── admin/
│       └── index.php           # Admin configuration view
├── docs/
│   ├── README.md               # User documentation
│   ├── CHANGELOG.md            # Version history
│   ├── TESTING.md              # Testing guide
│   └── IMPLEMENTATION.md       # This file
├── config.php                  # Module configuration
├── Events.php                  # Event handlers
├── Module.php                  # Main module class
└── module.json                 # Module metadata
```

## Key Changes from auth-google

### 1. Namespace Changes

All namespaces have been updated:
- **From**: `humhubContrib\auth\google`
- **To**: `humhubContrib\auth\moodle`

**Affected files:**
- `Module.php`
- `config.php`
- `Events.php`
- `controllers/AdminController.php`
- `models/ConfigureForm.php`
- `authclient/MoodleAuth.php` (renamed from GoogleAuth.php)

### 2. Module Identifier

- **From**: `auth-google`
- **To**: `auth-moodle`

**Affected files:**
- `module.json`
- `config.php`
- `Module.php`
- `models/ConfigureForm.php`

### 3. Auth Client Implementation

**File**: `authclient/MoodleAuth.php`

#### Key Differences from Google OAuth:

1. **Base Class**:
   - Google used: `extends yii\authclient\clients\Google`
   - Moodle uses: `extends yii\authclient\OAuth2`
   
   *Reason*: Google has a built-in Yii2 client, but Moodle requires a custom implementation.

2. **OAuth Endpoints**:
   ```php
   // These need to be configured based on actual Moodle installation:
   public $authUrl = 'https://your-moodle-instance.com/admin/oauth2callback.php';
   public $tokenUrl = 'https://your-moodle-instance.com/local/oauth/token.php';
   public $apiBaseUrl = 'https://your-moodle-instance.com/local/oauth';
   ```

3. **User Attribute Mapping**:
   ```php
   // Google mapping:
   'id' => 'sub',
   'username' => 'displayName',
   'firstname' => 'given_name',
   'lastname' => 'family_name',
   
   // Moodle mapping (to be verified):
   'id' => 'id',
   'username' => 'username',
   'firstname' => 'firstname',
   'lastname' => 'lastname',
   ```

4. **Scope**:
   - Google: Handled by Google client class
   - Moodle: `openid profile email` (to be verified)

### 4. Translation Keys

All translation keys updated:
- **From**: `AuthGoogleModule.base`
- **To**: `AuthMoodleModule.base`

**Note**: Actual translation files still need to be created.

### 5. Visual Elements

- Icon changed from `fa fa-google` to `fa fa-graduation-cap`
- Button color changed from `#e0492f` (Google red) to `#f98012` (Moodle orange)

## OAuth 2.0 Flow

### Standard OAuth Flow:
1. User clicks "Moodle" button on HumHub login page
2. HumHub redirects to Moodle authorization endpoint
3. User authenticates with Moodle
4. Moodle redirects back with authorization code
5. HumHub exchanges code for access token
6. HumHub uses access token to fetch user info
7. HumHub creates/updates user account
8. User is logged in to HumHub

### Implementation Details:

#### Step 1-2: Authorization Request
- URL: `$authUrl` (configured in MoodleAuth.php)
- Parameters:
  - `client_id`: From module configuration
  - `redirect_uri`: HumHub callback URL
  - `response_type`: 'code'
  - `scope`: Configured scope
  - `state`: CSRF protection token

#### Step 4-5: Token Exchange
- URL: `$tokenUrl` (configured in MoodleAuth.php)
- Method: POST
- Parameters:
  - `grant_type`: 'authorization_code'
  - `code`: Authorization code from redirect
  - `client_id`: From module configuration
  - `client_secret`: From module configuration
  - `redirect_uri`: Must match authorization request

#### Step 6: User Info Retrieval
- URL: Defined in `initUserAttributes()` method
- Method: GET
- Headers: `Authorization: Bearer {access_token}`

## Critical TODOs

### High Priority

1. **OAuth Endpoint URLs** (`authclient/MoodleAuth.php`)
   - Current values are placeholders
   - Must be updated based on actual Moodle installation
   - May vary by Moodle version and OAuth plugin

2. **User Attribute Mapping** (`authclient/MoodleAuth.php`)
   - Current mapping is estimated
   - Must be verified by examining actual Moodle API response
   - Field names may differ by Moodle version/configuration

3. **OAuth Scope** (`authclient/MoodleAuth.php`)
   - Current value: `openid profile email`
   - May need adjustment based on Moodle OAuth implementation

### Medium Priority

4. **Translation Files**
   - Create message files for AuthMoodleModule
   - Translate all UI strings
   - Support multiple languages

5. **Configuration Options** (`models/ConfigureForm.php`)
   - Consider adding Moodle instance URL field
   - Consider adding custom endpoint URL fields
   - Consider adding scope configuration

6. **Icon/Branding** (`authclient/MoodleAuth.php`)
   - Verify icon choice (`fa fa-graduation-cap`)
   - Verify button color (`#f98012`)
   - Consider custom Moodle icon

### Low Priority

7. **Module Icon** (`resources/module_image.png`)
   - Current image is from Google module
   - Should be updated to Moodle branding

8. **Documentation Links** (`views/admin/index.php`)
   - Update to actual Moodle OAuth documentation
   - Verify documentation URL is accessible

## Moodle OAuth Variants

Moodle OAuth implementation may vary based on:

1. **Moodle Version**:
   - Moodle 3.x
   - Moodle 4.x
   - Different versions may have different OAuth implementations

2. **OAuth Plugins**:
   - `auth_oauth2`: Core OAuth 2.0 authentication plugin
   - `local_oauth`: Custom OAuth provider plugin
   - Third-party OAuth plugins
   
3. **Configuration**:
   - Custom OAuth service configurations
   - Custom endpoint URLs
   - Custom field mappings

## Testing Requirements

Before this module can be considered production-ready:

1. **OAuth Flow Testing**:
   - Test complete authentication flow
   - Verify all OAuth endpoints work correctly
   - Test error scenarios

2. **User Mapping Testing**:
   - Verify user attributes are correctly mapped
   - Test with various Moodle user configurations
   - Test missing/optional fields

3. **Integration Testing**:
   - Test new user registration
   - Test existing user login
   - Test account linking

4. **Security Testing**:
   - Verify CSRF protection
   - Test redirect URI validation
   - Verify token handling
   - Check for information disclosure

5. **Compatibility Testing**:
   - Test with different Moodle versions
   - Test with different HumHub versions
   - Test with different PHP versions

## Known Limitations

1. **Moodle Instance Configuration**:
   - Currently hardcoded in MoodleAuth.php
   - Should ideally be configurable per installation

2. **Single Moodle Instance**:
   - Module assumes single Moodle instance
   - Multi-tenant scenarios not supported

3. **Custom Field Mapping**:
   - Field mapping is hardcoded
   - Custom fields require code changes

## Future Enhancements

Potential improvements for future versions:

1. **Dynamic Configuration**:
   - Allow configuring Moodle instance URL via admin interface
   - Allow configuring custom OAuth endpoints
   - Allow configuring custom field mappings

2. **Multiple Moodle Instances**:
   - Support authentication from multiple Moodle instances
   - Allow users to choose which Moodle instance to use

3. **Advanced Field Mapping**:
   - Support custom field mapping via configuration
   - Support additional Moodle user fields
   - Support profile field synchronization

4. **Improved Error Handling**:
   - Better error messages for common issues
   - Automatic retry on transient failures
   - User-friendly troubleshooting guide

5. **Automated Testing**:
   - Unit tests for OAuth flow
   - Integration tests with mock Moodle API
   - Continuous integration setup

## References

- [Moodle OAuth 2.0 Services Documentation](https://docs.moodle.org/en/OAuth_2_services)
- [Yii2 AuthClient Documentation](https://github.com/yiisoft/yii2-authclient)
- [HumHub Module Development Guide](https://docs.humhub.org/docs/develop/modules)
- [OAuth 2.0 RFC 6749](https://tools.ietf.org/html/rfc6749)

## Support

For issues or questions:
- GitHub Issues: https://github.com/Stefan-59/auth-moodle/issues
- Original auth-google: https://github.com/humhub-contrib/auth-google

## Version History

- **0.1.0**: Initial adaptation from auth-google (current)
  - Namespace migration
  - Basic Moodle OAuth structure
  - Documentation and TODOs added
