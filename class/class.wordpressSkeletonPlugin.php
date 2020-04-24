<?php
    class wordpressSkeletonPlugin extends WP_Widget{
        public function __construct() {
            parent::__construct(
                'Wordpress_skeleton_plugin',  // Base ID of Plugin
                'Wordpress Skeleton Plugin',   // Name of Plugin
                'Base to develop your own plugin'   // Text of Plugin in admin
            );
        }

        public function widget( $args, $instance ) {
            if(!empty($instance['title'])){
                echo "<h3 class='skleton-title'>";
                    echo $instance['title'];
                echo "</h3>";
            }
            echo '<div class="text-field">';
                    echo $instance['text'];
            echo '</div>';
        }

        public function form( $instance ) {
            (isset($instance['title']))?$title= $instance['title']:$title = 'Default Title';
            (isset($instance['text']))?$text= $instance['text']:$text = 'Default text Lorem';
            ?>
            <p>
                <label for="title"><?php _e( 'Title:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( "title" ); ?>" name="<?php echo $this->get_field_name( "title" ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
                <label for="text"><?php _e( 'Text:' ); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( "text" ); ?>" name="<?php echo $this->get_field_name( "text" ); ?>"><?php echo $text ; ?></textarea>
             </p>
            <?php
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['text'] = ( !empty( $new_instance['text'] ) ) ? $new_instance['text']  : '';

            return $instance;
        }
    }