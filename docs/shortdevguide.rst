Short overview of original OpenCATS Source code
===============================================


.. note:: This was written for the original source code.  It may not apply completely to the current OpenCATS version

We have not used any outside frameworks. The OpenCATS framework is very light and conceptually simple to understand. This allows for modifications to be isolated, preventing, for example, a small change to a template from affecting library code, or a major change in database structure from requiring a change to every single page.

Let’s have a look at the layout of the code OpenCATS is roughly divided into three parts:

  * Modules
  * Library Components
  * Templates

**Modules**

A module is loosely related to the tabs you see in the GUI and consists of the user interface logic and one or more “templates” to render the HTML page. Some of the modules in OpenCATS are:

  * Home
  * Candidates
  * Contacts
  * Calendar, etc.

Browse the modules directory to see the all the current modules in OpenCATS. Each module has its own separate directory.

**Library Components**

Library components are PHP objects which encapsulate lower-level functionality, such as interfacing with a database, parsing addresses, sending e-mail, etc. For each module, there is a roughly corresponding library component (but not all libraries directly correspond to a module). Examples of some library components are:

  * Candidates
  * Search
  * Users
  * VCard
  * AddressParser

Browse the lib/ directory to see the all different library components.

**OpenCATS Page Request Flow**

Every page request to OpenCATS goes through index.php, which acts as a “router” or delegator to the modules. 

  * A page request is sent to index.php
  * index.php parses the URL and sends the request to the corresponding module (specified by m= in the URL) for further processing
  * A module parses the “action” (specified by a= in the URL) and invokes the corresponding method within the module.
  * The method processes the request, often using library components
  * The function displays a template file, if necessary, and fills in the appropriate data and renders the HTML page

Every OpenCATS page request goes more or less through the above 5 steps.

**OpenCATS URLs**

OpenCATS URLs are designed to be intuitive and easy to use for developers:

E.g. HTTP://OpenCATS.org/index.php?m=clients&a=show&clientID=239 means:

  * m = clients
  * a = show
  * clientID = 329

index.php sends the URL to the “clients” module. The clients module processes the action “show” for clientID 329. We want to display details of client 239.

Here is the basic layout of a module:

.. literalinclude:: ../docs/_static/modui.php
    :linenos:
    :language: php
    :lines: 1-19


.. literalinclude:: ../docs/_static/myaction.php
    :linenos:
    :language: php
    :lines: 1-4

**Templates** 

Modules, as mentioned above, contain the necessary code to render the HTML pages in OpenCATS. HTML is separated from the rest of the code via “templates”. A page is displayed by a template by assigning variables to it using assign() and then call it’s display() method.

.. literalinclude:: ../docs/_static/tempaction.php
    :linenos:
    :language: php
    :lines: 1-7

To display a variable inside a template, use:

``_($this->myVariable); ?>``

Interfacing with the database is only done at the library level. This limits the effects that a change in the database structure can have on the upper layers of the code.
