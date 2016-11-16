Windows - OpenCATS Installation Instructions
============================================

 
**Windows Prerequisites**

These instructions are for the (Windows) XAMPP environment only.  Download and install the following software:

* `XAMPP <http://www.apachefriends.org/en/xampp-windows.html>`_
* `OpenCATS resume indexing tools <http://downloads.opencats.org/setupResumeIndexingTools.exe>`_
* `Antiword <http://www.winfield.demon.nl/#Windows>`_
* `PdfToText <http://www.foolabs.com/xpdf/download.html>`_
* `html2text <http://www.mbayer.de/html2text/>`_
* `UnRTF <http://www.gnu.org/software/unrtf/unrtf.html>`_
* `7-Zip or equivalent <http://www.7-zip.org/>`_
* `Composer <https://getcomposer.org/>`_

Installation instructions are given for the XAMPP default install environment only. And Prequisite Installation notes below.

* Download and install XAMPP to c:\xampp by following the directions provided on the XAMPP website. Very easy.
* Download the `OpenCATS resume indexing tools <http://downloads.opencats.org/setupResumeIndexingTools.exe>`_. Install the executable (exe file) and accept the default install locations.
* Optionally download `7-Zip or equivalent <http://www.7-zip.org/>`_ and install. This will allow you to extract the tar ball and gz files later. If you already have an extractor then you may skip this step.
* Now you are ready to get OpenCats Download `OpenCATS.9.1a <http://downloads.opencats.org/opencats-0.9.1a.tar.gz>`_

Open tarball (cats-0.9.1.tar.gz) using 7Zip and extract all files to C:\xampp\htdocs\opencats Verify that there is a readme.txt file in the directory C:/xampp/htdocs/opencats. If so you got it right :)

Go to C:\xampp\htdocs\opencats and run `composer install`

Launch phpMyAdmin. http://localhost/phpmyadmin/

* In the page that displays, type 'opencats' into the textbox under Create new database and click the Create button.
* Accept all the other defaults.

In your Web Browser, visit http://localhost/opencats If OpenCATS has been configured correctly, you should see a page that looks like this: 

.. note:: * If you are running OpenCATS locally on your computer, the host address will be localhost.  
.. note:: * If your server, VPS (some shared hosting too) has a specific address or IP, you will need to enter the specific address in place of localhost to access.

.. image:: ../docs/_static/installation-wizard.png

**Step 1 System Connectivity**
This step makes sure you have the required server environment set up correctly.  

.. note:: Green = good.  
.. note:: Yellow = OpenCATS will work, but some functions may not.  
.. warning:: Red = Bad  You can't continue the installation until a server environment issue is fixed.

.. note:: (I am setting up this example instance of OpenCATS in a shared hosting service.  I do not have command line access and can not install the required modules to get rid of the yellow areas.  For this Windows installation tutorial, you should have all green here.)

I you see all green and/or yellow, click ``Next``

.. image:: ../docs/_static/step1.png

**Step 2 Database connectivity**

When asked for database name, user, and password use database **opencats**, user **root**, and **a blank password**.

Click ``Test Database Connectivity``

If the SQL information is set up and entered correctly, you should have all green.  If you see red, something needs to be corrected or set up correctly.

.. image:: ../docs/_static/step2.png
**Step 3 Loading Data**


For a new installation, select ``New Installation``, then ``next``

.. note:: Demonstration Installation will autopopulate OpenCATS with general example clients, candidates, job orders, etc.  There's no reason to use this in my opinion.

.. note:: Restore installation from backup will be covered in a future tutorial

.. image:: ../docs/_static/step3.png



**Step 4 Setup resume indexing**

.. note:: This is only is you have root/administrative access, or are in a REALLY flexible shared hosting environment.  Most major shared hosting companies will not install this software for you.  So if you do not have root/administrative access, just skip this step.

.. note:: If you are running on a local machine, on a self-hosted server, VPS, or on a web host that will install packages for you, you can use this functionality.  

If you followed the steps above you may safely accept the default locations for Antiword, PDF2Text, HTML2Text and UnRTF.

Click ``Test configuration`` or ``skip this step``.  If it's all green, proceed.

.. image:: ../docs/_static/step4.png

**Step 5 Mail Settings**

OpenCATS can send emails.  If you don't want to use it, you don't have to.  OpenCATS works great either way!  

Choose an option from the Mail Support drop-down bar, fill the necessary information in (if you are using it) and click ``Next``

.. image:: ../docs/_static/step5.png

**Step 6 Loading extras**

Don't forget to set the time zone to your area!

.. warning:: If you forget to set the time zone ALL of the timestamps on every note in OpenCATS will be wrong.  Set the time zone correctly.  You will thank us...

Choose the date format you like best

(United States only) choose to install (if you want) zip code lookup

Click ``next``

.. image:: ../docs/_static/step6.png

**Step 7 Finishing installation**

Runs through the installation process.  You should see a box and some pretty bars moving.  It shouldn't take long.

.. note:: The default username and password are: admin/admin  or admin/cats (all lowercase) depending on your OpenCATS version

Click ``Start OpenCATS`` for your login screen.


.. image:: ../docs/_static/step7.png


**Success!!**

Your brand new OpenCATS applicant System!

.. image:: ../docs/_static/first-login.png










