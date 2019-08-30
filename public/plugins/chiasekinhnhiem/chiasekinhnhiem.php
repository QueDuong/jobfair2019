<?php
/*
Plugin Name: chiasekinhnhiem
Plugin URI: http://on1.vn
Description: chiasekinhnhiem
Author: nguyen anh dung
Version: 1.0
Author URI: dcv.vn
*/
/*
 * Khởi tạo widget item
 */
class Thachpham_Widget extends WP_Widget {
	
	/**
	 * Thiết lập widget: đặt tên, base ID
	 */
	function Thachpham_Widget() {
		$tpwidget_options = array(
			'classname' => 'thachpham_widget_class', //ID của widget
			'description' => 'Mô tả của widget'
		);
		$this->WP_Widget('thachpham_widget_id', 'Chia sẻ kinh nhiệm', $tpwidget_options);
	}
	
	/**
	 * Tạo form option cho widget
	 */
	function form( $instance ) {
		
		//Biến tạo các giá trị mặc định trong form
		$default = array(
			'title' => 'Tiêu đề widget'
		);
		
		//Gộp các giá trị trong mảng $default vào biến $instance để nó trở thành các giá trị mặc định
		$instance = wp_parse_args( (array) $instance, $default);
		
		//Tạo biến riêng cho giá trị mặc định trong mảng $default
		$title = esc_attr( $instance['title'] );
		
		//Hiển thị form trong option của widget
		echo "<p>Nhập tiêu đề <input type='text' class='widefat' name='".$this->get_field_name('title')."' value='".$title."' /></p>";
		
		
	}
	
	/**
	 * save widget form
	 */
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	
	/**
	 * Show widget
	 */
	
	function widget( $args, $instance ) {
		
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo $before_widget;
		
		//In tiêu đề widget
		if(!is_search())
		{
		?>
		<div style="border: 1px solid #f2f2f2;">
            <div class="widget-title" style="color:#054885;font-size:15px;font-weight:bold;padding-top:16px;border-bottom:2px solid">Chia sẻ kinh nhiệm</div>
			
			<?php $my_query = new WP_Query( array('post_type' => 'post','showposts' => 5, )); ?>

			<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
				<!-- Do special_cat stuff... -->

			<div>
			<?php 
			if ( has_post_thumbnail() ) {
			$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
			}else{$ca= get_bloginfo('stylesheet_directory'); $large_image_url[0]=get_bloginfo('stylesheet_directory').'/img/chuanhapanh.jpg';}
			?>
			
			<a href="<?php the_permalink();?>" title="<?php the_title();?>">
			<img style="float: left; margin-left: 13px; padding: 3px; width: 96px; border: 1px solid rgb(204, 204, 204);" src="<?php echo  $large_image_url[0];?>">
			</a>
			<p style="overflow: hidden; padding-left: 8px; margin-bottom: 0px; text-align: left; padding-right: 7px;">	
			<a title="<?php the_title();?>" href="<?php the_permalink();?>" style="font-size: 14px; color: rgb(51, 51, 51); font-weight: 500;">
			<?php the_title();?>
			</a>
			</p>
			<p style="text-align: right; margin-top: 0px; padding-right: 12px;">
			<a href="<?php the_permalink();?>">
			Xem thêm
			</a>
			</p>
			</div>
	     
		    <?php endwhile; ?>
		 
		</div>
		<?php
		}
		// Nội dung trong widget
		

		
		// Kết thúc nội dung trong widget
		
		echo $after_widget;
	}
	
}

/*
 * Khởi tạo widget item
 */
add_action( 'widgets_init', 'create_thachpham_widget' );
function create_thachpham_widget() {
	register_widget('Thachpham_Widget');
}