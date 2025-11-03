# TODO Checklist - Moodle OAuth Integration

This file contains all tasks that need to be completed to make this module production-ready.

## Critical Tasks (Must Complete Before Testing)

### 1. Configure Moodle OAuth Endpoints
**File**: `authclient/MoodleAuth.php`
**Lines**: 22-31

- [ ] Replace placeholder URLs with actual Moodle instance URLs
- [ ] Verify authorization endpoint URL
- [ ] Verify token endpoint URL  
- [ ] Verify API base URL
- [ ] Document the Moodle version being used
- [ ] Document the OAuth plugin being used (auth_oauth2, local_oauth, etc.)

**Current placeholders**:
```php
public $authUrl = 'https://your-moodle-instance.com/admin/oauth2callback.php';
public $tokenUrl = 'https://your-moodle-instance.com/local/oauth/token.php';
public $apiBaseUrl = 'https://your-moodle-instance.com/local/oauth';
```

### 2. Verify User Attribute Mapping
**File**: `authclient/MoodleAuth.php`  
**Lines**: 60-71

- [ ] Test authentication and capture actual Moodle API response
- [ ] Verify field name for user ID
- [ ] Verify field name for username
- [ ] Verify field name for first name
- [ ] Verify field name for last name
- [ ] Verify field name for email
- [ ] Update mapping in `defaultNormalizeUserAttributeMap()` if needed
- [ ] Document the API response structure

**Current mapping** (may need adjustment):
```php
return [
    'id' => 'id',
    'username' => 'username',
    'firstname' => 'firstname',
    'lastname' => 'lastname',
    'email' => 'email',
];
```

### 3. Verify OAuth Scope
**File**: `authclient/MoodleAuth.php`
**Lines**: 87-93

- [ ] Check Moodle OAuth documentation for required scopes
- [ ] Test with minimal scope requirements
- [ ] Update `defaultScope()` method if needed
- [ ] Document which scopes are required and why

**Current scope**: `openid profile email`

### 4. Verify User Info Endpoint
**File**: `authclient/MoodleAuth.php`
**Lines**: 80-84

- [ ] Identify correct user info endpoint for your Moodle setup
- [ ] Update `initUserAttributes()` method
- [ ] Test endpoint returns expected user data
- [ ] Handle potential errors/missing fields

## Testing Tasks

### 5. Module Installation Testing
- [ ] Install module in HumHub
- [ ] Verify module appears in module list
- [ ] Enable module without errors
- [ ] Access configuration page
- [ ] Verify all UI elements display correctly

### 6. Configuration Testing  
- [ ] Save configuration with valid credentials
- [ ] Verify settings persist after reload
- [ ] Test with invalid credentials (expect appropriate error)
- [ ] Copy redirect URI and configure in Moodle
- [ ] Verify redirect URI format is correct

### 7. OAuth Flow Testing - New User
- [ ] Click "Moodle" button on login page
- [ ] Verify redirect to Moodle
- [ ] Authenticate with Moodle credentials
- [ ] Verify redirect back to HumHub
- [ ] Verify new user account created
- [ ] Verify user attributes mapped correctly
- [ ] Verify user logged in successfully

### 8. OAuth Flow Testing - Existing User
- [ ] Test login with existing HumHub account (same email)
- [ ] Verify no duplicate account created
- [ ] Verify successful login
- [ ] Verify session established

### 9. Error Handling Testing
- [ ] Test with invalid client ID
- [ ] Test with invalid client secret
- [ ] Test with wrong redirect URI
- [ ] Test OAuth flow cancellation
- [ ] Test with Moodle user missing email
- [ ] Test network timeout scenarios
- [ ] Verify error messages are user-friendly

### 10. Security Testing
- [ ] Verify client secret not exposed in HTML
- [ ] Verify OAuth state parameter validated
- [ ] Verify CSRF protection works
- [ ] Verify no sensitive data in logs
- [ ] Test redirect URI validation
- [ ] Check for open redirect vulnerabilities

## Documentation Tasks

### 11. Update README
**File**: `docs/README.md`

- [ ] Add verified Moodle OAuth endpoint URLs
- [ ] Add step-by-step Moodle configuration guide
- [ ] Add screenshots of Moodle OAuth configuration
- [ ] Add troubleshooting section
- [ ] Update version compatibility information
- [ ] Remove "Development Status" section when complete

### 12. Update Documentation Links
**File**: `views/admin/index.php`
**Line**: 17

- [ ] Verify Moodle OAuth documentation URL is correct
- [ ] Update URL if needed
- [ ] Test that link is accessible

### 13. Create Translation Files
- [ ] Create message directory structure
- [ ] Create base English translation file
- [ ] Add all translation strings for AuthMoodleModule.base
- [ ] Consider additional language translations (German, Spanish, etc.)
- [ ] Test translation system works

**Required translation keys**:
- `<strong>Moodle</strong> Sign-In configuration`
- `Moodle OAuth Documentation`
- `Please follow the Moodle instructions...`
- `Enabled`
- `Client ID`
- `Client secret`
- Setup instruction steps (1-7)
- Testing required items

## Code Quality Tasks

### 14. Remove TODO Comments
After completing each task, remove the corresponding TODO comments from:
- [ ] `authclient/MoodleAuth.php`
- [ ] `models/ConfigureForm.php`
- [ ] `views/admin/index.php`
- [ ] `docs/README.md`

### 15. Code Review
- [ ] Review all namespace changes are complete
- [ ] Review all hardcoded strings have translations
- [ ] Review code follows HumHub coding standards
- [ ] Review security best practices followed
- [ ] Review error handling is comprehensive

### 16. Add Code Comments
- [ ] Document complex OAuth logic
- [ ] Document any Moodle-specific quirks
- [ ] Document configuration requirements
- [ ] Document security considerations

## Enhancement Tasks (Optional)

### 17. Advanced Configuration Options
**File**: `models/ConfigureForm.php`

- [ ] Add Moodle instance URL field
- [ ] Add custom OAuth endpoint URL fields
- [ ] Add scope configuration field
- [ ] Add user attribute mapping configuration
- [ ] Update admin view for new fields
- [ ] Update save/load logic

### 18. Improved Visual Elements
**File**: `authclient/MoodleAuth.php`

- [ ] Verify Moodle icon is appropriate
- [ ] Test button color matches Moodle branding
- [ ] Consider custom Moodle icon/logo
- [ ] Test button on different themes
- [ ] Verify popup size is optimal

### 19. Module Icon/Image
**File**: `resources/module_image.png`

- [ ] Create Moodle-branded module icon
- [ ] Replace Google icon with Moodle icon
- [ ] Test icon displays correctly in module list
- [ ] Ensure icon meets HumHub requirements

## Release Preparation Tasks

### 20. Update Version Information
**Files**: `module.json`, `docs/CHANGELOG.md`

- [ ] Update version to 1.0.0 when ready for release
- [ ] Complete CHANGELOG with all changes
- [ ] Document any breaking changes
- [ ] Document upgrade path from auth-google if applicable

### 21. Testing Documentation
**File**: `docs/TESTING.md`

- [ ] Complete all items in testing checklist
- [ ] Document actual test results
- [ ] Document any issues found and resolved
- [ ] Document version compatibility (Moodle versions tested)

### 22. Create Release Notes
- [ ] Summarize new features
- [ ] Document configuration requirements
- [ ] List known limitations
- [ ] Provide upgrade instructions
- [ ] Include troubleshooting tips

## Maintenance Tasks (Ongoing)

### 23. Monitor Issues
- [ ] Set up GitHub issue tracking
- [ ] Respond to user issues
- [ ] Document common problems and solutions
- [ ] Update documentation based on feedback

### 24. Keep Dependencies Updated
- [ ] Monitor HumHub version compatibility
- [ ] Test with new HumHub releases
- [ ] Monitor Moodle OAuth API changes
- [ ] Update as needed for new Moodle versions

### 25. Community Support
- [ ] Create support documentation
- [ ] Participate in HumHub community
- [ ] Share knowledge about Moodle OAuth integration
- [ ] Consider contributing improvements upstream

---

## Progress Tracking

**Last Updated**: 2025-11-02

**Overall Status**: Initial preparation complete, testing phase not started

**Completed**:
- [x] Namespace migration from Google to Moodle
- [x] Module ID updates
- [x] Basic code structure adaptation
- [x] Documentation framework created
- [x] TODO comments added throughout code

**In Progress**:
- [ ] OAuth endpoint configuration
- [ ] Testing with actual Moodle instance

**Not Started**:
- [ ] Translation file creation
- [ ] Production testing
- [ ] Release preparation

**Blockers**:
- Need access to Moodle instance with OAuth configured
- Need to determine exact OAuth endpoint URLs
- Need to verify user attribute API response structure

---

## Notes

- This module is forked from `humhub-contrib/auth-google`
- HumHub version requirement: 1.18+
- PHP version requirement: 7.4+
- Requires `allow_url_fopen` enabled

## Questions to Answer

1. Which Moodle OAuth plugin should be recommended?
2. What are the exact OAuth endpoints for different Moodle versions?
3. Are there any Moodle version-specific considerations?
4. Should the module support multiple Moodle instances?
5. What additional configuration options would be most useful?
