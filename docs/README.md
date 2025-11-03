# Moodle Sign-In

Using this module, users can directly log in or register with their Moodle credentials at this HumHub installation. 
A new button "Moodle" will appear on the login page.

## Configuration

<!-- TODO: Update with final Moodle OAuth documentation link -->
Please follow the Moodle OAuth 2.0 configuration instructions to create the required OAuth client credentials on your Moodle instance.

**Moodle OAuth Setup Steps:**
1. Navigate to your Moodle instance: `Site administration -> Server -> OAuth 2 services`
2. Create a new OAuth 2 service or configure an existing one
3. Configure the OAuth endpoints (see Technical Details below)
4. Generate the **Client ID** and **Client Secret**

Once you have the **Client ID** and **Client Secret** created, the values must then be entered in the module configuration at: `Administration -> Modules -> Moodle Auth -> Settings`. 
This page also displays the `Authorized redirect URI`, which must be inserted in Moodle in the corresponding field.

## Technical Details

<!-- TODO: Verify and update these OAuth endpoints based on actual Moodle implementation -->
**Moodle OAuth 2.0 Endpoints:**
- Authorization URL: `https://your-moodle-instance.com/admin/oauth2callback.php`
- Token URL: `https://your-moodle-instance.com/local/oauth/token.php`
- User Info URL: `https://your-moodle-instance.com/local/oauth/user_info.php`

**Note:** These endpoints may vary depending on your Moodle version and configuration. Please verify with your Moodle administrator.

## Requirements
- PHP 7.4+
- `allow_url_fopen` **MUST** be enabled
- Access to a Moodle instance with OAuth 2.0 support configured

## Development Status

⚠️ **This module is currently being adapted from Google OAuth to Moodle OAuth.**

### What still needs to be done:
- [ ] Verify Moodle OAuth 2.0 endpoint URLs
- [ ] Test OAuth flow with actual Moodle instance
- [ ] Verify user attribute mapping from Moodle (username, email, firstname, lastname)
- [ ] Test user registration flow
- [ ] Test user login flow
- [ ] Verify icon and styling for Moodle button
- [ ] Add Moodle-specific configuration options if needed
- [ ] Complete translation strings for all languages
