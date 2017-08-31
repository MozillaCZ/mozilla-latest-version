<?php

/**
 * Mozlv_Settings_Page outputs the plugin settings page HTML code.
 * 
 * @author Michal Stanke <mstanke@mozilla.cz>
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
		print( '<h2>Settings</h2>' );
		$this->main_settings();
		print( '<h2>How to use it?</h2>' );
		$this->main_howto();

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

	/**
	 * Outputs main plugin admin page how to HTML code.
	 */
	private function main_howto() {
		print('
			<p>There are currently four shortcodes added by this plugin. And three more additional for easier migration from the Mozilla.sk CMS Plugin without need of any content change. Here are explained all of them with their attributes.</p>
			<h3 class="title">Shortcodes</h3>
			<p class="description">All URLs (where posible) will contain the language code specified above.</p>
			<ul>
				<li><code>[mozilla-latest-version product=<em>product</em>]</code> - the latest version number of the specified <em>product</em></li>
			</ul>
			<p class="description">These URL shortcodes below work also as <a href="https://codex.wordpress.org/Shortcode_API#Enclosing_vs_self-closing_shortcodes" target="_blank">enclosing</a>. Using <code>[shortcode]...[/shortcode]</code> will produce HTML link <code>&lt;a href="URL"&gt;...&lt;/a&gt;</code> instead of an URL string.</p>
			<ul>
				<li><code>[mozilla-latest-download-url product=<em>product</em> platform=<em>platform</em>]</code> - download URL of the latest version of the specified <em>product</em> for <em>platform</em></li>
				<li><code>[mozilla-latest-langpack-url product=<em>product</em> platform=<em>platform</em>]</code> - download URL of the latest langpack (.xpi) for the specified <em>product</em> and <em>platform</em> (not available for <code>fennec</code>)</li>
				<li><code>[mozilla-latest-changelog-url product=<em>product</em>]</code> - changelog page URL for the latest version of the specified <em>product</em></li>
				<li><code>[mozilla-latest-requirements-url product=<em>product</em>]</code> - requirements page URL for the latest version of the specified <em>product</em></li>
			</ul>
			<h4>Shortcodes for easier migration from the Mozilla.sk CMS Plugin</h4>
			<p class="description">The Mozilla.sk CMS plugin shortcodes work as <a href="https://codex.wordpress.org/Shortcode_API#Enclosing_vs_self-closing_shortcodes" target="_blank">self-closing</a> only.</p>
			<ul>
				<li><code>[moz-download-version app=<em>product</em>]</code> = <code>[mozilla-latest-version product=<em>product</em>]</code></li>
				<li><code>[moz-download-url app=<em>product</em> platform=<em>platform</em>]</code> = <code>[mozilla-latest-download-url product=<em>product</em> platform=<em>platform</em>]</code></li>
				<li><code>[moz-download-rn app=<em>product</em>]</code> = <code>[mozilla-latest-changelog-url product=<em>product</em>]</code></li>
			</ul>
			<h3 class="title">Attributes</h3>
			<ul>
				<li><code>product</code> possible values are <code>firefox</code> for desktop, <code>fennec</code> or <code>mobile</code> for Android, <code>ios</code> for iOS, <code>thunderbird</code> and <code>seamonkey</code></li>
				<li><code>platform</code> specifies the platform for download links. Possible values are <code>win</code>, <code>win64</code>, <code>linux</code>, <code>lin</code>, <code>linux64</code>, <code>lin64</code>, <code>osx</code> and <code>mac</code></li>
				<li><code>channel</code> specifies the channel of product are is product dependent (if no specified, <code>release</code> will be used)</li>
			</ul>
			<h3 class="title">Channel</h3>
			<ul>
				<li>Firefox: <code>release</code>, <code>beta</code>, <code>devedition</code>, <code>nightly</code>, <code>esr</code></li>
				<li>Mobile: <code>release</code>, <code>beta</code>, <code>nightly</code></li>
				<li>iOS: <code>release</code>, <code>beta</code></li>
				<li>Thundebird: <code>release</code>, <code>beta</code></li>
				<li>SeaMonkey: <code>release</code>, <code>beta</code></li>
			</ul>
		');
	}

}
