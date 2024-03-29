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
				$key = trim(substr($line, 0, $eqpos));
				$key = preg_replace("/^tile\./", "block.", $key);
				$key = preg_replace("/\.name$/", "", $key);
				$val = trim(substr($line, $eqpos + 1));
				// Escape quotes and backslashes
				$val = str_replace('\\', '\\\\', $val);
				$val = str_replace('"', '\"', $val);
				$json .= "    \"$key\": \"$val\",\n";
			} else {
				$json .= "\n";
			}
		}
		$json = trim($json);
		$json = substr($json, 0, strlen($json) - 1) . "\n}";
		return $json;
	}

	$content = isset($_POST['content']) ? $_POST['content'] : null;
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="../root.css">
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
		<a href="/portfolio">Portfolio</a>
		<span class="separator"></span>
        <a href="https://discord.gg/e93JT7R">Discord</a>
		<a href="https://github.com/tterrag1098/">GitHub</a>
		<a href="https://ci.tterrag.com/">Jenkins</a>
  </nav>
</header>
<body>
  <div id="mobile-wrapper">
  <div id="content">
		<h2>What is this?</h2>
		<p>
			This is a tool to convert .lang files (used for Minecraft mods and resource packs up to version 1.12.2)
			to the new format in 1.13+, which uses .json files.
		</p><p>
			In addition to simply converting the syntax, it performs some common cleanup actions, such as removing
			#PARSE_ESCAPES entirely, replacing "tile." with "block.", and removing all ".name" suffixes.
		</p>
		<h4>Input:</h4>
		<form id="form" method="post" action=".">
		</form>
		<textarea form="form" name="content" placeholder="Paste .lang file contents here"><?= $content ?: '' ?></textarea>
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
