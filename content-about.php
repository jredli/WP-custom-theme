<?php /* Template Name: AboutPage */ ?>

<?php get_header(); ?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">


            <p>
            	<?php

                $content = get_field( 'content' );

                foreach( $content as $con ){
                    if( $con['acf_fc_layout'] == 'add_text'){
                         echo $con['text'];
                    }

                    if( $con['acf_fc_layout'] == 'add_image'){
                        echo '<img class="img-responsive" src="' . $con['image'] . '"/>';     
                    }                    
                    
                    if( $con['acf_fc_layout'] == 'blockquote' ){
                        echo '<blockquote>';
                    echo '<p>'.$con['quote'].'</p>';
                    echo '</blockquote>';
                    }              

                    if( array_key_exists( 'list_repeater', $con )){
                        echo '<ul class="text-center">';
                        foreach( $con['list_repeater'] as $c ){
                            
                            echo '<li style="list-style-type:none;" >' . $c['list_item'] . '</li>';
                           
                        }
                         echo '</ul>';

                    }    

                    if( $con['acf_fc_layout'] == 'add_icon' ){
                        echo '<div class="col-lg-4 icon-text">';
                        foreach( $con['icon_text'] as $c ){
                            echo '<div class="col-lg-12">';
                            echo '<i style="color:' . $c['icon_color'] . '" class="fa ' . $c['icons'] .' ' . $c['icon_size'] . ' " aria-hidden="true"></i>';
                            echo '</div>';
                            echo '<div class="col-lg-12">';
                            echo '<p>' . $c['text_icon'] .'</p>';
                            echo '</div>';
                        }
                        echo '</div>';
                    }


                                            
                } ?>

                

            </p>

      		 </div>

<?php get_footer(); ?>