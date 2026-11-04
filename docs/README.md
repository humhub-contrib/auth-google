# Google Sign-In

Using this module, users can directly log in or register with their Google credentials at this HumHub installation. 
A new button "Google" will appear on the login page.

## Configuration

Please follow the [Google instructions](https://developers.google.com/identity/protocols/OpenIDConnect#registeringyourapp) to create the required `OAuth client ID` credentials.

Once you have the **Client ID** and **Client Secret** created there, the values must then be entered in the module configuration at: `Administration -> Modules -> Google Sign-In -> Configure`. 
This page also displays the `Redirect URI`, which must be added in Google as an `Authorized redirect URI`.

## Requirements
- PHP 8.2+
- `allow_url_fopen` **MUST** be enabled.
