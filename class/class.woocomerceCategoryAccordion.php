<?php
class woocomerceCategoryAccordion extends WP_Widget{
    public function __construct() {
        parent::__construct(
            'Shinoks_Woocomerce_Category_Accordion',
            'Woocomerce Category Accordion',
            );
    }

    public function widget( $args, $instance ) {
        if($instance['show_title']=='on'){
            if(!empty($instance['title'])){
                echo "<h3 class='skleton-title'>";
                echo $instance['title'];
                echo "</h3>";
            }
        }
        echo '<div class="text-field">';
        echo $instance['text'];
        echo '</div>';
        $categories = $this->get_woocommerce_categories($instance['show_empty']);
        $url = '';
        $submenuhtml = '';
        echo '<nav>';
        echo '<ul class="shinoks_wc_accordion">';
        foreach($categories as $category){
            if($category->parent===0){
                $url = get_term_link( (int)$category->term_id, $category->taxonomy );
                echo '<li class="shinoks_wc_accordion_li" id="category-'.$category->term_id.'"><a href="'.$url.'">' .$category->name . '</a><span class="shinoks_wc_accordion_counter">' .$category->count. '</span> ';

                if($instance['show_sub_cat']=='on'){
                    $subcat = 0;
                    $submenuhtml = '<ul id="subcatgory-'.$category->term_id.'" class="shinoks_wc_accordion_sub shinoks_wc_accordion_hide" >';
                    foreach($categories as $submenu){
                        if($submenu->parent==$category->term_id){
                            $url = get_term_link( (int)$submenu->term_id, $submenu->taxonomy );
                            $submenuhtml .=  '<li class="shinoks_wc_accordion_li_sub"><a href="'.$url.'">'.$submenu->name.'</a> <span class="shinoks_wc_accordion_counter">' .$submenu->count. '</span> </li>';
                            $subcat++;
                        }
                    }
                    $submenuhtml .= '</ul>';
                    if($subcat>0){
                        echo '<a class="shinoks_wc_accordion_show" id="'.$category->term_id.'"></a>';
                        echo $submenuhtml;
                    }
                }
                echo '</li>';
            }
        }
        echo '</ul>';
        echo '</nav>';
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
        echo '<script>
			$(function(){
				$(".shinoks_wc_accordion_show").click(function(){
    				$("#subcatgory-"+$(this).attr("id")).toggle();
					$("#category-"+$(this).attr("id")).toggleClass("shinoks_wc_accordion_active");
				});
				$(".shinoks_wc_accordion_hide").click(function(){
    				$("#subcatgory-"+$(this).attr("id")).toggle();
					$("#category-"+$(this).attr("id")).toggleClass("shinoks_wc_accordion_active");
				});
			})
           </script>';

    }

    public function form( $instance ) {
        isset($instance['title'])?$instance['title']:$instance['title'] = 'Default Title';
        isset($instance['show_title'])?$instance['show_title']:'on';
        isset($instance['show_empty'])?$instance['show_empty']:'off';
        isset($instance['show_sub_cat'])?$instance['show_sub_cat']:'off';
        isset($instance['show_hide_icon'])?$instance['show_empty']:'off';
        var_dump($instance)
        ?>
        <p>
            <label for="title"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( "title" ); ?>" name="<?php echo $this->get_field_name( "title" ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /><br/>
            <label for="show_title"><?php _e( 'Show title:' ); ?></label>
            <input type="checkbox" <?php checked( 'on', $instance['show_title'] ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_title' ) ); ?>"><br/>
            <label for="show_empty"><?php _e( 'Show_empty:' ); ?></label>
            <input type="checkbox" <?php checked( 'on', $instance['show_empty'] ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_empty' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_empty' ) ); ?>"><br/>
            <label for="show_sub_cat"><?php _e( 'Show sub categories:' ); ?></label>
            <input type="checkbox" <?php checked( 'on', $instance['show_sub_cat'] ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_sub_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_sub_cat' ) ); ?>"><br/>
            <label for="show_hide_icon"><?php _e( 'Show/hide icon for sub categories:' ); ?></label>
            <input type="checkbox" <?php checked( 'on', $instance['show_hide_icon'] ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_hide_icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_hide_icon' ) ); ?>"><br/>
            <label for="show_counter"><?php _e( 'Show counter:' ); ?></label>
            <input type="checkbox" <?php checked( 'on', $instance['show_counter'] ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_counter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_counter' ) ); ?>">
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['show_title'] = ( !empty( $new_instance['show_title'] ) ) ? $new_instance['show_title']  : 'on';
        $instance['show_empty'] = ( !empty( $new_instance['show_empty'] ) ) ? $new_instance['show_empty']  : 'off';
        $instance['show_sub_cat'] = ( !empty( $new_instance['show_sub_cat'] ) ) ? $new_instance['show_sub_cat']  : 'off';
        $instance['show_hide_icon'] = isset( $new_instance['show_hide_icon'] ) ? $new_instance['show_hide_icon'] : 'off';
        $instance['show_counter'] = isset( $new_instance['show_counter'] ) ? $new_instance['show_counter'] : 'off';

        return $instance;
    }

    private function get_woocommerce_categories( $hide_empty=false ){
        $ag = array( 'hide_empty' => $hide_empty );
        $categories = get_terms( 'product_cat', $ag );

        return $categories;
    }
}