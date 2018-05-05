<div class="home_page_items home_page_gallery group">
    <h3><?php echo yiw_get_option('gallery_title') ?></h3>
    <h4><?php echo yiw_get_option('gallery_subtitle') ?></h4>
    
    <?php
    $gallery = new WP_Query( array(
        'post_type'      => 'bl_gallery',
        'posts_per_page' => yiw_get_option('gallery_items_home_page') * 1
    ) );
    
    $postsPerRow = (yiw_layout_page() != 'sidebar-no') ? 3 : 4;
    $i = 0;

    while( $gallery->have_posts() ) : $gallery->the_post(); ?>
        <?php $isFirstInRow = ( ++$i==1 | ($i % $postsPerRow) == 1 ) ? 1 : 0; ?>
        <?php $isLastInRow = ( ($i % $postsPerRow) == 0 ) ? 1 : 0; ?>

        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
        <div class="home_page_item home_page_item_gallery home_page_item_gallery_<?php the_ID() ?> <?php if($isFirstInRow): ?>home_page_item_first<?php endif ?><?php if($isLastInRow): ?>home_page_item_last<?php endif ?>">
            <a href="<?php echo $image[0] ?>" rel="prettyPhoto[gallery]" class="thumb"><?php the_post_thumbnail( 'thumb_home_page', array( 'class' => 'picture' ) ) ?></a>
            <h5><?php the_title() ?></h5>
            <?php the_content() ?>
        </div>
        <?php if($isLastInRow): ?><div class="clear"></div><?php endif ?>
    <?php 
        endwhile; 
        wp_reset_query();
    ?>
</div>
