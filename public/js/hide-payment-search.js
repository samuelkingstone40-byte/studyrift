(function() {
    var path = window.location.pathname;
    
    // Only hide on payment page
    if (path.includes("/make-payment") || path.includes("/payment")) {
        function hideSearch() {
            var elements = document.querySelectorAll("#search_text, #search_text2, #dropdown-search, #dropdown-search2");
            elements.forEach(function(el) {
                if (el) {
                    el.style.display = "none";
                    el.style.visibility = "hidden";
                    if (el.parentElement) {
                        el.parentElement.style.display = "none";
                    }
                }
            });
        }
        
        hideSearch();
        setTimeout(hideSearch, 100);
        
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", hideSearch);
        }
    }
})();
