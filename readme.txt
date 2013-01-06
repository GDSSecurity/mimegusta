MIMeGusta

INTRODUCTION
============

***WARNING: MIMeGusta IS INTENTIONALLY VULNERABLE.
DO NOT USE ON A PRODUCTION WEB SERVER. DO NOT
EXPOSE MIMeGusta IN AN UNTRUSTED ENVIRONMENT.***

MIMeGusta is a configurable content-sniffing XSS 
testbed. Content-sniffing XSS mainly applies to 
vulnerable file upload implementations, where an 
attacker is able to upload files with embedded 
client-side code such as JavaScript with the 
objective of XSS-ing users of the hosting domain.

MIMeGusta is intended to allow security testers to
explore the behaviour of browsers with particular 
focus upon the role of content-sniffing 'cues' in 
determining whether JavaScript will be executed. 

Rather than upload/download countless variations of 
files, MIMeGusta allows you to configure a range 
of headers which are included with a JavaScript 
alert box payload response. It can also include 
a range of file signatures, defensive headers,
as well as inserting file type path info into
the URL. It also includes two filters: one  
examines content-type headers, while the 
other analyses content-type headers AND file 
signatures. Both filters have a 'weak' (i.e 
circumventable) and 'strong' mode.

MIMeGusta also includes a small number of challenges 
intended to demonstrate some basic content-sniffing 
XSS techniques.

MIMeGusta challenges currently focus entirely upon Internet
Explorer 9 with the XSS filter enabled. Other browsers 
and earlier versions of IE are also subject to content 
sniffing based XSS attacks, but you've gotta start 
somewhere :-)

 
REQUIREMENTS
============

PHP 5.x
Web server
Challenges are written to work for Internet Explorer 9 
and likely cannot be completed in other browsers, though
earlier versions of IE are likley to work.

USAGE
=====

Place the MIMeGusta source files on your Web server and
open in Internet Explorer. 

COPYRIGHT
=========
 
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>

THANKS
======

Thanks to those who have released vulnerable test-beds such as XMLmao,
SQLol, CryptOMG, XSSmh, ShelLOL, etc, etc.
