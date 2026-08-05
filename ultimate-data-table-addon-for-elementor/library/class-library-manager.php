<?php

use Elementor\Core\Common\Modules\Ajax\Module as Ajax;
use Elementor\Plugin;

defined( 'ABSPATH' ) || exit;

class Ultimate_Data_Table_Library_Manager {

	protected $source = null;

	public function __construct() {
		add_action( 'elementor/editor/footer', [ $this, 'print_template_views' ] );
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );
		add_action( 'elementor/ajax/register_actions', [ $this, 'register_ajax_actions' ] );
	}

	public function print_template_views() {
		include_once ULTIMATE_DATA_TABLE_DIR_PATH . 'library/templates.php';
	}

	public function editor_scripts() {
		wp_enqueue_style(
			'ultimate-data-table-templates-library',
			ULTIMATE_DATA_TABLE_DIR_URL . 'assets/css/template-library.min.css',
			[ 'elementor-editor' ],
			ULTIMATE_DATA_TABLE_VERSION
		);

		wp_enqueue_script(
			'ultimate-data-table-templates-library',
			ULTIMATE_DATA_TABLE_DIR_URL . 'assets/js/template-library.min.js',
			[ 'elementor-editor', 'jquery', 'jquery-hover-intent', ],
			ULTIMATE_DATA_TABLE_VERSION,
			true
		);

		// Pro templates unlock only when the Pro plugin is active AND its license is activated.
		$pro_installed = class_exists( 'Ultimate_Data_Table_Pro_Extension' );
		$pro_licensed  = $pro_installed
			&& class_exists( 'Ultimate_Data_Table_Pro_License' )
			&& Ultimate_Data_Table_Pro_License::is_active();

		wp_localize_script(
			'ultimate-data-table-templates-library',
			'udtaLibraryLocalize',
			[
				'buttonIcon'   => ULTIMATE_DATA_TABLE_DIR_URL . 'assets/img/udta-icon.png',
				'hasPro'       => $pro_licensed,
				'proInstalled' => $pro_installed,
				'licenseUrl'   => admin_url( 'admin.php?page=ultimate-data-table-pro-license' ),
			]
		);
	}

	public function get_source() {
		if ( is_null( $this->source ) ) {
			$this->source = new Ultimate_Data_Table_Library_Source();
		}

		return $this->source;
	}

	public function register_ajax_actions( Ajax $ajax ) {
		$ajax->register_ajax_action( 'udta_get_library_data', function ( $data ) {
			if ( ! current_user_can( 'edit_posts' ) ) {
				throw new \Exception( 'Access Denied' );
			}

			if ( ! empty( $data[ 'editor_post_id' ] ) ) {
				$editor_post_id = absint( $data[ 'editor_post_id' ] );

				if ( ! get_post( $editor_post_id ) ) {
					throw new \Exception( __( 'Post not found.', 'ultimate-data-table-addon-for-elementor' ) );
				}

				Plugin::instance()->db->switch_to_post( $editor_post_id );
			}

			return $this->get_library_data( $data );
		} );

		$ajax->register_ajax_action( 'udta_get_template_data', function ( $data ) {
			if ( ! current_user_can( 'edit_posts' ) ) {
				throw new \Exception( 'Access Denied' );
			}

			if ( ! empty( $data[ 'editor_post_id' ] ) ) {
				$editor_post_id = absint( $data[ 'editor_post_id' ] );

				if ( ! get_post( $editor_post_id ) ) {
					throw new \Exception( __( 'Post not found', 'ultimate-data-table-addon-for-elementor' ) );
				}

				Plugin::instance()->db->switch_to_post( $editor_post_id );
			}

			if ( empty( $data[ 'template_id' ] ) ) {
				throw new \Exception( __( 'Template id missing', 'ultimate-data-table-addon-for-elementor' ) );
			}

			return $this->get_template_data( $data );
		} );
	}

	public function get_library_data( array $args ) {
		$source = $this->get_source();

		if ( ! empty( $args[ 'sync' ] ) ) {
			$source->get_library_data( true );
		}

		return [
			'templates'  => $source->get_items(),
			'categories' => $source->get_categories(),
			'types'      => $source->get_types(),
		];
	}

	public function get_template_data( array $args ) {
		$source = $this->get_source();

		return $source->get_data( $args );
	}
}