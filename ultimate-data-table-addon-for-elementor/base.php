<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
final class ultimate_data_table_Extension {

    private static $_instance = null;

    public function __construct() {
        
        add_action( 'plugins_loaded', [ $this, 'ultimate_data_table_init' ] );
    }

    public static function init() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function ultimate_data_table_init() {
        add_action( 'elementor/elements/categories_registered', [ $this, 'ultimate_data_table_register_elementor_category' ] );
        add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'ultimate_data_table_elementor_editor_css' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'ultimate_data_table_dependency' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'ultimate_data_table_enqueue_style' ] );
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'ultimate_data_table_editor_scripts' ] );
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'ultimate_data_table_register_elementor_widget' ] );
    }

    // Register a custom Elementor category
    public function ultimate_data_table_register_elementor_category($elements_manager) {
        $elements_manager->add_category(
            'ultimate_data_table_category',
            [
                'title' => esc_html__('Ultimate Table', 'ultimate-data-table-addon-for-elementor'),
                'icon' => 'eicon-theme-builder',
            ]
        );
    }

    // Frontend Script
    public function ultimate_data_table_editor_scripts() {
		wp_enqueue_script( 'ultimate-data-table-frontend-editor-js', ULTIMATE_DATA_TABLE_DIR_URL . '/assets/js/frontend.js', [ 'datatables' ], ULTIMATE_DATA_TABLE_VERSION, true );
	}

    // Dependency
    public function ultimate_data_table_dependency(){
        wp_enqueue_script('jquery');
        wp_enqueue_style('datatables', ULTIMATE_DATA_TABLE_DIR_URL.'/assets/css/datatables.min.css', [], ULTIMATE_DATA_TABLE_VERSION, 'all');
        wp_enqueue_script('datatables', ULTIMATE_DATA_TABLE_DIR_URL.'/assets/js/datatables.min.js', ['jquery'], ULTIMATE_DATA_TABLE_VERSION, true);
    }

    // Including editor CSS
    public function ultimate_data_table_elementor_editor_css() {
        wp_enqueue_style(
            'ultimate-data-table-elementor-editor-css',
            ULTIMATE_DATA_TABLE_DIR_URL . '/assets/css/el-ultimate-data-table-editor.css', [], ULTIMATE_DATA_TABLE_VERSION
        );
    }

    // Including widget CSS
    public function ultimate_data_table_enqueue_style() {
        wp_enqueue_style(
            'ultimate-data-table-style',
            ULTIMATE_DATA_TABLE_DIR_URL . 'widget/css/el-ultimate-data-table.css', [], ULTIMATE_DATA_TABLE_VERSION
        );
    }

    // Register the Elementor widget
    public function ultimate_data_table_register_elementor_widget() {
        if ( defined( 'ULTIMATE_DATA_TABLE_PRO_ACTIVE' ) ) {
            return;
        }
        
        include ULTIMATE_DATA_TABLE_DIR_PATH . 'widget/el-ultimate-data-table.php';
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Ultimate_Data_Table_Register_Elementor_Widget());
    }
}

// Initialize the plugin
function ultimate_data_table_addon() {
    return ultimate_data_table_Extension::init();
}
ultimate_data_table_addon();
