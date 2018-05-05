<?php
/**
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

$latteParams['posts'] = WpLatte::createPostEntity($wp_query->posts);

WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();