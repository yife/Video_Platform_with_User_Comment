<!-- Start of Woopra Code -->

function woopraReady(tracker) {
    tracker.setDomain('yife.info');
    tracker.setIdleTimeout(300000);
    tracker.trackPageview({type:'pageview',url:window.location.pathname+window.location.search,title:document.title});
    return false;
}
(function() {
    var wsc = document.createElement('script');
    wsc.src = document.location.protocol+'//static.woopra.com/js/woopra.js';
    wsc.type = 'text/javascript';
    wsc.async = true;
    var ssc = document.getElementsByTagName('script')[0];
    ssc.parentNode.insertBefore(wsc, ssc);
})();

<!-- End of Woopra Code -->