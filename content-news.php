<?php /* Template Name: NewsPage */ ?>

<?php get_header(); ?>


<div class="container">
        <div class="row">

<?php  
	$position = get_field('position');
	$show = get_field( 'show_sidebar' );
	$type = get_field( 'sidebar_type' );	
?>

<div class="col-lg-12 ">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	

	<?php if( 'yes' == $show ){
		if( 'left' == $position ){
			if( 'recentPosts' == $type ){
				echo '<div class="col-lg-4">';
				dynamic_sidebar( 'pagesidebar' );
				echo '</div>';
			}
			elseif( 'recentComments' == $type ){
				echo '<div class="col-lg-4">';
				dynamic_sidebar( 'commentsidebar' );
				echo '</div>';
			}
		}
	} ?>

	
	<?php if( 'no' == $show){ ?>
		<div class="col-lg-12">		
		    <?php the_content(); ?>
		</div>	
	<?php }else{ ?>
		<div class="col-lg-8">		
		    <?php the_content(); ?>
		</div>	
		<?php } ?>
	    
		    
    <?php if( 'yes' == $show ){
		if( 'right' == $position ){
			if( 'recentPosts' == $type ){
				echo '<div class="col-lg-4">';
				dynamic_sidebar( 'pagesidebar' );
				echo '</div>';
			}
			elseif( 'recentComments' == $type ){
				echo '<div class="col-lg-4">';
				dynamic_sidebar( 'commentsidebar' );
				echo '</div>';
			}
		}
	} ?>
	
	
	
<?php endwhile; ?>
<?php endif; ?>

</div>




<?php get_footer(); ?>