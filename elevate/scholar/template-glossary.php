<?php
/**
 * Template Name: Glossary Template
 *
 * Here we setup all logic and HTML that is required for the index template, used as both the homepage
 * and as a fallback template, if a more appropriate template file doesn't exist for a specific context.
 *
 * @package WooFramework
 * @subpackage Template
 */

get_header(); ?>
<script>
function submitfrm(){
	document.getElementById('frmsrch').submit();
	}
</script>
<style>
.download_btn{
	    border-radius: 20px 20px 20px 20px !important;
		border: none !important;
		text-align: center;
    text-shadow: rgba(0, 0, 0,.1) 0px 1px 1px;
    font-size: 13px;
    color: #fff !important;
    font-weight: 600;
    padding: 6px 24px !important;
	background-color: #70c9d1 !important;
	float:right;
		
	}
</style>

    <div id="content">
    	<div class="outer-wrapper">
        	<div class="col-full">
            	<?php $attid = get_post_meta(7868, 'file_upload', true);
				
				$attachment_id = $attid; // ID of attachment
$attachment_page = get_attachment_link( $attachment_id ); 

?>
				
                <!--left section start-->
                <div class="glossary-left" >
                	<h1 style="float: left;">Glossary</h1> <a class="download_btn" href="<?php echo get_the_guid( $attachment_id ); ?>" target="_blank">Download</a>
                    <h2 style="clear: both;"><?php echo $_GET['alpha']; ?></h2>
                    <ul class="glossary-list" style="float: left;">
                    <?php
					
				//	echo "sea999r5ch:".$_REQUEST['srchdrp'];
				
$type = 'glossary';
$args=array(
  'post_type' => $type,
  'post_status' => 'publish',
  'posts_per_page' => -1, 
  'caller_get_posts'=> 1,
  'orderby' => 'title',
  'order' => 'ASC'
  );
  
 $search_terms = isset( $_REQUEST['srch'] ) ? urldecode( $_REQUEST['srch'] ) : '';
  
  if (( $_REQUEST['srch'] != '') ) { //echo 'test';
    $args['s'] = $search_terms;
	}
	
	//print_r($args);


$my_query = null;
$my_query = new WP_Query($args);
 $mam_global_where = '';  // Turn off filter
if( $my_query->have_posts() ) {
  while ($my_query->have_posts()) { $my_query->the_post();
  
  global $post;
 $mykey_values = get_post_custom_values( 'course_module', $post->ID );
//$meta_abc = unserialize($ttt);
 foreach ( $mykey_values as $key => $value ) {
   // echo "$key  => $value<br />"; 
	$meta_abc = unserialize($value);	
  }
  
  //echo $_REQUEST['alpha']."fc:".substr(get_the_title(), 0, 1);
  
// echo "loop:".$_REQUEST['srchdrp'];
  
  if(($_REQUEST['srchdrp'] != '')){
	   
	 //  echo "in fir";
  if (in_array($_REQUEST['srchdrp'], $meta_abc))
  {//echo "in sec";
   ?>
   <li><h3><?php the_title(); ?></h3>
    <p><?php the_content(); ?></p>
    
   <?php 
 
 $i = 0; ?>
  <p class="tagLink">
 <?php
foreach($meta_abc as $abc){
 $term = get_term( $meta_abc[$i], 'module' ); ?>
<a href="/elevate/glossary/?srchdrp=<?php echo $term->term_id; ?>">
 <?php
 echo $term->name; ?>
 </a> <?php  if(count($meta_abc) != $i+1){ ?><span class="sapa">,</span><?php } ?>
<?php $i++;}

   ?>
</p>
   </li>
    <?php
  } }
  elseif(isset($_GET['alpha'])){ 
  if(substr(get_the_title(), 0, 1) == $_GET['alpha']){
 // echo "keyword:".$_REQUEST['alpha']."-".substr(get_the_title(), 0, 1); ?>
  
   <li><h3><?php the_title(); ?></h3>
    <p><?php the_content(); ?></p>
    
   <?php 
 
 $i = 0; ?>
  <p class="tagLink">
 <?php
foreach($meta_abc as $abc){
 $term = get_term( $meta_abc[$i], 'module' ); ?>
<a href="/elevate/glossary/?srchdrp=<?php echo $term->term_id; ?>" >
 <?php
 echo $term->name; ?>
 </a> <?php  if(count($meta_abc) != $i+1){ ?><span class="sapa">,</span><?php } ?>
<?php $i++;}

   ?>
</p>
   </li>
   
   <?php
  }
  }
  elseif(($_REQUEST['srchdrp'] == '-1') || ($_REQUEST['srchdrp'] == '')){ //echo "else";
	  ?>
	     <li><h3><?php the_title(); ?></h3>
    <p><?php the_content(); ?></p>
    
   <?php 
 
 $i = 0; ?>
  <p class="tagLink">
 <?php
foreach($meta_abc as $abc){
 $term = get_term( $meta_abc[$i], 'module' ); ?>
<a href="/elevate/glossary/?srchdrp=<?php echo $term->term_id; ?>">
 <?php
 echo $term->name; ?>
 </a> <?php  if(count($meta_abc) != $i+1){ ?><span class="sapa">,</span><?php } ?>
<?php $i++;}

   ?>
</p>
   </li>
	  
	<?php  }
  }
}
wp_reset_query();  // Restore global post data stomped by the_post().
?>
                    
                    </ul>
                </div>
                <!--left section end-->
                
                
                <!--right section start-->
                <div class="glossary-right">
                	<div class="glos-search">
                    	<form method="post" id="frmsrch" action="/elevate/glossary/">
                         <?php 
							$taxonomies=get_terms( 'module', 'orderby=menu_order&hide_empty=0' );
							
							 ?>
                        	<div class="list-box-searchModule">
                           
                            	<select name="srchdrp" id="srchdrp" onchange="submitfrm();">
                                	<option value="">Search by Module</option>
                                    <?php  foreach ( $taxonomies as $taxonomy ) { ?>
                                	<option value="<?php echo $taxonomy->term_id; ?>" <?php if($_REQUEST['srchdrp'] == $taxonomy->term_id){echo "selected";} ?>><?php echo $taxonomy->name; ?></option>
                                    <?php } ?>
                              
                                </select>
                            </div>
                            <p>Or</p>
                        	<input type="text" name="srch" value="<?php echo $search_terms; ?>" />
                            <input type="submit" />
                        </form>
                    </div>
                    <ul class="alph-list">
                    	<li><a href="/elevate/glossary/?alpha=A" class="active">a</a></li>
                        <li><a href="/elevate/glossary/?alpha=B">b</a></li>
                        <li><a href="/elevate/glossary/?alpha=C">c</a></li>
                        <li><a href="/elevate/glossary/?alpha=D">d</a></li>
                        <li><a href="/elevate/glossary/?alpha=E">e</a></li>
                        <li><a href="/elevate/glossary/?alpha=F">f</a></li>
                        <li><a href="/elevate/glossary/?alpha=G">g</a></li>
                        <li><a href="/elevate/glossary/?alpha=H">h</a></li>
                        <li><a href="/elevate/glossary/?alpha=I">i</a></li>
                        <li><a href="/elevate/glossary/?alpha=J">j</a></li>
                        <li><a href="/elevate/glossary/?alpha=K">k</a></li>
                        <li><a href="/elevate/glossary/?alpha=L">l</a></li>
                        <li><a href="/elevate/glossary/?alpha=M">m</a></li>
                        <li><a href="/elevate/glossary/?alpha=N">n</a></li>
                        <li><a href="/elevate/glossary/?alpha=O">o</a></li>
                        <li><a href="/elevate/glossary/?alpha=P">p</a></li>
                        <li><a href="/elevate/glossary/?alpha=Q">q</a></li>
                        <li><a href="/elevate/glossary/?alpha=R">r</a></li>
                        <li><a href="/elevate/glossary/?alpha=S">s</a></li>
                        <li><a href="/elevate/glossary/?alpha=T">t</a></li>
                        <li><a href="/elevate/glossary/?alpha=U">u</a></li>
                        <li><a href="/elevate/glossary/?alpha=V">v</a></li>
                        <li><a href="/elevate/glossary/?alpha=W">w</a></li>
                        <li><a href="/elevate/glossary/?alpha=X">x</a></li>
                        <li><a href="/elevate/glossary/?alpha=Y">y</a></li>
                        <li><a href="/elevate/glossary/?alpha=Z">z</a></li>
                    </ul>
                </div>
                <!--right section end-->
            
            
            <?php /*?><?php 

$args = array(
    'post_type'=> 'glossary',   
    'order'    => 'ASC'
    );              

$the_query = new WP_Query( $args );
if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); 

?>
            <div><strong><?php the_title(); ?></strong></div>
          
            <div><?php the_content();  ?></div>
              <br />
   <?php endwhile;
   endif;
    ?>         <?php */?>
            </div>
           
         </div>

    </div><!-- /.content -->

<?php get_footer(); ?>