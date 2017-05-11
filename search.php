<?php get_header(); ?>

<?php 
    

?>


<div class="container">
        <div class="row">
            <div class="col-lg-12">           
    <?php 

        // WP_query arguments
        $req = $_GET[ 's' ];
        $args = array(
          'post_type' => 'any',
          's' => $req
        );

        $query = new WP_Query( $args );

        // Post type counters
        $news = 0; $videos = 0; $galleries = 0; $regular_post = 0;

        if ( $query->have_posts() ) {
          while ( $query->have_posts() ) {
            $query->the_post();

            if( get_post_type() == 'news' ){
              $news++; 
            }elseif( get_post_format() == 'video' ){
              $videos++; 
            }elseif( get_post_format() == 'gallery' ){
              $galleries++;
            }elseif( get_post_type() == 'post' ){
              $regular_post++; 
            }    

          }  
         
          wp_reset_postdata();
        } 

        // Number of each post type results
        echo  '<div class="col-lg-8 col-lg-offset-2 search_num">
                <h3>
                    There are:
                    <a href="#news_a">' . $news . ' news</a>, 
                    <a href="#video_a">' . $videos .' videos</a>, 
                    <a href="#gallery_a">' . $galleries .' galleries</a>, 
                    <a href="#regular_a">' . $regular_post . ' regular posts</a>
                </h3>
               </div>';  


        // Printing search results
        if ( $query->have_posts() ) {
          while ( $query->have_posts() ) {
            $query->the_post();

            if( get_post_type() == 'news' ){
               echo news_results();
            }elseif( get_post_format() == 'video' ){
               echo video_results();
            }elseif( get_post_format() == 'gallery' ){
               echo gallery_results();
            }elseif( get_post_type() == 'post' ){
               echo regular_results();
            }       

          }   

          wp_reset_postdata();
        }                     

        ?>
	
<?php get_footer(); ?>