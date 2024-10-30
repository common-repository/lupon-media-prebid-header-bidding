<?php

defined( 'ABSPATH' ) or die;

if ( ! class_exists( 'Lupon_Media_WPP_Main' ) ) {
	class Lupon_Media_WPP_Main {
		public static function get_instance() {
			if ( self::$instance == null ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		private static $instance = null;

		private function __clone() { }

		public function __wakeup() { }

		private function __construct() {
			$this->options = null;
			$this->adstxt_file = trailingslashit( ABSPATH ) . 'ads.txt';
			$this->allowed_atts = array(
				'align' => array(),
				'class' => array(),
				'type' => array(),
				'id' => array(),
				'dir' => array(),
				'lang' => array(),
				'style' => array(),
				'xml:lang' => array(),
				'src' => array(),
				'alt' => array(),
				'href' => array(),
				'rel' => array(),
				'rev' => array(),
				'target' => array(),
				'novalidate' => array(),
				'type' => array(),
				'value' => array(),
				'name' => array(),
				'tabindex' => array(),
				'action' => array(),
				'method' => array(),
				'for' => array(),
				'width' => array(),
				'height' => array(),
				'data' => array(),
				'title' => array()
			);
			$this->allowed_tags = array(
				'label',
				'input',
				'textarea',
				'iframe',
				'script',
				'style',
				'strong',
				'small',
				'table',
				'span',
				'abbr',
				'code',
				'pre',
				'div',
				'img',
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
				'ol',
				'ul',
				'li',
				'em',
				'hr',
				'br',
				'tr',
				'td',
				'p',
				'a',
				'b',
				'i'
			);
				

			add_action( 'admin_init', array( $this, 'register_settings' ) );
			add_action( 'admin_menu', array( $this, 'add_menu_item' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
			add_action( 'update_option_' . LUPON_MEDIA_WPP_OPTIONS_NAME, array( $this, 'update_option' ), 10, 3 );
			add_action( 'wp_head', array( $this, 'wp_head' ) );
			add_action( 'wp_footer', array( $this, 'wp_footer_start' ), 1 );
			add_action( 'wp_footer', array( $this, 'wp_footer_end' ), 1000 );

			add_filter( 'the_content', array( $this, 'filter_content' ), 1000 );
		}

		public function register_settings() {
			register_setting( LUPON_MEDIA_WPP_OPTSGROUP_NAME, LUPON_MEDIA_WPP_OPTIONS_NAME );
		}

		public function add_menu_item() {
			add_menu_page(
				__( 'Lupon Media WPP', 'lupon-media-wpp' ),
				__( 'Lupon Media WPP', 'lupon-media-wpp' ),
				'manage_options',
				'lupon-media-wpp',
				array( $this, 'render_options_page' )
			);
		}

		public function render_options_page() {
			require( LUPON_MEDIA_WPP_INC_PATH . 'options.php' );
		}

		public function enqueue_admin_assets( $n ) {
			if ( $n != 'toplevel_page_lupon-media-wpp' ) return;
			wp_enqueue_script( 'lupon-media-wpp-admin', plugins_url( 'js/admin.js', LUPON_MEDIA_WPP_FILE ), array( 'jquery' ), LUPON_MEDIA_WPP_VER, true );
		}

		public function update_option( $old_value, $value, $option ) {
			if ( ! is_writable( dirname( $this->adstxt_file ) ) ) return false;
			if ( ! isset( $value['adstxt_content'] ) ) return false;
			file_put_contents( $this->adstxt_file, $value['adstxt_content'] );
		}

		public function wp_head() {
			echo wp_kses( $this->get_option( 'header_content' ), $this->get_allowed_tags() );
		}

		public function wp_footer_start() {
			ob_start();
		}

		public function wp_footer_end() {
			$footer_html = ob_get_clean(); // Not ours, should be already escaped/safe
			$footer_content = wp_kses( $this->get_option( 'footer_content' ), $this->get_allowed_tags() );
			if ( preg_match( '/<\/footer>/i', $footer_html ) ) {
				$footer_html = str_replace( '</footer>', "$footer_content</footer>", $footer_html );
			} else {
				$footer_html .= $footer_content;
			}
			echo $footer_html;
		}

		public function filter_content( $content ) {
			if ( ! is_singular( 'post' ) ) return $content;
			$els = explode( '</p>', $content );
			foreach( $els as $index => $el ) {
				$els[$index + 0] .= '</p>';
				if ( count( $els ) <= $index + 1 ) break;
				if ( $index < 5 ) {
					$option = 'apc' . ( $index + 1 );
					$ad = $this->get_option( $option );
					if ( ! empty( $ad ) ) $els[$index + 0] .= $ad;
				}					
			}
			return implode( '', $els );
		}

		private function get_option( $option_name, $default = '' ) {
			if ( is_null( $this->options ) ) $this->options = ( array ) get_option( LUPON_MEDIA_WPP_OPTIONS_NAME, array() );
			if ( isset( $this->options[$option_name] ) ) return $this->options[$option_name];
			return $default;
		}

		private function get_adstxt_content() {
			if ( ! is_writable( dirname( $this->adstxt_file ) ) ) return false;
			if ( ! is_writable( $this->adstxt_file ) ) return false;
			return file_exists( $this->adstxt_file ) ? file_get_contents( $this->adstxt_file ) : '';
		}

		private function get_allowed_tags() {
			foreach( $this->allowed_tags as $index => $tag ) {
				$this->allowed_tags[$index] = $this->allowed_atts;
			}

			return $this->allowed_tags;
		}
	}
}