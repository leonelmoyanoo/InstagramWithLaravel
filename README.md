# InstagramWithLaravel
 It's a simple project from Udemy's course of "Master en PHP, SQL, POO, MVC, Laravel, Symfony, WordPress +" , the objective is to copy the main purpose of Instagram (Create a profile, AMD of your own photos, search users, view their photos, like and comment them). The project was made in Laravel 7 and Bootstrapp 4.
 
## Make a VirtualHost
You can use this code at the end of your archive to change the Apache's configuration. 
_If you're using XAMPP, you can find the archive in **C:\xampp\apache\conf\extra\httpd-vhosts.conf**:_

>       <VirtualHost *:80\\>
	>       		DocumentRoot C:\Documents\InstagramWithLaravel\public
	>       		ServerName instagram.test
>       </VirtualHost>

- Document: the route of your project, for example **C:\Documents\InstagramWithLaravel\public**

- ServerName: the name you want, for example **instagram.test**

***Can be difference depends on your host***


Then you have to add a new route on your hosts' configurations.
_If you're using Windows, you can find the archive in **C:/Windows/System32/drivers/etc/hosts**:_

>     127.0.0.1 **instagram.test**

- After the IP of your localhost you have to set the name you put.

Finally reset your localhost and it's done, your VirutalHost is ready to use :smiley:. Just put [http://instagram.test](http://instagram.test) 
