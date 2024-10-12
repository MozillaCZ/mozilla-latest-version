<?php

/**
 * Mozlv_Settings_Page outputs the plugin settings page HTML code.
 */
class Mozlv_Settings_Page {

	private $option_group;

	/**
	 * Mozlv_Settings_Page constructor.
	 * 
	 * @param string $option_group
	 */
	public function __construct( $option_group ) {
		$this->option_group = $option_group;
	}

	/**
	 * Outputs main plugin admin page HTML code.
	 */
	public function main() {
		print( '<div class="wrap">' );

		$plugin_data = get_plugin_data( MOZLV_PLUGIN_FILE );
		printf( '<h2>%s</h2>', $plugin_data['Name'] );
		printf( '<p>%s</p>', $plugin_data['Description'] );
		printf( '<p><a href="%s" target="_blank">How to use it?</a></p>', $plugin_data['PluginURI'] );
		print( '<h2>Settings</h2>' );
		$this->main_settings();

		print( '</div>' );
	}

	/**
	 * Outputs main plugin admin page settings HTML code.
	 */
	private function main_settings() {
		$mozlv_options = Mozlv_Options::getInstance();
		print( '<form method="post" action="options.php">' );
		settings_fields( $this->option_group );
		do_settings_sections( $this->option_group );
		print( '<table class="form-table">' );
		printf('
			<tr>
				<th><label for="%1$s">Cache type</label></th>
				<td>
					<select name="%1$s" id="%1$s" required>
						<option label="---" disabled></option>
						<option value="%2$s"%3$s>WordPress Transients API</option>
						<option value="%4$s"%5$s>Files</option>
					</select>
					<p class="description">You can choose from two options. WordPress Transients API cache uses database to store the informations about the application version, or Files.</p>
				</td>
			</tr>
			',
			$mozlv_options->cache_type(),
			$mozlv_options->cache_type_transients_api(),
			$this->if_selected_cache_type( $mozlv_options->cache_type_transients_api() ),
			$mozlv_options->cache_type_files(),
			$this->if_selected_cache_type( $mozlv_options->cache_type_files() )
		);
		printf('
			<tr>
				<th><label for="%1$s">Cache expiration</label></th>
				<td>
					<input type="number" name="%1$s" id="%1$s" min="0" value="%2$s" required>
					<p class="description">This option sets the cache expiration in seconds (default 3600 = 1 hour).</p>
				</td>
			</tr>
			',
			$mozlv_options->cache_expire(),
			esc_attr( $mozlv_options->get_cache_expire() )
		);
		printf('
			<tr>
				<th><label for="%1$s">Links language code</label></th>
				<td>
					<input type="text" name="%1$s" id="%1$s" value="%2$s" required>
					<p class="description">Here you can specify the language code for your download and other links. More information about the codes you can find in this <a href="https://wiki.mozilla.org/L10n:Locale_Codes" target="_blank">Mozilla Wiki page</a>.</p>
				</td>
			</tr>
			',
			$mozlv_options->links_lang(),
			esc_attr( $mozlv_options->get_links_lang() )
		);
		print( '</table>' );
		submit_button();
		print( '</form>' );
	}

	/**
	 * Outputs selected for $cache_type set.
	 * 
	 * @param string $cache_type
	 * @return string selected for $cache_type
	 */
	private function if_selected_cache_type( $cache_type ) {
		if ( Mozlv_Options::getInstance()->get_cache_type() == $cache_type ) {
			return ' selected';
		} else {
			return '';
		}
	}

}
