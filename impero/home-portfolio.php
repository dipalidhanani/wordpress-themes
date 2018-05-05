<div class="home_page_items home_page_portfolio group">
    <h3><?php echo yiw_get_option('portfolio_title') ?></h3>
    <h4><?php echo yiw_get_option('portfolio_subtitle') ?></h4>
    
    <?php
    $portfolio = new WP_Query( array(
        'post_type'      => 'bl_portfolio',
        'posts_per_page' => yiw_get_option('portfolio_items_home_page') * 1
    ) );
    
    $postsPerRow = (yiw_layout_page() != 'sidebar-no') ? 3 : 4;
    $i = 0;
    
    add_filter('excerpt_length', 'yiw_excerpt_length');
    add_filter( 'excerpt_more', 'yiw_excerpt_more' );
    remove_filter( 'the_excerpt', 'wpautop' );
    
    while( $portfolio->have_posts() ) : $portfolio->the_post(); ?>
        <?php $isFirstInRow = ( ++$i==1 | ($i % $postsPerRow) == 1 ) ? 1 : 0; ?>
        <?php $isLastInRow = ( ($i % $postsPerRow) == 0 ) ? 1 : 0; ?>

        <div class="home_page_item home_page_item_portfolio home_page_item_portfolio_<?php the_ID() ?>  <?php if($isFirstInRow): ?>home_page_item_first<?php endif ?><?php if($isLastInRow): ?>home_page_item_last<?php endif ?>">
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'thumb_home_page', array( 'class' => 'picture' ) ) ?></a>
            <h5><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a></h5>
            <?php the_terms( get_the_ID(), 'category-project', '<p class="categories">', ' & ', '</p>' ); ?>
        </div>
        <?php if($isLastInRow): ?><div class="clear"></div><?php endif ?>
    <?php 
        endwhile; 
        wp_reset_query(); 
        remove_filter('excerpt_length', 'yiw_excerpt_length');
        remove_filter( 'excerpt_more', 'yiw_excerpt_more' );
        add_filter( 'the_excerpt', 'wpautop' );
    ?>
</div>
