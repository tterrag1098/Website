// ==UserScript==
// @name         Blaseball Dashboard
// @namespace    https://tterrag.com/
// @version      0.3.0-beta
// @description  A more compact and at-a-glance blaseball UI
// @author       tterrag
// @match        https://www.blaseball.com/*
// @grant        none
// ==/UserScript==

// Global variable for the observer so that we can kill and reinitialize if the script is run more than once
var _bbd_observer;
var ordering = new Map();

const battingIcon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" x="0px" y="0px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve"><path d="M16.4,10.5l4.9-4.9c0.7-0.7,0.9-1.9,0.3-2.8c-0.8-1.1-2.3-1.2-3.2-0.3l-5,5c-1.7,1.7-5.3,7.1-7.5,9.3l-2.7,2.7  c-0.3-0.3-0.8-0.3-1.1,0l0,0c-0.3,0.3-0.3,0.8,0,1.1l1.1,1.1c0.3,0.3,0.8,0.3,1.1,0l0,0c0.3-0.3,0.3-0.8,0-1.1L7.1,18  C9.3,15.8,14.7,12.3,16.4,10.5z"></path><g><path d="M10,4.4C9.6,4.5,9.3,4.7,9,5C8.7,5.3,8.5,5.6,8.4,6C9.2,5.8,9.8,5.2,10,4.4z"></path><path d="M8.7,4.7C9.1,4.3,9.6,4.1,10,3.9C10,2.9,9.1,2,8.1,2C8,2.4,7.7,2.9,7.3,3.3C6.9,3.7,6.4,4,6,4.1C6,5.1,6.9,6,7.9,6   C8,5.6,8.3,5.1,8.7,4.7z"></path><path d="M7.6,2C6.8,2.2,6.2,2.8,6,3.6C6.4,3.5,6.7,3.3,7,3C7.3,2.7,7.5,2.4,7.6,2z"></path></g></svg>'
const coinsIcon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="128" height="128" viewBox="0 0 256 256" style="width: 20px; height: 20px;"><image id="coins" x="15.5" y="51" width="225" height="154" xlink:href="data:img/png;base64,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"></image></svg>'

function initialize() {
    if ($('script#sprintf').length == 0) {
        let sprintf = document.createElement('script');
        sprintf.type = 'text/javascript';
        sprintf.addEventListener('load', initialize);
        sprintf.id = 'sprintf';
        sprintf.src = 'https://cdnjs.cloudflare.com/ajax/libs/sprintf/1.1.2/sprintf.min.js';
        document.head.appendChild(sprintf);
        return;
    }

    let attach = $('.Main')[0];
    if (!attach) {
        // Wait for site load
        setTimeout(initialize, 50);
        return;
    }

    console.log("Initializing Blaseball Dashboard");

    $('head').append($('<script src="https://kit.fontawesome.com/e7e5187ceb.js" crossorigin="anonymous">'));

    let lastMutationTime = 0;
    let allFinished = false;
    let callback = function(mutationsList, observer) {
        // Don't run this callback more frequently than once every 500ms, avoids duplicate calls for modifications done by our code
        let time = Date.now();
        if (time - 500 < lastMutationTime) {
            return;
        }
        lastMutationTime = time;
        console.log("[Blaseball Dashboard] Refreshing widgets");
        
        // Update widget bar
        
        let widgetBar = $('.bbd-widget-bar');
        if (widgetBar.length == 0) {
            widgetBar = $('<div class="bbd-widget-bar">');
            widgetBar.insertBefore($('.Main-Body > div:not([class]) > ul:not([class]), .Main-Body > div:not([class]) > div:not([class]) > ul:not([class]) > ul:not([class])'));
            widgetBar.append($('<div class="bbd-widget bets-widget">'));

            let buttons = $('<div class="bbd-widget bbd-buttons">');
            widgetBar.append(buttons);

            let sizeBtn = $('<button class="size-btn" title="Toggle Widget Size"><i class="fas fa-th-large"></i></button>');
            buttons.append(sizeBtn);
            sizeBtn.click(function() {
                let body = $('body');
                body.toggleClass('large-widgets');
                let icon = sizeBtn.find('i');
                if (body.hasClass('large-widgets')) {
                    icon.removeClass('fa-th-large').addClass('fa-th');
                } else {
                    icon.addClass('fa-th-large').removeClass('fa-th');
                }
            });

            let fullscreenBtn = $('<button class="fullscreen-btn" title="Toggle Fullscreen"><i class="fas fa-expand"></i></button>');
            buttons.append(fullscreenBtn);
            fullscreenBtn.click(function() {
                let icon = fullscreenBtn.find('i');
                if (isInFullScreen()) {
                    cancelFullScreen();
                    icon.removeClass('fa-compress').addClass('fa-expand');
                    $('nav').css('position', '');
                } else {
                    requestFullScreen();
                    icon.addClass('fa-compress').removeClass('fa-expand');
                    window.scrollTo(0, $(".League-Countdown").offset().top + 10);
                    $('nav').css('position', 'relative');
                }
            });
        }

        // Delay updates a bit or they can run before the DOM is updated
        setTimeout(function() {
            let games = getGameData();

            updateBets(games);

            if (onLeaguePage()) {
                // Calculate the number of games that are finished by counting the "FINAL" labels
                let numFinished = games.filter(g => !g.live).length;
                console.log("Finished games: " + numFinished + "   All finished? " + allFinished);
                if (numFinished == games.length) {
                    console.log("[Blaseball Dashboard] All games finished");
                    allFinished = true;
                } else if (allFinished) {
                    // If all games were previously finished, this is a new slate of games, so we need to clear the ordering state
                    console.log("[Blaseball Dashboard] Clearing saved widget ordering");
                    ordering.clear();
                    allFinished = false;
                }
            }

            // Update state of all widgets
            games.forEach(updateGame);
        }, 50);
    };

    // Disable any old observer
    if (_bbd_observer) {
        console.log("[Blaseball Dashboard] Disconnecting old observer");
        _bbd_observer.disconnect();
    }

    // Run the callback initially to instantly apply the dashboard features
    callback(null, null);
    // Set up an observer to update the additions whenever the gamestate changes
    _bbd_observer = new MutationObserver(callback);

    let config = { childList: true, subtree: true };
    console.log("[Blaseball Dashboard] Attaching observer");
    // console.log($(attach));
    _bbd_observer.observe(attach, config);
}

function updateBets(games) {
    let betWidget = $('.bets-widget');

    let totalPaid = 0, paidLive = 0, paidFinished = 0;
    let currentWinnings = 0;
    let totalWinnings = 0;
    for (var i = 0; i < games.length; i++) {
        if (games[i].bet) {
            totalPaid += games[i].bet.amount;
            if (games[i].live) {
                paidLive += games[i].bet.amount;
            } else {
                paidFinished += games[i].bet.amount;
            }
            if (games[i].bet.status == BetStatus.PAID) {
                totalWinnings += games[i].bet.winnings;
            } else if (inTheMoney(games[i].bet.status)) {
                currentWinnings += games[i].bet.winnings;
            }
        }
    }

    betWidget.empty();
    if (totalPaid > 0) {
        betWidget.append(createBetPill(totalPaid).prepend('Paid: '));

        if (onLeaguePage()) {
            let unrealizedPL = currentWinnings - paidLive;
            let realizedPL = totalWinnings - paidFinished;

            // betWidget.append(betPill);
            if (paidLive > 0) {
                betWidget.append(createBetPill(paidLive, currentWinnings, unrealizedPL > 0 ? BetStatus.ITM : unrealizedPL == 0 ? BetStatus.TIED : BetStatus.OTM).prepend('Unrealized: '));
            }
            if (paidFinished > 0) {
                betWidget.append(createBetPill(paidFinished, totalWinnings, realizedPL > 0 ? BetStatus.ITM : realizedPL == 0 ? BetStatus.TIED : BetStatus.OTM).prepend('Realized: '));
            }
                // "Paid: %d | Unrealized: %d (%.2f%%) | Realized: %d (%.2f%%)",
                // totalPaid, unrealizedPL, 100 * (unrealizedPL / totalPaid), realizedPL, 100 * (realizedPL / totalPaid)));
        }
    } else {
        betWidget.append($('<div>No Bets!</div>'));
    }
}

function createBetPill(input, output, status) {
    if (status === undefined) status = BetStatus.ITM;
    let pill = $('<div class="GameWidget-ScoreBet" role="text">');
    let bet = $('<div class="GameWidget-ScoreBet-Bet">');
    bet.append($(coinsIcon + '<div class="GameWidget-ScoreBet-Amount"><div class="sr-only" role="text" aria-label="You Bet "></div>' + input + '</div></div>'));
    pill.append(bet);

    if (output !== undefined) {
        let winnings = $('<div class="GameWidget-ScoreBet-Winnings">');
        winnings.append($('<div class="GameWidget-ScoreBet-Triangle"></div><div class="sr-only" role="text" aria-label="To Win "></div>' + output + '</div></div>'));
        setBetColor(winnings, status);
        pill.append(winnings);
    } else {
        bet.addClass('no-winnings');
    }
    return pill;
}

const BetStatus = Object.freeze({
    /** 
     * 3 bit field, where the bits in order (from least significant) represent:
     *   - "In the money" status
     *   - Game completion status
     *   - Tied
     * 
     * Thus a value of 3 (PAID) = 0b011, which represents an un-tied game that is complete and also in the money
     */ 
    OTM: 0,
    ITM: 1,
    COMPLETE: 2,
    TIED: 4,
    PAID: 1 | 2,
    LOST: 2,
});

function inTheMoney(status) {
    return (status & BetStatus.ITM) > 0;
}

function outOfTheMoney(status) {
    return (status & BetStatus.TIED) == 0 && !inTheMoney(status);
}

function setBetColor(element, status) {
    if (outOfTheMoney(status)) {
        element.css('background-color', '#c72222');
    } else if ((status & BetStatus.TIED) > 0) {
        element.css('background-color', '#0c8eb1');
    } else {
        element.css('background-color', '');
    }
}

/**
 * Game[]
 *   id: string
 *   element: jQuery
 *   live: boolean
 *   participants: Participant[]
 *     team: string
 *     score: float
 *   bet: Bet?
 *     team: int (0 or 1)
 *     amount: int
 *     winnings: int
 *     status: BetStatus
 */
function getGameData() {
    let games = [];
    $('.GameWidget').each(function(i) {
        let widget = $(this);
        let status = widget.find('.Widget-Status');
        let game = {
            index: i,
            id: widget.attr('aria-label'),
            element: widget,
            live: !status.hasClass('Widget-Status--Complete'),
            participants: []
        };
        widget.find('.GameWidget-ScoreLine').each(function(j) {
            let participant = $(this);
            game.participants.push({
                team: participant.find('.GameWidget-ScoreName').text(),
                score: parseFloat(participant.find('.GameWidget-ScoreNumber').text()),
            })

            let bet = participant.find('.GameWidget-ScoreBet');
            if (bet.length > 0) {
                game.bet = {
                    team: j,
                    amount: parseInt(bet.find('.GameWidget-ScoreBet-Amount').text()),
                    winnings: parseInt(bet.find('.GameWidget-ScoreBet-Winnings').text())
                };
            }
        });
        games.push(game);
    });
    for (i = 0; i < games.length; i++) {
        let game = games[i];
        let bet = game.bet;
        if (bet) {
            let betScore = game.participants[bet.team].score;
            let opponentScore = game.participants[1 - bet.team].score;

            if (!game.live) bet.status |= BetStatus.COMPLETE;

            if (betScore > opponentScore) bet.status |= BetStatus.ITM;
            else if (betScore == opponentScore) bet.status |= BetStatus.TIED;
        } else {
            bet = game.element.find('.GameWidget-UpcomingBet');
            if (bet.length > 0) {
                game.bet = {
                    team: 0,
                    amount: parseInt(bet.text()),
                    winnings: 0,
                    status: BetStatus.OTM,
                }
            }
        }
    }
    return games;
}

function updateGame(game) {
    //console.log("[Blaseball Dashboard] Updating widget #" + idx);
    // Add highlight on score events
    let widget = game.element;
    if (widget.find(".Widget-Log-Score").text().length > 1) {
        widget.addClass("Scored");
    } else {
        widget.removeClass("Scored");
    }

    // Show on-bat indicator next to team name
    let status = widget.find('.Widget-Status--Live, .Widget-Status--Shame');
    widget.find('.Batting-Indicator').remove();
    if (status.length > 0) {
        let batting = status.text().substr(-1) == "▼" || status.is('.Widget-Status--Shame') ? 1 : 0;
        widget.find('.GameWidget-ScoreLine').eq(batting).find('.GameWidget-ScoreName').append($('<span class="Batting-Indicator">&nbsp;</span>').append($(battingIcon)));
    }

    // Show play count on compact view
    let counter = widget.children('.Widget-Log').find('.Widget-Log-PlayCount').clone();
    widget.find('.Widget-Display-Body .Widget-Log-PlayCount').remove();
    widget.find('.Widget-Display-Body .Widget-Log').append(counter);

    // Color bet widget based on current score
    let bet = widget.find('.GameWidget-ScoreBet-Winnings');
    if (bet.length > 0 && game.bet) {
        setBetColor(bet, game.bet.status);
    }

    // Only fix order of live games
    if (onLeaguePage()) {
        // Best unique ID we have is the screen-reader name
        let id = game.id;
        let order = game.index;
        if (ordering.has(id)) {
            //console.log("[" + id + "] Found existing order: " + ordering.get(id));
            order = ordering.get(id);
        } else {
            //console.log("[" + id + "] Found new order: " + order);
            ordering.set(id, order);
        }
        // Force the saved order so that games don't shuffle around when they complete
        widget.css('order', order);
    } else {
        widget.css('order', ''); // Otherwise remove this so that it uses the default order on the betting page etc.
    }
}

function onLeaguePage() {
    return window.location.href.indexOf('/league') > 0;
}

function cancelFullScreen() {
    var el = document;
    var requestMethod = el.cancelFullScreen || el.webkitCancelFullScreen || el.mozCancelFullScreen || el.exitFullscreen || el.webkitExitFullscreen;
    return requestMethod.call(el);
}

function requestFullScreen() {
    var el = document.documentElement;
    var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;
    return requestMethod.call(el);
}

function isInFullScreen() {
    return (document.fullScreenElement || document.mozFullScreen || document.webkitIsFullScreen);
}

((d,e) => {
    const script = document.createElement('script');
    // I know, I have a problem, deal with it
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js';
    document.head.appendChild(script);

    // Load active components
    script.addEventListener('load', initialize);

    // Add custom styles
    e = d.createElement("style");
    e.innerHTML = `
/* This is all copied from the media query for the "mobile" look */
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
    width: 100%;
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
/* End copied code */

/* Tighten up some margins/padding to free up space */
.Widget-Display-Visual {
    padding: 0 0 0 10px;
}

.Widget-ScoreBacking {
    padding: 10px 0 0 0;
}

.Widget-Outs {
    padding: 0 0 10px 0;
}

.Widget-Display-Body .Widget-Log {
    min-height: 75px;
}

/* Fix maximum blaseball display */
.Widget-Display-Visual-Max {
    margin-top: 24px !important;
}

/* Hack to remove horizontal scrolling on Firefox */
body {
    overflow-x: hidden;
}

/* Add a forced width and margin to widgets */
.GameWidget {
    display: inline-block;
    min-width: 350px;
    max-width: 450px;
    margin: 2px;
    flex: 1 1 0;
}

.large-widgets .GameWidget {
    min-width: 450px;
}

/* Give hitter/pitcher names a little more room to breathe */
.Widget-Display-Body {
    grid-template-columns: 100px auto;
}

/* The game list does not have any class or ID so we have to just select the exact element */
.Main-Body > div:not([class]),
.Main-Body > div:not([class]) > div:not([class]) { /* site bug? */
    /* Force the game list to 100% screen width */
    width: 100vw;
    margin-left: calc(-50vw + 509px); /* This inverses the padding on the parent div */
    padding-left: 15px;
    padding-right: 10px;
}

.Main-Body > div:not([class]) > ul:not([class]),
.Main-Body > div:not([class]) > div:not([class]) > ul:not([class]) > ul:not([class]) {
    /* Make the list of widgets a flexbox so that they fill available space */
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

@media (max-width: 1080px) {

    /* Unapply forced width on mobile layout */
    .Main-Body > div:not([class]),
    .Main-Body > div:not([class]) > div:not([class]) { /* site bug? */
        width: 100%;
        margin-left: 0;
        padding: 0;
    }
}

/* Add an invisible border as a placeholder for the score highlight */
.theme-dark .GameWidget {
    border: 3px solid black;
}

.theme-light .GameWidget {
    border: 3px solid white;
}

/* Highlighting scoring events */
.GameWidget.Scored {
    border: 3px solid #ffeb57;
}

.Batting-Indicator {
    display: inline-block;
    width: 20px;
    line-height: 0;
    margin-left: 5px;
}

/* Remove team color from at-bat indicator */
.theme-dark .Batting-Indicator {
    fill: white;
}

.theme-light .Batting-Indicator {
    fill: black;
}

.bbd-buttons {
    font-size: 32px;
}

.bbd-buttons button {
    color: rgba(255, 255, 255, 0.25);
    line-height: 0;
}

.bbd-buttons button:hover {
    color: white;
}

.bbd-widget-bar {
    font-family: "Lora","Courier New",monospace,serif;
    display: flex;
    text-align: center;
    max-width: max-content;
    margin: 0 auto;
    margin-bottom: 5px;
}

.bbd-widget {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    max-width: max-content;
    background-color: #171717;
    padding: 5px;
    margin: 0 5px;
    border-radius: 5px;
}

.bbd-widget.bets-widget > * {
    margin: 0 8px;
    display: flex;
    align-items: center;
}

.bbd-widget.bets-widget > .GameWidget-ScoreBet > .GameWidget-ScoreBet-Bet {
    margin-left: 5px;
}

.bbd-widget.bets-widget .GameWidget-ScoreBet-Bet.no-winnings {
    padding-right: 10px;
    border-radius: 20px;
}
    `;
    d.head.appendChild(e)
})(document)
