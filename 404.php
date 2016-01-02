<?php get_template_part('templates/page', 'header'); ?>

<div class="alert alert-warning">
  <?php _e('Sorry, but the page you were trying to view does not exist.', 'ci-modern-doctors-office'); ?>
</div>

<p><?php _e('It looks like this was the result of either:', 'ci-modern-doctors-office'); ?></p>
<ul>
  <li><?php _e('a mistyped address', 'ci-modern-doctors-office'); ?></li>
  <li><?php _e('an out-of-date link', 'ci-modern-doctors-office'); ?></li>
</ul>

<?php get_search_form(); ?>
