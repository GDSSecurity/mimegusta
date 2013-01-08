<?php

$payload = '<script>alert(/xss/)</script>';
$payloadhtmlencoded = htmlentities($payload);
$here = dirname($_SERVER['PHP_SELF']);


#content-type filter section:
$match=0;
if (isset($_REQUEST["fltr"]))
	{
	$fltrmode = urldecode($_REQUEST["fltr"]);
	if ($fltrmode == "1" && (urldecode($_REQUEST["cntntyp"]) != ""))
		{
		$type = urldecode($_REQUEST["cntntyp"]);
		$myfile = 'validcontenttypes.txt';
		$lines = file($myfile); 
		for($i=count($lines);$i>0;$i--)
			{
			$reference = trim($lines[$i]);
			if (strpos($type,$reference)!== false)
				{
				$match=1;
				}
			}
		if ($match == 0){
			#header("Location: $_SERVER['PHP_SELF']/error.html");
			header("Location: $here/error.html");
			exit;
			}
		}
	if ($fltrmode == "2" && (urldecode($_REQUEST["cntntyp"]) != ""))
		{
		$type = urldecode($_REQUEST["cntntyp"]);
		$myfile = 'validcontenttypes.txt';
		$lines = file($myfile); 
		for($i=count($lines);$i>0;$i--)
			{
			$reference = $lines[$i];
			if ($reference == $type)
				{
				$match=1;
				}
			}
		if ($match == 0){
			header("Location: $here/error.html");
			exit;
			}
		}
	else 
		{
		if ($type == "")
			{
			header("Location: $here/error.html");
			exit;
			}
		}
	}


#file signature filter section:
$match=0;
if (isset($_REQUEST["sfltr"]))
	{
	$fltrmode = urldecode($_REQUEST["sfltr"]);
	if ($fltrmode == "1" && (urldecode($_REQUEST["cntntyp"]) != ""))
		{
		$type = urldecode($_REQUEST["cntntyp"]);
		$myfile = 'validcontenttypes.txt';
		$lines = file($myfile);
		$signature = urldecode($_REQUEST["fileSig"]); 
		for($i=count($lines);$i>0;$i--)
			{
			$reference = trim($lines[$i]);
			if (strpos($type,$reference)!== false)
				{
				if (strpos($type,'gif')!== false)
					{
					if (strpos($signature,'GIF8')!== false)
					$match=1;
					}
				else if (strpos($type,'png')!== false)
					{
					if (strpos($signature,'895')!== false)
					$match=1;					
					}
				if (strpos($type,'jpg')!== false)
					{
					if (strpos($signature,'ffd')!== false)
					$match=1;
					}
				if (strpos($type,'pdf')!== false)
					{
					if (strpos($signature,'%PDF')!== false)
					$match=1;					
					}
				}
			}
		if ($match == 0){
			header("Location: $here/error2.html");
			exit;
			}
		}
	if ($fltrmode == "2" && (urldecode($_REQUEST["cntntyp"]) != ""))
		{
		$type = urldecode($_REQUEST["cntntyp"]);
		$myfile = 'validcontenttypes.txt';
		$lines = file($myfile);
		$signature = urldecode($_REQUEST["fileSig"]); 
		for($i=count($lines);$i>0;$i--)
			{
			$reference = trim($lines[$i]);
			if (strpos($type,$reference)!== false)
				{
				if (strpos($type,'gif')!== false)
					{
					if (strpos($signature,'GIF87a')!== false)
					$match=1;
					}
				else if (strpos($type,'png')!== false)
					{
					if (strpos($signature,'8951')!== false)
					$match=1;					
					}
				if (strpos($type,'jpg')!== false)
					{
					if (strpos($signature,'ffd9')!== false)
					$match=1;
					}
				if (strpos($type,'pdf')!== false)
					{
					if (strpos($signature,'%PDF-')!== false)
					$match=1;					
					}
				}
			}
		if ($match == 0){
			header("Location: $here/error2.html");
			exit;
			}
		}
	else 
		{
		if ($type == "")
			{
			header("Location: $here/error2.html");
			exit;
			}
		}
	}

if (isset($_REQUEST["cntntyp"])){
$header = 'Content-Type: ' . urldecode($_REQUEST["cntntyp"]);
header($header);
}

if (isset($_REQUEST["cntntdsp"])){
$header2 = 'Content-Disposition: ' . urldecode($_REQUEST["cntntdsp"]);
header($header2);
}

if (isset($_REQUEST["nosnf"])){
$header3 = urldecode($_REQUEST["nosnf"]);
header($header3);
}

if (isset($_REQUEST["noopn"])){
$header4 = urldecode($_REQUEST["noopn"]);
header($header4);
}

if (isset($_REQUEST["fileSig"]))
{
$signature = urldecode($_REQUEST["fileSig"]);
if (strpos($signature,'GIF')!== false)
	{
	echo $signature;	
	}
else if (strpos($signature,'PDF')!== false)
	{
	echo $signature;	
	}
else if (strpos($signature,'ffd8')!== false)
	{
	readfile("jpg-header-valid.png");	
	}
else if (strpos($signature,'ffd9')!== false)
	{
	readfile("jpg-header-invalid.png");	
	}
else if (strpos($signature,'8950')!== false)
	{
	readfile("png-header-valid.png");	
	}
else if (strpos($signature,'8951')!== false)
	{
	readfile("png-header-valid.png");	
	}
}

if (isset($_GET['submit']))
	{
	echo $payload;	
	}
?>

<html>
	<head>
		<title>MIMeGusta - Content Sniffing XSS Test Bed</title>
	</head>
	<body>
	<h2>MIMeGusta - Content Sniffing XSS Test Bed</h2>
	<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>">Reset</a> | <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>/../challenges.php">Challenges</a> | <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>/../readme.txt">Readme</a> | Payload is: <?php echo "$payloadhtmlencoded";?>
	<script type="text/javascript" language="JavaScript">
	function doit()
	{

	if(document.myform.reason[0].checked == true) 
	{
	document.myform.action = '<?php echo $_SERVER['PHP_SELF']; ?>/.html';
	}
	else if(document.myform.reason[1].checked == true) 
	{
	document.myform.action = '<?php echo $_SERVER['PHP_SELF']; ?>/.exe';
	}
	else
	{
	document.myform.action = '<?php echo $_SERVER['PHP_SELF']; ?>';
	}
	
	return true;
	}
	</script>
		<form name="myform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
			Content-Type header: <br>
			<select name="cntntyp">
				<option value="">none</option>
				<option value="text/html">text/html</option>
				<option value="text/plain">text/plain</option>
				<option value="image/gif">image/gif</option>
				<option value="image/png">image/png</option>
				<option value="image/jpeg">image/jpeg</option>
				<option value="application/pdf">application/pdf</option>
				<option value="application/octet-stream">application/octet-stream</option>
				<option value="application/json">application/json</option>
				<option value="application/x-zip-compressed">application/x-zip-compressed</option>
				<option value="application/zip">application/zip</option>
				<option value="application/pdfa">application/pdfa</option>
				<option value="*/*">*/*</option>
				<option value="unknown/unknown">unknown/unknown</option>
			</select>
			<br>
			(Note: if set to 'none', Apache will set a default Content-Type: text/html header) <br>
			<br>
			Content-Disposition header: <br>
			<select name="cntntdsp">
				<option value="">none</option>
				<option value="Content-Disposition: attachment">Content-Disposition: attachment</option>
				<option value="Content-Disposition: attachment; filename="file.pdf"">Content-Disposition: attachment; filename="file.pdf"</option>
				<option value="Content-Disposition: attachment; filename="file.docx"">Content-Disposition: attachment; filename="file.docx"</option>
				<option value="Content-Disposition: attachment; filename="file.exe"">Content-Disposition: attachment; filename="file.exe"</option>
				<option value="Content-Disposition: attachment; filename="file.html"">Content-Disposition: attachment; filename="file.html"</option>
				<option value="Content-Disposition: attachment; filename="file.zip"">Content-Disposition: attachment; filename="file.zip"</option>
			</select>
			<br><br>
				
			<input type="radio" name="reason">Insert /.html PATHINFO<br>
			<input type="radio" name="reason">Insert /.exe PATHINFO<br>
			<br>

			<input type="radio" name="nosnf" value="X-Content-Type-Options: nosniff">Add nosniff header<br>
			<input type="radio" name="noopn" value="X-Download-Options: noopen">Add noopen header<br>
			<br>

			File signature: <br>
			<select name="fileSig">
				<option value="">none</option>
				<option value="GIF87a">valid GIF</option>
				<option value="GIF88a">invalid GIF</option>
				<option value="8950">valid PNG</option>
				<option value="8951">invalid PNG</option>
				<option value="ffd8">valid JPEG</option>
				<option value="ffd9">invalid JPEG</option>
				<option value="%PDF-">valid PDF</option>
				<option value="%PDFA">invalid PDF</option>
			</select>
			<br><br>
			This filter restricts file types to PDFs or images by analysing the content-type header:<br>
			<input type="radio" name="fltr" value="1">Content-Type Filter: Mode 1<br>
			<input type="radio" name="fltr" value="2">Content-Type Filter: Mode 2<br>
			<br>
			This filter restricts file types to PDFs or images by analysing the content-type header and the first 4 bytes of the file:<br>
			<input type="radio" name="sfltr" value="1">File signature check: Mode 1<br>
			<input type="radio" name="sfltr" value="2">File signature check: Mode 2<br>
			<br>
			<input type="submit" name="submit" value="        XSS ME!        " onClick="return doit();"> <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>">Reset</a>
		</form>
	</body>
</html>
