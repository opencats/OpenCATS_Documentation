Install Scripts-Linux
==========================

These install scripts will dramatically reduce the time and effort necessary for installing OpenCATS on a Linux system.  HOWEVER, there are some very specific requirements that must be met for using these scripts.  If you don't meet these requirements, there is no telling what can happen to any web-software that you are running from the system you use this script on.

.. warning:: These scripts are ONLY for Linux systems that do not have Apache, MySQL/MariaDB and PHP installed.  This will install a full lamp stack from scratch.  It will likely wipe out any existing settings that are in place. I can not stress this enough.

Having gotten that out of the way, let's proceed.

Open a terminal

.. note:: If you get a wget error, install wget.  ``sudo apt-get install wget`` in Ubuntu and Debian, ``sudo yum install wget`` in CentOS.

Get the correct script for your distribution
--------------------------------------------

Wget the install script for your Distro by typing/copy-paste the following into your terminal.
Ubuntu 14.04:
``$ wget https://github.com/cptr13/OpenCATS-Installation-Scripts/blob/master/Ubuntu14.04-OpenCATS-Install.sh``
Ubuntu 16.04:
``$ wget https://github.com/cptr13/OpenCATS-Installation-Scripts/blob/master/Ubuntu16.04-OpenCATS-Install.sh``
Debian 8:
``$ wget https://github.com/cptr13/OpenCATS-Installation-Scripts/blob/master/Debian8-OpenCATS-Install.sh``
CentOS 7:
``$ wget https://github.com/cptr13/OpenCATS-Installation-Scripts/blob/master/CentOS7-OpenCATS-install.sh``

List directory to see the file name: 
``ls``

Make the script executable:
``sudo chmod +x script-name.sh``

Run the script:
``sudo ./script-name.sh``


Wait until it is finished.


Install the OpenCATS software
-----------------------------


In your browser, go to http://localhost/opencats


Click: ``Installation Wizard``

.. image:: ../docs/_static/installation-wizard.png

**Step 1: System Connectivity**

This step makes sure you have the required server environment set up correctly.  

.. note:: Green = good.  
.. note:: Yellow = OpenCATS will work, but some functions may not.  
.. warning:: Red = Bad  You can't continue the installation until a server environment issue is fixed.

If there are no issues, it should be all green, click ``Next``


.. image:: ../docs/_static/step1.png


**Step 2: Database connectivity**

Do NOT change anything here. Use the default information.

Click ``Test Database Connectivity``

.. image:: ../docs/_static/step2.png

If you see all green, click ``next``

**Step 3: Loading Data**

For a new installation, select ``New Installation``, then ``next``

.. note:: ``Demonstration Installation`` will autopopulate OpenCATS with general example clients, candidates, job orders, etc.  There's no reason to use this in my opinion.

.. note:: ``Restore installation from backup`` will be covered in a future tutorial

.. image:: ../docs/_static/step3.png



**Step 4 Setup resume indexing**

* Change the paths to the executables to the correct paths.  They should be as follows:
* /usr/bin/antiword 
* /usr/bin/pdftotext
* /usr/bin/html2text
* /usr/bin/unrtf
* Click ``Test Configuration``

.. note:: I always get red the first couple clicks, then it will go green.  If you get green, proceed.  If it stays red after a few click, the system isn't recognizing the executables.  There may be a path issue that needs corrected.

.. image:: ../docs/_static/step4.png


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








