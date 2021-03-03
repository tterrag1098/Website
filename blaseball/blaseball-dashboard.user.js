// ==UserScript==
// @name         Blaseball Dashboard
// @namespace    https://tterrag.com/
// @version      0.1
// @description  A more compact and at-a-glance blaseball UI
// @author       tterrag
// @match        https://www.blaseball.com/*
// @grant        none
// ==/UserScript==

// Global variable for the observer so that we can kill and reinitialize if the script is run more than once
var _bbd_observer;
var ordering = new Map();

function loadObserver() {
    let config = { childList: true, subtree: true };

    let lastMutationTime = 0;
    let allFinished = false;
    let callback = function(mutationsList, observer) {
        // Don't run this callback more frequently than once every 500ms, avoids duplicate calls for modifications done by our code
        let time = Date.now();
        if (time - 500 < lastMutationTime) {
            return;
        }
        lastMutationTime = time;
        // Delay updates a bit or they can run before the DOM is updated
        setTimeout(function() {
            if (onLeaguePage()) {
                // Calculate the number of games that are finished by counting the "FINAL" labels
                let numFinished = $('.Widget-Status-Complete').length;
                if (numFinished == 10) {
                    allFinished = true;
                } else if (allFinished) {
                    // If all games were previously finished, this is a new slate of games, so we need to clear the ordering state
                    ordering.clear();
                }
            }

            // Update state of all widgets
            $(".GameWidget").each(function(idx) {
                updateWidget($(this), idx);
            });
        }, 50);
    };

    // Disable any old observer
    if (_bbd_observer) {
        _bbd_observer.disconnect();
    }

    // Run the callback initially to instantly apply the dashboard features
    callback(null, null);
    // Set up an observer to update the additions whenever the gamestate changes
    _bbd_observer = new MutationObserver(callback);
    _bbd_observer.observe($('.Main-Body')[0], config);
}

function updateWidget(widget, idx) {
    // Add highlight on score events
    if (widget.find(".Widget-Log-Score").text().length > 1) {
        widget.addClass("Scored");
    } else {
        widget.removeClass("Scored");
    }

    // Show on-bat indicator next to team name
    let status = widget.find('.Widget-Status--Live');
    widget.find('.Batting-Indicator').remove();
    if (status.length > 0) {
        let batting = widget.find('.Widget-Status--Live').text().substr(-1) == "▼" ? 1 : 0;
        widget.find('.GameWidget-ScoreLine').eq(batting).find('.GameWidget-ScoreName').append('<span class="Batting-Indicator">&nbsp;<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" x="0px" y="0px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve"><path d="M16.4,10.5l4.9-4.9c0.7-0.7,0.9-1.9,0.3-2.8c-0.8-1.1-2.3-1.2-3.2-0.3l-5,5c-1.7,1.7-5.3,7.1-7.5,9.3l-2.7,2.7  c-0.3-0.3-0.8-0.3-1.1,0l0,0c-0.3,0.3-0.3,0.8,0,1.1l1.1,1.1c0.3,0.3,0.8,0.3,1.1,0l0,0c0.3-0.3,0.3-0.8,0-1.1L7.1,18  C9.3,15.8,14.7,12.3,16.4,10.5z"></path><g><path d="M10,4.4C9.6,4.5,9.3,4.7,9,5C8.7,5.3,8.5,5.6,8.4,6C9.2,5.8,9.8,5.2,10,4.4z"></path><path d="M8.7,4.7C9.1,4.3,9.6,4.1,10,3.9C10,2.9,9.1,2,8.1,2C8,2.4,7.7,2.9,7.3,3.3C6.9,3.7,6.4,4,6,4.1C6,5.1,6.9,6,7.9,6   C8,5.6,8.3,5.1,8.7,4.7z"></path><path d="M7.6,2C6.8,2.2,6.2,2.8,6,3.6C6.4,3.5,6.7,3.3,7,3C7.3,2.7,7.5,2.4,7.6,2z"></path></g></svg></span>');
    }

    // Show play count on compact view
    let counter = widget.children('.Widget-Log').find('.Widget-Log-PlayCount').clone();
    widget.find('.Widget-Display-Body .Widget-Log-PlayCount').remove();
    widget.find('.Widget-Display-Body .Widget-Log').append(counter);

    // Color bet widget based on current score
    let bet = widget.find('.GameWidget-ScoreBet-Winnings');
    let line = bet.parents('.GameWidget-ScoreLine');
    let forscore = parseInt(line.find('.GameWidget-ScoreNumber').text());
    let againstscore = parseInt(line.siblings().find('.GameWidget-ScoreNumber').text());
    if (forscore < againstscore) {
        bet.css('background-color', '#c72222');
    } else if (forscore == againstscore) {
        bet.css('background-color', '#0c8eb1');
    } else {
        bet.css('background-color', '');
    }

    // Only fix order of live games
    if (onLeaguePage()) {
        // Best unique ID we have is the screen-reader name
        let id = widget.attr('aria-label');
        let order = idx;
        if (ordering.has(id)) {
            console.log("[" + id + "] Found existing order: " + ordering.get(id));
            order = ordering.get(id);
        } else {
            console.log("[" + id + "] Found new order: " + order);
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

((d,e) => {
    const script = document.createElement('script');
    // I know, I have a problem, deal with it
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js';
    document.head.appendChild(script);

    // Load active components
    script.addEventListener('load', loadObserver);

    // Add custom styles
    e = d.createElement("style");
    e.innerHTML = `
    /* This is all copied from the media query for the "mobile" look */
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

    /* Add a forced width and margin to widgets */
    .GameWidget {
        display: inline-block;
        width: 350px;
        margin: 2px;
    }

    /* Give hitter/pitcher names a little more room to breathe */
    .Widget-Display-Body {
        grid-template-columns: 100px auto;
    }

    /* The game list does not have any class or ID so we have to just select the exact ul element */
    .Main-Body > div:not([class]) > ul:not([class]) {
        /* Force the game list to 100% screen width */
        width: 100vw;
        margin-left: calc(-50vw + 509px); /* This inverses the padding on the parent div */

        /* Make the list of widgets a flexbox so that they fill available space */
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
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
        margin-left: 5px;
        margin-top: -100px;
    }

    /* Remove team color from at-bat indicator */
    .theme-dark .Batting-Indicator {
        fill: white;
    }

    .theme-light .Batting-Indicator {
        fill: black;
    }
    `;
    d.head.appendChild(e)
})(document)