<?php
/**
 * CodeIgniter view file with jQuery and CKEditor integration featuring three inline-editable elements.
 *
 * Replace welcome_message.php with this version in the application/views/ directory.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Welcome to the CodeIgniter CKEditor inline-editor demo!</title>

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
	</div>
</div>
</body>
</html>