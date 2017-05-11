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

    <header class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 header-margin">        
                <?php
                  global $post;
                  $author_id = $post->post_author;
                ?>           
                    <div class="col-lg-12 text-center" style="background-color: rgba(204, 204, 204, 0.07);">
                      <!-- Autor levo -->
                      <div class="col-lg-5 author-img">
                        <div class="col-lg-12">
                          <?php echo get_avatar( $author_id, 150, 150); ?>
                        </div>
                        <div class="col-lg-12">
                          <p>Name:<?php the_author_meta( 'user_nicename', $author_id ); ?></p>
                          <p>Twitter:
                            <?php echo '<a href=' . get_the_author_meta( 'twitter' ) .' target="_blank">
                                            <img src=' . get_template_directory_uri() . '/img/twitter.png height="16" width="16" />
                                       </a>'
                            ?>
                          </p>
                           <p>Facebook:
                            <?php echo '<a href=' . get_the_author_meta( 'facebook' ) .' target="_blank">
                                            <img src=' . get_template_directory_uri() . '/img/facebook.jpg height="16" width="16" />
                                       </a>'
                            ?>
                          </p>
                          <p>Email:<?php the_author_meta( 'user_email', $author_id ); ?></p>
                        </div>
                      </div>
                      <!-- Autor desno -->
                      <div class="col-lg-7">
                        <div class="col-lg-12">
                          <h2 style="color: #ad7217">Bio</h2>
                            <p class="author-p"><?php the_author_meta( 'description', $author_id ); ?></p>
                        </div>                       
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

   