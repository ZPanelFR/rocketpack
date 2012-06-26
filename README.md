What is RocketPack?
-------------------
RocketPack is a simple, light-weight, easy to learn and code-on PHP MVC framework that aims to help you build robust, secure and stable web applications in very little time!

![RocketPack Logo](http://ballen.co.uk/rocketpack_logo.png "RocketPack Logo")


Why RocketPack was developed
----------------------------
RocketPack was developed by myself Bobby Allen (bobbyallen.uk@gmail.com) mainly for my own personal use, I do a lot of PHP development and believe that by developing a single PHP framework I could save hundreds of hours a year by not having to re-write code!

I recently played with Ruby on Rails, I loved 'most' of the ways it works but I felt some of it was too simple and some of the syntax I felt didn't always follow suit and make sense although most of the time it did. I also feel that PHP is the future, I prefer working with PHP as firstly it is my first proper web application language but also as PHP is ran on most of the worlds web servers I personally believe it makes sense! Ruby on Rails is a pain to setup correctly and to have it hosted requires a little more than your normal web host generally offers.

Getting started..
-------------------
Once you've grabbed your copy of RocketPack you need to make a few configuration changes to match your enviroment, these are as follows:-

* Edit and customise your application settings in config.php, you may want to disable the use of mod_rewrite etc.
* If you are using RocketPack from a directory on your machine other than '/rocketpack/' you'll need to update the .htaccess file and set the correct RewriteBase path. Generally once you use RocketPack in a production enviroment you will have it hosted in the root of your domain, in this case you'd need to set the RewriteBase to '/' instead.
* If using a Linux or UNIX based operating system you should set the appropriate directory settings on 'cache/', 'tmp/' and 'log/' to enable your web server of choice to be able to write to these directories.

Thats it pretty much!