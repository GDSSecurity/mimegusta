<head>
<title>MIMeGusta - Challenge 2</title>
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
<h2>MIMeGusta - Challenge 2: No page name = no pathinfo? </h2>
<a href="index.php">MIMeGusta</a> | <a href="challenges.php">Challenges</a>
<b>Browser: IE 9</b>
<br><br>
How can you control the path info when the page your content is served from is called '/'? The page name (e.g. index.aspx, default.html, etc) may not be used in the URL you are testing. This can be problematic when trying to insert a file extension into the path info.
<br><br>
If we access the following MIMeGusta URL (note that the page name is absent), we get IE 9 the save / open dialogue - a good indicator that we can trigger content sniffing by inserting './html' into the path info section of the URL:
<br>
<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>/../?cntntyp=application%2Fzip&cntntdsp=&reason=on&fileSig=&submit=XSS+ME%21">/?cntntyp=application%2Fzip&cntntdsp=&reason=on&fileSig=&submit=XSS+ME%21</a>
<br><br>
... but when we try inserting './html' into the path info section of the URL, we get a '403 Forbidden' response:
<br><br>
<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>/../.html?cntntyp=application%2Fzip&cntntdsp=&reason=on&fileSig=&submit=XSS+ME%21">/.html?cntntyp=application%2Fzip&cntntdsp=&reason=on&fileSig=&submit=XSS+ME%21</a>
<br><br>
If we try inserting 'foo.html' into the path info section of the URL, we get a '404 Not Found' response:
<br><br>
<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>/../foo.html?cntntyp=application%2Fzip&cntntdsp=&reason=on&fileSig=&submit=XSS+ME%21">/foo.html?cntntyp=application%2Fzip&cntntdsp=&reason=on&fileSig=&submit=XSS+ME%21</a>
<br><br>
Q. How can you insert a path info value when you are calling a directory, not a file?   
<br><br><a href="javascript:unhide('solution1');">Solution</a>
<br>
 <div id="solution1" class="hidden">
A. Simple: add the missing page name. In this case we know it to be 'index.php'. In practice, you will need to guess the value, but it is likely to be something like index.php, index.aspx, or index.jsp. You'll know when you've got the right page name because you'll get the good old IE9 save / open dialogue when you submit the correct page name.
<br><br>
Here's the MIMeGusta URL with the page name present in the URL:
<br><br>
<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>/../index.php?cntntyp=application%2Fzip&cntntdsp=&reason=on&fileSig=&submit=XSS+ME%21">/index.php?cntntyp=application%2Fzip&cntntdsp=&reason=on&fileSig=&submit=XSS+ME%21</a>
<br><br>
Here's the MIMeGusta URL with the page name present and the '/.html' path info:
<br><br>
<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>/../index.php/.html?cntntyp=application%2Fzip&cntntdsp=&reason=on&fileSig=&submit=XSS+ME%21">/index.php/.html?cntntyp=application%2Fzip&cntntdsp=&reason=on&fileSig=&submit=XSS+ME%21</a>
 </ul>
 </div>
