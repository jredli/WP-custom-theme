<?php get_header(); ?>

 <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
    <?php 

        echo $vezba_options['wiki_test_select'];
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();             
                


            $id = get_the_ID();
            $post_format = get_post_format($id);

            // Video Post Format
            if ( 'video' == $post_format ) {
                $the_query = new WP_Query( array( 'p' => $id ) );
                if ( $the_query->have_posts() ) {
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        $content = get_the_content();
                        $media = get_media_embedded_in_content($content);
                                                
                        $txt = getTextBetweenTags($content);
                        $txt = substr($txt, 0, -7);
                        parse_str( parse_url( $txt, PHP_URL_QUERY ), $my_array_of_vars );
                        $vid_id = $my_array_of_vars['v']; ?>
                        
                        <div id="post-preview-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <a href="<?php the_permalink(); ?>">
                                <h2 class="post-title">
                                    <?php the_title(); ?>
                                </h2>
                            <a href="<?php the_permalink(); ?>">
                                

                               <?php echo '
                        <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$vid_id.'" frameborder="0" allowfullscreen></iframe>
                        </div>'; ?>


                            </a>
                            <p class="post-meta">Posted by <a href="#"><?php the_author_posts_link(); ?></a> on <?php the_time('l, F jS, Y') ?></p>
                            <?php edit_post_link( 'Edit post content' ); ?>
                            <?php the_category( '&bull;' ); ?>
                        </div>

                       <?php 
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
               }
            }
            // Gallery Post Format 

            else if( 'gallery' == $post_format ){
                $gallery = get_post_gallery_images( $post );  ?>

                  <div id="post-preview-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <a href="<?php the_permalink(); ?>">
                                    <h2 class="post-title">
                                        <?php the_title(); ?>
                                    </h2>
                                <a href="<?php the_permalink(); ?>">

                       <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">

                  <?php 
                  $i=1;
                  $active='';
                  if ($gallery) {
                      foreach( $gallery as $image_url ) {
                        if ( '1' == $i ) {
                            $active ='active';
                        }
                        echo '
                         <div class="item '.$active.'">

                         <div style="background-image: url( ' .$image_url. ' ); height: 400px; background-size: cover; margin: 0px auto; width: 100%;"></div>
                          <div class="carousel-caption">
                            ...
                          </div>
                        </div> 
                        ';
                        $i++;
                        $active = '';
                      }
                  }
                  ?>
                    <!-- Page Header -->
                    <!-- Set your background image for this header on the line below. -->
                    <header class="intro-header">    
                    
                  </div>

                  <!-- Controls -->
                  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>

                </a>
                        <p class="post-meta">Posted by <a href="#"><?php the_author_posts_link(); ?></a> on <?php the_time('l, F jS, Y') ?></p>
                        <?php edit_post_link( 'Edit post content' ); ?>
                    </div>
                
                  <?php  } else { ?>


                <div id="post-preview-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <a href="<?php the_permalink(); ?>">
                        <h2 class="post-title">
                            <?php the_title(); ?>
                        </h2>
                    </a>
                        <h3 class="post-subtitle">
                            <?php echo get_the_excerpt(); ?>
                            <a href="<?php the_permalink(); ?>"></a>

                        </h3>
                    
                    <p class="post-meta">Posted by <a href="#"><?php the_author_posts_link(); ?></a> on <?php the_time('l, F jS, Y') ?></p>
                    <?php edit_post_link( '<span class="glyphicon glyphicon-pencil pencil-edit">', '</span>' ); ?>
                    <?php the_category( '&bull;' ); ?>

                </div>
                <?php } ?>
           <?php endwhile;


           
            if ( function_exists('wp_bootstrap_pagination') )
            wp_bootstrap_pagination();
        


           ?>
           
        <?php endif;  ?>
	 </div>


   


<?php get_footer(); ?>


