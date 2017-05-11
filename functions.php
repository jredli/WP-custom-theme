<?php

require get_template_directory() . '/widgets.php';
// Loading scripts
function load_scripts() {
    wp_register_style( 'temaCss',  get_template_directory_uri() .'/style.css', array(), null, 'all' );
    wp_register_style( 'bootstrapCss',  get_template_directory_uri() .'/vendor/bootstrap/css/bootstrap.css', array(), null, 'all' );
    wp_register_style( 'fontAwesomeCss',  get_template_directory_uri() .'/vendor/font-awesome/css/font-awesome.css', array(), null, 'all' );

    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'cleanBlogJs', get_template_directory_uri() . '/js/clean-blog.js', true );
    wp_enqueue_script( 'funkcije', get_template_directory_uri() . '/js/funkcije.js', true );
    wp_enqueue_script( 'contactJs', get_template_directory_uri() . '/js/contact_me.js', true );
    wp_enqueue_script( 'BsValidationJs', get_template_directory_uri() . '/js/jqBootstrapValidation.js', true );
    wp_enqueue_script( 'bsJs', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.min.js', true );
    wp_enqueue_style( 'temaCss' );
    wp_enqueue_style( 'bootstrapCss' );
    wp_enqueue_style( 'fontAwesomeCss' );
}

add_action( 'wp_enqueue_scripts', 'load_scripts');


//Temiranje
add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio') );
add_theme_support( 'custom-background' );
add_theme_support( 'html5', array( 'search-form' ));
add_theme_support( 'post-thumbnails', array( 'post', 'page', 'news' ) ); 
add_image_size( 'small-thumbnail', 150, 150, true );
    
// Video url regex
function getTextBetweenTags($string) {
    $pattern = "#[\s*?$embed\b[^>]*](.*?)[/$embed\b[^>]*]#s";
    preg_match($pattern, $string, $matches);
    return $matches[1];
}

function custom_excerpt_length(){
	return 25;
}

add_filter('excerpt_length', 'custom_excerpt_length');

// Sidebars

function tema_widgets_init() {
    register_sidebar( array(
        'name' => __( 'GlavniSidebar' ),
        'id' => 'glavnisidebar',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
	        'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name' => __( 'PageSidebar' ),
        'id' => 'pagesidebar',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
	        'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name' => __( 'CommentSidebar' ),
        'id' => 'commentsidebar',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );



}

add_action( 'widgets_init', 'tema_widgets_init' );

// Register default header
//Check see if the customisetheme_setup exists
if ( !function_exists('customisetheme_setup') ):
    //Any theme customisations contained in this function
    function customisetheme_setup() {
        //Define default header image
        define( 'HEADER_IMAGE', '%s/header/default.jpg' );

        //Define the width and height of our header image
        define( 'HEADER_IMAGE_WIDTH', apply_filters( 'customisetheme_header_image_width', 960 ) );
        define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'customisetheme_header_image_height', 220 ) );

        //Turn off text inside the header image
        define( 'NO_HEADER_TEXT', true );

        //Don't forget this, it adds the functionality to the admin menu
        add_custom_image_header( '', 'customisetheme_admin_header_style' );

        //Set some custom header images, add as many as you like
        //%s is a placeholder for your theme directory
        $customHeaders = array (
                //Image 1
                'perfectbeach' => array (
                'url' => '%s/header/default.jpg',
                'thumbnail_url' => '%s/header/thumbnails/pb-thumbnail.jpg',
                'description' => __( 'Perfect Beach', 'customisetheme' )
            ),
                //Image 2
                'tiger' => array (
                'url' => '%s/header/tiger.jpg',
                'thumbnail_url' => '%s/header/thumbnails/tiger-thumbnail.jpg',
                'description' => __( 'Tiger', 'customisetheme' )
            ),
                //Image 3
                'lunar' => array (
                'url' => '%s/header/lunar.jpg',
                'thumbnail_url' => '%s/header/thumbnails/lunar-thumbnail.jpg',
                'description' => __( 'Lunar', 'customisetheme' )
            )
        );
        //Register the images with Wordpress
        register_default_headers($customHeaders);
    }
endif;

if ( ! function_exists( 'customisetheme_admin_header_style' ) ) :
    //Function fired and inline styles added to the admin panel
    //Customise as required
    function customisetheme_admin_header_style() {
    ?>
        <style type="text/css">
            #wpbody-content #headimg {
                height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
                width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
                border: 1px solid #333;
            }
        </style>
    <?php
    }
endif;

//Execute our custom theme functionality
add_action( 'after_setup_theme', 'customisetheme_setup' );

// Register Custom Navigation Walker
require_once('wp_bootstrap_pagination.php');

// Register Custom Navigation Walker
require_once('wp-bootstrap-navwalker.php');

register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'tema' ),
) );

function new_excerpt_more($more) {
    global $post;
    return ' <a class="moretag btn btn-primary pull-right" href="'. get_permalink($post->ID) . '">Read More</a>'; //Change to suit your needs
}
 
add_filter( 'excerpt_more', 'new_excerpt_more' );

function wpdocs_custom_excerpt_length( $length ) {
    return 60;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function test () {
    ob_start();
    the_post_thumbnail( 'small-thumbnail' );
    return ob_get_clean(); 
}

//Edit post link
function edit_news_link () {
   ob_start();
   edit_post_link( '<span class="glyphicon glyphicon-pencil pencil-edit">', '</span>' );
   return ob_get_clean();
}

function newspostformat(){
    $args = array(
        'post_type' => 'news',
    );

    $string = '';
    $query = new WP_Query( $args );
    if( $query->have_posts() ){
        while( $query->have_posts() ){ $query->the_post();
            

            $string .= 
                '<div class="col-lg-12 news_frame">
                    <div class="col-lg-12">                        
                            <!-- Levo -->
                            <div class="col-lg-3 text-center">
                            <!-- Slika -->
                            <div class="col-lg-12 news-left">' 
                                . test () . 
                            '</div>
                            <!-- Bio -->
                                <div class="col-lg-12">
                                    <h5>Posted by - ' 
                                        . get_the_author_posts_link() . '
                                        <a href=' . get_the_author_meta( 'facebook' ) .' target="_blank">
                                            <img src=' . get_template_directory_uri() . '/img/facebook.jpg height="16" width="16" />
                                        </a>
                                        <a href=' . get_the_author_meta( 'twitter' ) .' target="_blank">
                                            <img src=' . get_template_directory_uri() . '/img/twitter.png height="16" width="16" />
                                        </a>                                        
                                    </h5>
                                    ' . get_the_time('l, F jS, Y') . '
                                </div>
                            </div>
                            <!-- Desno -->
                            <div class="col-lg-9 text-left"><a href="' . get_the_permalink() . '">
                            <h2>' . get_the_title() . '</h2>
                        </a>
                                <!-- Tekst -->
                                                             
                                    <p class="news-p">'
                                        . get_the_excerpt() . '
                                    </p>
                                    <p>
                                        ' . edit_news_link() . '
                                    </p>
                                                        
                            </div>
                    </div>
                </div>';
        }
    }

    wp_reset_postdata();
    return $string;
}

add_shortcode( 'listnews', 'newspostformat' );

// Adding social network links to a user
function my_new_contactmethods( $contactmethods ) {
// Add Twitter
$contactmethods['twitter'] = 'Twitter';
//add Facebook
$contactmethods['facebook'] = 'Facebook';


 
return $contactmethods;
}
add_filter('user_contactmethods','my_new_contactmethods',10,1);

// Custom print_r
function check($value) { 
    echo "<pre>",print_r($value, true),"</pre>";
}

// Printing news results
function news_results(){
    return '<div id="news_a" class="col-lg-8 col-lg-offset-2 news_frame">
                    <div class="col-lg-12">                        
                            <!-- Levo -->
                            <div class="col-lg-3 text-center">
                            <!-- Slika -->
                            <div class="col-lg-12 news-left">' 
                                . test () . 
                            '</div>
                            <!-- Bio -->
                                <div class="col-lg-12">
                                    <h5>Posted by - ' 
                                        . get_the_author_posts_link() . '
                                        <a href=' . get_the_author_meta( 'facebook' ) .' target="_blank">
                                            <img src=' . get_template_directory_uri() . '/img/facebook.jpg height="16" width="16" />
                                        </a>
                                        <a href=' . get_the_author_meta( 'twitter' ) .' target="_blank">
                                            <img src=' . get_template_directory_uri() . '/img/twitter.png height="16" width="16" />
                                        </a>                                        
                                    </h5>
                                    ' . get_the_time('l, F jS, Y') . '
                                </div>
                            </div>
                            <!-- Desno -->
                            <div class="col-lg-9 text-left"><a href="' . get_the_permalink() . '">
                            <h2>' . get_the_title() . '</h2>
                        </a>
                                <!-- Tekst -->
                                                             
                                    <p class="news-p">'
                                        . get_the_excerpt() . '
                                    </p>
                                    <p>
                                        ' . edit_news_link() . '
                                    </p>
                                                        
                            </div>
                    </div>
                </div>';
}

// Printing regular results
function regular_results(){
    return '<div id="regular_a" class="col-lg-8 col-lg-offset-2 regular_frame">
                    <div class="col-lg-12">                        
                            <!-- Levo -->
                            <div class="col-lg-3 text-center">
                            <!-- Slika -->
                            <div class="col-lg-12 news-left">' 
                                . test () . 
                            '</div>
                            <!-- Bio -->
                                <div class="col-lg-12">
                                    <h5>Posted by - ' 
                                        . get_the_author_posts_link() . '
                                        <a href=' . get_the_author_meta( 'facebook' ) .' target="_blank">
                                            <img src=' . get_template_directory_uri() . '/img/facebook.jpg height="16" width="16" />
                                        </a>
                                        <a href=' . get_the_author_meta( 'twitter' ) .' target="_blank">
                                            <img src=' . get_template_directory_uri() . '/img/twitter.png height="16" width="16" />
                                        </a>                                        
                                    </h5>
                                    ' . get_the_time('l, F jS, Y') . '
                                </div>
                            </div>
                            <!-- Desno -->
                            <div class="col-lg-9 text-left"><a href="' . get_the_permalink() . '">
                            <h2>' . get_the_title() . '</h2>
                        </a>
                                <!-- Tekst -->
                                                             
                                    <p class="news-p">'
                                        . get_the_excerpt() . '
                                    </p>
                                    <p>
                                        ' . edit_news_link() . '
                                    </p>
                                                        
                            </div>
                    </div>
                </div>';
}

// Printing news results
function gallery_results(){
    return '<div id="gallery_a" class="col-lg-8 col-lg-offset-2 gallery_frame">
                    <div class="col-lg-12">                        
                            <!-- Levo -->
                            <div class="col-lg-3 text-center">
                            <!-- Slika -->
                            <div class="col-lg-12 news-left">' 
                                . test () . 
                            '</div>
                            <!-- Bio -->
                                <div class="col-lg-12">
                                    <h5>Posted by - ' 
                                        . get_the_author_posts_link() . '
                                        <a href=' . get_the_author_meta( 'facebook' ) .' target="_blank">
                                            <img src=' . get_template_directory_uri() . '/img/facebook.jpg height="16" width="16" />
                                        </a>
                                        <a href=' . get_the_author_meta( 'twitter' ) .' target="_blank">
                                            <img src=' . get_template_directory_uri() . '/img/twitter.png height="16" width="16" />
                                        </a>                                        
                                    </h5>
                                    ' . get_the_time('l, F jS, Y') . '
                                </div>
                            </div>
                            <!-- Desno -->
                            <div class="col-lg-9 text-left"><a href="' . get_the_permalink() . '">
                            <h2>' . get_the_title() . '</h2>
                        </a>
                                <!-- Tekst -->
                                                             
                                    <p class="news-p">'
                                        . get_the_excerpt() . '
                                    </p>
                                    <p>
                                        ' . edit_news_link() . '
                                    </p>
                                                        
                            </div>
                    </div>
                </div>';
}

// Printing news results
function video_results(){
    return '<div id="video_a" class="col-lg-8 col-lg-offset-2 video_frame">
                    <div class="col-lg-12">                        
                            <!-- Levo -->
                            <div class="col-lg-3 text-center">
                            <!-- Slika -->
                            <div class="col-lg-12 news-left">' 
                                . test () . 
                            '</div>
                            <!-- Bio -->
                                <div class="col-lg-12">
                                    <h5>Posted by - ' 
                                        . get_the_author_posts_link() . '
                                        <a href=' . get_the_author_meta( 'facebook' ) .' target="_blank">
                                            <img src=' . get_template_directory_uri() . '/img/facebook.jpg height="16" width="16" />
                                        </a>
                                        <a href=' . get_the_author_meta( 'twitter' ) .' target="_blank">
                                            <img src=' . get_template_directory_uri() . '/img/twitter.png height="16" width="16" />
                                        </a>                                        
                                    </h5>
                                    ' . get_the_time('l, F jS, Y') . '
                                </div>
                            </div>
                            <!-- Desno -->
                            <div class="col-lg-9 text-left"><a href="' . get_the_permalink() . '">
                            <h2>' . get_the_title() . '</h2>
                        </a>
                                <!-- Tekst -->
                                                             
                                    <p class="news-p">'
                                        . get_the_excerpt() . '
                                    </p>
                                    <p>
                                        ' . edit_news_link() . '
                                    </p>
                                                        
                            </div>
                    </div>
                </div>';
}

/**
 * Get the bootstrap!
 */
if ( file_exists( __DIR__ . '/cmb2/init.php' ) ) {
  require_once __DIR__ . '/cmb2/init.php';
} elseif ( file_exists(  __DIR__ . '/CMB2/init.php' ) ) {
  require_once __DIR__ . '/CMB2/init.php';
}

// Inicijaliacija Site Option strane
require('vezba_options.php');
vezba_admin();

// Get section post types for displaying posts
function get_section_post_types(){
    $id = vezba_get_option( 'ddlSections' );

        $section = wp_remote_get( 'http://www.iwa-network.org/wp-json/wp/v2/sections/'. $id );
        $body = wp_remote_retrieve_body( $section );
        $data = json_decode( $body, true );

        // Get all section post types
        foreach( $data as $key => $value ) {
            if( is_array( $value ) ) {
                    $counter = 0;
                foreach( $value as $item ) {
                    $links = $value['wp:post_type'];    
                }
            }
        }   
        return $links;
}
?>