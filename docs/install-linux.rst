Install on Linux
================


These instructions are for LAMP (Linux Apache MySQL/MariaDB Php) environment only. 
Instructions are provided for CentOS7, Debian8, and Ubuntu 16.04.


Installation-Unix/Linux Prerequisites
-------------------------------------

You must have LAMP server software installed and running.

.. note:: mysql and mariadb are basically the same software with different names.  You can use either, just change the commands to the appropriate name.

CentOS7-Installing MySQL 5/Mariadb
----------------------------------

* ``# yum check-update``
* ``# yum -y install mariadb-server mariadb``
* ``# systemctl start mariadb.service``
* ``# systemctl enable mariadb.service``
* ``# mysql_secure_installation``
* Skip to :ref:`Securing-MySQL-MariaDB` section below.

Debian8/Ubuntu16.04-Installing MySQL 5/Mariadb
----------------------------------------------

* ``$ sudo apt-get update``
* ``$ sudo apt-get install mariadb-server mariadb-client``

.. note:: If you are asked to provide a MySQL/MariaDB password, enter it and write it down.  You'll need it later

* ``$ mysql_secure_installation``
* Skip to :ref:`Securing-MySQL-MariaDB` section below.


.. _Securing-MySQL-MariaDB:

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

* ``# yum install httpd``
* ``# systemctl start httpd.service``
* ``# systemctl enable httpd.service``

.. note:: CentOS 7.0 uses Firewall-cmd, so we will customize it to allow external access to port 80 (http) and 443 (https).

* ``# firewall-cmd --permanent --zone=public --add-service=http``
* ``# firewall-cmd --permanent --zone=public --add-service=https``
* ``# firewall-cmd --reload``
* Skip to :ref:`Check-Success-Apache` Section.

Debian8/Ubuntu16.04-Installing Apache2
--------------------------------------

* ``$ sudo apt-get install apache2``

.. _Check-Success-Apache:

Check for success-Apache
------------------------

.. note:: In this tutorial, we use the hostname server1.example.com with the IP address 192.168.0.100. These settings might differ for you, so you have to replace them where appropriate.

* Now direct your browser to http://192.168.0.100, and you should see the Apache2 placeholder page:

.. image:: ../docs/_static/apache1.png

CentOS7-Installing PHP5
-----------------------

* ``# yum -y install php``
* ``# systemctl restart httpd.service``
* Skip to :ref:`Testing-php5` section

Debian8/Ubuntu16.06-Installing PHP5
-----------------------------------

* ``$ sudo apt-get install php5``
* ``$ sudo service apache2 restart``

.. _Testing-php5:

Testing PHP5 / Getting Details About Your PHP5 Installation
-----------------------------------------------------------

.. note:: The document root of the default website is /var/www/html. We will now create a small PHP file (info.php) in that directory and call it in a browser. The file will display lots of useful details about our PHP installation, such as the installed PHP version.

* ``# vi /var/www/html/info.php`` (you can also use nano instead of vi)
* Type or paste the following into it and save as info.php:

.. literalinclude:: ../docs/_static/info.php
    :linenos:
    :language: php
    :lines: 1-5

* (Debian/Ubuntu) ``$ sudo service apache2 restart``
* (CentOS) ``# systemctl restart httpd.service``
* In your browser, go to http://192.168.0.100/info.php

.. image:: ../docs/_static/infophp.png

If you see this screen, everything is good.  Proceed. 

.. note:: If you get any PHP errors during the OpenCATS install, this screen can help you see what php modules are installed and loaded.


CentOS7-Getting MySQL Support In PHP5
-------------------------------------

* ``# yum search php``
* You will need php-mysql, php-gd and php-soap
* ``# yum -y install php-mysql php-gd php-soap``
* ``# systemctl restart httpd.service``
* Now reload http://192.168.0.100/info.php in your browser and you should see the new php modules listed
* Skip to :ref:`Setting-up-mysql` section

Debian8/Ubuntu16.04-Getting MySQL Support In PHP5
-------------------------------------------------
* ``$sudo apt-cache search php-``
* You will need php-mysql, php-gd and php-soap
* ``$ sudo apt-get install php-mysql php-gd php-soap``
* ``$ sudo service apache2 restart``
* Now reload http://192.168.0.100/info.php in your browser and you should see the new php modules listed

.. _Setting-up-mysql:

Setting up your MySQL/MariaDB database
--------------------------------------

.. note:: This is the backend database that stores all your OpenCATS information.  You likely will NOT be messing with this much after installation unless you choose to.  The login/password you set up here will NOT be the same as your login/password for OpenCATS.

.. note:: Make sure you remember or write down your login/password.  You'll need it in a new minutes.

* ``$ mysql -u root -p`` (If that doesn't work, try ``mysql -u root -yourmariadbpasswordfromearlier``)
* You should see a prompt like this: ``mysql>``
* ``mysql>`` CREATE USER 'yourusername'@'localhost' IDENTIFIED BY 'yourmariadbpassword';
* ``mysql>`` CREATE DATABASE cats;
* ``mysql>`` GRANT ALL PRIVILEGES ON `cats`.* TO 'cats'@'localhost' IDENTIFIED BY 'yourmariadbpassword';
* ``mysql>`` exit;

.. note:: Make sure you don't forget the ; on the end of every line!

Server and Directory permissions
--------------------------------

**CentOS**

* ``# chown apache:apache cats``
* ``# chown -R apache:apache cats-x.x.x/``

.. warning:: make sure this is set to **EXACTLY** the name of your OpenCATS directory, default for version 9.1a would be ``opencats-0.9.1a/``

* ``# chmod 770 cats-x.x.x/attachments``

**Debian/Ubuntu** 

* ``$ sudo chown www-data:www-data cats-x.x.x/``

.. warning:: make sure this is set to **EXACTLY** the name of your OpenCATS directory, default for version 9.1a would be ``opencats-0.9.1a/``

* ``$ sudo chown -R www-data:www-data cats-x.x.x/``
* ``$ sudo chmod 770 cats-x.x.x/attachments``

Install resume indexing tools
=============================

CentOS7
-------
.. note:: Some of these may already be in your repositories.  Perform a ``yum search`` for the packages and install if they are there.  If not, install from the links below.

* `Antiword <ftp://ftp.pbone.net/mirror/ftp5.gwdg.de/pub/opensuse/repositories/home:/Kenzy:/modified:/C7/CentOS_7/x86_64/antiword-0.37-20.1.x86_64.rpm>`_
* PdfToText, install Poppler-utils (contains pdftotext): `poppler-utils <ftp://ftp.pbone.net/mirror/ftp.centos.org/7.2.1511/os/x86_64/Packages/poppler-utils-0.26.5-5.el7.x86_64.rpm>`_
* `html2text <https://pkgs.org/centos-7/epel-x86_64/html2text-1.3.2a-14.el7.x86_64.rpm.html>`_
* `UnRTF <https://pkgs.org/centos-7/epel-x86_64/unrtf-0.21.9-1.el7.x86_64.rpm.html>`_

.. note:: These software packages may have dependancies.  If you get installation errors, go to the linked pages and research/install the dependancies.
* Skip to :ref:`Install-Opencats-Software` section

Debian8/Ubuntu16.06
-------------------

.. note::All of these should (hopefully) be in your repositiories, if not, you'll have to search out sources online

* ``$ sudo apt-get install antiword poppler-utils html2text unrtf``

.. _Install-Opencats-Software:

Install the OpenCATS software
=============================

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









