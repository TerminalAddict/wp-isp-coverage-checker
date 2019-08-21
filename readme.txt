=== Plugin Name ===
Contributors: TerminalAddict
Tags: internetnz, wanna, coverage check
Requires at least: 4
Tested up to: 4.9.8
Requires PHP: 7
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
This plugin will check your NZ ISP coverage
 
== Description ==
 
This plugin does what it says on the packaging :)
It connects to internetnz broadband map and checks if you can get internet at the supplied address.

 
== Installation ==
 
This section describes how to install the plugin and get it working.
 
1. Download and unzip the plugin on your local machine
2. Upload the unzipped directory to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Configure the plugin

== Usage ==

Insert the short code `[wanna-isp-coverage-check-form]` to display the form on any page or post.

Insert the short code `[wanna-isp-coverage-check-results]` to display the results on any page or post.

 
== Frequently Asked Questions ==
 
= What do you use to lookup addresses? =
 
https://www.algolia.com/places
It uses javascript to try and predict the address as you type
 
= What do you use to get lat/long coordinates? =
 
LocationIQ.com
You need an API key from locationIQ
 
= Where do you get the results from? =
 
Internet NZ
You need an API key from Internet NZ
