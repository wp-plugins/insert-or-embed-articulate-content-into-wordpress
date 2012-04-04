=== Insert or Embed Articulate Content into Wordpress ====

Contributors: Brian Batt
Donate link: http://www.articulatefreak.com/presenter/insert-or-embed-articulate-content-into-wordpress-plugin/
Tags: articulate, presenter, quizmaker, engage, insert, embed, iframe
Requires at least: 2.0.2
Tested up to: 3.2.2
Stable tag: 1.04
 
Quickly embed or insert Articulate content into a post or page.

== Description ==

This plugin will add a new toolbar icon (the letter 'a') next to the 'Add Media' button on the Edit Post and Edit Page pages.  Upon clicking this toolbar icon, you will have the ability to upload your published Articulate content as a ZIP file.  Once uploaded, the plugin will automatically extract the content, find the approriate .html file, and add code to your post or page that will display your Articulate content as an iframe.

== Installation ==

1. Upload the 'insert-or-embed-articulate-into-wordpress' folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== How to Use ==

Check out the screencast in the link below to learn how to use this plugin:

http://www.screenr.com/zSSs

== Frequently Asked Questions ==

= How do I use this to embed Articulate content? =

Check out this screencast:  http://www.screenr.com/zSSs

= Will this work with Articulate Storyline content when it's available? =

Yes, it will work with Articulate Storyline.

= Why does the upload never finish or I get a -1 error message? = 

In order to resolve this issue, you need to update your php.ini to reflect the following:

post_max_size = 50M

max_execution_time = 60

max_input_time = 60

upload_max_filesize = 50M


(These settings will vary depending upon your server and content.  You may need to contact your hosting company to make these changes.) 

= How do I get rid of the bars above and below my content? = 

This plugin will automatically set the width of the iframe to 100% and the height to 600 px.  You may need to manually decrease the height in order to display the Articulate content as expected.

= My Articulate content does not fit as expected.  What do I do now? = 

Since this plugin currently embeds the Articulate content as an iframe, the content may not display as expected if the width of your post or page is smaller than the width of the content.  You may need to use the workaround provided by Articulate to embed the presentation:

"You can embed your Articulate Presenter 5 or Articulate Presenter '09 presentation in an existing site in the following manner: 

1) Download and extract this zip file: 

http://www.articulate.com/support/files/TestPage.zip 

2) Place the resulting HTML page in the same folder as player.html. 

3) Follow the instructions in the HTML file on how to load the player inside a custom page. 

If you're integrating your presentation into an existing site, you may need to copy the contents of TestPage.html into the desired HTML page."

= Are there any plans to upgrade this plugin to embed content using methods other than iframes? = 

Yes, we are currently in the process of making this plugin more intuitive.

= If I delete the plugin, what happens to the content that I've uploaded? =

The uploaded content is saved into the wp-content / uploads / articulate_uploads folder on your site.  Thus, your uploaded content will not be removed if you delete this plugin.

== Changelog ==

= 1.04 =

Fixed short tag created when adding Storyline content (story.html)

Added additional information in the readme.txt on handling the -1 error and other upload errors

= 1.03 =

Fixed call to quiz.png for all users

= 1.02 =

Fixed call to quiz.png for some browsers

= 1.01 =

Fixed call to jquery

= 1.0 =
Initial version.
