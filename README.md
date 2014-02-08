Currency Converter
==================

A simple self updating commandline currency converter written in PHP, which actually makes a decent all purpose language to implement simple console programs. Allows to easily convert between any Currency, and can be easily adapted to fit into a larger project.

Installation:
=============
Copy to /usr/local/bin/currency_converter
Make executeable (chmod +x /usr/local/bin/currency_converter)

Open up the File and Fill in the two needed Variables for API_KEY (get it from openexchangerates.com) and where you want to save your rates file.

Useage:
=======
currency_converter SOURCE_CURRENCY TARGET_CURRENCY AMOUNT

Example:
currency_converter USD EUR 1

Its pretty simple, but i think the conversion formula is pretty neat and i used it in many different projects.
