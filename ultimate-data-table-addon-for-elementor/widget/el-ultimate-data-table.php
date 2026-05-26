<?php

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Css_Filter;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

defined( 'ABSPATH' ) || die();

class Ultimate_Data_Table_Register_Elementor_Widget extends \Elementor\Widget_Base {
    public function get_name() {
        return 'ultimate_data_table_el_widget';
    }

    public function get_title() {
        return __('Data Table', 'ultimate-data-table-addon-for-elementor');
    }

    public function get_icon() {
        return 'eicon-table ultimate-badge';
    }

    public function get_categories() {
        return ['ultimate_data_table_category'];
    }

    public function get_keywords() {
        return ['table', 'rs', 'ultimate', 'data'];
    }

    protected function register_controls() {
		// Header Content Start
		$this->start_controls_section(
			'content_table_header',
			[
				'label' => esc_html__( 'Table Header', 'ultimate-data-table-addon-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
			$repeaterHeader = new Repeater();
			$repeaterHeader->add_control(
				'text', [
					'label' => esc_html__( 'Text', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'placeholder' => esc_html__( 'Table Header', 'ultimate-data-table-addon-for-elementor' ),
					'default' => esc_html__( 'Table Header', 'ultimate-data-table-addon-for-elementor' ),
					'dynamic' => [
						'active' => true,
					]
				]
			);
			$repeaterHeader->add_control(
				'advance', [
					'label' => esc_html__( 'Advance Settings', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'label_off' => esc_html__( 'No', 'ultimate-data-table-addon-for-elementor' ),
					'label_on' => esc_html__( 'Yes', 'ultimate-data-table-addon-for-elementor' ),
					'default' => 'no'
				]
			);
			$repeaterHeader->add_control(
				'colspan', [
					'label' => esc_html__( 'colSpan', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'condition' => [
						'advance' => 'yes',
					],
					'label_off' => esc_html__( 'No', 'ultimate-data-table-addon-for-elementor' ),
					'label_on' => esc_html__( 'Yes', 'ultimate-data-table-addon-for-elementor' ),
				]
			);
			$repeaterHeader->add_control(
				'colspannumber', [
					'label' => esc_html__( 'colSpan Number', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [
						'advance' => 'yes',
						'colspan' => 'yes',
					],
					'placeholder' => esc_html__( '1', 'ultimate-data-table-addon-for-elementor' ),
					'default' => esc_html__( '1', 'ultimate-data-table-addon-for-elementor' ),
				]
			);
			$repeaterHeader->add_control(
				'customwidth', [
					'label' => esc_html__( 'Custom Width', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'condition' => [
						'advance' => 'yes',
					],
					'label_off' => esc_html__( 'No', 'ultimate-data-table-addon-for-elementor' ),
					'label_on' => esc_html__( 'Yes', 'ultimate-data-table-addon-for-elementor' ),
				]
			);
			$repeaterHeader->add_control(
				'width', [
					'label' => esc_html__( 'Width', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'condition' => [
						'advance' => 'yes',
						'customwidth' => 'yes',
					],
					'range' => [
						'%' => [
							'min' => 0,
							'max' => 100,
						],
						'px' => [
							'min' => 1,
							'max' => 1000,
						],
					],
					'default' => [
						'size' => 30,
						'unit' => '%',
					],
					'size_units' => [ '%', 'px' ],
					'selectors' => [ '{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-header {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
					]
				]
			);
			$repeaterHeader->add_control(
				'align', [
					'label' => esc_html__( 'Alignment', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'condition' => [
						'advance' => 'yes',
					],
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-right',
						],
						'justify' => [
							'title' => esc_html__( 'Justified', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-justify',
						],
					],
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-header {{CURRENT_ITEM}}' => 'text-align: {{VALUE}};',
					]
				]
			);
			$repeaterHeader->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'this_typography',
					'selector' => '{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-header {{CURRENT_ITEM}}',
					'condition' => [
						'advance' => 'yes',
					],
				]
			);
			$repeaterHeader->add_control(
				'this_color',
				[
					'label' => esc_html__( 'Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-header {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
					],
					'condition' => [
						'advance' => 'yes',
					],
				]
			);
			$repeaterHeader->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'this_background',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-header {{CURRENT_ITEM}}',
					'condition' => [
						'advance' => 'yes',
					],
				]
			);
			$this->add_control(
				'table_header',
				[
					'label' => esc_html__( 'Table Header Cell', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeaterHeader->get_controls(),
					'default' => [
						[
							'text' => esc_html__( 'Table Header', 'ultimate-data-table-addon-for-elementor' ),
						],
						[
							'text' => esc_html__( 'Table Header', 'ultimate-data-table-addon-for-elementor' ),
						]
					],
					'title_field' => '{{{ text }}}',
				]
			);
		$this->end_controls_section();
		// Header Content End
		
		// Body Content Start
		$this->start_controls_section(
			'content_table_body',
			[
				'label' => esc_html__( 'Table Body', 'ultimate-data-table-addon-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
			$repeaterBody = new Repeater();
			$repeaterBody->add_control(
				'row', [
					'label' => esc_html__( 'New Row', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'label_off' => esc_html__( 'No', 'ultimate-data-table-addon-for-elementor' ),
					'label_on' => esc_html__( 'Yes', 'ultimate-data-table-addon-for-elementor' ),
				]
			);
			$repeaterBody->add_control(
				'text', [
					'label' => esc_html__( 'Text', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::TEXTAREA,
					'label_block' => true,
					'placeholder' => esc_html__( 'Table Data', 'ultimate-data-table-addon-for-elementor' ),
					'default' => esc_html__( 'Table Data', 'ultimate-data-table-addon-for-elementor' ),
					'dynamic' => [
						'active' => true,
					]
				]
			);
			$repeaterBody->add_control(
				'advance', [
					'label' => esc_html__( 'Advance Settings', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'label_off' => esc_html__( 'No', 'ultimate-data-table-addon-for-elementor' ),
					'label_on' => esc_html__( 'Yes', 'ultimate-data-table-addon-for-elementor' ),
				]
			);
			$repeaterBody->add_control(
				'colspan', [
					'label' => esc_html__( 'colSpan', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'condition' => [
						'advance' => 'yes',
					],
					'label_off' => esc_html__( 'No', 'ultimate-data-table-addon-for-elementor' ),
					'label_on' => esc_html__( 'Yes', 'ultimate-data-table-addon-for-elementor' ),
					'separator' => 'before'
				]
			);
			$repeaterBody->add_control(
				'colspannumber', [
					'label' => esc_html__( 'colSpan Number', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [
						'advance' => 'yes',
						'colspan' => 'yes',
					],
					'placeholder' => esc_html__( '1', 'ultimate-data-table-addon-for-elementor' ),
					'default' => esc_html__( '1', 'ultimate-data-table-addon-for-elementor' ),
				]
			);
			$repeaterBody->add_control(
				'rowspan', [
					'label' => esc_html__( 'rowSpan', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'condition' => [
						'advance' => 'yes',
					],
					'label_off' => esc_html__( 'No', 'ultimate-data-table-addon-for-elementor' ),
					'label_on' => esc_html__( 'Yes', 'ultimate-data-table-addon-for-elementor' ),
				]
			);
			$repeaterBody->add_control(
				'rowspannumber', [
					'label' => esc_html__( 'rowSpan Number', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [
						'advance' => 'yes',
						'rowspan' => 'yes',
					],
					'placeholder' => esc_html__( '1', 'ultimate-data-table-addon-for-elementor' ),
					'default' => esc_html__( '1', 'ultimate-data-table-addon-for-elementor' ),
				]
			);
			$repeaterBody->add_control(
				'align', [
					'label' => esc_html__( 'Alignment', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'condition' => [
						'advance' => 'yes',
					],
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-right',
						],
						'justify' => [
							'title' => esc_html__( 'Justified', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-justify',
						],
					],
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-body {{CURRENT_ITEM}}' => 'text-align: {{VALUE}};',
					],
					'separator' => 'before'
				]
			);
			$repeaterBody->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'this_typography',
					'selector' => '{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-body {{CURRENT_ITEM}}',
					'condition' => [
						'advance' => 'yes',
					],
				]
			);
			$repeaterBody->add_control(
				'this_color',
				[
					'label' => esc_html__( 'Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-body {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
					],
					'condition' => [
						'advance' => 'yes',
					],
				]
			);
			$repeaterBody->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'this_background',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-body {{CURRENT_ITEM}}',
					'condition' => [
						'advance' => 'yes',
					],
				]
			);
			$this->add_control(
				'table_body',
				[
					'label' => esc_html__( 'Table Body Cell', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeaterBody->get_controls(),
					'default' => [
						[
							'text' => esc_html__( 'Table Data', 'ultimate-data-table-addon-for-elementor' ),
						],
						[
							'text' => esc_html__( 'Table Data', 'ultimate-data-table-addon-for-elementor' ),
						],
					],
					'title_field' => '{{{ text }}}',
				]
			);
		$this->end_controls_section();
		// Body Content Start
		
		// Configuration Content Start
		$this->start_controls_section(
            '_section_datatables',
            [
                'label' => esc_html__( 'Configuration', 'ultimate-data-table-addon-for-elementor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
			$this->add_control(
				'show_search',
				[
					'label' => esc_html__( 'Enable Search', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,               
					'label_on' => esc_html__( 'Show', 'ultimate-data-table-addon-for-elementor' ),
					'label_off' => esc_html__( 'Hide', 'ultimate-data-table-addon-for-elementor' ),
					'return_value' => 'yes',
					'default' => 'no',
					'render_type' => 'template',
					'frontend_available' => true
				]
			);
			$this->add_control(
				'search_label',
				[
					'label' => esc_html__( 'Label', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'Search:', 'ultimate-data-table-addon-for-elementor' ),
					'label_block' => true,
					'condition' => [
						'show_search' => 'yes'
					],
					'frontend_available' => true
				]
			);
			$this->add_control(
				'no_data_label',
				[
					'label' => esc_html__( 'No Data Text', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'No data found', 'ultimate-data-table-addon-for-elementor' ),
					'label_block' => true,
					'condition' => [
						'show_search' => 'yes'
					],
					'frontend_available' => true
				]
			);
			$this->add_control(
				'show_pagination',
				[
					'label'        => esc_html__( 'Enable Pagination', 'ultimate-data-table-addon-for-elementor' ),
					'type'         => Controls_Manager::SWITCHER,               
					'label_on'     => esc_html__( 'Show', 'ultimate-data-table-addon-for-elementor' ),
					'label_off'    => esc_html__( 'Hide', 'ultimate-data-table-addon-for-elementor' ),
					'return_value' => 'yes',
					'default'      => 'no',
					'render_type' => 'template',
					'separator' => 'before',
					'frontend_available' => true
				]
			);
			$this->add_control(
				'pagination_entries_label',
				[
					'label' => esc_html__( 'Label', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'Entries per page:', 'ultimate-data-table-addon-for-elementor' ),
					'label_block' => true,
					'condition' => [
						'show_pagination' => 'yes'
					],
					'frontend_available' => true
				]
			);
			$this->add_control(
				'pagination_type',
				[
					'label' => esc_html__( 'Pagination Type', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						''                => esc_html__( 'Default', 'ultimate-data-table-addon-for-elementor' ),
						'simple'          => esc_html__( 'Simple (Prev / Next)', 'ultimate-data-table-addon-for-elementor' ),
						'simple_numbers'  => esc_html__( 'Simple Numbers', 'ultimate-data-table-addon-for-elementor' ),
						'numbers'         => esc_html__( 'Numbers Only', 'ultimate-data-table-addon-for-elementor' ),
						'full'            => esc_html__( 'Full (First / Prev / Next / Last)', 'ultimate-data-table-addon-for-elementor' ),
						'full_numbers'    => esc_html__( 'Full Numbers', 'ultimate-data-table-addon-for-elementor' ),
						'first_last_numbers' => esc_html__( 'First + Numbers + Last', 'ultimate-data-table-addon-for-elementor' ),
					],
					'condition' => [
						'show_pagination' => 'yes'
					],
					'frontend_available' => true
				]
			);
			$this->add_control(
				'enable_ordering',
				[
					'label'        => esc_html__( 'Enable Ordering', 'ultimate-data-table-addon-for-elementor' ),
					'type'         => Controls_Manager::SWITCHER,               
					'label_on'     => esc_html__( 'Show', 'ultimate-data-table-addon-for-elementor' ),
					'label_off'    => esc_html__( 'Hide', 'ultimate-data-table-addon-for-elementor' ),
					'return_value' => 'yes',
					'default'      => 'no',
					'render_type' => 'template',
					'separator' => 'before',
					'frontend_available' => true
				]
			);
			$this->add_control(
				'show_tableinfo',
				[
					'label'        => esc_html__( 'Show Table Info', 'ultimate-data-table-addon-for-elementor' ),
					'type'         => Controls_Manager::SWITCHER,               
					'label_on'     => esc_html__( 'Show', 'ultimate-data-table-addon-for-elementor' ),
					'label_off'    => esc_html__( 'Hide', 'ultimate-data-table-addon-for-elementor' ),
					'return_value' => 'yes',
					'default'      => 'no',
					'render_type' => 'template',
					'separator' => 'before',
					'frontend_available' => true
				]
			);
			$this->add_control(
				'info_text',
				[
					'label' => esc_html__( 'Info Text', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'Showing _START_ to _END_ of _TOTAL_ entries', 'ultimate-data-table-addon-for-elementor' ),
					'label_block' => true,
					'condition' => [
						'show_tableinfo' => 'yes'
					],
					'frontend_available' => true
				]
			);
			$this->add_control(
				'info_after_filter',
				[
					'label' => esc_html__( 'Info Text After Filter', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( '(filtered from _MAX_ total entries)', 'ultimate-data-table-addon-for-elementor' ),
					'label_block' => true,
					'condition' => [
						'show_tableinfo' => 'yes'
					],
					'frontend_available' => true
				]
			);
			$this->add_control(
				'info_text_help',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw'  => '
						<code>_START_</code> = First visible row number<br>
						<code>_END_</code>   = Last visible row number<br>
						<code>_TOTAL_</code> = Total number of entries<br>
						<code>_MAX_</code>   = Total entries before filtering
					',
					'content_classes' => 'rs-panel-notice',
					'condition' => [
						'show_tableinfo' => 'yes'
					],
				]
			);
        $this->end_controls_section();
		// Configuration Content End

		// Table Global Style Start
		$this->start_controls_section(
			'section_table_style',
			[
				'label' => esc_html__( 'Table Global', 'ultimate-data-table-addon-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'table_margin',
				[
					'label' => esc_html__( 'Wrapper Margin', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row.dt-layout-table' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'table_padding',
				[
					'label' => esc_html__( 'Inner Cell Padding', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table td,{{WRAPPER}} .ultimate-data-table table th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'word_break',
				[
					'label' => esc_html__( 'Word Break', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'' => esc_html__( 'Default', 'ultimate-data-table-addon-for-elementor' ),
						'unset' => esc_html__( 'Break Words', 'ultimate-data-table-addon-for-elementor' ),
						'nowrap' => esc_html__( 'No Break', 'ultimate-data-table-addon-for-elementor' ),
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row table th,
						{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row table td' => 'white-space: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'g_border_style',
				[
					'label' => esc_html__( 'Border Style', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'' => esc_html__( 'Default', 'ultimate-data-table-addon-for-elementor' ),
						'none' => esc_html__( 'None', 'ultimate-data-table-addon-for-elementor' ),
						'solid' => esc_html__( 'Solid', 'ultimate-data-table-addon-for-elementor' ),
						'dotted' => esc_html__( 'Dotted', 'ultimate-data-table-addon-for-elementor' ),
						'dashed' => esc_html__( 'Dashed', 'ultimate-data-table-addon-for-elementor' ),
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table' => '--borderStyle: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'g_border_width',
				[
					'label' => esc_html__( 'Border Width', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table' => '--borderWidth: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'g_border_style!' => ['none', ''],
					]
				]
			);
			$this->add_control(
				'g_border_color',
				[
					'label' => esc_html__( 'Border Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table' => '--borderColor: {{VALUE}}',
					],
					'condition' => [
						'g_border_style!' => ['none', ''],
					]
				]
			);
		$this->end_controls_section();
		// Table Global Style End

		// Header Style Start
		$this->start_controls_section(
			'table_header_style',
			[
				'label' => esc_html__( 'Table Header', 'ultimate-data-table-addon-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'header_align',
				[
					'label' => esc_html__( 'Alignment', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-right',
						],
						'justify' => [
							'title' => esc_html__( 'Justified', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-header th' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'header_text_color',
				[
					'label' => esc_html__( 'Text Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-header th' => 'color: {{VALUE}};',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'header_typography',
					'selector' => '{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-header th',
				]
			);
			$this->add_control(
				'header_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-header' => 'background-color: {{VALUE}};',
					]
				]
			);
			$this->add_responsive_control(
				'header_border_style',
				[
					'label' => esc_html__( 'Border Style', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'' => esc_html__( 'Default', 'ultimate-data-table-addon-for-elementor' ),
						'none' => esc_html__( 'None', 'ultimate-data-table-addon-for-elementor' ),
						'solid' => esc_html__( 'Solid', 'ultimate-data-table-addon-for-elementor' ),
						'dotted' => esc_html__( 'Dotted', 'ultimate-data-table-addon-for-elementor' ),
						'dashed' => esc_html__( 'Dashed', 'ultimate-data-table-addon-for-elementor' ),
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-header' => '--borderStyle: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'header_border_width',
				[
					'label' => esc_html__( 'Border Width', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-header' => '--borderWidth: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'header_border_style!' => ['none', ''],
					]
				]
			);
			$this->add_control(
				'header_border_color',
				[
					'label' => esc_html__( 'Border Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-header' => '--borderColor: {{VALUE}}',
					],
					'condition' => [
						'header_border_style!' => ['none', ''],
					]
				]
			);
			$this->add_responsive_control(
				'header_cells_padding',
				[
					'label' => esc_html__( 'Cell Padding', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-header th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		// Header Style End

		// Body Style Start
		$this->start_controls_section(
			'table_body_style',
			[
				'label' => esc_html__( 'Table Body', 'ultimate-data-table-addon-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'body_align',
				[
					'label' => esc_html__( 'Alignment', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-right',
						],
						'justify' => [
							'title' => esc_html__( 'Justified', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-body' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'body_text_color',
				[
					'label' => esc_html__( 'Text Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-body td' => 'color: {{VALUE}};',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'body_typography',
					'selector' => '{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-body td',
				]
			);
			$this->add_control(
				'body_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-body' => 'background-color: {{VALUE}};',
					]
				]
			);
			$this->add_control(
				'striped_bg', 
				[
					'label' => esc_html__( 'Striped Background', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'label_off' => esc_html__( 'No', 'ultimate-data-table-addon-for-elementor' ),
					'label_on' => esc_html__( 'Yes', 'ultimate-data-table-addon-for-elementor' ),
				]
			);
			$this->add_control(
				'striped_bg_color', 
				[
					'label' => esc_html__( 'Secondary Background Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'condition' => [
						'striped_bg' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-body tr:nth-child(odd)' => 'background-color: {{VALUE}};',
					]
				]
			);
			$this->add_responsive_control(
				'body_border_style',
				[
					'label' => esc_html__( 'Border Style', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'' => esc_html__( 'Default', 'ultimate-data-table-addon-for-elementor' ),
						'none' => esc_html__( 'None', 'ultimate-data-table-addon-for-elementor' ),
						'solid' => esc_html__( 'Solid', 'ultimate-data-table-addon-for-elementor' ),
						'dotted' => esc_html__( 'Dotted', 'ultimate-data-table-addon-for-elementor' ),
						'dashed' => esc_html__( 'Dashed', 'ultimate-data-table-addon-for-elementor' ),
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-body' => '--borderStyle: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'body_border_width',
				[
					'label' => esc_html__( 'Border Width', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-body' => '--borderWidth: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'body_border_style!' => ['none', ''],
					]
				]
			);
			$this->add_control(
				'body_border_color',
				[
					'label' => esc_html__( 'Border Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-body' => '--borderColor: {{VALUE}}',
					],
					'condition' => [
						'body_border_style!' => ['none', ''],
					]
				]
			);
			$this->add_responsive_control(
				'body_cells_padding',
				[
					'label' => esc_html__( 'Cell Padding', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table table .ultimate-data-table-body td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		// Body Style End

		// Row/Column Style End
		$this->start_controls_section(
			'section_g_row_col_style',
			[
				'label' => esc_html__( 'Row/Column', 'ultimate-data-table-addon-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'g_row_ctrl_heading',
				[
					'label' => esc_html__( 'Row Controls', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'classes' => 'rs-control-type-heading',
				]
			);
			$this->add_responsive_control(
				'g_row_flex_v_align',
				[
					'label' => esc_html__( 'Vertical Align', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'flex-start' => [ 'title' => esc_html__( 'Top', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-align-start-v' ],
						'center'     => [ 'title' => esc_html__( 'Middle', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-align-center-v' ],
						'flex-end'   => [ 'title' => esc_html__( 'Bottom', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-align-end-v' ],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row' => 'align-items: {{VALUE}} !important;',
					],
				]
			);
			$this->add_responsive_control(
				'g_row_flex_h_align',
				[
					'label' => esc_html__( 'Horizontal Align', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'flex-start'     => [ 'title' => esc_html__( 'Start', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-align-start-h' ],
						'center'         => [ 'title' => esc_html__( 'Center', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-align-center-h' ],
						'flex-end'       => [ 'title' => esc_html__( 'End', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-align-end-h' ],
						'space-between'  => [ 'title' => esc_html__( 'Space Between', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-justify-space-between-h' ],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row' => 'justify-content: {{VALUE}} !important;',
					],
				]
			);
			$this->add_responsive_control(
				'g_row_flex_dir',
				[
					'label' => esc_html__( 'Column Direction', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'row'            => [ 'title' => esc_html__( 'Row', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-justify-start-h' ],
						'row-reverse'    => [ 'title' => esc_html__( 'Row Reverse', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-wrap' ],
						'column'         => [ 'title' => esc_html__( 'Column', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-justify-start-v' ],
						'column-reverse' => [ 'title' => esc_html__( 'Column Reverse', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-wrap' ],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row' => 'flex-direction: {{VALUE}} !important;',
					],
				]
			);
			$this->add_responsive_control(
				'g_row_flex_wrap',
				[
					'label' => esc_html__( 'Flex Wrap', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'nowrap' => [ 'title' => esc_html__( 'No Wrap', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-nowrap' ],
						'wrap'   => [ 'title' => esc_html__( 'Wrap', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-wrap' ],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row' => 'flex-wrap: {{VALUE}} !important;',
					],
				]
			);
			$this->add_responsive_control(
				'g_row_flex_gap',
				[
					'label' => esc_html__( 'Gap Between', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [ 'min' => 0, 'max' => 1000 ],
						'%' => [ 'min' => 0, 'max' => 100 ],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row' => 'gap: {{SIZE}}{{UNIT}} !important;',
					],
				]
			);
			$this->add_responsive_control(
				'g_row_margin',
				[
					'label' => esc_html__( 'Margin', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'g_col_ctrl_heading',
				[
					'label' => esc_html__( 'Column Controls', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'classes' => 'rs-control-type-heading',
					'separator' => 'before'
				]
			);
			$this->add_responsive_control(
				'g_col_width',
				[
					'label' => esc_html__( 'Width', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-layout-cell:not(.dt-layout-full)' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		// Row/Column Style End

		// Search Style Start
		$this->start_controls_section(
			'search_style',
			[
				'label' => esc_html__( 'Search', 'ultimate-data-table-addon-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' =>[
					'show_search' => 'yes'
				]
			]
		);
			$this->add_control(
				'search_wrapper_ctrl_heading',
				[
					'label' => esc_html__( 'Wrapper', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'classes' => 'rs-control-type-heading',
				]
			);
			$this->add_responsive_control(
				'search_wrapper_align',
				[
					'label' => esc_html__( 'Text Align', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-right',
						],
					],
					'default' => '',
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-layout-cell .dt-search' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'search_wrapper_width',
				[
					'label' => esc_html__( 'Width', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-layout-cell .dt-search' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'search_label_ctrl_heading',
				[
					'label' => esc_html__( 'Label', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'classes' => 'rs-control-type-heading',
					'separator' => 'before'
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'search_label_typo',
					'selector' => '{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-search label',
				]
			);
			$this->add_control(
				'search_label_color',
				[
					'label' => esc_html__( 'Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-search label' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'search_label_margin',
				[
					'label' => esc_html__( 'Margin', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-search label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'search_input_ctrl_heading',
				[
					'label' => esc_html__( 'Input', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'classes' => 'rs-control-type-heading',
					'separator' => 'before'
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'search_input_typo',
					'selector' => '{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-search input',
				]
			);
			$this->add_control(
				'search_input_color',
				[
					'label' => esc_html__( 'Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-search input' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'search_input_background',
				[
					'label' => esc_html__( 'Background', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-search input' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'search_input_padding',
				[
					'label' => esc_html__( 'Padding', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-search input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'search_input_radius',
				[
					'label' => esc_html__( 'Border Radius', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-search input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'search_input_min_width',
				[
					'label' => esc_html__( 'Min Width', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-search input' => 'min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'search_input_height',
				[
					'label' => esc_html__( 'Height', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-search input' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'search_input_border_style',
				[
					'label' => esc_html__( 'Border Style', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'' => esc_html__( 'Default', 'ultimate-data-table-addon-for-elementor' ),
						'none' => esc_html__( 'None', 'ultimate-data-table-addon-for-elementor' ),
						'solid' => esc_html__( 'Solid', 'ultimate-data-table-addon-for-elementor' ),
						'dotted' => esc_html__( 'Dotted', 'ultimate-data-table-addon-for-elementor' ),
						'dashed' => esc_html__( 'Dashed', 'ultimate-data-table-addon-for-elementor' ),
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-search' => '--borderStyle: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'search_input_border_width',
				[
					'label' => esc_html__( 'Border Width', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-search' => '--borderWidth: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'search_input_border_style!' => ['none', ''],
					]
				]
			);
			$this->add_control(
				'search_input_border_color',
				[
					'label' => esc_html__( 'Border Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-search' => '--borderColor: {{VALUE}}',
					],
					'condition' => [
						'search_input_border_style!' => ['none', ''],
					]
				]
			);
		$this->end_controls_section();
		// Search Style End

		// Entries Dropdown Style Start
		$this->start_controls_section(
			'entries_dropdown_style',
			[
				'label' => esc_html__( 'Entries Dropdown', 'ultimate-data-table-addon-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' =>[
					'show_pagination' => 'yes'
				]
			]
		);
			$this->add_control(
				'entries_dropdown_wrapper_ctrl_heading',
				[
					'label' => esc_html__( 'Wrapper', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'classes' => 'rs-control-type-heading',
				]
			);
			$this->add_responsive_control(
				'entries_dropdown_wrapper_align',
				[
					'label' => esc_html__( 'Text Align', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-right',
						],
					],
					'default' => '',
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-layout-cell .dt-length' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'entries_dropdown_wrapper_width',
				[
					'label' => esc_html__( 'Width', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-layout-cell .dt-length' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'entries_dropdown_label_ctrl_heading',
				[
					'label' => esc_html__( 'Label', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'classes' => 'rs-control-type-heading',
					'separator' => 'before'
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'entries_dropdown_label_typo',
					'selector' => '{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-length label',
				]
			);
			$this->add_control(
				'entries_dropdown_label_color',
				[
					'label' => esc_html__( 'Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-length label' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'entries_dropdown_label_margin',
				[
					'label' => esc_html__( 'Margin', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-length label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'entries_dropdown_ctrl_heading',
				[
					'label' => esc_html__( 'Dropdown', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'classes' => 'rs-control-type-heading',
					'separator' => 'before'
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'entries_dropdown_typo',
					'selector' => '{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-length select',
				]
			);
			$this->add_control(
				'entries_dropdown_color',
				[
					'label' => esc_html__( 'Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-length select' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'entries_dropdown_background',
				[
					'label' => esc_html__( 'Background', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-length select' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'entries_dropdown_padding',
				[
					'label' => esc_html__( 'Padding', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-length select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'entries_dropdown_radius',
				[
					'label' => esc_html__( 'Border Radius', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-length select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'entries_dropdown_min_width',
				[
					'label' => esc_html__( 'Min Width', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-length select' => 'min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'entries_dropdown_height',
				[
					'label' => esc_html__( 'Height', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-length select' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'entries_dropdown_border_style',
				[
					'label' => esc_html__( 'Border Style', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'' => esc_html__( 'Default', 'ultimate-data-table-addon-for-elementor' ),
						'none' => esc_html__( 'None', 'ultimate-data-table-addon-for-elementor' ),
						'solid' => esc_html__( 'Solid', 'ultimate-data-table-addon-for-elementor' ),
						'dotted' => esc_html__( 'Dotted', 'ultimate-data-table-addon-for-elementor' ),
						'dashed' => esc_html__( 'Dashed', 'ultimate-data-table-addon-for-elementor' ),
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-length' => '--borderStyle: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'entries_dropdown_border_width',
				[
					'label' => esc_html__( 'Border Width', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-length' => '--borderWidth: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'entries_dropdown_border_style!' => ['none', ''],
					]
				]
			);
			$this->add_control(
				'entries_dropdown_border_color',
				[
					'label' => esc_html__( 'Border Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-length' => '--borderColor: {{VALUE}}',
					],
					'condition' => [
						'entries_dropdown_border_style!' => ['none', ''],
					]
				]
			);
			$this->add_control(
				'entries_dropdown_icon_ctrl_heading',
				[
					'label' => esc_html__( 'Icon', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'classes' => 'rs-control-type-heading',
					'separator' => 'before'
				]
			);
			$this->add_control(
				'entries_dropdown_icon_color',
				[
					'label' => esc_html__( 'Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row  .dt-length:after' => 'color: {{VALUE}} !important;',
					],
				]
			);
			$this->add_responsive_control(
				'entries_dropdown_icon_size',
				[
					'label' => esc_html__( 'Size', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row  .dt-length:after' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					],
				]
			);
			$this->add_responsive_control(
				'entries_dropdown_icon_position_x',
				[
					'label' => esc_html__( 'Position X', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-length:after' => 'right: {{SIZE}}{{UNIT}} !important;',
					],
				]
			);
			$this->add_responsive_control(
				'entries_dropdown_icon_position_y',
				[
					'label' => esc_html__( 'Position Y', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-length:after' => 'bottom: {{SIZE}}{{UNIT}} !important;',
					],
				]
			);
		$this->end_controls_section();
		// Entries Dropdown Style End

		// Pagination Style Start
		$this->start_controls_section(
			'pagination_style',
			[
				'label' => esc_html__( 'Pagination', 'ultimate-data-table-addon-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' =>[
					'show_pagination' => 'yes'
				]
			]
		);
			$this->add_control(
				'pagination_wrapper_ctrl_heading',
				[
					'label' => esc_html__( 'Wrapper', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'classes' => 'rs-control-type-heading',
				]
			);
			$this->add_responsive_control(
				'pagination_wrapper_width',
				[
					'label' => esc_html__( 'Width', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'pagination_wrapper_flex_v_align',
				[
					'label' => esc_html__( 'Vertical Align', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'flex-start' => [ 'title' => esc_html__( 'Top', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-align-start-v' ],
						'center'     => [ 'title' => esc_html__( 'Middle', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-align-center-v' ],
						'flex-end'   => [ 'title' => esc_html__( 'Bottom', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-align-end-v' ],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav' => 'align-items: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'pagination_wrapper_flex_h_align',
				[
					'label' => esc_html__( 'Horizontal Align', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'flex-start'     => [ 'title' => esc_html__( 'Start', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-align-start-h' ],
						'center'         => [ 'title' => esc_html__( 'Center', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-align-center-h' ],
						'flex-end'       => [ 'title' => esc_html__( 'End', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-align-end-h' ],
						'space-between'  => [ 'title' => esc_html__( 'Space Between', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-justify-space-between-h' ],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav' => 'justify-content: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'pagination_wrapper_flex_dir',
				[
					'label' => esc_html__( 'Column Direction', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'row'            => [ 'title' => esc_html__( 'Row', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-justify-start-h' ],
						'row-reverse'    => [ 'title' => esc_html__( 'Row Reverse', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-wrap' ],
						'column'         => [ 'title' => esc_html__( 'Column', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-justify-start-v' ],
						'column-reverse' => [ 'title' => esc_html__( 'Column Reverse', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-wrap' ],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav' => 'flex-direction: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'pagination_wrapper_flex_wrap',
				[
					'label' => esc_html__( 'Flex Wrap', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'nowrap' => [ 'title' => esc_html__( 'No Wrap', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-nowrap' ],
						'wrap'   => [ 'title' => esc_html__( 'Wrap', 'ultimate-data-table-addon-for-elementor' ), 'icon' => 'eicon-wrap' ],
					],
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav' => 'flex-wrap: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'pagination_wrapper_flex_gap',
				[
					'label' => esc_html__( 'Gap Between', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [ 'min' => 0, 'max' => 1000 ],
						'%' => [ 'min' => 0, 'max' => 100 ],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'pagination_item_ctrl_heading',
				[
					'label' => esc_html__( 'Item', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'classes' => 'rs-control-type-heading',
					'separator' => 'before'
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'pagination_item_typography',
					'selector' => '{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav .dt-paging-button',
				]
			);
			$this->add_responsive_control(
				'pagination_item_padding',
				[
					'label' => esc_html__( 'Padding', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav .dt-paging-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'pagination_item_radius',
				[
					'label' => esc_html__( 'Border Radius', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav .dt-paging-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'pagination_item_width',
				[
					'label' => esc_html__( 'Width', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav .dt-paging-button' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'pagination_item_height',
				[
					'label' => esc_html__( 'Height', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav .dt-paging-button' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->start_controls_tabs( 'pagination_item_style_tabs' );
				$this->start_controls_tab(
					'pagination_item_style_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'ultimate-data-table-addon-for-elementor' ),
					]
				);
					$this->add_control(
						'pagination_item_color',
						[
							'label' => esc_html__( 'Color', 'ultimate-data-table-addon-for-elementor' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav .dt-paging-button' => 'color: {{VALUE}} !important;',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' => 'pagination_item_background',
							'types' => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav .dt-paging-button',
						]
					);
					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name' => 'pagination_item_border',
							'selector' => '{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav .dt-paging-button',
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'pagination_item_style_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'ultimate-data-table-addon-for-elementor' ),
					]
				);
					$this->add_control(
						'pagination_item_color_hover',
						[
							'label' => esc_html__( 'Color', 'ultimate-data-table-addon-for-elementor' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav .dt-paging-button:hover' => 'color: {{VALUE}} !important;',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' => 'pagination_item_background_hover',
							'types' => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav .dt-paging-button:hover',
						]
					);
					$this->add_control(
						'pagination_item_border_color_hover',
						[
							'label' => esc_html__( 'Border Color', 'ultimate-data-table-addon-for-elementor' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav .dt-paging-button:hover' => 'border-color: {{VALUE}}',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'pagination_item_style_active_tab',
					[
						'label' => esc_html__( 'Active', 'ultimate-data-table-addon-for-elementor' ),
					]
				);
					$this->add_control(
						'pagination_item_color_active',
						[
							'label' => esc_html__( 'Color', 'ultimate-data-table-addon-for-elementor' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav .dt-paging-button.current' => 'color: {{VALUE}} !important;',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name' => 'pagination_item_background_active',
							'types' => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav .dt-paging-button.current',
						]
					);
					$this->add_control(
						'pagination_item_border_color_active',
						[
							'label' => esc_html__( 'Border Color', 'ultimate-data-table-addon-for-elementor' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-paging nav .dt-paging-button.current' => 'border-color: {{VALUE}}',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		// Pagination Style End

		// Info Style Start
		$this->start_controls_section(
			'tableinfo_style',
			[
				'label' => esc_html__( 'Info Style', 'ultimate-data-table-addon-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' =>[
					'show_tableinfo' => 'yes'
				]
			]
		);
			$this->add_control(
				'tableinfo_wrapper_ctrl_heading',
				[
					'label' => esc_html__( 'Wrapper', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'classes' => 'rs-control-type-heading',
				]
			);
			$this->add_responsive_control(
				'tableinfo_wrapper_align',
				[
					'label' => esc_html__( 'Text Align', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'ultimate-data-table-addon-for-elementor' ),
							'icon' => 'eicon-text-align-right',
						],
					],
					'default' => '',
					'toggle' => true,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-layout-cell .dt-info' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'tableinfo_wrapper_width',
				[
					'label' => esc_html__( 'Width', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-info' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'tableinfo_text_ctrl_heading',
				[
					'label' => esc_html__( 'Text', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::HEADING,
					'classes' => 'rs-control-type-heading',
					'separator' => 'before'
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'tableinfo_text_typography',
					'selector' => '{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-info',
				]
			);
			$this->add_control(
				'tableinfo_text_color',
				[
					'label' => esc_html__( 'Color', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-info' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'tableinfo_text_margin',
				[
					'label' => esc_html__( 'Margin', 'ultimate-data-table-addon-for-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .ultimate-data-table .dt-container .dt-layout-row .dt-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		// Info Style End
	}

	protected function render() {
	    $settings = $this->get_settings_for_display();
	    $unique   = 'uni-' . $this->get_id();
	    ?>

	    <div class="ultimate-data-table">
	        <table id="<?php echo esc_attr( 'ultimate-datatable-' . $unique ); ?>">
	            <thead class="ultimate-data-table-header">
	                <tr>
	                    <?php
	                    $header_count = isset($settings['table_header']) ? count($settings['table_header']) : 0;

	                    foreach ($settings['table_header'] as $index => $headeritem) {

	                        $repeater_setting_key = $this->get_repeater_setting_key('text', 'table_header', $index);
	                        $this->add_inline_editing_attributes($repeater_setting_key);
		                    if (
			                    !empty($headeritem['colspan']) &&
			                    $headeritem['colspan'] === 'yes' &&
			                    !empty($headeritem['advance']) &&
			                    $headeritem['advance'] === 'yes'
		                    ) {
			                    $this->add_render_attribute($repeater_setting_key, 'colspan', $headeritem['colspannumber']);
		                    }
		                    $this->add_render_attribute(
			                    $repeater_setting_key,
			                    'class',
			                    [
				                    'elementor-inline-editing',
				                    'elementor-repeater-item-' . $headeritem['_id'],
			                    ]
		                    );
	                        ?>
	                        <th
	                            <?php $this->print_render_attribute_string($repeater_setting_key); ?>
	                        >
	                            <?php echo esc_html( $headeritem['text'] ); ?>
	                        </th>
	                        <?php
	                    }
	                    ?>
	                </tr>
	            </thead>

	            <tbody class="ultimate-data-table-body">
	                <?php
	                $cell_count = 0;
	                echo '<tr>';

	                foreach ($settings['table_body'] as $index => $item) {

	                    $table_body_key = $this->get_repeater_setting_key('text', 'table_body', $index);
	                    $this->add_inline_editing_attributes($table_body_key);

	                    if (isset($item['row']) && $item['row'] === 'yes' && $cell_count > 0) {
	                        $missing_cells = $header_count - $cell_count;

	                        for ($i = 0; $i < $missing_cells; $i++) {
	                            echo '<td style="display:none;"></td>';
	                        }

	                        echo '</tr><tr>';
	                        $cell_count = 0;
	                    }

	                    $cell_attr = [];
						
						if (
							isset($item['colspan'], $item['advance']) &&
							$item['colspan'] === 'yes' &&
							$item['advance'] === 'yes' &&
							!empty($item['colspannumber'])
						) {
							$cell_attr[] = 'colspan=' . intval($item['colspannumber']);

							$this->add_render_attribute(
								$table_body_key,
								'colspan',
								intval($item['colspannumber'])
							);
						}
						
						if (
							isset($item['rowspan'], $item['advance']) &&
							$item['rowspan'] === 'yes' &&
							$item['advance'] === 'yes' &&
							!empty($item['rowspannumber'])
						) {
							$cell_attr[] = 'rowspan=' . intval($item['rowspannumber']);

							$this->add_render_attribute(
								$table_body_key,
								'rowspan',
								intval($item['rowspannumber'])
							);
						}

						$this->add_render_attribute(
							$table_body_key,
							'class',
							'elementor-repeater-item-' . $item['_id']
						);
	                    ?>
	                    <td
	                        <?php $this->print_render_attribute_string($table_body_key); ?>
	                    >
	                        <?php echo esc_html( $item['text'] ); ?>
	                    </td>
	                    <?php

	                    $cell_count++;
	                }

	                $missing_cells = $header_count - $cell_count;
	                for ($i = 0; $i < $missing_cells; $i++) {
	                    echo '<td style="display:none;"></td>';
	                }
	                echo '</tr>';
	                ?>
	            </tbody>
	        </table>
	    </div>

	<?php }
}