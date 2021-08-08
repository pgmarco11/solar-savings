(function($) {    
    $(window).ready(function() {
        var pageRefresh = 1000; //5 s
            setInterval(function() {
                $('#counter_kwh_total').load(location.href + " #counter_kwh_total > div");
                $('#counters').load(location.href + " #counters > div");
            }, pageRefresh);
        });
}(jQuery));