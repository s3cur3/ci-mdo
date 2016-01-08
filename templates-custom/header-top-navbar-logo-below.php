<?php
$navbarType = "static";
if(get_option('navbar_fixed', false)) {
    $navbarType = "fixed";
}
?>
<!-- CUSTOM HEADER-TOP-NAVBAR.PHP -->
<header class="banner navbar navbar-default navbar-<?php echo $navbarType; ?>-top" role="banner">
    <div class="header-container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <nav class="collapse navbar-collapse" role="navigation"> <?php
            $socialHTML = "";
            if(function_exists('ciGetSocialLinks') && get_option('social_in_nav', false)) {
                $socialHTML = ciGetSocialLinks();
            }

            $ecommerceHTML = get_option('ecommerce', false) ? "<div class=\"cart-btn\"><a class=\"fa fa-2x fa-shopping-cart\" href=\"/cart/\"></a></div>" : "";

            $additionalNavText = get_option('additional_menu_text', '');
            $has_search = get_option('search_in_nav', false);
            $additionalNavClass = "";
            if($socialHTML && !$additionalNavText && !$ecommerceHTML) {
                $additionalNavClass = "social-only";
            } elseif($additionalNavText && !($socialHTML || $ecommerceHTML)) {
                $additionalNavClass = "text-only";
            } elseif($additionalNavText && $socialHTML) {
                $additionalNavClass = "text-and-social";
            }
            if($has_search) {
                $additionalNavClass .= " with-search";
            } ?>
            <div class="post-nav <?php echo $additionalNavClass; ?>"><?php
                if($has_search) { ?>
                    <div class="nav-search">
                        <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                            <input type="text" name="s" placeholder="<?php echo esc_attr_x('SEARCH', 'search placeholder', 'ci-modern-doctors-office'); ?>">
                            <button type="submit" class="header-search-icon" name="submit" id="searchsubmit" value="<?php echo esc_attr_x('Search', 'submit button', 'ci-modern-doctors-office'); ?>">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div> <?php
                }
                echo $additionalNavText, $ecommerceHTML, $socialHTML; ?>
            </div> <?php
            if( has_nav_menu('primary_navigation') ) {
                wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
            } ?>
        </nav>
    </div>
</header>
<div class="container">
    <a class="navbar-brand logo-centered" href="<?php echo home_url(); ?>/"><?php echo ci_get_logo_html(); ?></a>
</div>
