=== FB Page Promoter Lightbox ===
Contributors: Arevico 
Requires at least: 3.0
Tested up to: 4.9.5
Requires PHP: 5.3
Stable tag: 4.1.4
Tags: facebook, facebook popup, share button, social popup, like button, facebook like box, like box, share popup, facebook like box popup

Sky-rocket your amount of Facebook fans. Display a highly configurable modal to convert your website traffic into highly engaged fans!

== Description ==

Sky-rocket your amount of Facebook fans. Display a highly configurable modal to convert your website traffic into highly engaged fans!

**Features:**

* Super Simple To Setup
* Facebook page is needed
* Display the facebook lightbox onload with or without a delay
* Limit the lightbox to once every x days per individual visitors
* Promote your own facebook fanpage

[youtube http://www.youtube.com/watch?v=zXfNwxBk7pA]

**Requirements:**

* PHP 5.3 or higher
* Facebook Fanpage or Group
* Javascript enabled


== Screenshots ==

1. The plugin in action.
2. The option page

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page. Configure the plugin under the menu 'Arevico Settings'.

Navigate to the "Arevico Settings" tab and set your preferences. You will need a facebook fanpage and retrieve it's ID. The plugin does not work with facebook groups or personal profiles.

== Frequently Asked Questions ==

**The lightbox does not appear, only the close button?**
Make sure that the delays is not set to '0'. Use a recommended values of 3000 or more.


**The lightbox appears even tough I already like it. How do I fix this?**

We designed the plugin to work on most sites. The reason why we did not include it is, that you'll need a Facebook API Key for it to work. Using a Facebook API key often creates conflict with other social applications. In order to deliver sustainable support , we included that feature in the premium version.


**The lightbox appears to be blank (white), how to fix this?**

Make sure that you've inserted the correct Page ID, also make sure that you're website doesn't have any geographical or age restrictions on it. Facebook can only enforce such restrictions if you are logged in. Non-logged in users will therefore be presented with a white likebox (empty).

**I'm Getting an Invalid Version Error, How to fix this ?**
This error occurs because the Facebook API is initialized twice. To fix this, make sure that the other plugin omits the version number and uses the new sdk.js instead of the old all.js

Make sure that your website has a valid doctype. When in doubt it is recommended to use a HTML5 doctype. Open header.php via your theme editor and make sure that the very first line is  <!DOCTYPE html>.


**The lightbox seems to be scrolling out of screen (extends infinitely)**

Make sure that your website has a valid doctype. When in doubt it is recommended to use a HTML5 doctype. Open header.php via your theme editor and make sure that the very first line is  <!DOCTYPE html>.

**What are some good settings?**

A delay of 5000-10000 seconds is recomended. This way, the user has read some of  your content. Furtermore, once in 4 or 7 days is also a good option to not annoy repeat visitors.


**The lightbox shows, but it is white. It doesn't contain the likebox?**

While using facebook as a page, you can't use any social plugins. To do this, please go to facebook.com and use facebook as a personal account.

**It conflict with other social plugins? how can I fix it?**

If you need the xfbml make sure, that you aways specify the application/api Key and use only one per page!

**Which browsers are supported?.**

All major browser >= IE7. Tested in google chrome, internet explorer 8+ and firefox.

**Youtube videos show trough the lightbox?**

To fix this issue, set the wmode=transparent parameter to the youtube embed url!

**How to get support?**

First, read this F.A.Generally, emails are answered faster than forum threads. Which ever support channel you choose, be sure to include enough details so that we can either see the problem live or re-create the problem in our development environment.

**I come up with a great feature , what should i do?**

Contact us via the WordPress forums or via http://arevico.com/contact/.

**Only the general settings appear, style and advanced don't?**

That functionality is part of the premium version. Make sure you remove this version first before installing the premium version.

== Changelog ==

= Version 4.1.4 =
* Added PHP 5.3 Requirement
* Changed Facebook to FB for compliance
* Tested WordPress 4.9.5

= Version 4.1.2 =
* Update Featherlight from 1.3.5 to 1.7.8
* Fixed close button size bug (on Twentyseventeen)
* Tested on WordPress 4.8.2

= Version 4.1.1 ==
* Tested against WordPress 4.8.1
* Updated Admin Font
* Introduced Semantic Versioning
* PHP 5.3 is now Required

= Version 4.1 =
* Bug Fixes
* Tested plugin on WordPress 4.8

= Version 3.9 =
* Updated Framework helper 

= Version 3.8 =
* Fixed deprecated use of all.js to sdk.js with an version number
* Added Feature to hide or disable scrollbars when the lightbox is active

= Version 3.7 =
* Fixed Bug Static Front Pages
* Increased Message Readability

= Version 3.4 =
* Added Performance Modes

= Version 2.6.6 =
Introduced:
* New admin UI
* Hide on overlay click

Bugs fixed:
* Display on homepage, custom post-types
* Width and scaling issues

= Version 3.1 =
* Updated the plugin for Facebook API v2.3

= Version 2.6.4 =
* Reversed assumptions made about dehooking, jQuery scope, refined anti conflict methods (fancybox scope, css specific prefixes etc).

= Version 2.6.1 =
* Fixed all lightbox conflicts by giving fancybox it's own, seperate namespace. Fixes issues regarding: close buttons, background colors,etc

= Version 2.5.8 =
* Found a bug with the latest jQuery which occurs with some themes. Import update, was missed in the previous one!

= Version 2.5.7 =
* Fixes layout bugs of option page, commited box sizing layout issues (theme compatibility)

= Version 2.5.3 =
* Added support for archive pages.

= Version 2.5 =
* Code maintenance and optimizations. Fixed bug regarding to checkbox options. Fixed phantom options correctly this time. Added link to premium version.

= Version 2.4 =
* Fixed z-index issue with twenty ten theme and this plugin. Added link to the premium version of the plugin. Included link to premium version on option page. Small optimizations. Added a few screenshots. 

= Version 2.3 =
* Wordpress version compatibility update. Be aware, that your options will be reset!

= Version 2.2 =
* Emergency fix

= Version 2.1 =
* Fixed scrollbar issue in google chrome

= Version 2.0 =
* Full rework of all code. Facebook code has been updated from the old depreciated code to a new iframe code. Has now the option to reliably display on homepage, and any other page in a better way than the old plugin. 

= Version 1.1 =
* Fixed option page bug, deselecting was not possible

= Version 1.0 =
**Initial release**