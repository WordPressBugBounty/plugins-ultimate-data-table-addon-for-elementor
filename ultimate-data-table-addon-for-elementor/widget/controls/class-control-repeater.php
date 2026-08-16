<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Control_Udt_Repeater extends \Elementor\Control_Repeater {

	public function get_type() {
		return 'udt-repeater';
	}
}
