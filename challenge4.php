<head>
<title>MIMeGusta - Challenge 3</title>
</head>
<body>
<h2>MIMeGusta - Challenge 3: Content-Type filter bypass </h2>
<b>Browser: IE 9</b>
<br><br>
MIMeGusta's content-type filter attempts to restrict uploaded files to PDFs or images by analysing the content-type header. If the MIME type of the user-provided content-type header (e.g. image/png or application/pdf) matches a list of accepted MIME types, the MIME type is stored and returned with the uploaded (in our case malicious) content.  
<br><br>
In general, if a content-type header with a browser-recognised MIME type (e.g. image/png or application/pdf) is set, it will not be possible to XSS IE9 users. In contrast, one of the key triggers for content sniffing is where our uploaded content is returned with an invalid/unrecognised content-type header (e.g. */* or unknown/unknown). But the filter will users from submitting an invalid MIME type, wont it?<br><br> 
The key to filter bypass attackes are to find a condition that satisfies the filter and also triggers the required response...
<br><br>
<b>Setup</b><br><br>
 - Set the <i>Insert /.html PATHINFO</i> radio button<br>
 - Set the <i>Content-Type Filter: Mode 1</i> radio button<br>
 - Identify which of the content-type header MIME types in the <i>Content-Type header</i> drop down are<br> 
(a) accepted by the filter, and also<br>
(b) treated as unrecognised by the browser, resulting in JavaScript execution. 
<br><br>

A. Set the application/pdfa header. The filter matches on 'application/pdf', while the browser sees 'application/pdfa' as an unrecognised MIME type.
<br><br>
<a href="index.php">MIMeGusta</a>
<br><br>
<a href="challenges.php">Challenges</a><br>
