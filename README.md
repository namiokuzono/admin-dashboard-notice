# Admin Dashboard Notice

A WordPress plugin to display notices in the admin dashboard. Perfect for WooCommerce support engineers to track Zendesk tickets and display important messages.

## Description

Admin Dashboard Notice allows you to display customizable notices in your WordPress admin dashboard. These notices can be used to communicate important information, updates, or announcements to your site administrators.

## Features

- Display customizable notices in the WordPress admin dashboard
- Quick Zendesk ticket reference integration
  - Automatically extracts ticket numbers from Zendesk URLs
  - Displays ticket reference with clickable link
  - WooCommerce-specific styling with pastel purple theme
- Additional message support
  - Add extra information below Zendesk ticket reference
  - Or use as standalone notice with different types (info, success, warning, error)
- Debug mode for troubleshooting
  - Enable/disable debug information
  - View plugin settings and configuration

## Installation

1. Download the plugin files
2. Upload the plugin files to the `/wp-content/plugins/admin-dashboard-notice` directory
3. Activate the plugin through the 'Plugins' menu in WordPress

## Usage

### Basic Notice

1. Go to Notice > Settings in your WordPress admin menu
2. Enter your message in the "Additional Message" field
3. Select the notice type (info, success, warning, or error)
4. Save your settings

### Zendesk Integration

1. Enable the "Quick Zendesk Note" option
2. Enter your Zendesk ticket URL (e.g., https://zendesk.com/agent/tickets/1234567)
3. Add any additional message if needed
4. Save your settings

The notice will automatically display:
- The ticket reference (e.g., "1234567-zen")
- A clickable link to the Zendesk ticket
- Your additional message below (if provided)
- WooCommerce-specific styling

### Debug Mode

1. Enable the "Debug Mode" option in the settings
2. Debug information will be displayed in the admin dashboard
3. Useful for troubleshooting plugin issues

## Notice Types

- Info (blue) - For general information
- Success (green) - For success messages
- Warning (yellow) - For warnings or important notices
- Error (red) - For error messages or critical alerts

## Requirements

- WordPress 5.0 or higher
- PHP 7.2 or higher

## License

This project is licensed under the GPL v2 or later - see the [LICENSE](LICENSE) file for details.

## Author

Created by [Nami Okuzono](https://github.com/a8cnam) 