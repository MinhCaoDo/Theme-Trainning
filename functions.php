<?php
/** 
	@Thiết lập hằng dữ liệu
	@THEME_URL = get_stylesheet_directory() - đường dẫn tới thư mục theme
	@CORE = thư mục / core của theme, chứa các file nguồn
	**/

	define('THEME_URL', get_stylesheet_directory());
	define('CORE', THEME_URL.'/core');
	
/**
  @ Load file /core/init.php
  @ Đây là file cấu hình ban đầu của theme mà sẽ không nên được thay đổi sau này.
  **/
	require_once(CORE.'/init.php');

	if( !isset($content_width)){
		/* Nếu chưa thiết lập Content width thì gán giá trị cho nó */
		$content_width = 620;
	}

/**
	@Thiết lập chức năng sẽ được theme hỗ trợ
	**/
	if( !function_exists('cmg_theme_setup')){
		function cmg_theme_setup(){
			_cmg_theme_setup_partical();
		}
		add_action('init','cmg_theme_setup'); 
	}

	function _cmg_theme_setup_partical(){
		/* Cài đặt hỗ trợ đa ngôn ngữ */
		$lang_folder = THEME_URL . '/languages';
		load_theme_textdomain('cmg', $lang_folder);

		/* Cài đặt RSS Feed */
		add_theme_support( 'automatic_feed_links' );

		/* Post Thumbnail*/
		add_theme_support('post-thumbnails');
		//set_post_thumbnail_size(50,50,true);


		/* Title tag */
		add_theme_support('title-tag');

		/* Post format chọn loại bài viết */
		add_theme_support('post-formats', array('image','video','gallery','quote','link'));

		/* Custom background*/
		$default_bg = array('default-color'=>"#e8e8e8");
		add_theme_support('custom-background',$default_bg);

		/* Tạo menu cho theme, 'cmg' là textdomain */
		register_nav_menu('primary-menu',__('Primary Menu','cmg'));

		/* Tạo sidebar cho theme*/
		$sidebar = array(
			'name' => __('Main Sidebar','cmg'),
			'id' => __('cmg-sidebar'),
			'description' => 'CMG Main sidebar for theme',
			'before_title'	=>	'<h3 class="widdgetitle">',
			'after_sidebar'	=>	'</h3>'
			);
		register_sidebar( $sidebar );
	}

/**
	@Thiết lập hàm hiển thị logo
	@cmg_logo()
	**/
	if( ! function_exists('cmg_logo')){
		function cmg_logo(){ ?>
			<div class='logo'>
			<div class='site-name'>
			<?php if( is_home()){
					printf(
					'<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
						get_bloginfo('url'),
						get_bloginfo('description'),
						get_bloginfo('sitename')
					);
				} else {
					printf(
						'<p><a href="%1$s" title="%2$s">%3$s</a></p>',
						get_bloginfo('url'),
						get_bloginfo('description'),
						get_bloginfo('sitename')
				);	
				}

		}
	};

/**
	@Thiết lập hàm hiển thị menu
	@cmg_menu(	$slug  )
	**/

	if(	!function_exists('cmg_menu')){
		function cmg_menu(	$slug  ){
			$menu = array(
				'theme_location'	=>	$slug,
				'container'	=>	'nav',
				'container_class'	=>	$slug
			);
			wp_nav_menu(  $menu  );
		}
	}

/**
	@Thiết lập phân trang cho trang chủ
	@cmg_menu(	$slug  )
	**/
	if( !function_exists('cmg_pagination') ){
		function cmg_pagination(){

		}
	}