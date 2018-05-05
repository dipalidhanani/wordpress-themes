<?php
/**
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

/**
 * Template Name: Full-width template
 */

$latteParams['post'] = WpLatte::createPostEntity($GLOBALS['wp_query']->post, array('meta' => $GLOBALS['pageOptions']));
$latteParams['post']->classes = implode(' ', get_post_class());

WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();