<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CodeIgniter-CKEditor inline-text editor Demo</title>

<link rel="stylesheet" type="text/css" href="/css/ci.css" />

<script src="/js/jquery-2.0.3.min.js"></script>
<script src="/ckeditor/ckeditor.js"></script>
<script src="/js/ckeditor_inline.js"></script>
</head>
<body>
<div id="container">
	<div id="title" contenteditable="true" class=""><?php echo $title; ?></div>

	<div id="body">
		<div id="editable1" contenteditable="true" class=""><?php echo $editable1; ?></div>
		<div id="editable2" contenteditable="true" class=""><?php echo $editable2; ?></div>
		<div id="editable3" class="" contenteditable="true"><?php echo $editable3; ?></div>
		<div class="separator"></div>
		<div class="float_left">
			<div id="buttons"><button id="refresh">Refresh</button>&nbsp;&nbsp;&nbsp;<button id="reset">Reset</button></div>
		</div>
		<div class="float_right">
			<a href="https://github.com/csantala/inline-cms" title="Clean & CI integrated branches at GitHub"><img src="/images/github-logo-transparent.png" border="0"></a>
		</div>
		<div class="separator"></div>
	</div>
</body>
</html>