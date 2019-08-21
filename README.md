# Plugin Details
* Contributors: Paul Willard (paul@paulwillard.nz)
* Tags: internetnz, wanna, coverage check, wanna.net.nz
* Requires at least: Wordpress 4
* Tested up to: Wordpress 4.9.8
* Requires PHP: 7
* Stable tag: 4.3
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
This plugin will check your NZ ISP coverage
 
## Description
 
This plugin does what it says on the packaging :)
It connects to internetnz broadband map and checks if you can get internet at the supplied address.

 
## Installation
 
This section describes how to install the plugin and get it working.
 
1. Download and unzip the plugin on your local machine
2. Upload the unzipped directory to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Configure the plugin

## Usage

Insert the short code `[wanna-isp-coverage-check-form]` to display the form on any page or post.

Insert the short code `[wanna-isp-coverage-check-results]` to display the results on any page or post.
 
## Frequently Asked Questions
 
1. What do you use to lookup addresses? 
 
> https://www.algolia.com/places
>
> It uses javascript to try and predict the address as you type
 
2. What do you use to get lat/long coordinates?
 
> https://locationiq.com/
>
> You need an API key from locationIQ
 
3. Where do you get the results from? 
 
> https://internetnz.nz/
>
> You need an API key from Internet NZ

## Customise css
There is an area in the config to insert custom CSS

1. The search form shortcode produces html that looks like:
~~~~
<div id="address_check_container">
	<form method="post" action="#" id="address_check">
	<nput type="text" id="address_check_field" value="" placeholder="Check your coverage ...." autofocus="" accesskey="q" />
	<input type="submit" id="address_check_submit" class="button" value="Search" />
	</form>
</div>
<div style="clear:both;"></div>
~~~~

2. The results shortcode produces html that looks like:
~~~~
<div id="address_check_results_container">
  <h3 class="resultsHeader">
  Yay! Looks like you’re in coverage! Complete your signup 
  </h3>
  <div class="hidden_debug_data" style="display: none;">96 Cambridge Road, Hamilton, Waikato, New Zealand | 10.255.255.213 | lat: -37.7981442 | long: 175.3145347 | PASS</div>
  <table class="resultsTabulated">
    <tbody>
      <tr>
        <td>Available</td><td>Fibre</td>
      </tr>
      <tr>
        <td>Not Available</td><td>Cable</td>
        .... (continued for each technology type)
    </tbody>
  </table>
  <div class="internetnzlink">Data provided by: <a href="https://broadbandmap.nz/" target="_blank">The National broadband map</a></div>
</div>
<div style="clear:both;"></div>
~~~~

## Credits
1. https://www.wanna.net.nz For paying me the time to make this plugin :)
2. https://github.com/erusev/parsedown For Parserdown.php to display this about page
3. https://www.algolia.com/places For the ability to predict addresses
4. https://locationiq.com/ For the ability to convert human readable addresses to latitude and longitude
5. https://internetnz.nz/ For providing data, and the awesome Broadband map of NZ https://broadbandmap.nz/
