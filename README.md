# Moodle Sign-In Authentication Module for HumHub

🚧 **Status: In Development - Preparation Phase Complete**

This HumHub module enables authentication via Moodle OAuth 2.0, allowing users to log in to HumHub using their Moodle credentials.

## Current Status

This module has been **forked from auth-google** and all code has been **prepared for Moodle OAuth integration**. The structural changes are complete, but the module **requires configuration and testing** before it can be used.

### ✅ Completed
- All namespaces migrated from Google to Moodle
- OAuth client implementation structure created
- Configuration forms and admin interface adapted
- Comprehensive documentation created
- TODO comments added throughout code

### ⚠️ Requires Configuration
- OAuth endpoint URLs (currently placeholders)
- User attribute mappings (need verification with real Moodle API)
- Translation files (keys defined, files not created)

### 🧪 Not Yet Tested
- OAuth authentication flow
- User registration
- User login
- Error handling

## Quick Start (For Developers)

### Prerequisites
- HumHub 1.18 or higher
- PHP 7.4 or higher with `allow_url_fopen` enabled
- Access to a Moodle instance with OAuth 2.0 configured

### Installation
1. Clone this repository into your HumHub modules directory
2. Enable the module in HumHub admin interface
3. Configure OAuth credentials in module settings

### Next Steps for Development
1. **Read the documentation** in the `docs/` directory:
   - `docs/MIGRATION_SUMMARY.md` - Overview of changes made
   - `docs/IMPLEMENTATION.md` - Technical details
   - `docs/TODO.md` - Complete task checklist
   - `docs/TESTING.md` - Testing guide

2. **Configure OAuth endpoints** in `authclient/MoodleAuth.php`:
   - Update `$authUrl`, `$tokenUrl`, `$apiBaseUrl` with your Moodle URLs
   - See TODO comments in the file

3. **Test with a Moodle instance**:
   - Follow the testing guide in `docs/TESTING.md`
   - Verify user attribute mappings
   - Test authentication flow

4. **Complete remaining tasks**:
   - Create translation files
   - Update documentation with verified configuration
   - Remove TODO comments as tasks are completed

## Documentation

### Main Documentation Files

- **[README.md](docs/README.md)** - User-facing setup and configuration guide
- **[MIGRATION_SUMMARY.md](docs/MIGRATION_SUMMARY.md)** - Overview of changes from auth-google
- **[IMPLEMENTATION.md](docs/IMPLEMENTATION.md)** - Technical implementation details
- **[TODO.md](docs/TODO.md)** - Complete task checklist
- **[TESTING.md](docs/TESTING.md)** - Comprehensive testing guide
- **[CHANGELOG.md](docs/CHANGELOG.md)** - Version history

### Key Information

**Module ID**: `auth-moodle`  
**Namespace**: `humhubContrib\auth\moodle`  
**Version**: 0.1.0 (Development)  
**HumHub Version**: 1.18+  
**PHP Version**: 7.4+

## File Structure

```
auth-moodle/
├── authclient/
│   └── MoodleAuth.php          # OAuth client (needs endpoint configuration)
├── controllers/
│   └── AdminController.php     # Admin interface controller
├── models/
│   └── ConfigureForm.php       # Configuration model
├── views/
│   └── admin/
│       └── index.php           # Admin configuration view
├── docs/
│   ├── README.md               # User documentation
│   ├── CHANGELOG.md            # Version history
│   ├── TESTING.md              # Testing guide
│   ├── IMPLEMENTATION.md       # Technical details
│   ├── TODO.md                 # Task checklist
│   └── MIGRATION_SUMMARY.md    # Migration overview
├── config.php                  # Module configuration
├── Events.php                  # Event handlers
├── Module.php                  # Main module class
└── module.json                 # Module metadata
```

## Configuration

The module requires the following configuration:

1. **Moodle OAuth Credentials**:
   - Client ID
   - Client Secret
   - Configured in HumHub admin interface

2. **Moodle OAuth Endpoints** (in code):
   - Authorization URL
   - Token URL
   - User Info API URL
   - Currently set as placeholders in `authclient/MoodleAuth.php`

3. **Redirect URI**:
   - Displayed in HumHub module settings
   - Must be added to Moodle OAuth configuration

## Development Notes

### Critical TODOs

See `docs/TODO.md` for the complete checklist. Most critical items:

1. Update OAuth endpoint URLs in `authclient/MoodleAuth.php`
2. Verify user attribute mapping with actual Moodle API response
3. Test authentication flow with real Moodle instance
4. Create translation files for AuthMoodleModule
5. Update documentation with verified configuration

### Code Comments

Extensive TODO comments have been added throughout the code to guide development:

- `authclient/MoodleAuth.php` - OAuth implementation TODOs
- `models/ConfigureForm.php` - Configuration TODOs
- `views/admin/index.php` - UI TODOs
- `docs/README.md` - Documentation TODOs

### Translation Keys

All UI strings use the `AuthMoodleModule.base` translation domain. Translation files need to be created in a `messages/` directory following HumHub conventions.

## Testing

Before this module can be used in production, it must pass all tests in `docs/TESTING.md`, including:

- Module installation and configuration
- OAuth authentication flow (new user registration)
- OAuth authentication flow (existing user login)
- Error handling
- Security testing
- User attribute mapping verification

## Support & Contribution

This is a work in progress. Contributions are welcome!

### Reporting Issues

When reporting issues, please include:
- HumHub version
- Moodle version
- PHP version
- Exact error messages
- Steps to reproduce

### Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

See `docs/LICENCE.md` for license information.

## Credits

This module was forked from [humhub-contrib/auth-google](https://github.com/humhub-contrib/auth-google) and adapted for Moodle OAuth authentication.

## Resources

- [HumHub Documentation](https://docs.humhub.org/)
- [Moodle OAuth 2.0 Services](https://docs.moodle.org/en/OAuth_2_services)
- [Yii2 AuthClient](https://github.com/yiisoft/yii2-authclient)
- [OAuth 2.0 Specification](https://tools.ietf.org/html/rfc6749)

---

**Ready to continue development?** Start with `docs/MIGRATION_SUMMARY.md` to understand what has been done, then follow the checklist in `docs/TODO.md`.
