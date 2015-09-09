=== Plugin Name ===
Contributors: sevenspark
Donate link: http://bit.ly/DonateResponsiveSelect
Tags: menu, switch, swap, change
Requires at least: 4.0
Tested up to: 4.3
Stable tag: 1.1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The Menu Swapper allows you to register custom theme locations and easily swap menus on individual Pages or Posts, all through the WordPress Admin Panel.

== Description ==

The Menu Swapper provides two utilities:

1. A settings page that allows you to register unlimited menu theme locations

2. A meta box that will appear on Pages and Posts, which will allow you to replace existing menu theme locations with your new theme locations for those individual Posts/Pages.

[Video demo](http://www.youtube.com/watch?v=kAd0_RKvvLw)

== Installation ==

Install just like any other plugin

1. Upload the `/menu-swapper/` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Create your theme locations via Settings > Menu Swapper
1. Set menus for your new theme locations in Appearance > Menus
1. Swap your theme locations via the meta box on individual Pages and Posts

== Frequently Asked Questions ==

None yet.


== Screenshots ==

None yet.


== Changelog ==

= 1.1.0.2 =

* Add WPML swapper check
* Don't unset 'menu' argument to avoid invalid array index access in core

= 1.1.0.1 =

* Previous deployment erroneously removed assets folder, this re-adds it so that the Control Panel page will work properly

= 1.1 =

* Add check to remove the 'menu' argument from wp_nav_menu args, as this will override theme location setting
* Cleaned up admin panel for current WordPress styles.

= 1.0.1 =
* Set the default to not affect any menus so that when Menu Swapper is not needed it won't inadvertently swap your menus

= 1.0 =
* Initial submission


