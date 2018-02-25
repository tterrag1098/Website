<?php
  require('vendor/autoload.php');
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>tterrag - K9</title>
  <meta name="author" content="tterrag">

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

    #content p:first-child {
      margin: auto;
      width: 40%;
      height: auto;
      text-align: center;
    }

    #content img {
      text-align:  center;
      margin: auto;
      height: inherit;
      width: inherit;
    }

  </style>

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>
<header>
  <nav>
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
