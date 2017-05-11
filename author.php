
<?php get_header( 'author' ); ?>

	<div class="container">
        <div class="row">

        <?php 
        	global $post;
            $author_id = $post->post_author;

        	$args = array(
        		'author' => $author_id
    		);
    	?>
    	
		<?php 
			$query = new WP_Query( $args );
		    if( $query->have_posts() ):
		        while( $query->have_posts() ): $query->the_post();
		?>

	<div class="col-lg-8 col-lg-offset-2 news_frame">
        <div class="col-lg-12">                        
                <!-- Levo -->
                <div class="col-lg-3 text-center">
                <!-- Slika -->
                <div class="col-lg-12 news-left"> 
                    Posted by - <?php the_author_posts_link() ?>
                </div>
                <!-- Bio -->
                    <div class="col-lg-12">                        
                    	<?php the_time('l, F jS, Y'); ?>
                    </div>
                </div>
                <!-- Desno -->
                <div class="col-lg-9 text-left">
                <?php echo '<a href="' . get_the_permalink( $post->ID) . '">'?>
                	<h2><?php the_title(); ?></h2>
            	<?php echo '</a>'; ?>
                    <!-- Tekst -->                                                 
                        <p class="news-p"><?php the_excerpt(); ?></p>
                        <p><?php edit_news_link(); ?></p>
                                            
                </div>
        </div>
    </div>
	
			<?php endwhile; ?>
			<?php endif; ?>


<?php get_footer(); ?>