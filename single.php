<?php 

get_header(); ?>
 <div class="container">
        <div class="row">
            <div class="col-lg-12">

    <?php 
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post(); ?>

                <?php 
                    $id = get_the_ID();
                    $post_format = get_post_format($id);                    
                ?>

                <div class="post-preview">                    
                        <h1 class="post-title">
                            <?php the_title(); ?>
                        </h1>                    
                        <h3 class="post-subtitle">
                            <?php the_content(); ?>
                        </h3>
                    
                    <p class="post-meta">Posted by <a href="#"><?php the_author_posts_link(); ?></a> on <?php the_time('l, F jS, Y') ?></p>
                </div>
        <?php 

           // end while
            }
        } // end if
        ?>
    


</div>
<?php get_footer(); ?>