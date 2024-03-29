<?php
require('../vendor/autoload.php');

$content = isset($_POST['content']) ? $_POST['content'] : null;
$mintime = isset($_POST['time']) ? $_POST['time'] : gmdate("Y-m-d\TH:i:s", intdiv(time() - 3600, 3600) * 3600); // Default to on the hour at least 1 hour ago
$minamnt = isset($_POST['min-amount']) ? $_POST['min-amount'] : 20;
$prevwinners = isset($_POST['prev-winners']) ? $_POST['prev-winners'] : '';
$final_prize_mode = isset($_POST['final-prize-mode']) ? $_POST['final-prize-mode'] : false;

function getEligibleDonations() {
	global $content, $mintime, $minamnt, $prevwinners, $final_prize_mode;

	$blacklist = explode(",", $prevwinners);

	$time = strtotime($mintime);

	$csv = new ParseCsv\Csv($content);
	$csv->data = array_filter($csv->data, function($d) use ($minamnt, $time) {
		return $d['amount'] >= $minamnt && strtotime($d['created_at']) >= $time;
	});

	$eligible = array_values($csv->data);
	$res = [];

	if (!$final_prize_mode) {
		foreach ($eligible as $donation) {
			if (!in_array($donation['donor_name'], $blacklist)) {
				for ($i = 0; $i < $donation['amount'] / $minamnt; $i++) {
					// echo $donation['donor_name'] . ': ' . $donation['amount'] . '<br>';
					$res[] = $donation;
				}
			}
		}
	} else {
		$res = [];

		foreach ($eligible as $donation) {
			$email = $donation['email'];
			if (!array_key_exists($email, $res)) {
				$res[$email] = $donation;
			} else {
				$res[$email]['amount'] += $donation['amount'];
			}
		}
		$res = array_values($res);
	}

	return $res;
}
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="../root.css">
	<link rel="stylesheet" type="text/css" href="lottery.css">

	<script src="jstz.min.js"></script>
	<script src="moment.min.js"></script>
	<script src="moment-timezone-with-data-2012-2022.min.js"></script>

  <title>tterrag - Prize Lottery</title>
  <meta name="author" content="tterrag">
	<meta name="description" content="Tiltify Prize Lottery">
	<meta name="theme-color" content="#4e9745">

	<meta property="og:title" content="Tiltify Prize Lottery">
	<meta property="og:type" content="website">
	<meta property="og:url" content="http://www.tterrag.com/lottery">
	<meta property="og:site_name" content="tterrag.com">

	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Tiltify Prize Lottery">

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
		<a href="https://github.com/tterrag1098/">GitHub</a>
		<a href="https://ci.tterrag.com/">Jenkins</a>
  </nav>
</header>
<body>
  <div id="mobile-wrapper">
		<div id="content">
			<h4>Input:</h4>
			<form id="form" method="post" action=".">
			</form>
			<textarea form="form" name="content" placeholder="Paste tiltify CSV contents here"><?= $content ?: '' ?></textarea>
			<div>
				Use all donations after:
				<input id="input-time" type="datetime-local" name="time" value="<?= $mintime ?>" form="form"/>
				<span id="local-time"></span>
			</div>
			<div>
				Minimum donation amount: $<input form="form" name="min-amount" type="number" min="1" step="1" value="<?= $minamnt ?>"/>
			</div>
			<div>
				Final Prize Mode? (Equal chances for all): <input form="form" name="final-prize-mode" type="checkbox"/>
			</div>
			<div>
				<input form="form" type="submit" name="submit" value="Spin That Wheel!"/>
			</div>
			<div>
				Previous winners: <br><textarea form="form" name="prev-winners" placeholder="Comma separated names to exclude"><?= $prevwinners ?: '' ?></textarea>
			</div>

<?php
			if ($content && strlen($content) > 0) {
				$eligible = getEligibleDonations();
				echo '<h4>Result:</h4>';
				echo '<div>Eligible donors: ' . count(array_unique($eligible, SORT_REGULAR)) . '</div>';
				echo '<div>Total ballots: ' . count($eligible) . '</div>';

				$winner = $eligible[rand(0, count($eligible) - 1)];
				echo '<div id="winner">WINNER: '. $winner['donor_name'] . '!</div>';
				echo '<div>Contact: ' . $winner['email'] . '  Amount: ' . sprintf("$%.2f", $winner['amount']) . '</div>';
			}
?>
		</div>
  </div>
</body>
<script>
	// Get the timezone
	// If it's already in storage, just grab from there
	if (!sessionStorage.getItem('timezone')) {
	  var tz = jstz.determine() || 'UTC';
	  sessionStorage.setItem('timezone', tz.name());
	}
	var currTz = sessionStorage.getItem('timezone');

	// References to DOM elements
	var inputTime = document.querySelector("#input-time");
	var output = document.querySelector("#local-time");

	// When the input changes, update the local time
	inputTime.addEventListener("change", function() {
	  updateTime(this.value);
	});

	function updateTime(theTime) {

	  // Create a Moment.js object
	  var momentTime = moment(theTime + "Z");

	  // Adjust using Moment Timezone
	  var tzTime = momentTime.tz(currTz);

	  // Format the time back to normal
	  var formattedTime = tzTime.format('Y-M-D @ h:mm A');

	  output.textContent = "Local time: " + formattedTime + " (" + currTz + ")";
	}

	updateTime(inputTime.value);
</script>
</html>
