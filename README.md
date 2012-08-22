What is RocketPack?
-------------------
RocketPack is a simple, light-weight, easy to learn and code-on PHP MVC framework that aims to help you build robust, secure and stable web applications in very little time!

![RocketPack Logo](http://ballen.co.uk/rocketpack_logo.png "RocketPack Logo")


Why RocketPack was developed
----------------------------
RocketPack was developed by myself, Bobby Allen (bobbyallen.uk@gmail.com) mainly for my own personal use, I do a lot of PHP development and believe that by developing a single PHP framework I could save hundreds of hours a year by not having to re-write code!

I recently played with Ruby on Rails, I loved 'most' of the ways it works but I felt some of it was too simple and some of the syntax I felt didn't always follow suit and make sense although most of the time it did. I also feel that PHP is the future, I prefer working with PHP as firstly it is my first proper web application language but also as PHP is ran on most of the worlds web servers I personally believe it makes sense! Ruby on Rails is a pain to setup correctly and to have it hosted requires a little more than your normal web host generally offers.

Getting started..
-------------------
Once you've grabbed your copy of RocketPack you need to make a few configuration changes to match your enviroment, these are as follows:-

* Edit and customise your application settings in config.php, you may want to enable the use of mod_rewrite etc.
* If you are using RocketPack from a directory on your machine other than '/rocketpack/' you'll need to update the .htaccess file and set the correct RewriteBase path. Generally once you use RocketPack in a production enviroment you will have it hosted in the root of your domain, in this case you'd need to set the RewriteBase to '/' instead.
* If using a Linux or UNIX based operating system you should set the appropriate directory permissions on 'cache/', 'tmp/' and 'log/' to enable your web server of choice to be able to write to these directories.
* If you now access RocketPack from your browser like so: http://localhost/rocketpack/ you should now see a summary of things you may still need to do to finalise your applications enviroment (such as configure database connection, invalid permissions sets on folder etc.).
* You can now empty out the default (example) controllers, models and views from the app/ directory and start developing your application. You may also want to change the 'default controller' option in config.php.

Alternative .htaccess for nginx users
-------------------------------------
nginx users should use the below config as a replacement for the top level .htaccess file:-

`# nginx configuration

location = index.php {
}

location /rocketpack/ {
  rewrite ^/rocketpack/([^/]+)/?$ /rocketpack/index.php?controller=$1 break;
  rewrite ^/rocketpack/([^/]+)/([^/]+)/?$ /rocketpack/index.php?controller=$1&action=$2 break;
  rewrite ^/rocketpack/([^/]+)/([^/]+)/([^/]+)/?$ /rocketpack/index.php?controller=$1&action=$2&id=$3 break;
  rewrite ^/rocketpack/([^/]+)/([^/]+)/([^/]+)/([^/]+)/?$ /rocketpack/index.php?controller=$1&action=$2&id=$3&otherid=$4 break;
  rewrite ^/rocketpack/([^/]+)/([^/]+)/([^/]+)/([^/]+)/(.*)?$ /rocketpack/index.php?controller=$1&action=$2&id=$3&otherid=$4$5 break;
}`

A replacement for the .htaccess file in /public/ should be added like so:-

`# nginx configuration

autoindex off;`