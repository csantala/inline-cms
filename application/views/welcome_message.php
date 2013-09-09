<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<link rel="stylesheet" type="text/css" href="/css/ci.css" />

	<script src="/js/jquery-2.0.3.min.js"></script>
	<script src="/ckeditor/ckeditor.js"></script>
	<script src="/js/ckeditor_inline.js"></script>

</head>
<body>

<div id="container">
	<div id="title" contenteditable="true" class=""><?php echo $title; ?></div>

	<div id="body" contenteditable="true" class=""><?php echo $body; ?></div>
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
		<div id="editable1" contenteditable="true" class=""><?php echo $editable1; ?></div>
	</div>

	<p class="" id="footer" contenteditable="true"><?php echo $footer; ?>Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>