<?php
function ait_gridgalleryb( $params ) {
    extract( shortcode_atts( array (
        'slug' => 'all',
        'cols' => '5',
        'count' => '15',
        'category' => '0',
        'display' => 'detail',
        'showfilter' => true,
        'order' => 'chronological',
        'height' => 'auto',
        'descheight' => '50',
        'description' => '0'
    ), $params ) );

  $categories = array();
  $portfolio_categories = get_categories( array( 'taxonomy' => 'ait-grid-portfoliob-category', 'orderby' => 'menu_order', 'order' => 'ASC'));
  $portfolio_cats = array();
  if($category == '0'){
    $args = array( 'numberposts' => 500 , 'cat' => $category , 'post_type' => 'ait-grid-portfoliob', 'orderby' => 'menu_order', 'order' => 'ASC' );
    $portfolio_images = get_posts($args);
  } else {
    $categories = explode(", ",$category);
    $portfolio_images = array();
    foreach($categories as $cat){
      /* IMAGE RESOLVING */
      $args = array( 'post_type' => 'ait-grid-portfoliob', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 500, 'tax_query' => array( array( 'taxonomy' => 'ait-grid-portfoliob-category', 'field' => 'id', 'terms' => $cat) ) );
      foreach(get_posts($args) as $cPost){
        $portfolio_images[$cPost->ID] = $cPost;
      }
      /* IMAGE RESOLVING */

      /* CATEGORY RESOLVING */
      foreach($portfolio_categories as $pCat){
        if($cat == $pCat->cat_ID){
          array_push($portfolio_cats,$pCat);
        }
      }
      /* CATEGORY RESOLVING */
    }
    $portfolio_categories = $portfolio_cats;
  }

  $result = '';

	$click = '';
	switch($display)
  {
    case 'direct':
      $click = 'item-direct';
    break;
    case 'fancybox':
      $click = 'item-fancybox';
    break;
  }

	if($portfolio_images){
	  $style = "display: block; visibility: hidden";
    switch($cols){
      case 5:
        if($description){
          $result .= '<div class="portfolio clearfix five gridgallery '.$click.' with-description">';
        } else {
          $result .= '<div class="portfolio clearfix five gridgallery '.$click.'">';
        }
      break;
      case 4:
        if($description){
          $result .= '<div class="portfolio clearfix four gridgallery '.$click.' with-description">';
        } else {
          $result .= '<div class="portfolio clearfix four gridgallery '.$click.'">';
        }
      break;
      case 3:
        if($description){
          $result .= '<div class="portfolio clearfix three gridgallery '.$click.' with-description">';
        } else {
          $result .= '<div class="portfolio clearfix three gridgallery '.$click.'">';
        }
      break;
    }
    $result .= '<div id="portfolio-loader" style="position: absolute; top: 35%; left: 50%"><img src="'.THEME_IMG_URL.'/loader2.gif" width="50" height="50" alt="loader" title="" /></div>';

    if($showfilter){
      /* SORTING MENU */
      if(strlen($category) > 1 || $category == 0){
        $result .= '<ul id="filterOptions" class="port-cat categories clearfix"  style="'.$style.'">';
        $result .= '<li class="active"><a href="#" class="all">All</a></li>';
        if($portfolio_categories){
          foreach($portfolio_categories as $category){
            $result .= '<li><a href="#" class="cat-'.$category->slug.'">'.$category->name.'</a></li>';
          }
        }
        $result .= '</ul>';
        $result .= '<a href="#" class="port-cat icon"  style="'.$style.'"><!-- This is ICON! --></a>';
      }
      /* SORTING MENU */
    }

    /* TILE COUNTING */
    $i = 0;
    $result .= '<div class="ulHolder" style="'.$style.'">';
    $height = 'auto';
    if($height == 'auto'){
      $result .= '<div id="gridgallery-setting-height" style="display: none">auto</div>';
    } else {
      $result .= '<div id="gridgallery-setting-height" style="display: none">'.$height."</div>";
    }

    $result .= '<div class="portfolioHolder"><ul class="ourHolder clearfix">';

    switch($order){
      case 'chronological':
      break;
      case 'newest':
      $portfolio_images = array_reverse($portfolio_images);
      break;
      case 'random':
      shuffle($portfolio_images);
      break;
    }

    foreach($portfolio_images as $counter=>$item){
      $itemCats = get_the_terms( $item->ID, 'ait-grid-portfoliob-category' );
      $itemCategories = "";
      foreach($itemCats as $itemCat){
        $itemCategories .= "cat-".$itemCat->slug." ";
      }
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $item->ID ), 'single-post-thumbnail' );
      if($i < $count)
      {
        global $wpdb;
        $sql = "SELECT meta_value FROM ".$wpdb->prefix."postmeta WHERE post_id=".$item->ID." AND meta_key LIKE '%_ait%'";
        $itemMeta = $wpdb->get_results($sql);
        $itemMetaValue = unserialize($itemMeta[0]->meta_value);

        if($itemMetaValue['itemType'] == NULL){$itemMetaValue['itemType']='image';}
        $result .= '<li class="item left tile-'.$i.' '.$itemCategories.' itemType-'.$itemMetaValue['itemType'].'" data-id="id-'.$i.'">';

        $bigImageAlignment = "";

        if($image){
          switch($itemMetaValue['itemType']){
            case 'image':

              if($display == 'fancybox'){
                $result .= '<div class="tile" style="display: none" data-bigimg="'.$image[0].'"><div class="tileWrap" style="overflow: hidden">'.AitImageResizer::resize($image[0], array('w' => 250, 'h' => 250)).'</div><span class="gridgallery-icon"><a class="tileImage" href="'.$image[0].'">';
              } else {
                $result .= '<div class="tile" style="display: none" data-bigimg="'.$image[0].'"><div class="tileWrap" style="overflow: hidden">'.AitImageResizer::resize($image[0], array('w' => 250, 'h' => 250)).'</div><span class="gridgallery-icon"><a class="tileImage" href="'.get_permalink( $item->ID ).'">';
              }
            break;
            case 'website':
                $result .= '<div class="tile" style="display: none" data-bigimg="'.$image[0].'"><div class="tileWrap" style="overflow: hidden">'.AitImageResizer::resize($image[0], array('w' => 250, 'h' => 250)).'</div><span class="gridgallery-icon"><a class="tileImage" href="'.$itemMetaValue['websiteLink'].'">';
            break;
            case 'video':
              if($display == 'fancybox'){
                $result .= '<div class="tile" style="display: none" data-bigimg="'.$image[0].'"><div class="tileWrap" style="overflow: hidden">'.AitImageResizer::resize($image[0], array('w' => 250, 'h' => 250)).'</div><span class="gridgallery-icon"><a class="tileImage" href="'.$itemMetaValue['videoLink'].'">';
              } else {
                $result .= '<div class="tile" style="display: none" data-bigimg="'.$image[0].'"><div class="tileWrap" style="overflow: hidden">'.AitImageResizer::resize($image[0], array('w' => 250, 'h' => 250)).'</div><span class="gridgallery-icon"><a class="tileImage" href="'.get_permalink( $item->ID ).'">';
              }
            break;
          }

          $result .= '<span class="about">';
          $result .= '<span class="about-title">'.$item->post_title.'</span>';
            $itemCats = get_the_terms( $item->ID, 'ait-grid-portfoliob-category' );
            $itemCategories = "";
            foreach($itemCats as $itemCat){
              $itemCategories .= $itemCat->name." ";
            }
          $result .= '<span class="about-category">'.$itemCategories.'</span>';
          $result .= '</span>';
          $result .= '</a></span>';
          $result .= '</div>';

          if($description == '1'){
            $descText = $itemMetaValue['itemDescription'];
            $result .= '<div class="tile-desc-wrap"><div class="tile-desc" style="height: '.$descheight.'; margin-right: 0px; overflow: hidden"><h3 class="tile-desc-title">'.$item->post_title.'</h3><p class="tile-desc-cont" style="margin: 0px; padding: 0px;">'.$descText.'</p></div></div>';
          }
        }
        $result .= '</li>';
      }
      $i++;
    }

    $result .= '</ul></div>';
    $result .= '</div>';
    $result .= '</div>';
    /* TILE COUNTING */

  } else {
    $result = '<h2>Insert images into the portfolio</h2>';
  }

  return $result;
}
add_shortcode( "ait-gridgallery", "ait_gridgalleryb" );