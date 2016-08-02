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
			'id' => 'main-sidebar',
			'description' => 'CMG Main sidebar for theme',
			'class' => 'main-sidebar',
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
			/* Không hiển thị phân trang nếu số trang nhỏ hơn 2 */
			if( $GLOBALS['wp_query']->max_num_pages < 2 ){
				return '';
			} ?>

			<nav class='pagiation' role='navigation'>
				<?php if( get_next_posts_link()) :?>
					<div class='prev'><?php next_posts_link( __('Olders Post', 'cmg')); ?></div>
				<?php endif; ?>
				<?php if ( get_previous_post_link() ) : ?>
				     <div class="next"><?php previous_posts_link( __('Newer Posts', 'cmg') ); ?></div>
				   <?php endif; ?>
			</nav><?php
		}
	}


/**
	@ Hàm hiển thị hình ảnh Thumbnails của post.
	@ Ảnh thumbnail sẽ không hiển thị trong trang single
	@ Nhưng sẽ hiển thị trong single nếu post có format là Image
	@ cmg_thumbnails( $size )
	**/
	if( !function_exists('cmg_thumbnails')){
		function cmg_thumbnails( $size ){
			//Chỉ hiển thị thumbnail với post không có mật khẩu
			if ( ! is_single() &&  has_post_thumbnail()  && ! post_password_required() || has_post_format( 'image' ) ) : ?>
			    <figure class="post-thumbnail"><?php the_post_thumbnail( $size ); ?></figure><?php
			endif;
		}
	}

/**
@ Hàm hiển thị tiêu đề của post trong .entry-header
@ Tiêu đề của post sẽ là nằm trong thẻ <h1> ở trang single
@ Còn ở trang chủ và trang lưu trữ, nó sẽ là thẻ <h2>
@ thachpham_entry_header()
**/
if ( ! function_exists( 'thachpham_entry_header' ) ) {
  function cmg_entry_header() {
    if ( is_single() ) : ?>
 
      <h1 class="entry-title">
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <?php the_title(); ?>
        </a>
      </h1>
    <?php else : ?>
      <h2 class="entry-title">
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <?php the_title(); ?>
        </a>
      </h2><?php
 
    endif;
  }
}

/**
@ Hàm hiển thị thông tin của post (Post Meta)
@ thachpham_entry_meta()
**/
if( ! function_exists( 'cmg_entry_meta' ) ) {
  function cmg_entry_meta() {
    if ( ! is_page() ) :
      echo '<div class="entry-meta">';
 
        // Hiển thị tên tác giả, tên category và ngày tháng đăng bài
        printf( __('<span class="author">Posted by %1$s</span>', 'cmg'),
          get_the_author() );
 
        printf( __('<span class="date-published"> at %1$s</span>', 'cmg'),
          get_the_date() );
 
        printf( __('<span class="category"> in %1$s</span>', 'cmg'),
          get_the_category_list( ', ' ) );
 
        // Hiển thị số đếm lượt bình luận
        if ( comments_open() ) :
          echo ' <span class="meta-reply">';
            comments_popup_link(
              __('Leave a comment', 'cmg'),
              __('One comment', 'cmg'),
              __('% comments', 'cmg'),
              __('Read all comments', 'cmg')
             );
          echo '</span>';
        endif;
      echo '</div>';
    endif;
  }
}

/*
 * Thêm chữ Read More vào excerpt
 */
function cmg_readmore() {
  return '...<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'cmg') . '</a>';
}
add_filter( 'excerpt_more', 'cmg_readmore' );
 
/**
@ Hàm hiển thị nội dung của post type
@ Hàm này sẽ hiển thị đoạn rút gọn của post ngoài trang chủ (the_excerpt)
@ Nhưng nó sẽ hiển thị toàn bộ nội dung của post ở trang single (the_content)
@ cmg_entry_content()
**/
if ( ! function_exists( 'cmg_entry_content' ) ) {
  function cmg_entry_content() {
 
    if ( ! is_single() ) :
      the_excerpt();
    else :
      the_content();
 
      /*
       * Code hiển thị phân trang trong post type
       */
      $link_pages = array(
        'before' => __('<p>Page:', 'cmg'),
        'after' => '</p>',
        'nextpagelink'     => __( 'Next page', 'cmg' ),
        'previouspagelink' => __( 'Previous page', 'cmg' )
      );
      wp_link_pages( $link_pages );
    endif;
  }
}

/**
@ Hàm hiển thị tag của post
@ thachpham_entry_tag()
**/
if ( ! function_exists( 'cmg_entry_tag' ) ) {
  function cmg_entry_tag() {
    if ( has_tag() ) :
      echo '<div class="entry-tag">';
      printf( __('Tagged in %1$s', 'cmg'), get_the_tag_list( '', ', ' ) );
      echo '</div>';
    endif;
  }
}


/**
	@ Chèn CSS và JS vào theme
	@ Sử dụng hook wp_enqueue_scripts() để hiển thị nó ra ngoài front-end
**/
	
	function cmg_styles(){
		wp_register_style('main-style', get_template_directory_uri()."/style.css",'all');
		wp_enqueue_style("main-style" );
	}
	add_action("wp_enqueue_scripts","cmg_styles" );