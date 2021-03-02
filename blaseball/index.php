<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">	

    <link rel="stylesheet" type="text/css" href="../root.css">
    <link rel="stylesheet" type="text/css" href="blaseball.css">

    <title>tterrag - Blaseball Stuff</title>
    <meta name="author" content="tterrag">
    <meta name="description" content="Various blaseball projects">
    <meta name="theme-color" content="#4e9745">

    <meta property="og:title" content="Blaseball Stuff">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://www.tterrag.com/blaseball">
    <meta property="og:site_name" content="tterrag.com">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Blaseball Stuff">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>
<header>
    <nav>
        <a href="/">Home</a>
        <span class="separator"></span>
        <a href="https://discord.gg/e93JT7R">Discord</a>
        <a href="https://github.com/tterrag1098/">GitHub</a>
    </nav>
</header>
<body>
    <div id="mobile-wrapper">
    <div id="content">
	    <h1>Blaseball Dashboard</h1>
		<p>
			Alters the css of the league page to show more games at once in a more compact grid.
		</p>
        <img src="example.png"/>
        <p>Drag this to your bookmark bar to save it, then just click the bookmark with the league page open.</p>
        <a id="bookmarklet-a" class="bookmarklet" href="javascript:(function()%7B((d%2Ce)%3D%3E%7B%0A%20%20e%20%3D%20d.createElement(%22style%22)%3B%0A%20%20e.innerHTML%20%3D%20%60.Widget-Display-Visual%20%7B%0A%20%20%20%20margin%3A0%3B%0A%20%20%20%20grid-row%3A%202%2F4%3B%0A%20%20%20%20flex-direction%3A%20column%3B%0A%20%20%20%20padding%3A%200%2010px%2010px%3B%0A%20%20%20%20background%3A%20transparent%0A%7D%0A%0A.Widget-Display-Visual-Max%3Aafter%20%7B%0A%20%20%20%20bottom%3A%205px%3B%0A%20%20%20%20left%3A%207px%3B%0A%20%20%20%20font-size%3A%2011px%0A%7D%0A%0A.Widget-Display-Body%20%7B%0A%20%20%20%20padding%3A%200%3B%0A%20%20%20%20width%3A%20100%25%0A%7D%0A%0A.Widget-Display-Body%20.Widget-Bases%20%7B%0A%20%20%20%20grid-column%3A%201%2F2%3B%0A%20%20%20%20grid-row%3A%201%2F2%0A%7D%0A%0A.Widget-Display-Body%20.Widget-Outs%20%7B%0A%20%20%20%20grid-column%3A%201%2F2%3B%0A%20%20%20%20grid-row%3A%202%2F3%0A%7D%0A%0A.Widget-Display-Body%20.Widget-AtBat%20%7B%0A%20%20%20%20grid-column%3A%202%2F3%3B%0A%20%20%20%20grid-row%3A%201%2F2%0A%7D%0A%0A.Widget-Display-Body%20.Widget-Log%20%7B%0A%20%20%20%20display%3A%20block%3B%0A%20%20%20%20min-height%3A%2092px%3B%0A%20%20%20%20padding%3A%205px%2010px%3B%0A%20%20%20%20grid-column%3A%202%2F3%3B%0A%20%20%20%20grid-row%3A%202%2F3%3B%0A%20%20%20%20font-size%3A%2014px%0A%7D%0A%0A.theme-dark%20.Widget-Display-Body%20.Widget-Log%20%7B%0A%20%20%20%20background%3A%20rgba(30%2C30%2C30%2C.64)%0A%7D%0A%0A.theme-light%20.Widget-Display-Body%20.Widget-Log%20%7B%0A%20%20%20%20background%3A%20hsla(0%2C0%25%2C89%25%2C.71)%0A%7D%0A%0A.Widget-Header%20%7B%0A%20%20%20%20border-radius%3A%200%0A%7D%0A%0A.Widget-Header-Wrapper%20%7B%0A%20%20%20%20grid-column%3A%201%2F3%0A%7D%0A%0A.Widget-ScoreBacking%20%7B%0A%20%20%20%20padding%3A%2010px%200%0A%7D%0A%0A.Widget-ScoreLabel--Series%2B.GameWidget-ScoreLabel--Score%20%7B%0A%20%20%20%20display%3A%20none%0A%7D%0A%0A.Widget-AtBat%20%7B%0A%20%20%20%20grid-column%3A%202%2F3%3B%0A%20%20%20%20grid-row%3A%202%2F3%0A%7D%0A%0A.Widget-Outs%20%7B%0A%20%20%20%20justify-content%3A%20flex-start%0A%7D%0A%0A.Widget-Outs-Label%20%7B%0A%20%20%20%20font-size%3A%2012px%0A%7D%0A%0A.Widget-Outs-DotList%20%7B%0A%20%20%20%20align-items%3A%20flex-start%3B%0A%20%20%20%20height%3A%2085%25%0A%7D%0A%0A.Widget-Outs-Dots%20%7B%0A%20%20%20%20font-size%3A%2024px%3B%0A%20%20%20%20line-height%3A%2014px%0A%7D%0A%0A.Widget-Log%20%7B%0A%20%20%20%20grid-column%3A%202%2F3%3B%0A%20%20%20%20grid-row%3A%203%2F4%0A%7D%0A%0A.Widget-Log%2C.Widget-Log-Header%20%7B%0A%20%20%20%20display%3A%20none%0A%7D%0A%0A.Widget-Log-Content%20%7B%0A%20%20%20%20font-size%3A%2014px%3B%0A%20%20%20%20margin-bottom%3A%200%0A%7D%0A%0A.Widget-Log-Line%20%7B%0A%20%20%20%20margin%3A%200%0A%7D%0A%0A.Widget-PlayerLine%20%7B%0A%20%20%20%20justify-content%3A%20flex-start%0A%7D%0A%0A.Widget-PlayerStatusLabel%20%7B%0A%20%20%20%20display%3A%20none%0A%7D%0A%0A.Widget-PlayerStatusIcon%20%7B%0A%20%20%20%20display%3A%20block%0A%7D%0A%0A.Widget-PlayerLineName%20%7B%0A%20%20%20%20font-size%3A%2014px%3B%0A%20%20%20%20line-height%3A%2016px%3B%0A%20%20%20%20padding%3A%202px%200%0A%7D%0A%0A.GameWidget%20%7B%0A%20%20%20%20border-radius%3A%205px%0A%7D%0A%0A.theme-dark%20.GameWidget%20%7B%0A%20%20%20%20background%3A%20%230b0b0b%3B%0A%7D%0A%0A.theme-light%20.GameWidget%20%7B%0A%20%20%20%20background%3A%20%23f2f2f2%0A%7D%0A%0A.GameWidget-Full-Live%20%7B%0A%20%20%20%20grid-template-columns%3A%20100%25%3B%0A%20%20%20%20grid-gap%3A%200%3B%0A%20%20%20%20gap%3A%200%0A%7D%0A%0A.GameWidget-Full-Upcoming%20%7B%0A%20%20%20%20grid-template-columns%3A%2040%25%20auto%0A%7D%0A%0A.GameWidget-Upcoming-Info%20%7B%0A%20%20%20%20grid-column%3A%201%2F3%3B%0A%20%20%20%20margin-left%3A%200%3B%0A%20%20%20%20background-color%3A%20transparent%0A%7D%0A%0A.GameWidget-Upcoming-Odds%20%7B%0A%20%20%20%20grid-template-columns%3A%20100%25%0A%7D%0A%0A.GameWidget-Upcoming-OddsTeam%20%7B%0A%20%20%20%20flex-direction%3A%20row%3B%0A%20%20%20%20justify-content%3A%20space-around%0A%7D%0A%0A.GameWidget-Upcoming-Favorites-Team%20%7B%0A%20%20%20%20font-size%3A%2014px%0A%7D%0A%0A.GameWidget-Upcoming-Favorites-Percentage%20%7B%0A%20%20%20%20font-size%3A%2018px%0A%7D%0A%0A.GameWidget-Upcoming-Full%20%7B%0A%20%20%20%20grid-column%3A%201%2F3%3B%0A%20%20%20%20grid-gap%3A%2010px%3B%0A%20%20%20%20gap%3A%2010px%3B%0A%20%20%20%20grid-template-columns%3A%20100%25%0A%7D%0A%0A.GameWidget-Upcoming-Header%20%7B%0A%20%20%20%20display%3A%20none%0A%7D%0A%0A.GameWidget-Upcoming-Body%20%7B%0A%20%20%20%20flex-direction%3A%20row%3B%0A%20%20%20%20width%3A%20100%25%3B%0A%20%20%20%20justify-content%3A%20flex-start%0A%7D%0A%0A.GameWidget-Upcoming-Body%20.GameWidget-PlayerLine%2B.GameWidget-PlayerLine%20%7B%0A%20%20%20%20margin-left%3A%2010px%0A%7D%0A%0A.GameWidget-Upcoming-Label%20%7B%0A%20%20%20%20display%3A%20none%0A%7D%0A%0A.GameWidget-Upcoming-Icon%20%7B%0A%20%20%20%20display%3A%20block%3B%0A%20%20%20%20margin-left%3A%2020px%0A%7D%0A%0A.GameWidget-Upcoming-Bets%20%7B%0A%20%20%20%20background-color%3A%20rgba(30%2C30%2C30%2C.64)%3B%0A%20%20%20%20display%3A%20block%3B%0A%20%20%20%20padding%3A%2010px%3B%0A%20%20%20%20grid-column%3A%201%2F3%3B%0A%20%20%20%20border-radius%3A%200%0A%7D%0A%0A.theme-dark%20.GameWidget-Upcoming-Bets%20%7B%0A%20%20%20%20background%3A%20rgba(30%2C30%2C30%2C.64)%0A%7D%0A%0A.theme-light%20.GameWidget-Upcoming-Bets%20%7B%0A%20%20%20%20background%3A%20hsla(0%2C0%25%2C89%25%2C.71)%0A%7D%0A%0A.GameWidget-Upcoming-BetButtons%20%7B%0A%20%20%20%20margin-top%3A%2010px%3B%0A%20%20%20%20margin-bottom%3A%2010px%0A%7D%0A%0A.GameWidget-Outcome%20%7B%0A%20%20%20%20grid-column%3A%201%2F3%3B%0A%20%20%20%20background-color%3A%20rgba(30%2C30%2C30%2C.64)%3B%0A%20%20%20%20border-radius%3A%200%0A%7D%0A%0A.theme-dark%20.GameWidget-Outcome%20%7B%0A%20%20%20%20background%3A%20rgba(30%2C30%2C30%2C.64)%0A%7D%0A%0A.theme-light%20.GameWidget-Outcome%20%7B%0A%20%20%20%20background%3A%20hsla(0%2C0%25%2C89%25%2C.71)%0A%7D%0A%0A.GameWidget-ScoreName%20%7B%0A%20%20%20%20font-size%3A%2018px%0A%7D%0A%0A.GameWidget-ScoreNumber%20%7B%0A%20%20%20%20margin%3A%200%208px%200%200%0A%7D%0A%0A.GameWidget-ScoreTeamColorBar%20%7B%0A%20%20%20%20width%3A%2035px%3B%0A%20%20%20%20height%3A%2035px%3B%0A%20%20%20%20margin-left%3A%2010px%3B%0A%20%20%20%20font-size%3A%2024px%0A%7D%0A%0A.GameWidget-ScoreLine%20%7B%0A%20%20%20%20grid-gap%3A%205px%3B%0A%20%20%20%20gap%3A%205px%3B%0A%20%20%20%20margin-bottom%3A%205px%0A%7D%0A%0A.GameWidget.IsComplete%20.GameWidget-Log%20%7B%0A%20%20%20%20display%3A%20none%0A%7D%0A%0A.GameWidget%20%7B%0A%20%20%20%20display%3A%20inline-block%3B%0A%20%20%20%20width%3A%20350px%3B%0A%20%20%20%20margin%3A%2010px%0A%7D%0A%0A.Main-Body%20%7B%0A%20%20%20%20width%3A%20100vw%3B%0A%20%20%20%20margin-left%3A%20calc(-50vw%20%2B%20512px)%3B%0A%7D%0A%0A.Main-Body%20%3E%20div%20%3E%20ul%20%7B%0A%20%20%20%20display%3A%20flex%3B%0A%20%20%20%20flex-wrap%3A%20wrap%3B%0A%20%20%20%20justify-content%3A%20center%3B%0A%7D%60%3B%0A%20%20d.head.appendChild(e)%0A%7D)(document)%7D)()%3B">Blaseball Dashboard</a>
        <details>
            <summary>This bookmarklet is a small script that simply adds some CSS to the page. Expand this to view the full code.</summary>
            <pre>
((d,e)=>{
    e = d.createElement("style");
    e.innerHTML = `
        /* This is all copied from the media query for the "mobile" look
        .Widget-Display-Visual {
            margin:0;
            grid-row: 2/4;
            flex-direction: column;
            padding: 0 10px 10px;
            background: transparent
        }

        .Widget-Display-Visual-Max:after {
            bottom: 5px;
            left: 7px;
            font-size: 11px
        }

        .Widget-Display-Body {
            padding: 0;
            width: 100%
        }

        .Widget-Display-Body .Widget-Bases {
            grid-column: 1/2;
            grid-row: 1/2
        }

        .Widget-Display-Body .Widget-Outs {
            grid-column: 1/2;
            grid-row: 2/3
        }

        .Widget-Display-Body .Widget-AtBat {
            grid-column: 2/3;
            grid-row: 1/2
        }

        .Widget-Display-Body .Widget-Log {
            display: block;
            min-height: 92px;
            padding: 5px 10px;
            grid-column: 2/3;
            grid-row: 2/3;
            font-size: 14px
        }

        .theme-dark .Widget-Display-Body .Widget-Log {
            background: rgba(30,30,30,.64)
        }

        .theme-light .Widget-Display-Body .Widget-Log {
            background: hsla(0,0%,89%,.71)
        }

        .Widget-Header {
            border-radius: 0
        }

        .Widget-Header-Wrapper {
            grid-column: 1/3
        }

        .Widget-ScoreBacking {
            padding: 10px 0
        }

        .Widget-ScoreLabel--Series+.GameWidget-ScoreLabel--Score {
            display: none
        }

        .Widget-AtBat {
            grid-column: 2/3;
            grid-row: 2/3
        }

        .Widget-Outs {
            justify-content: flex-start
        }

        .Widget-Outs-Label {
            font-size: 12px
        }

        .Widget-Outs-DotList {
            align-items: flex-start;
            height: 85%
        }

        .Widget-Outs-Dots {
            font-size: 24px;
            line-height: 14px
        }

        .Widget-Log {
            grid-column: 2/3;
            grid-row: 3/4
        }

        .Widget-Log,.Widget-Log-Header {
            display: none
        }

        .Widget-Log-Content {
            font-size: 14px;
            margin-bottom: 0
        }

        .Widget-Log-Line {
            margin: 0
        }

        .Widget-PlayerLine {
            justify-content: flex-start
        }

        .Widget-PlayerStatusLabel {
            display: none
        }

        .Widget-PlayerStatusIcon {
            display: block
        }

        .Widget-PlayerLineName {
            font-size: 14px;
            line-height: 16px;
            padding: 2px 0
        }

        .GameWidget {
            border-radius: 5px
        }

        .theme-dark .GameWidget {
            background: #0b0b0b;
        }

        .theme-light .GameWidget {
            background: #f2f2f2
        }

        .GameWidget-Full-Live {
            grid-template-columns: 100%;
            grid-gap: 0;
            gap: 0
        }

        .GameWidget-Full-Upcoming {
            grid-template-columns: 40% auto
        }

        .GameWidget-Upcoming-Info {
            grid-column: 1/3;
            margin-left: 0;
            background-color: transparent
        }

        .GameWidget-Upcoming-Odds {
            grid-template-columns: 100%
        }

        .GameWidget-Upcoming-OddsTeam {
            flex-direction: row;
            justify-content: space-around
        }

        .GameWidget-Upcoming-Favorites-Team {
            font-size: 14px
        }

        .GameWidget-Upcoming-Favorites-Percentage {
            font-size: 18px
        }

        .GameWidget-Upcoming-Full {
            grid-column: 1/3;
            grid-gap: 10px;
            gap: 10px;
            grid-template-columns: 100%
        }

        .GameWidget-Upcoming-Header {
            display: none
        }

        .GameWidget-Upcoming-Body {
            flex-direction: row;
            width: 100%;
            justify-content: flex-start
        }

        .GameWidget-Upcoming-Body .GameWidget-PlayerLine+.GameWidget-PlayerLine {
            margin-left: 10px
        }

        .GameWidget-Upcoming-Label {
            display: none
        }

        .GameWidget-Upcoming-Icon {
            display: block;
            margin-left: 20px
        }

        .GameWidget-Upcoming-Bets {
            background-color: rgba(30,30,30,.64);
            display: block;
            padding: 10px;
            grid-column: 1/3;
            border-radius: 0
        }

        .theme-dark .GameWidget-Upcoming-Bets {
            background: rgba(30,30,30,.64)
        }

        .theme-light .GameWidget-Upcoming-Bets {
            background: hsla(0,0%,89%,.71)
        }

        .GameWidget-Upcoming-BetButtons {
            margin-top: 10px;
            margin-bottom: 10px
        }

        .GameWidget-Outcome {
            grid-column: 1/3;
            background-color: rgba(30,30,30,.64);
            border-radius: 0
        }

        .theme-dark .GameWidget-Outcome {
            background: rgba(30,30,30,.64)
        }

        .theme-light .GameWidget-Outcome {
            background: hsla(0,0%,89%,.71)
        }

        .GameWidget-ScoreName {
            font-size: 18px
        }

        .GameWidget-ScoreNumber {
            margin: 0 8px 0 0
        }

        .GameWidget-ScoreTeamColorBar {
            width: 35px;
            height: 35px;
            margin-left: 10px;
            font-size: 24px
        }

        .GameWidget-ScoreLine {
            grid-gap: 5px;
            gap: 5px;
            margin-bottom: 5px
        }

        .GameWidget.IsComplete .GameWidget-Log {
            display: none
        }

        /* Add a forced width and margin to widgets */
        .GameWidget {
            display: inline-block;
            width: 350px;
            margin: 10px
        }

        /* Force the body (everything under the navbar) to 100% screen width
        .Main-Body {
            width: 100vw;
            margin-left: calc(-50vw + 512px); /* This inverses the padding on the parent div */
        }

        /* Make the list of widgets a flexbox so that they fill available space */
        .Main-Body > div > ul {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
    `;
    d.head.appendChild(e)
})(document)
            </pre>
        </details>
    </div>
    </div>
</body>
</html>
<?php date_default_timezone_set(ini_get('date.timezone')); ?>
