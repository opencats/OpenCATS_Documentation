Install-CentOS 7
================


These instructions are for LAMP (Linux Apache MySQL/MariaDB Php) environment only. 
Instructions are provided for CentOS7.


Installation-Unix/Linux Prerequisites
-------------------------------------

We will install LAMP server software and get it running.  Then install the OpenCATS ATS.


.. note:: mysql and mariadb are basically the same software with different names.  You can use either, just change the commands to the appropriate name.

CentOS7-Installing MySQL 5/Mariadb
----------------------------------

* ``$ sudo yum check-update``
* ``$ sudo yum -y install mariadb-server mariadb``
* ``$ sudo systemctl start mariadb.service``
* ``$ sudo systemctl enable mariadb.service``
* ``$ sudo mysql_secure_installation``

.. note:: If you are asked to provide a MySQL/MariaDB password, enter it and write it down.  You'll need it later

* ``$ mysql_secure_installation``


Securing MySQL/MariaDB
----------------------
.. note:: In order to log into MariaDB to secure it, we'll need the current password for the root user.  If you've just installed MariaDB, and you haven't set the root password yet, **the password will be blank**, so you should just press enter here.

* Set root password? [Y/n] Y
* New password: <--yourmariadbpassword  (Remember this or write it down!)
* Re-enter new password: <--yourmariadbpassword (Remember this or write it down!)
* Password updated successfully!
* Reloading privilege tables..... Success!
* Remove anonymous users? [Y/n] Y
* Disallow root login remotely? [Y/n] Y
* Remove test database and access to it? [Y/n] Y
* Reload privilege tables now? [Y/n] Y
* All done!  If you've completed all of the above steps, your MariaDB,installation should now be secure.  Thanks for using MariaDB!

CentOS7-Installing Apache2
--------------------------

* ``$ sudo yum install httpd``
* ``$ sudo systemctl start httpd.service``
* ``$ sudo systemctl enable httpd.service``

.. note:: CentOS 7.0 uses Firewall-cmd, so we will customize it to allow external access to port 80 (http) and 443 (https).

* ``$ sudo firewall-cmd --permanent --zone=public --add-service=http``
* ``$ sudo firewall-cmd --permanent --zone=public --add-service=https``
* ``$ sudo firewall-cmd --reload``


Check for success-Apache
------------------------

.. note:: In this tutorial, we use localhost. These settings might differ for you, so you have to replace them where appropriate.

* Now direct your browser to localhost in the address bar, and you should see the Apache2 placeholder page (it may look different than this image):

.. image:: ../docs/_static/apache1.png

CentOS7-Installing PHP5
-----------------------

.. note:: the default php version in CentOS 7 is php 5.4, which is too low for everything we need.  We'll have to install php5.6 instead.

* ``$ sudo rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm``
* ``$ sudo rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm``
* ``$ sudo yum install php56w php56w-soap php56w-ldap php56w-gd php56w-mysql``
* ``$ sudo systemctl restart httpd.service``

Testing PHP5 / Getting Details About Your PHP5 Installation
-----------------------------------------------------------

.. note:: The document root of the default website is /var/www/html. We will now create a small PHP file (info.php) in that directory and call it in a browser. The file will display lots of useful details about our PHP installation, such as the installed PHP version.

* ``$ sudo nano /var/www/html/info.php``
* Type or paste the following into it and save as info.php:

.. literalinclude:: ../docs/_static/info.php
    :linenos:
    :language: php
    :lines: 1-5

* ``CTL-O then Enter`` to save
* ``CTL-X`` to exit nano
* (CentOS) ``$ sudo systemctl restart httpd.service``
* In your browser, go to localhost/info.php

.. image:: ../docs/_static/infophp.png

If you see this screen, everything is good.  Proceed. 

.. note:: If you get any PHP errors during the OpenCATS install, this screen can help you see what php modules are installed and loaded.


Setting up your MySQL/MariaDB database
--------------------------------------

.. note:: This is the backend database that stores all your OpenCATS information.  You likely will NOT be messing with this much after installation unless you choose to.  The login/password you set up here will NOT be the same as your login/password for OpenCATS.

.. note:: Make sure you remember or write down your login/password.  You'll need it in a new minutes.

* ``$ mysql -u root -p`` (If that doesn't work, try ``mysql -u root -yourmariadbpasswordfromearlier``)
* You should see a prompt like this: ``mysql>``
* ``mysql>`` CREATE USER 'opencats'@'localhost' IDENTIFIED BY 'databasepassword';
* ``mysql>`` CREATE DATABASE opencats;
* ``mysql>`` GRANT ALL PRIVILEGES ON `opencats`.* TO 'opencats'@'localhost' IDENTIFIED BY 'databasepassword';
* ``mysql>`` exit;

.. note:: Make sure you don't forget the ; on the end of every line!


Run composer to get dependencies
--------------------------------
* ``$ sudo yum install composer``
* ``$ cd /var/www/html``
* ``$ sudo wget https://github.com/opencats/OpenCATS/archive/0.9.3-3.tar.gz``
* ``$ sudo tar -xvzf 0.9.3-3.tar.gz``
* ``$ cd OpenCATS-0.9.3-3``
* ``$ sudo composer install``

.. note:: If everything is done correctly, there should be no composer errors.  If there are errors, take a close look at them to see what is missing.


Server and Directory permissions
--------------------------------

.. note:: CentOS runs SElinux for additional security layers.  We need to do a few additional things on permissions.

* ``$ cd ..`` Move back into the main html directory
* ``$ sudo chown -R apache:apache OpenCATS-0.9.3-3``
* ``$ cd OpenCATS-0.9.3-3`` move back into the OpenCATS Directory
* ``$ sudo find . -type f -exec chmod 0644 {} \;``
* ``$ sudo find . -type d -exec chmod 0770 {} \;``
* ``$ sudo chcon -t httpd_sys_content_t /data/www/html/OpenCATS-0.9.3-3 -R``
* ``$ sudo chcon -t httpd_sys_rw_content_t /data/www/html/OpenCATS-0.9.3-3/attachments -R``
* ``$ sudo chcon -t httpd_sys_rw_content_t /data/www/html/upload -R``

.. warning:: make sure this is set to **EXACTLY** the name of your OpenCATS directory, default for OpenCATS version 0.9.3-3 would be ``OpenCATS-0.9.3-3``


Install resume indexing tools
-----------------------------
* ``$ sudo wget ftp://ftp.pbone.net/mirror/ftp5.gwdg.de/pub/opensuse/repositories/home:/Kenzy:/modified:/C7/CentOS_7/x86_64/antiword-0.37-20.1.x86_64.rpm``
* ``$ sudo rpm -ivh antiword-0.37-20.1.x86_64.rpm``
* ``$ sudo wget http://dl.fedoraproject.org/pub/epel/7/x86_64/h/html2text-1.3.2a-14.el7.x86_64.rpm``
* ``$ sudo rpm -ivh html2text-1.3.2a-14.el7.x86_64.rpm``
* ``$ sudo yum install poppler poppler-utils unrtf``

If you want to remove the files after you have installed them then do:
* ``$ sudo rm antiword-0.37-20.1.x86_64.rpm html2text-1.3.2a-14.el7.x86_64.rpm``


Install the OpenCATS software
-----------------------------

In your browser, go to localhost/OpenCATS-opencats-0.9.3/  (Or use the address of your server or VPS in place of "localhost").

.. note::  If you have already attempted to install OpenCATS and the installer doesn't load, check to see if there is a file called 'INSTALL_BLOCK' in the OpenCATS directory. Delete it to allow the installer to run.

Click: ``Installation Wizard``

.. image:: ../docs/_static/installation-wizard.png

**Step 1: System Connectivity**

This step makes sure you have the required server environment set up correctly.  

.. note:: Green = good.  
.. note:: Yellow = OpenCATS will work, but some functions may not.  
.. warning:: Red = Bad  You can't continue the installation until a server environment issue is fixed.

(I am setting up this example instance of OpenCATS in a shared hosting service.  I do not have command line access and can not install the required modules to get rid of the yellow areas.  If you are running OpenCATS locally on your computer, or you have root access to a server, VPS, etc., you can install these extra modules and should see all green before continuing.)

If you see all green and/or yellow, click ``Next``


.. image:: ../docs/_static/step1.png


**Step 2: Database connectivity**

Enter your OpenCATS MySQL/MariaDB database name, MySQL/MariaDB database username, MySQL/MariaDB database password, and MySQL/MariaDB database host address in these boxes. 
 
.. note:: If you are running OpenCATS locally on your computer, or on some shared hosts, the host address will be localhost.  If your server, VPS (some shared hosting too), you will need to enter the specific address to access.

Click ``Test Database Connectivity``

If the MySQL/MariaDB information is set up and entered correctly, you should have all green.  If you see red, something needs to be corrected or set up correctly.

.. image:: ../docs/_static/step2.png

**Step 3: Loading Data**


For a new installation, select ``New Installation``, then ``next``

.. note:: ``Demonstration Installation`` will autopopulate OpenCATS with general example clients, candidates, job orders, etc.  There's no reason to use this in my opinion.

.. note:: ``Restore installation from backup`` will be covered in a future tutorial

.. image:: ../docs/_static/step3.png



**Step 4 Setup resume indexing**


Click ``Test configuration`` or ``skip this step``.  If it's all green, proceed.  If you did not install these packages earlier, skip this step.

.. image:: ../docs/_static/step4.png

.. note:: Make sure you change the path to executables paths to the correct path on your system!  Linux is usually /usr/bin/applicationname

**Step 5 Mail Settings**

OpenCATS can send emails.  If you don't want to use it, you don't have to.  OpenCATS works great either way!  

Choose an option from the Mail Support drop-down bar, fill the necessary information in (if you are using it) and click ``Next``

.. image:: ../docs/_static/step5.png

**Step 6 Loading extras**

Don't forget to set the time zone to your area!

.. warning:: If you forget to set the time zone ALL of the timestamps on every note in OpenCATS will be wrong.   Set the time zone correctly.  You will thank us...

Choose the date format you like best

(United States only) choose to install (if you want) zip code lookup

Click ``next``

.. image:: ../docs/_static/step6.png

**Step 7 Finishing installation**

Runs through the installation process.  You should see a box and some pretty bars moving.  It shouldn't take long.

.. note:: The default username and password are: admin/admin (all lowercase)

Click ``Start OpenCATS`` for your login screen.


.. image:: ../docs/_static/step7.png


**Success!!**

Your brand new OpenCATS applicant System!

.. image:: ../docs/_static/first-login.png









