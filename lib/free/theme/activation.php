<?php
/**
 * Theme activation
 */
if (is_admin() && isset($_GET['activated']) && 'themes.php' == $GLOBALS['pagenow']) {
    wp_redirect(admin_url('themes.php?page=theme_activation_options'));
    exit;
}

function roots_theme_activation_options_init()
{
    register_setting(
        'roots_activation_options',
        'roots_theme_activation_options'
    );
}

add_action('admin_init', 'roots_theme_activation_options_init');

function roots_activation_options_page_capability($capability)
{
    return 'edit_theme_options';
}

add_filter('option_page_capability_roots_activation_options', 'roots_activation_options_page_capability');

function roots_theme_activation_options_add_page()
{
    $roots_activation_options = roots_get_theme_activation_options();

    if (!$roots_activation_options) {
        $theme_page = add_theme_page(
            __('Theme Activation', 'ci-modern-accounting-firm'),
            __('Theme Activation', 'ci-modern-accounting-firm'),
            'edit_theme_options',
            'theme_activation_options',
            'roots_theme_activation_options_render_page'
        );
    } else {
        if (is_admin() && isset($_GET['page']) && $_GET['page'] === 'theme_activation_options') {
            flush_rewrite_rules();
            wp_redirect(admin_url('themes.php'));
            exit;
        }
    }
}

add_action('admin_menu', 'roots_theme_activation_options_add_page', 50);

function roots_get_theme_activation_options()
{
    return get_option('roots_theme_activation_options');
}

function roots_theme_activation_options_render_page()
{
    ?>
    <div class="wrap">
        <h2><?php printf(__('%s Theme Activation', 'ci-modern-accounting-firm'), wp_get_theme()); ?></h2>

        <div class="update-nag">
            <?php _e('These settings are optional and should usually be used only on a fresh installation', 'ci-modern-accounting-firm'); ?>
        </div>
        <?php settings_errors(); ?>

        <form method="post" action="options.php">
            <?php settings_fields('roots_activation_options'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Create static front page?', 'ci-modern-accounting-firm'); ?>  (recommended)</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span><?php _e('Create static front page?', 'ci-modern-accounting-firm'); ?></span></legend>
                            <select name="roots_theme_activation_options[create_front_page]" id="create_front_page">
                                <option selected="selected" value="true"><?php echo _e('Yes', 'ci-modern-accounting-firm'); ?></option>
                                <option value="false"><?php echo _e('No', 'ci-modern-accounting-firm'); ?></option>
                            </select>

                            <p class="description"><?php printf(__('Create a page called Home and set it to be the static front page', 'ci-modern-accounting-firm')); ?></p>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Change permalink structure?', 'ci-modern-accounting-firm'); ?>  (recommended)</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span><?php _e('Update permalink structure?', 'ci-modern-accounting-firm'); ?></span></legend>
                            <select name="roots_theme_activation_options[change_permalink_structure]"
                                    id="change_permalink_structure">
                                <option selected="selected" value="true"><?php echo _e('Yes', 'ci-modern-accounting-firm'); ?></option>
                                <option value="false"><?php echo _e('No', 'ci-modern-accounting-firm'); ?></option>
                            </select>

                            <p class="description"><?php printf(__('Change permalink structure to /&#37;postname&#37;/', 'ci-modern-accounting-firm')); ?></p>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Create navigation menu?', 'ci-modern-accounting-firm'); ?> (recommended)</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span><?php _e('Create navigation menu?', 'ci-modern-accounting-firm'); ?></span></legend>
                            <select name="roots_theme_activation_options[create_navigation_menus]"
                                    id="create_navigation_menus">
                                <option selected="selected" value="true"><?php echo _e('Yes', 'ci-modern-accounting-firm'); ?></option>
                                <option value="false"><?php echo _e('No', 'ci-modern-accounting-firm'); ?></option>
                            </select>

                            <p class="description"><?php printf(__('Create the Primary Navigation menu and set the location', 'ci-modern-accounting-firm')); ?></p>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Add pages to menu?', 'ci-modern-accounting-firm'); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span><?php _e('Add pages to menu?', 'ci-modern-accounting-firm'); ?></span>
                            </legend>
                            <select name="roots_theme_activation_options[add_pages_to_primary_navigation]"
                                    id="add_pages_to_primary_navigation">
                                <option selected="selected" value="true"><?php echo _e('Yes', 'ci-modern-accounting-firm'); ?></option>
                                <option value="false"><?php echo _e('No', 'ci-modern-accounting-firm'); ?></option>
                            </select>

                            <p class="description"><?php printf(__('Add all current published pages to the Primary Navigation', 'ci-modern-accounting-firm')); ?></p>
                        </fieldset>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>

<?php
}

function roots_theme_activation_action()
{
    if (!($roots_theme_activation_options = roots_get_theme_activation_options())) {
        return;
    }

    if (strpos(wp_get_referer(), 'page=theme_activation_options') === false) {
        return;
    }

    if ($roots_theme_activation_options['create_front_page'] === 'true') {
        $roots_theme_activation_options['create_front_page'] = false;

        $default_pages = array('Home');
        $existing_pages = get_pages();
        $temp = array();

        foreach ($existing_pages as $page) {
            $temp[] = $page->post_title;
        }

        $pages_to_create = array_diff($default_pages, $temp);

        foreach ($pages_to_create as $new_page_title) {
            $home = <<<EOL
<div class="row mt30 mb30">
<div class="col-sm-8">
<h1>One of New York's Oldest Accounting Firms</h1>
For over 90 years, Sample &amp; Testing has helped clients with tax compliance, payroll, auditing, and more.

We act as trusted advisors to our clients, helping them achieve their goals and set even bigger ones for the future.

</div>
<div class="col-sm-4">
<h3>News</h3>
<ul>
	<li><a href="#">Sample &amp; Testing recognized as a top accounting firm</a></li>
	<li><a href="#">Another equally exciting news item here</a></li>
	<li><a href="#">A third placeholder news item</a></li>
	<li><a href="#">Final news item here</a></li>
</ul>
</div>
</div>
<h2>Our Practice Areas</h2>

<hr />

<div class="practicearea-insert">[practiceareas max=10 columns=4 length=100 /]</div>
<div class="inverted jumbo-band no-pad">
<h2><a class="btn btn-primary btn-lg alignright ml15" href="#">Contact our office now!</a>Schedule a free consult.</h2>
Our office is ready to help with your problems.

</div>
<h2>Meet Our CPAs</h2>

<hr />

<div class="attorneys-insert">

[staff columns=4 length=0 /]

</div>
&nbsp;
<h2>What Our Clients Say</h2>

<hr />

[testimonialswidget_widget random=true]

&nbsp;
EOL;



            $defaultPgToAdd = array(
                'post_title' => $new_page_title,
                'post_content' => $home,
                'post_status' => 'publish',
                'post_type' => 'page'
            );

            $result = wp_insert_post($defaultPgToAdd);
        }

        $home = get_page_by_title('Home');
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home->ID);

        $home_menu_order = array(
            'ID' => $home->ID,
            'menu_order' => -1
        );
        wp_update_post($home_menu_order);
    }

    if ($roots_theme_activation_options['change_permalink_structure'] === 'true') {
        $roots_theme_activation_options['change_permalink_structure'] = false;

        if (get_option('permalink_structure') !== '/%postname%/') {
            global $wp_rewrite;
            $wp_rewrite->set_permalink_structure('/%postname%/');
            flush_rewrite_rules();
        }
    }

    if ($roots_theme_activation_options['create_navigation_menus'] === 'true') {
        $roots_theme_activation_options['create_navigation_menus'] = false;

        $roots_nav_theme_mod = false;

        $primary_nav = wp_get_nav_menu_object('Primary Navigation');

        if (!$primary_nav) {
            $primary_nav_id = wp_create_nav_menu('Primary Navigation', array('slug' => 'primary_navigation'));
            $roots_nav_theme_mod['primary_navigation'] = $primary_nav_id;
        } else {
            $roots_nav_theme_mod['primary_navigation'] = $primary_nav->term_id;
        }

        $landing_nav = wp_get_nav_menu_object('Landing Page Navigation');

        if (!$landing_nav) {
            $landing_nav_id = wp_create_nav_menu('Landing Page Navigation', array('slug' => 'landing_navigation'));
            $roots_nav_theme_mod['landing_navigation'] = $landing_nav_id;
        } else {
            $roots_nav_theme_mod['landing_navigation'] = $landing_nav->term_id;
        }

        if ($roots_nav_theme_mod) {
            set_theme_mod('nav_menu_locations', $roots_nav_theme_mod);
        }
    }

    if ($roots_theme_activation_options['add_pages_to_primary_navigation'] === 'true') {
        $roots_theme_activation_options['add_pages_to_primary_navigation'] = false;

        $primary_nav = wp_get_nav_menu_object('Primary Navigation');
        $primary_nav_term_id = (int)$primary_nav->term_id;
        $menu_items = wp_get_nav_menu_items($primary_nav_term_id);

        if (!$menu_items || empty($menu_items)) {
            $pages = get_pages();
            foreach ($pages as $page) {
                $item = array(
                    'menu-item-object-id' => $page->ID,
                    'menu-item-object' => 'page',
                    'menu-item-type' => 'post_type',
                    'menu-item-status' => 'publish'
                );
                wp_update_nav_menu_item($primary_nav_term_id, 0, $item);
            }
        }
    }

    update_option('roots_theme_activation_options', $roots_theme_activation_options);
}

add_action('admin_init', 'roots_theme_activation_action');

function roots_deactivation()
{
    delete_option('roots_theme_activation_options');
}

add_action('switch_theme', 'roots_deactivation');
