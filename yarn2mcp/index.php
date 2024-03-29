<?php date_default_timezone_set("UTC"); ?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="../root.css">
	<link rel="stylesheet" type="text/css" href="yarn2mcp.css">

  <title>tterrag - Yarn over MCP mappings</title>
  <meta name="author" content="tterrag">
	<meta name="description" content="Yarn over MCP mappings">
	<meta name="theme-color" content="#4e9745">

	<meta property="og:title" content="Yarn over MCP mappings">
	<meta property="og:type" content="website">
	<meta property="og:url" content="http://www.tterrag.com/yarn2mcp">
	<meta property="og:site_name" content="tterrag.com">

	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Yarn over MCP mappings">

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
		<h1>This project is DEPRECATED. Please switch to official (mojang) mappings if you want parity between mod APIs.</h1>
		<h2>What is this?</h2>
		<p>
			This service provides custom mappings for use when creating forge mods, that use the <a href="https://github.com/FabricMC/yarn">yarn</a> mapping data. Two artifacts are published daily:
		</p>
		<ul>
			<li>Yarn mappings on top of MCP (srgs) for the latest stable Yarn version (currently 1.16.1). If the two versions are the same, this will be skipped</li>
			<li>A set of mixed mappings, which use 1.14.3 MCP mappings applied to the latest (currently 1.16.1) srgs, with yarn names filling in as many unnamed members as possible. <strong>This is the set you most likely want.</strong></li>
		</ul>
        <p>
        Additionally, a stable channel of Yarn on top of MCP srgs is published for the latest stable version of MCP.
        </p>
		<p>
			They can be used by adding my maven (<code>https://maven.tterrag.com/</code>) to your gradle repositories, and adding <code>-yarn</code> (for yarn mappings) or <code>-mixed</code> (for mixed mappings) suffix to the snapshot version (e.g. <code><?= date("Ymd") ?>-mixed-1.16.1</code>). So overall, it should look like this:
			<pre>
repositories {
    maven {
        url "https://maven.tterrag.com/"
    }
}

minecraft {
    mappings channel: 'snapshot', version: '<?= date("Ymd") ?>-mixed-1.16.1'
    ...</pre>
		</p>
		<p>
			For stable 1.16.1 yarn mappings, use the channel <code>'stable'</code> with the version <code>'yarn-1.16.1'</code>.
		</p>
		<h2>Why?</h2>
		<p>
			MCP does not currently have mappings released for 1.16.1, so this fills the gap until those are completed so that modders can work on 1.16.1 forge mods without all the new fields/methods being unnamed. Additionally, due to the legal issues surrounding the official mojang mappings, I wanted to give forge modders the choice to use an alternative mapping set entirely.
		</p>
  </div>
  </div>
</body>
</html>
<?php date_default_timezone_set(ini_get('date.timezone')); ?>
