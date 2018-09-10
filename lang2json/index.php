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
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

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

  <style>
    body {
      -webkit-font-smoothing: antialiased;
      font-family: "Roboto", "lucida grande", tahoma, verdana, arial, sans-serif;
      background-color: rgb(53, 56, 60);
      color: #eee;
      font-size: 0.9em;
    }

    a {
      color: #aaf;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    #content p, #content li {
      color: #bbb;
    }

    nav {
      margin-top: 15px;
    }

    nav a {
      color: #999;
      padding-left: 20px;
    }

    nav a:hover {
      color: white;
      text-decoration: none;
    }

    li {
      margin-bottom: 5px;
    }

    #mobile-wrapper {
      margin: 30px;
    }

    #content {
      max-width: 1000px;
      margin: auto;
      margin-bottom: 100px;
    }

		#content textarea {
			width: calc(100% - 6px);
			height: 300px;
			margin-bottom: 4px;
		}

		#content input[type="submit"], button {
			width: 100%;
			background-color: #ddd;
			margin-bottom: 7px;
			height: 30px;
			font-size: 1.2em;
			font-family: Consolas, monospace;
		}

  </style>

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>
<header>
  <nav>
		<a href="https://tterrag.com/">Home</a>
  </nav>
</header>
<body>
  <div id="mobile-wrapper">
  <div id="content">
		<form id="form" method="post" action=".">
		</form>
		<textarea form="form" name="content" placeholder="Paste lang file here"></textarea>
		<input form="form" type="submit" name="submit" value="Convert"/>

<?php
		if (isset($_POST['content'])) {
?>
			<h4>Result:</h4>
			<textarea id="result" readonly="true"><?= convert($_POST['content']) ?></textarea>
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
