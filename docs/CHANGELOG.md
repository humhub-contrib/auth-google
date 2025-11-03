Changelog
=========

0.1.0 (Unreleased - Development)
---------------------------------
### Migration from Google OAuth to Moodle OAuth

**Initial Preparation:**
- Forked from auth-google module
- Updated all namespaces from `humhubContrib\auth\google` to `humhubContrib\auth\moodle`
- Updated module ID from `auth-google` to `auth-moodle`
- Renamed GoogleAuth class to MoodleAuth
- Updated documentation for Moodle OAuth configuration
- Added comprehensive TODO comments throughout codebase

**What Still Needs to Be Done:**
- [ ] Configure and verify Moodle OAuth 2.0 endpoint URLs
- [ ] Test OAuth authentication flow with actual Moodle instance
- [ ] Verify user attribute mappings from Moodle API
- [ ] Test user registration workflow
- [ ] Test user login workflow
- [ ] Update and test icon/styling for Moodle button
- [ ] Create translation files for AuthMoodleModule
- [ ] Add Moodle instance URL configuration option
- [ ] Add support for custom OAuth endpoint configuration
- [ ] Comprehensive testing with different Moodle versions
- [ ] Update module icon/image for Moodle branding

**Technical Notes:**
- Module requires Moodle instance with OAuth 2.0 support enabled
- OAuth endpoints may vary by Moodle version and configuration
- User attribute names from Moodle API need verification

---

## Previous History (from auth-google)

1.1.1 (Unreleased)
-------------------------
- Fix: Update module resources path

1.1.0 (July 26, 2025)
---------------------
- Enh #13: Migration to Bootstrap 5 for HumHub 1.18

1.0.1 (January 30, 2025)
------------------------
- Initial release
- Enh #8: Use PHP CS Fixer
- Fix #9: New account registration fails when a profile field (other than first and last name) is required