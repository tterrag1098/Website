<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">	

    <link rel="stylesheet" type="text/css" href="../root.css">
    <link rel="stylesheet" type="text/css" href="blaseball.css">

    <title>tterrag - Blaseball Stuff</title>
    <meta name="author" content="tterrag">
    <meta name="description" content="A more compact and at-a-glance blaseball UI">
    <meta name="theme-color" content="#4e9745">

    <meta property="og:title" content="Blaseball Dashboard">
    <meta property="og:description" content="A more compact and at-a-glance blaseball UI">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.tterrag.com/blaseball">
    <meta property="og:site_name" content="tterrag.com">
    <meta property="og:image" content="https://www.tterrag.com/blaseball/example.png">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Blaseball Dashboard">

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
			Alters the league and upcoming pages to show more games at once in a compact grid. You can toggle full screen mode and widget size using buttons that appear in the top right.
		</p>
		<p>
			In the watch live tab, games will have a few additional elements for better at-a-glance information:
		</p>
		<ul>
			<li>During a scoring event, a game will have a bright yellow border</li>
			<li>The team currently at bat will have a bat icon next to their name</li>
			<li>The bet widget will be colored based on the current result (green: winning, blue: tied, red: losing)</li>
		</ul>
		<p>
			In addition, completed games will no longer move to the end of the list (as long as you do not refresh the page).
		</p>
        <img width="100%" src="example.png"/>
        <p>Drag this to your bookmark bar to save it, then just click the bookmark with the league page open.</p>
        <a id="bookmarklet-a" href="javascript:(function()%7Bvar%20_bbd_observer%2Cordering%3Dnew%20Map%3Bfunction%20initialize()%7Blet%20n%3D%24(%22.Main%22)%5B0%5D%3Bif(!n)return%20void%20setTimeout(initialize%2C50)%3Bconsole.log(%22Initializing%20Blaseball%20Dashboard%22)%2C%24(%22head%22).append(%24('%3Cscript%20src%3D%22https%3A%2F%2Fkit.fontawesome.com%2Fe7e5187ceb.js%22%20crossorigin%3D%22anonymous%22%3E'))%3Blet%20e%3D%24('%3Cdiv%20class%3D%22bbd-buttons%22%3E')%3B%24(%22body%22).append(e)%3Blet%20t%3D%24('%3Cbutton%20class%3D%22size-btn%22%20title%3D%22Toggle%20Widget%20Size%22%3E%3Ci%20class%3D%22fas%20fa-th-large%22%3E%3C%2Fi%3E%3C%2Fbutton%3E')%3Be.append(t)%2Ct.click(function()%7Blet%20n%3D%24(%22body%22)%3Bn.toggleClass(%22large-widgets%22)%3Blet%20e%3Dt.find(%22i%22)%3Bn.hasClass(%22large-widgets%22)%3Fe.removeClass(%22fa-th-large%22).addClass(%22fa-th%22)%3Ae.addClass(%22fa-th-large%22).removeClass(%22fa-th%22)%7D)%3Blet%20i%3D%24('%3Cbutton%20class%3D%22fullscreen-btn%22%20title%3D%22Toggle%20Fullscreen%22%3E%3Ci%20class%3D%22fas%20fa-expand%22%3E%3C%2Fi%3E%3C%2Fbutton%3E')%3Be.append(i)%2Ci.click(function()%7Blet%20n%3Di.find(%22i%22)%3BisInFullScreen()%3F(cancelFullScreen()%2Cn.removeClass(%22fa-compress%22).addClass(%22fa-expand%22)%2C%24(%22nav%22).css(%22position%22%2C%22%22))%3A(requestFullScreen()%2Cn.addClass(%22fa-compress%22).removeClass(%22fa-expand%22)%2Cwindow.scrollTo(0%2C%24(%22.League-Countdown%22).offset().top%2B10)%2C%24(%22nav%22).css(%22position%22%2C%22relative%22))%7D)%3Blet%20a%3D0%2Co%3D!1%2Cd%3Dfunction(n%2Ce)%7Blet%20t%3DDate.now()%3Bt-500%3Ca%7C%7C(a%3Dt%2Cconsole.log(%22%5BBlaseball%20Dashboard%5D%20Refreshing%20widgets%22)%2CsetTimeout(function()%7Bif(onLeaguePage())%7Blet%20n%3D%24(%22.Widget-Status--Complete%22).length%3Bconsole.log(%22Finished%20games%3A%20%22%2Bn%2B%22%20%20%20All%20finished%3F%20%22%2Bo)%2Cn%3D%3D%24(%22.GameWidget%22).length%3F(console.log(%22%5BBlaseball%20Dashboard%5D%20All%20games%20finished%22)%2Co%3D!0)%3Ao%26%26(console.log(%22%5BBlaseball%20Dashboard%5D%20Clearing%20saved%20widget%20ordering%22)%2Cordering.clear()%2Co%3D!1)%7D%24(%22.GameWidget%22).each(function(n)%7BupdateWidget(%24(this)%2Cn)%7D)%7D%2C50))%7D%3B_bbd_observer%26%26(console.log(%22%5BBlaseball%20Dashboard%5D%20Disconnecting%20old%20observer%22)%2C_bbd_observer.disconnect())%2Cd()%2C_bbd_observer%3Dnew%20MutationObserver(d)%3Bconsole.log(%22%5BBlaseball%20Dashboard%5D%20Attaching%20observer%22)%2C_bbd_observer.observe(n%2C%7BchildList%3A!0%2Csubtree%3A!0%7D)%7Dfunction%20updateWidget(n%2Ce)%7Bn.find(%22.Widget-Log-Score%22).text().length%3E1%3Fn.addClass(%22Scored%22)%3An.removeClass(%22Scored%22)%3Blet%20t%3Dn.find(%22.Widget-Status--Live%2C%20.Widget-Status--Shame%22)%3Bif(n.find(%22.Batting-Indicator%22).remove()%2Ct.length%3E0)%7Blet%20e%3D%22%E2%96%BC%22%3D%3Dt.text().substr(-1)%7C%7Ct.is(%22.Widget-Status--Shame%22)%3F1%3A0%3Bn.find(%22.GameWidget-ScoreLine%22).eq(e).find(%22.GameWidget-ScoreName%22).append('%3Cspan%20class%3D%22Batting-Indicator%22%3E%26nbsp%3B%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20version%3D%221.0%22%20x%3D%220px%22%20y%3D%220px%22%20viewBox%3D%220%200%2024%2024%22%20enable-background%3D%22new%200%200%2024%2024%22%20xml%3Aspace%3D%22preserve%22%3E%3Cpath%20d%3D%22M16.4%2C10.5l4.9-4.9c0.7-0.7%2C0.9-1.9%2C0.3-2.8c-0.8-1.1-2.3-1.2-3.2-0.3l-5%2C5c-1.7%2C1.7-5.3%2C7.1-7.5%2C9.3l-2.7%2C2.7%20%20c-0.3-0.3-0.8-0.3-1.1%2C0l0%2C0c-0.3%2C0.3-0.3%2C0.8%2C0%2C1.1l1.1%2C1.1c0.3%2C0.3%2C0.8%2C0.3%2C1.1%2C0l0%2C0c0.3-0.3%2C0.3-0.8%2C0-1.1L7.1%2C18%20%20C9.3%2C15.8%2C14.7%2C12.3%2C16.4%2C10.5z%22%3E%3C%2Fpath%3E%3Cg%3E%3Cpath%20d%3D%22M10%2C4.4C9.6%2C4.5%2C9.3%2C4.7%2C9%2C5C8.7%2C5.3%2C8.5%2C5.6%2C8.4%2C6C9.2%2C5.8%2C9.8%2C5.2%2C10%2C4.4z%22%3E%3C%2Fpath%3E%3Cpath%20d%3D%22M8.7%2C4.7C9.1%2C4.3%2C9.6%2C4.1%2C10%2C3.9C10%2C2.9%2C9.1%2C2%2C8.1%2C2C8%2C2.4%2C7.7%2C2.9%2C7.3%2C3.3C6.9%2C3.7%2C6.4%2C4%2C6%2C4.1C6%2C5.1%2C6.9%2C6%2C7.9%2C6%20%20%20C8%2C5.6%2C8.3%2C5.1%2C8.7%2C4.7z%22%3E%3C%2Fpath%3E%3Cpath%20d%3D%22M7.6%2C2C6.8%2C2.2%2C6.2%2C2.8%2C6%2C3.6C6.4%2C3.5%2C6.7%2C3.3%2C7%2C3C7.3%2C2.7%2C7.5%2C2.4%2C7.6%2C2z%22%3E%3C%2Fpath%3E%3C%2Fg%3E%3C%2Fsvg%3E%3C%2Fspan%3E')%7Dlet%20i%3Dn.children(%22.Widget-Log%22).find(%22.Widget-Log-PlayCount%22).clone()%3Bn.find(%22.Widget-Display-Body%20.Widget-Log-PlayCount%22).remove()%2Cn.find(%22.Widget-Display-Body%20.Widget-Log%22).append(i)%3Blet%20a%3Dn.find(%22.GameWidget-ScoreBet-Winnings%22)%2Co%3Da.parents(%22.GameWidget-ScoreLine%22)%2Cd%3DparseFloat(o.find(%22.GameWidget-ScoreNumber%22).text())%2Cl%3DparseFloat(o.siblings().find(%22.GameWidget-ScoreNumber%22).text())%3Bif(d%3Cl%3Fa.css(%22background-color%22%2C%22%23c72222%22)%3Ad%3D%3Dl%3Fa.css(%22background-color%22%2C%22%230c8eb1%22)%3Aa.css(%22background-color%22%2C%22%22)%2ConLeaguePage())%7Blet%20t%3Dn.attr(%22aria-label%22)%2Ci%3De%3Bordering.has(t)%3Fi%3Dordering.get(t)%3Aordering.set(t%2Ci)%2Cn.css(%22order%22%2Ci)%7Delse%20n.css(%22order%22%2C%22%22)%7Dfunction%20onLeaguePage()%7Breturn%20window.location.href.indexOf(%22%2Fleague%22)%3E0%7Dfunction%20cancelFullScreen()%7Bvar%20n%3Ddocument%3Breturn(n.cancelFullScreen%7C%7Cn.webkitCancelFullScreen%7C%7Cn.mozCancelFullScreen%7C%7Cn.exitFullscreen%7C%7Cn.webkitExitFullscreen).call(n)%7Dfunction%20requestFullScreen()%7Bvar%20n%3Ddocument.documentElement%3Breturn(n.requestFullScreen%7C%7Cn.webkitRequestFullScreen%7C%7Cn.mozRequestFullScreen%7C%7Cn.msRequestFullscreen).call(n)%7Dfunction%20isInFullScreen()%7Breturn%20document.fullScreenElement%7C%7Cdocument.mozFullScreen%7C%7Cdocument.webkitIsFullScreen%7D((n%2Ce)%3D%3E%7Bconst%20t%3Ddocument.createElement(%22script%22)%3Bt.src%3D%22https%3A%2F%2Fcdnjs.cloudflare.com%2Fajax%2Flibs%2Fjquery%2F3.5.1%2Fjquery.min.js%22%2Cdocument.head.appendChild(t)%2Ct.addEventListener(%22load%22%2Cinitialize)%2C(e%3Dn.createElement(%22style%22)).innerHTML%3D'%5Cn%2F*%20This%20is%20all%20copied%20from%20the%20media%20query%20for%20the%20%22mobile%22%20look%20*%2F%5Cn.Widget-Display-Visual%20%7B%5Cn%20%20%20%20margin%3A0%3B%5Cn%20%20%20%20grid-row%3A%202%2F4%3B%5Cn%20%20%20%20flex-direction%3A%20column%3B%5Cn%20%20%20%20padding%3A%200%2010px%2010px%3B%5Cn%20%20%20%20background%3A%20transparent%5Cn%7D%5Cn%5Cn.Widget-Display-Visual-Max%3Aafter%20%7B%5Cn%20%20%20%20bottom%3A%205px%3B%5Cn%20%20%20%20left%3A%207px%3B%5Cn%20%20%20%20font-size%3A%2011px%5Cn%7D%5Cn%5Cn.Widget-Display-Body%20%7B%5Cn%20%20%20%20padding%3A%200%3B%5Cn%20%20%20%20width%3A%20100%25%3B%5Cn%7D%5Cn%5Cn.Widget-Display-Body%20.Widget-Bases%20%7B%5Cn%20%20%20%20grid-column%3A%201%2F2%3B%5Cn%20%20%20%20grid-row%3A%201%2F2%5Cn%7D%5Cn%5Cn.Widget-Display-Body%20.Widget-Outs%20%7B%5Cn%20%20%20%20grid-column%3A%201%2F2%3B%5Cn%20%20%20%20grid-row%3A%202%2F3%5Cn%7D%5Cn%5Cn.Widget-Display-Body%20.Widget-AtBat%20%7B%5Cn%20%20%20%20grid-column%3A%202%2F3%3B%5Cn%20%20%20%20grid-row%3A%201%2F2%5Cn%7D%5Cn%5Cn.Widget-Display-Body%20.Widget-Log%20%7B%5Cn%20%20%20%20display%3A%20block%3B%5Cn%20%20%20%20min-height%3A%2092px%3B%5Cn%20%20%20%20padding%3A%205px%2010px%3B%5Cn%20%20%20%20grid-column%3A%202%2F3%3B%5Cn%20%20%20%20grid-row%3A%202%2F3%3B%5Cn%20%20%20%20font-size%3A%2014px%5Cn%7D%5Cn%5Cn.theme-dark%20.Widget-Display-Body%20.Widget-Log%20%7B%5Cn%20%20%20%20background%3A%20rgba(30%2C30%2C30%2C.64)%5Cn%7D%5Cn%5Cn.theme-light%20.Widget-Display-Body%20.Widget-Log%20%7B%5Cn%20%20%20%20background%3A%20hsla(0%2C0%25%2C89%25%2C.71)%5Cn%7D%5Cn%5Cn.Widget-Header%20%7B%5Cn%20%20%20%20border-radius%3A%200%5Cn%7D%5Cn%5Cn.Widget-Header-Wrapper%20%7B%5Cn%20%20%20%20grid-column%3A%201%2F3%5Cn%7D%5Cn%5Cn.Widget-ScoreBacking%20%7B%5Cn%20%20%20%20padding%3A%2010px%200%5Cn%7D%5Cn%5Cn.Widget-ScoreLabel--Series%2B.GameWidget-ScoreLabel--Score%20%7B%5Cn%20%20%20%20display%3A%20none%5Cn%7D%5Cn%5Cn.Widget-AtBat%20%7B%5Cn%20%20%20%20grid-column%3A%202%2F3%3B%5Cn%20%20%20%20grid-row%3A%202%2F3%5Cn%7D%5Cn%5Cn.Widget-Outs%20%7B%5Cn%20%20%20%20justify-content%3A%20flex-start%5Cn%7D%5Cn%5Cn.Widget-Outs-Label%20%7B%5Cn%20%20%20%20font-size%3A%2012px%5Cn%7D%5Cn%5Cn.Widget-Outs-DotList%20%7B%5Cn%20%20%20%20align-items%3A%20flex-start%3B%5Cn%20%20%20%20height%3A%2085%25%5Cn%7D%5Cn%5Cn.Widget-Outs-Dots%20%7B%5Cn%20%20%20%20font-size%3A%2024px%3B%5Cn%20%20%20%20line-height%3A%2014px%5Cn%7D%5Cn%5Cn.Widget-Log%20%7B%5Cn%20%20%20%20grid-column%3A%202%2F3%3B%5Cn%20%20%20%20grid-row%3A%203%2F4%5Cn%7D%5Cn%5Cn.Widget-Log%2C.Widget-Log-Header%20%7B%5Cn%20%20%20%20display%3A%20none%5Cn%7D%5Cn%5Cn.Widget-Log-Content%20%7B%5Cn%20%20%20%20font-size%3A%2014px%3B%5Cn%20%20%20%20margin-bottom%3A%200%5Cn%7D%5Cn%5Cn.Widget-Log-Line%20%7B%5Cn%20%20%20%20margin%3A%200%5Cn%7D%5Cn%5Cn.Widget-PlayerLine%20%7B%5Cn%20%20%20%20justify-content%3A%20flex-start%5Cn%7D%5Cn%5Cn.Widget-PlayerStatusLabel%20%7B%5Cn%20%20%20%20display%3A%20none%5Cn%7D%5Cn%5Cn.Widget-PlayerStatusIcon%20%7B%5Cn%20%20%20%20display%3A%20block%5Cn%7D%5Cn%5Cn.Widget-PlayerLineName%20%7B%5Cn%20%20%20%20font-size%3A%2014px%3B%5Cn%20%20%20%20line-height%3A%2016px%3B%5Cn%20%20%20%20padding%3A%202px%200%5Cn%7D%5Cn%5Cn.GameWidget%20%7B%5Cn%20%20%20%20border-radius%3A%205px%5Cn%7D%5Cn%5Cn.theme-dark%20.GameWidget%20%7B%5Cn%20%20%20%20background%3A%20%230b0b0b%3B%5Cn%7D%5Cn%5Cn.theme-light%20.GameWidget%20%7B%5Cn%20%20%20%20background%3A%20%23f2f2f2%5Cn%7D%5Cn%5Cn.GameWidget-Full-Live%20%7B%5Cn%20%20%20%20grid-template-columns%3A%20100%25%3B%5Cn%20%20%20%20grid-gap%3A%200%3B%5Cn%20%20%20%20gap%3A%200%5Cn%7D%5Cn%5Cn.GameWidget-Full-Upcoming%20%7B%5Cn%20%20%20%20grid-template-columns%3A%2040%25%20auto%5Cn%7D%5Cn%5Cn.GameWidget-Upcoming-Info%20%7B%5Cn%20%20%20%20grid-column%3A%201%2F3%3B%5Cn%20%20%20%20margin-left%3A%200%3B%5Cn%20%20%20%20background-color%3A%20transparent%5Cn%7D%5Cn%5Cn.GameWidget-Upcoming-Odds%20%7B%5Cn%20%20%20%20grid-template-columns%3A%20100%25%5Cn%7D%5Cn%5Cn.GameWidget-Upcoming-OddsTeam%20%7B%5Cn%20%20%20%20flex-direction%3A%20row%3B%5Cn%20%20%20%20justify-content%3A%20space-around%5Cn%7D%5Cn%5Cn.GameWidget-Upcoming-Favorites-Team%20%7B%5Cn%20%20%20%20font-size%3A%2014px%5Cn%7D%5Cn%5Cn.GameWidget-Upcoming-Favorites-Percentage%20%7B%5Cn%20%20%20%20font-size%3A%2018px%5Cn%7D%5Cn%5Cn.GameWidget-Upcoming-Full%20%7B%5Cn%20%20%20%20grid-column%3A%201%2F3%3B%5Cn%20%20%20%20grid-gap%3A%2010px%3B%5Cn%20%20%20%20gap%3A%2010px%3B%5Cn%20%20%20%20grid-template-columns%3A%20100%25%5Cn%7D%5Cn%5Cn.GameWidget-Upcoming-Header%20%7B%5Cn%20%20%20%20display%3A%20none%5Cn%7D%5Cn%5Cn.GameWidget-Upcoming-Body%20%7B%5Cn%20%20%20%20flex-direction%3A%20row%3B%5Cn%20%20%20%20width%3A%20100%25%3B%5Cn%20%20%20%20justify-content%3A%20flex-start%5Cn%7D%5Cn%5Cn.GameWidget-Upcoming-Body%20.GameWidget-PlayerLine%2B.GameWidget-PlayerLine%20%7B%5Cn%20%20%20%20margin-left%3A%2010px%5Cn%7D%5Cn%5Cn.GameWidget-Upcoming-Label%20%7B%5Cn%20%20%20%20display%3A%20none%5Cn%7D%5Cn%5Cn.GameWidget-Upcoming-Icon%20%7B%5Cn%20%20%20%20display%3A%20block%3B%5Cn%20%20%20%20margin-left%3A%2020px%5Cn%7D%5Cn%5Cn.GameWidget-Upcoming-Bets%20%7B%5Cn%20%20%20%20background-color%3A%20rgba(30%2C30%2C30%2C.64)%3B%5Cn%20%20%20%20display%3A%20block%3B%5Cn%20%20%20%20padding%3A%2010px%3B%5Cn%20%20%20%20grid-column%3A%201%2F3%3B%5Cn%20%20%20%20border-radius%3A%200%5Cn%7D%5Cn%5Cn.theme-dark%20.GameWidget-Upcoming-Bets%20%7B%5Cn%20%20%20%20background%3A%20rgba(30%2C30%2C30%2C.64)%5Cn%7D%5Cn%5Cn.theme-light%20.GameWidget-Upcoming-Bets%20%7B%5Cn%20%20%20%20background%3A%20hsla(0%2C0%25%2C89%25%2C.71)%5Cn%7D%5Cn%5Cn.GameWidget-Upcoming-BetButtons%20%7B%5Cn%20%20%20%20margin-top%3A%2010px%3B%5Cn%20%20%20%20margin-bottom%3A%2010px%5Cn%7D%5Cn%5Cn.GameWidget-Outcome%20%7B%5Cn%20%20%20%20grid-column%3A%201%2F3%3B%5Cn%20%20%20%20background-color%3A%20rgba(30%2C30%2C30%2C.64)%3B%5Cn%20%20%20%20border-radius%3A%200%5Cn%7D%5Cn%5Cn.theme-dark%20.GameWidget-Outcome%20%7B%5Cn%20%20%20%20background%3A%20rgba(30%2C30%2C30%2C.64)%5Cn%7D%5Cn%5Cn.theme-light%20.GameWidget-Outcome%20%7B%5Cn%20%20%20%20background%3A%20hsla(0%2C0%25%2C89%25%2C.71)%5Cn%7D%5Cn%5Cn.GameWidget-ScoreName%20%7B%5Cn%20%20%20%20font-size%3A%2018px%5Cn%7D%5Cn%5Cn.GameWidget-ScoreNumber%20%7B%5Cn%20%20%20%20margin%3A%200%208px%200%200%5Cn%7D%5Cn%5Cn.GameWidget-ScoreTeamColorBar%20%7B%5Cn%20%20%20%20width%3A%2035px%3B%5Cn%20%20%20%20height%3A%2035px%3B%5Cn%20%20%20%20margin-left%3A%2010px%3B%5Cn%20%20%20%20font-size%3A%2024px%5Cn%7D%5Cn%5Cn.GameWidget-ScoreLine%20%7B%5Cn%20%20%20%20grid-gap%3A%205px%3B%5Cn%20%20%20%20gap%3A%205px%3B%5Cn%20%20%20%20margin-bottom%3A%205px%5Cn%7D%5Cn%5Cn.GameWidget.IsComplete%20.GameWidget-Log%20%7B%5Cn%20%20%20%20display%3A%20none%5Cn%7D%5Cn%2F*%20End%20copied%20code%20*%2F%5Cn%5Cn%2F*%20Add%20a%20forced%20width%20and%20margin%20to%20widgets%20*%2F%5Cn.GameWidget%20%7B%5Cn%20%20%20%20display%3A%20inline-block%3B%5Cn%20%20%20%20min-width%3A%20350px%3B%5Cn%20%20%20%20max-width%3A%20450px%3B%5Cn%20%20%20%20margin%3A%202px%3B%5Cn%20%20%20%20flex%3A%201%201%200%3B%5Cn%7D%5Cn%5Cn.large-widgets%20.GameWidget%20%7B%5Cn%20%20%20%20min-width%3A%20450px%3B%5Cn%7D%5Cn%5Cn%2F*%20Give%20hitter%2Fpitcher%20names%20a%20little%20more%20room%20to%20breathe%20*%2F%5Cn.Widget-Display-Body%20%7B%5Cn%20%20%20%20grid-template-columns%3A%20100px%20auto%3B%5Cn%7D%5Cn%5Cn%2F*%20The%20game%20list%20does%20not%20have%20any%20class%20or%20ID%20so%20we%20have%20to%20just%20select%20the%20exact%20ul%20element%20*%2F%5Cn.Main-Body%20%3E%20div%3Anot(%5Bclass%5D)%20%3E%20ul%3Anot(%5Bclass%5D)%2C%5Cn.Main-Body%20%3E%20div%3Anot(%5Bclass%5D)%20%3E%20div%3Anot(%5Bclass%5D)%20%3E%20ul%3Anot(%5Bclass%5D)%20%3E%20ul%3Anot(%5Bclass%5D)%20%7B%20%2F*%20site%20bug%3F%20*%2F%5Cn%20%20%20%20%2F*%20Force%20the%20game%20list%20to%20100%25%20screen%20width%20*%2F%5Cn%20%20%20%20width%3A%20100vw%3B%5Cn%20%20%20%20margin-left%3A%20calc(-50vw%20%2B%20509px)%3B%20%2F*%20This%20inverses%20the%20padding%20on%20the%20parent%20div%20*%2F%5Cn%20%20%20%20padding-left%3A%2015px%3B%5Cn%20%20%20%20padding-right%3A%2010px%3B%5Cn%5Cn%20%20%20%20%2F*%20Make%20the%20list%20of%20widgets%20a%20flexbox%20so%20that%20they%20fill%20available%20space%20*%2F%5Cn%20%20%20%20display%3A%20flex%3B%5Cn%20%20%20%20flex-wrap%3A%20wrap%3B%5Cn%20%20%20%20justify-content%3A%20center%3B%5Cn%7D%5Cn%5Cn%40media%20(max-width%3A%201080px)%20%7B%5Cn%5Cn%20%20%20%20%2F*%20Unapply%20forced%20width%20on%20mobile%20layout%20*%2F%5Cn%20%20%20%20.Main-Body%20%3E%20div%3Anot(%5Bclass%5D)%20%3E%20ul%3Anot(%5Bclass%5D)%2C%5Cn%20%20%20%20.Main-Body%20%3E%20div%3Anot(%5Bclass%5D)%20%3E%20div%3Anot(%5Bclass%5D)%20%3E%20ul%3Anot(%5Bclass%5D)%20%3E%20ul%3Anot(%5Bclass%5D)%20%7B%20%2F*%20site%20bug%3F%20*%2F%5Cn%20%20%20%20%20%20%20%20width%3A%20100%25%3B%5Cn%20%20%20%20%20%20%20%20margin-left%3A%200%3B%5Cn%20%20%20%20%20%20%20%20padding%3A%200%3B%5Cn%20%20%20%20%7D%5Cn%7D%5Cn%5Cn%2F*%20Add%20an%20invisible%20border%20as%20a%20placeholder%20for%20the%20score%20highlight%20*%2F%5Cn.theme-dark%20.GameWidget%20%7B%5Cn%20%20%20%20border%3A%203px%20solid%20black%3B%5Cn%7D%5Cn%5Cn.theme-light%20.GameWidget%20%7B%5Cn%20%20%20%20border%3A%203px%20solid%20white%3B%5Cn%7D%5Cn%5Cn%2F*%20Highlighting%20scoring%20events%20*%2F%5Cn.GameWidget.Scored%20%7B%5Cn%20%20%20%20border%3A%203px%20solid%20%23ffeb57%3B%5Cn%7D%5Cn%5Cn.Batting-Indicator%20%7B%5Cn%20%20%20%20display%3A%20inline-block%3B%5Cn%20%20%20%20width%3A%2020px%3B%5Cn%20%20%20%20margin-left%3A%205px%3B%5Cn%20%20%20%20margin-top%3A%20-100px%3B%5Cn%7D%5Cn%5Cn%2F*%20Remove%20team%20color%20from%20at-bat%20indicator%20*%2F%5Cn.theme-dark%20.Batting-Indicator%20%7B%5Cn%20%20%20%20fill%3A%20white%3B%5Cn%7D%5Cn%5Cn.theme-light%20.Batting-Indicator%20%7B%5Cn%20%20%20%20fill%3A%20black%3B%5Cn%7D%5Cn%5Cn.bbd-buttons%20%7B%5Cn%20%20%20%20font-size%3A%2032px%3B%5Cn%20%20%20%20position%3A%20fixed%3B%5Cn%20%20%20%20right%3A%200%3B%5Cn%20%20%20%20top%3A%200%3B%5Cn%20%20%20%20padding%3A%204px%3B%5Cn%7D%5Cn%5Cn.bbd-buttons%20button%20%7B%5Cn%20%20%20%20color%3A%20rgba(255%2C%20255%2C%20255%2C%200.25)%3B%5Cn%20%20%20%20line-height%3A%2040px%3B%5Cn%7D%5Cn%5Cn.bbd-buttons%20button%3Ahover%20%7B%5Cn%20%20%20%20color%3A%20white%3B%5Cn%7D%5Cn%20%20%20%20'%2Cn.head.appendChild(e)%7D)(document)%3B%7D)()%3B">Blaseball Dashboard</a>
        <p>Or just click this link to install it as a UserScript (requires Tampermonkey, etc.):
        <a href="blaseball-dashboard.user.js">Install Userscript</a>
        </p>
        <p>
            <h3>Changes in 0.2.2 (Published 2021-03-16) [UserScript Only]</h3>
            <ul>
                <li>Fixed horizontal scrollbar appearing on Firefox</li>
            </ul>
            <h3>Changes in 0.2.1 (Published 2021-03-16) [UserScript Only]</h3>
            <ul>
                <li>Fixed position of batting indicator</li>
            </ul>
            <h3>Changes in 0.2.0 (Published 2021-03-10)</h3>
            <ul>
                <li>Added widget size and full screen buttons. Full screen should allow all 12 games to be visible on a standard 1080p 16:9 monitor.</li>
                <li>Fixed reordering of game widgets. Games should now consistently stay in the same location for the duration of the day, and reset to the default order when the next day of games begins.</li>
                <li>Fixed initialization inconsistency. It was possible for the script to initialize but fail to subscribe to changes on the page properly, resulting in missing functionality. This should now be 100% reliable.</li>
            </ul>
        </p>
        <details>
            <summary style="cursor:pointer;">Expand to view the full code.<br/><br/>This is a small script that is purely clientside. It collects no information and makes no network requests except to download jQuery (from cdnjs, a trusted JavaScript CDN) and FontAwesome (a well known icons library).</summary>
            <pre><?= htmlspecialchars(file_get_contents('blaseball-dashboard.user.js')) ?></pre>
        </details>
        <p>go pies</p>
    </div>
    </div>
</body>
</html>
