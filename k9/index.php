<?php
  require('../vendor/autoload.php');
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="../root.css">
	<link rel="stylesheet" type="text/css" href="k9.css">

  <title>tterrag - K9</title>
  <meta name="author" content="tterrag">
  <meta name="description" content="A Discord bot with some useful commands.">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>
<header>
  <nav>
		<a href="/">Home</a>
		<a class="selected" href="/k9">K9</a>
		<a href="/lang2json">Lang to JSON Converter</a>
		<span class="separator"></span>
    <a href="https://github.com/tterrag1098/K9">GitHub</a>
    <a href="https://ci.tterrag.com/job/K9">Builds</a>
  </nav>
</header>
<body>
  <div id="mobile-wrapper">
  <div id="content">
<?php
    $Parsedown = new Parsedown();
    $text = file_get_contents('https://raw.githubusercontent.com/tterrag1098/K9/master/README.md?r=' . rand(0, 99999));
    echo $Parsedown->text($text);
?>
  </div>
  </div>
</body>
</html>
