<?php

if ( ! class_exists( 'KB_Structure_Archive' ) ) {

	/**
	 * Define KB_Structure_Archive class
	 */
	class KB_Structure_Archive extends Jet_Theme_Core_Structure_Base {

		public function get_id() {
			return 'kb_archive';
		}

		public function get_single_label() {
			return esc_html__( 'KB Archive', 'knowledge-base' );
		}

		public function get_plural_label() {
			return esc_html__( 'KB Archives', 'knowledge-base' );
		}

		public function get_sources() {
			return array();
		}

		public function get_document_type() {
			return array(
				'class' => 'KB_Archive_Document',
				'file'  => get_theme_file_path( 'document-types/archive.php' ),
			);
		}

		/**
		 * Is current structure could be outputed as location
		 *
		 * @return boolean
		 */
		public function is_location() {
			return true;
		}

		/**
		 * Location name
		 *
		 * @return boolean
		 */
		public function location_name() {
			return 'kb_archive';
		}

		/**
		 * Aproprite location name from Elementor Pro
		 *
		 * @return [type] [description]
		 */
		public function pro_location_mapping() {
			return 'archive';
		}

	}

}
