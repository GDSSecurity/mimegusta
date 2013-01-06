<head>
<title>MIMeGusta - Challenge 1</title>
<script type="text/javascript">
 function unhide(divID) {
 var item = document.getElementById(divID);
 if (item) {
 item.className=(item.className=='hidden')?'unhidden':'hidden';
 }
 }
 </script>
<link rel="stylesheet" href="a.css" media="all">
</head>
<body>
<h2>MIMeGusta - Challenge 1: Path info tricks </h2>
<a href="index.php">MIMeGusta</a> | <a href="challenges.php">Challenges</a>
<b>Browser: IE 9</b><br><br>
<b>Part I</b><br><br>
<b>Setup:</b><br>
 - Go to the <a href="index.php">MIMeGusta</a> page <br>
 - Set the <i>Content-Type header</i> drop down menu to <i>application/json</i><br>
 - Press the XSS ME! button<br>
 - If all went well, you should see the IE 9 save / open dialogue:<br><br>
<img src="saveOpenDialogue.png" width=750><br><br>
In general, if you see the above dialogue box, you may be close to triggering content-sniffing XSS, where, with a little nudge, IE will execute any embedded JavaScript in the response. But what just happened? Well, MIMeGusta sent your browser a response something like the below:
<br>
<br>
HTTP/1.1 200 OK<br>
Content-Length: 4298<br>
Content-Type: application/json<br><br>

&lt;script&gt;alert(/xss/)&lt;/script&gt;<br>
&lt;html&gt;<br>
.....<br>
<br>
This simulates scenarios where you are able cause JavaScript to be sent to the victim, and a Content-Type: application/json  header is set, and allows you to concentrate on turning this into a working XSS Proof of Concept.
<br><br>
Q. How can you trigger JavaScript execution when the application/json content-type header is set?   
<br>
<br>
Hint:

http://blog.watchfire.com/wfblog/2011/10/json-based-xss-exploitation.html

<br><br>
<a href="javascript:unhide('solution1');">Solution</a>
<br>
 <div id="solution1" class="hidden">
A. Add path info to the URL: <a href="index.php/.html?cntntyp=application%2Fjson&cntntdsp=&reason=on&fileSig=&submit=XSS+ME%21">index.php/.html?cntntyp=application%2Fjson&cntntdsp=&reason=on&fileSig=&submit=XSS+ME%21</a>
 </ul>
 </div>

<b>Part II</b><br><br>
<b>Setup:</b><br>
 - Go to the <a href="index.php">MIMeGusta</a> page <br>
 - Set the <i>Content-Type header</i> drop down menu to <i>application/x-zip-compressed</i><br>
 - Press the XSS ME! button<br>
 - Set the <i>Content-Type header</i> drop down menu to <i>application/zip</i><br>
 - Press the XSS ME! button<br><br>
The application/x-zip-compressed MIME type results in JavaScript execution, the application/zip MIME type triggers an open/save file dialogue. 
<br><br>

Q. How can you trigger JavaScript execution when the application/zip content-type header is set?   
<br><br>
<a href="javascript:unhide('solution2');">Solution</a>
<br>
 <div id="solution2" class="hidden">
A. Add path info to the URL:
<a href="index.php/.html?cntntyp=application%2Fzip&cntntdsp=&reason=on&fileSig=&submit=XSS+ME%21">index.php/.html?cntntyp=application%2Fzip&cntntdsp=&reason=on&fileSig=&submit=XSS+ME%21</a>
 </ul>
 </div>
