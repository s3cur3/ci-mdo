
(function($) {
    "use strict";

    // Turn on the Bootstrap dropdowns
    $(".dropdown-toggle").dropdown();

    // Make sure the header doesn't get smashed up with the menu and social media buttons overlapping
    function showOrHideHeaderItems() {
        function hideSocialIfOverlapping() {
            function boxesAreOverlapping(box1, box2) {
                return box1.width >= 1 &&
                    box2.width >= 1 &&
                    box2.left < box1.right &&
                    box2.top < box1.bottom;
            }

            var socialBox = $(".post-nav");
            if(socialBox.length) {
                socialBox.show();
                var menuBounds = $(".navbar-nav")[0].getBoundingClientRect();
                var socialBounds = socialBox[0].getBoundingClientRect();
                var areOverlapping = boxesAreOverlapping(menuBounds, socialBounds);
                var searchBox = $(".nav-search");
                if(searchBox.length) {
                    var searchBounds = searchBox[0].getBoundingClientRect();
                    areOverlapping = areOverlapping || boxesAreOverlapping(searchBounds, socialBounds);
                }
                if(areOverlapping) {
                    socialBox.hide();
                } else {
                    socialBox.show();
                }
            }
        }
        function hideSearchIfTooWide() {
            function hideIfTooWide(element, optionalClassToRemove) {
                function isTooWide(postNav) {
                    var postNavWidth = postNav.is(':visible') ? postNav.outerWidth() : 0;
                    return $(".navbar-nav").outerWidth() + postNavWidth + 3 > $(".navbar-collapse").innerWidth();
                }
                var postNav = $(".post-nav");
                if(isTooWide(postNav)) {
                    element.hide();
                    if(optionalClassToRemove) {
                        postNav.removeClass(optionalClassToRemove);
                    }
                }
            }
            var search = $(".nav-search");
            var postNav = $(".post-nav");
            search.show();
            postNav.addClass("with-search");
            postNav.show();
            if($(window).width() >= 768 - 10) {
                hideIfTooWide(search, "with-search");
                hideIfTooWide(postNav);
            }
        }

        hideSocialIfOverlapping();
        hideSearchIfTooWide();
    }

    function enablePrettyPhoto() {
        // first, we add the rel="prettyPhoto[page_id]" to image galleries (since they aren't handled by our PHP regex)
        $(".gallery a.thumbnail").attr('rel', 'prettyPhoto[' + parseInt(post_id, 10) + ']');
        $("a[rel^='prettyPhoto']").prettyPhoto();
    }

    $(document).ready(showOrHideHeaderItems);
    $(document).ready(enablePrettyPhoto);
    $(window).resize(showOrHideHeaderItems);
})(jQuery);


