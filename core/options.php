<?php
        if ( ! class_exists( 'CMG_Theme_Options' ) ) {
 
                /* class CMG_Theme_Options sẽ chứa toàn bộ code tạo options trong theme từ Redux Framework */
      class CMG_Theme_Options {
 			public $args = array();
 			public $sections = array();
 			public $theme;
 			public $ReduxFramework;

 			/* Load plugin Framework */
 			public function __construct(){

 				if( ! class_exists('ReduxFramework')){
 					return;
 				}

 				if( true == Redux_Helpers::isTheme(__FILE__) ){
 					$this->initSettings();
 				} else{
 					add_action('plugins_loaded', array($this,'initSettings'),10);
 				}
 			}
      }
                  /* Kích hoạt class CMG_Theme_Options vào Redux Framework */
        global $reduxConfig;
        $reduxConfig = new CMG_Theme_Options();
      }

      /**
      Thiết lập các method muốn sử dụng
                              Method nào được khai báo trong này thì cũng phải được sử dụng
                          **/
      public function initSettings() {
       
          // Set the default arguments
          $this->setArguments();
       
          // Set a few help tabs so you can see how it's done
          $this->setHelpTabs();
       
          // Create the sections and fields
          $this->setSections();
       
          if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
              return;
          }
       
          $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
      }