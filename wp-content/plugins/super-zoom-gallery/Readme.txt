=== Super Zoom Gallery ===
Contributors: ndoorn
Tags: image, photo, gallery, zoom, webshop, superzoomgallery, css3, html5, captions, multiple galleries on one page, transitions, javascript, jquery
Requires at least: 3.5.0
Tested up to: 4.0
Stable tag: 0.5.13

== Description ==
Yet another gallery plugin. I was looking for a simple gallery where you can 
select a thumbnail, see the complete picture in a acceptable size but also have 
the oppertunity to see the details of the image. I searched the web for a way
to do this and found the AnythingZoomer, a jQuery Plugin by Chris Coyier. I 
originally used this jquery plugin for this Wordpress plugin. 

In version 0.5 the plugin was completely re-written. The generated HTML is completely different, the JavaScript was re-designed and the CSS was created from scratch. Also inner zoom was introduced.

It works well for e-commerce sites like webshops or as a photo gallery.

It is easy to adapt if you would want to, but the default behaviour should be
very much usable by anybody. 

There is a settingspage to customize the images used and wheter or not to over-
write the default gallery shortcode.

If you want to use this gallery, simply use the [superzoomgallery] shortcode in
your post or page, or enable the overwriting of the gallery shortcode and use
the default wordpress [gallery] shortcode in your post or page. 

Since this is still an early version, I recommend to test it out first before taking
it to a production site.

If you have any questions or problems, I would be happy to hear from you and help
you if I can!

== Installation ==
Unzip and activate. There is a settingspage which allows you to select which 
image sizes you would like to use and wheter or not to use this gallery as the 
main gallery.

(pro) If the default sizes of the images (thumb, medium, full) don't look very good,
you can add image sizes via your theme. This way you can customize the image sizes.

== Frequently Asked Questions ==

= Can I change the look of the gallery? =
Basically, most of style information is in szg-style.css. If you want to 
change the HTML, then look in the superzoomgalley.php for the function 
'generate_gallery'. 

= I have some problems with my theme. It works great with the default theme. =
Hmm, possible a CSS problem. Do not hesitate to contact me on the forum!

== Screenshots ==
1. This is a screenshot where you see the thumbnails down below, the selected image and the details of a part of the image. This is a screenshot of a webshop which uses the zoom function to show details of the products.
2. This is a screenshot where you see the thumbnails down below, the selected image and the details of a part of the image. This is a screenshot of a webshop which uses the zoom function to show details of the products.
3. Screenshot of the settingspage. Here you can choose what size images you want to use and some more things
4. Another shot with high details
5. A screenshot with the innerzoom feature
6. A screenshot with the innerzoom feature
7. Captions on the medium size image, the disapear on mouse over

== Changelog ==

= 0.1 =
* First version. With settingspanel. Not completely satisfied with the css yet.

= 0.1.1 =
* Minor change, added a link to the settings page from the plugin admin page 

= 0.2 =
* Bugfix! please upgrade! Error for loading css/js

= 0.2.1 =
* Some improvements on the Javascript, things work better now, removed some stuff

= 0.2.2 =
* Removed some bugs after extensive testing

= 0.2.3 =
* Changed the CSS to avoid some theme problems with the zoomed image

= 0.2.4 =
* Javascript and CSS change to overcome IE7 problems!

= 0.2.5 =
* Javascript changes to fix IE7 bug

= 0.3 =
* Some improvements on the zoom functionality around the edges, fixed some css bugs. Cleaned up the JavaScript code. Many thanks to the requests from different users for improvements!

= 0.4 =
* Menu order changed (thanks to teuunn for posting the solution to the forum)
* Multiple galleries on one page now work
* Caption on thumbnails: show title or subtext (thanks to Sara for requesting and her advice on this feature)
* Optional use of CSS3 animations if your theme supports them

= 0.4.1 =
* Created a new version because of some svn issues (my fault)

= 0.4.2 =
* Minor CSS change
* If the caption does not show correctly in your theme, overwrite the `div.imageinfobi' and `div.imageinfosmall' css classes in your theme!

= 0.4.3 =
* Hiding the thumbnails when there is only one image in the gallery

= 0.4.4 =
* Bugfix

= 0.4.5 =
* Bugfixes

= 0.5 =
WARNING! test before upgrading!

Complete re-write of the Super Zoom Gallery. Now with innerzoom options. Much better loading performance, better cross browser support.

= 0.5.1 =
Width of zoom box when not many thumbnails are present fixed.

= 0.5.2 =
First selected thumbnail when multiple galleries on one site bug fixed, handling of empty gallery improved

= 0.5.3 =
Bug preventing to see bottom part of image fixed. WordPress 3.5 gallery style supported. Id's, excludes, order by.

= 0.5.4 =
Changed the default order

= 0.5.5 =
Fixed a bug that displayed the loader when clicking twice on a thumbnail

= 0.5.6 =
Some IE compatibility problems with opacity fixed

= 0.5.7 =
Some IE5-8 compatibility problems with opacity fixed

= 0.5.8 =
Fixed a javascript bug preventing elements under the zoombox from being selected

= 0.5.9 =
Improved css and javascript bugfix

= 0.5.11 =
Css bugs fixed

= 0.5.12 =
Some slight refactoring

= 0.5.13 =
Bugfix

== Upgrade Notice ==

= 0.1.1 =
Upgrade if you want a link to the settings page from the plugin admin page.

= 0.2 =
Bugfix, please update! Made an error in the css/js path

= 0.2.2 =
Recommended to upgrade

= 0.2.3 =
Upgrade to avoid css problems with some themes

= 0.2.4 =
Upgrade to avoid javascript problems with IE7

= 0.3 =
Highly recommended to upgrade. Improved version. Worthy of a 0.3 version number.

= 0.4 =
Release with some nice new features and other improvements, upgrade recommended

= 0.4.1 =
Same as 0.4

= 0.4.4 =
Bugfix, please upgrade!

= 0.4.5 =
Bugfix, dependencies with jquery fixed for wp 3.4

= 0.5 =
Complete re-write. Changes to theme css could be necessary for your theme if you adapted the super zoom gallery classes in your theme. Please test first before upgrading!

= 0.5.1 =
Fixes some bugs. Upgrade adviced.

= 0.5.2 =
Fixes some (minor) bugs. Upgrade adviced.

= 0.5.3 =
Please upgrade, JavaScript bug fixed, improved gallery functionality like the default 3.5 version.

= 0.5.4 =
Changed the default order when not specified

= 0.5.5 =
Fixed a bug that displayed the loader when clicking twice on a thumbnail. Worry free update.

= 0.5.6 =
Some IE compatibility problems with opacity fixed

= 0.5.7 =
Some IE5-8 compatibility problems with opacity fixed

= 0.5.8 =
JavaScript bug fixed

= 0.5.9 =
Improved css and javascript bugfix, Upgrade recommended!

= 0.5.11 =
Bugixes in css, upgrade recommended!
