<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php the_title(); ?></title>

    <!-- Bootstrap Core CSS -->
    
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  <script type="text/javascript">
  var templateUrl = '<?= get_bloginfo("template_url"); ?>';
  </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <?php 
              // Fix menu overlap
              if ( is_admin_bar_showing() ) echo '<div style="min-height: 32px;"></div>'; 
         ?>
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


            <?php
            wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => false,                
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker())
            );
        ?>

        <form class="navbar-form navbar-right" role="search">
          <div class="form-group">

            <?php get_search_form(); ?>
            
        </form>

          </div>
            <!-- /.navbar-collapse -->
        </div>


        <!-- /.container -->
    </nav>

    <?php 


    $id = get_the_ID();
    $post_format = get_post_format($id);
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
                $vid_id = $my_array_of_vars['v'];

                
                echo '
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$vid_id.'" frameborder="0" allowfullscreen></iframe>
                </div>';




            }
            /* Restore original Post Data */
            wp_reset_postdata();
        } 


    }
    else if( 'gallery' == $post_format ){
    $gallery = get_post_gallery_images( $post );  ?>

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
        echo '<div class="item '.$active.'">

         <div style="background-image: url( ' .$image_url. ' ); height: 400px; background-size: cover; margin: 0px auto; width: 100%;"></div>
          <div class="carousel-caption">
            ...
          </div>
        </div> 
        ';
        $i++;
        $active = '';
      }
    }  ?>
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
    
      <?php  } else if( wp_get_attachment_url(get_post_thumbnail_id($post->ID)) ) { ?>

         <header class="intro-header" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
        <?php } else { ?>
          <header class="intro-header" style="background-image: url(<?php header_image(); ?>)">
        <?php } ?>


    <?php if( !$post_format ){ ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">                                       
                    <?php 

                    global $post;
                    $id = get_the_ID();
                    $post_format = get_post_format($id);
                    $sticky = $post->post_name;
                    if( !$post_format && $sticky != 'sticky'){  

                    ?>
                    <div class="site-heading">

                        <h1>
                          <?php echo get_the_title($post->ID); ?>
                          <hr class="small" />
                        </h1>

                        <?php } else{ ?> 

                          <div class="site-heading">
                            <h1><?php bloginfo('name'); ?></h1>
                            <hr class="small">
                            <span class="subheading">

                            <?php bloginfo('description'); ?>                                 

                            </span>
                        </div>
                        <?php } ?>                          


                    </div>
            </div>
        </div>

      <?php } ?>
    </header>

   