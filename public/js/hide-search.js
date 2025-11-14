(function() {
    var path = window.location.pathname;
    
    // Show on homepage (default behavior)
    // Only hide if we are clearly NOT on homepage
    var isHomepage = (path === "/" || path === "" || path === "/index.html");
    
    if (!isHomepage) {
        function hideSearch() {
            var elements = ["#search_text", "#search_text2", "#dropdown-search", "#dropdown-search2"];
            elements.forEach(function(selector) {
                var el = document.querySelector(selector);
                if (el) {
                    el.style.display = "none !important";
                    el.style.visibility = "hidden !important";
                    // Hide parent container too
                    if (el.parentElement) {
                        el.parentElement.style.display = "none !important";
                    }
                }
            });
        }
        
        // Run multiple times to catch dynamically loaded elements
        hideSearch();
        setTimeout(hideSearch, 100);
        setTimeout(hideSearch, 500);
        
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", hideSearch);
        } else {
            hideSearch();
        }
    }
})();
