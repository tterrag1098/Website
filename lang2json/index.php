<?php
	function convert($lang) {
		$lines = explode("\n", $lang);
		$json = "{\n";
		foreach ($lines as $line) {
			$line = trim($line);
			if (strpos($line, '#') === 0) {
				if ($line != "#PARSE_ESCAPES") {
					$json .= '    "_comment": "' . trim(substr($line, 1)) . "\",\n";
				}
			} else if (strlen($line) > 0) {
				$eqpos = strpos($line, '=');
				$key = substr($line, 0, $eqpos);
				$key = preg_replace("/^tile\./", "block.", $key);
				$key = preg_replace("/\.name$/", "", $key);
				$val = trim(substr($line, $eqpos + 1));
				$json .= "    \"$key\": \"$val\",\n";
			} else {
				$json .= "\n";
			}
		}
		$json = substr($json, 0, strlen($json) - 3) . "\n}";
		return $json;
	}

	$content = isset($_POST['content']) ? $_POST['content'] : null;
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="../index.css">
	<link rel="stylesheet" type="text/css" href="lang2json.css">

  <title>tterrag - .lang to .json</title>
  <meta name="author" content="tterrag">
	<meta name="description" content="Minecraft .lang to .json converter">
	<meta name="theme-color" content="#4e9745">

	<meta property="og:title" content="Minecraft .lang to .json converter">
	<meta property="og:type" content="website">
	<meta property="og:url" content="http://www.tterrag.com/lang2json">
	<meta property="og:site_name" content="tterrag.com">

	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Minecraft .lang to .json converter">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>
<header>
	<nav>
		<a href="/">Home</a>
		<a href="/k9">K9</a>
		<a class="selected" href="/lang2json">Lang to JSON Converter</a>
		<span class="separator"></span>
		<a href="https://github.com/tterrag1098/">GitHub</a>
		<a href="https://ci.tterrag.com/">Jenkins</a>
  </nav>
</header>
<body>
  <div id="mobile-wrapper">
  <div id="content">
		<form id="form" method="post" action=".">
		</form>
		<textarea form="form" name="content" placeholder="Paste lang file here"><?= $content ?: '' ?></textarea>
		<input form="form" type="submit" name="submit" value="Convert"/>

<?php
		if ($content && strlen($content) > 0) {
?>
			<h4>Result:</h4>
			<textarea id="result" readonly="true"><?= convert($content) ?></textarea>
			<button id="copybutton" onclick="copyResult()">Copy to Clipboard</button>

			<script type="text/javascript">
				function copyResult() {
					var textarea = document.getElementById("result");

					textarea.select();
					document.execCommand("copy");
					if (document.selection) document.selection.empty();
					else if (window.getSelection) window.getSelection().removeAllRanges();

					document.getElementById("copybutton").innerHTML = "Copied!";
				}
			</script>
<?php
		}
?>
  </div>
  </div>
</body>
</html>
