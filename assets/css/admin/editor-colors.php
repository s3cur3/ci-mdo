<?php
header("Content-type: text/css; charset: UTF-8");
define('WP_USE_THEMES', false);
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

$splash = get_option('splash_color');
$firm_name = get_option('firm_name_color');
$background = get_option('background_color');
$secondaryBG = get_option('secondary_background_color');
$backgroundImg = get_option("full_screen_image_bg");
$backgroundPattern = get_option("pattern_bg");
$btn = get_option('button_color');

// Correct weirdness from WP
if( $splash == "" ) $splash = "#428bca";
if( $firm_name == "" ) $firm_name = "#222222";
if( $background == "" ) $background = "#eeeeee";
if( $secondaryBG == "" ) $secondaryBG = "#222222";
if( $btn == "" ) $btn = "#428bca";

if( $splash[0] !== "#" ) $splash = "#" . $splash;
if( $firm_name[0] !== "#" ) $firm_name = "#" . $firm_name;
if( $background[0] !== "#" ) $background = "#" . $background;
if( $secondaryBG[0] !== "#" ) $secondaryBG = "#" . $secondaryBG;

?>
/* From editor-colors.php */
a {
    color: <?php echo $splash; ?>;
}

.inverted {
    background: <?php echo $secondaryBG; ?>;
    color: #fff;
}

a:hover, a:focus {
    color: <?php echo ciAdjustBrightness($splash, -30) ?>;
}
.btn-primary, input[type="submit"], button[type="submit"], .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
    color: #fff;
    position: relative;
    border-color: <?php echo $btn; ?>;
}
.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary, input[type="submit"]:hover, button[type="submit"]:hover, input[type="submit"]:focus, button[type="submit"]:focus, form input[type="submit"]:hover, form input[type="submit"]:focus,
.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt:focus, .woocommerce a.button.alt:focus, .woocommerce button.button.alt:focus, .woocommerce input.button.alt:focus, .woocommerce #respond input#submit.alt:active, .woocommerce a.button.alt:active, .woocommerce button.button.alt:active, .woocommerce input.button.alt:active {
    background-color: <?php echo $btn; ?>;
    border-color: <?php echo $btn; ?>;
}
.btn-primary:active, .btn-primary.active, .sidebar input[type="submit"]:active,
.woocommerce #respond input#submit.alt:active, .woocommerce a.button.alt:active, .woocommerce button.button.alt:active, .woocommerce input.button.alt:active {
    background-color: <?php echo ciAdjustBrightness($btn, -30) ?>;
    border-color: <?php echo ciAdjustBrightness($btn, -30) ?>;
}