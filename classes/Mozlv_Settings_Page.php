<?php

class Mozlv_Settings_Page {

	private $option_group;

	public function __construct($option_group) {
		$this->option_group = $option_group;
	}

	public function main() {
		print('<div class="wrap">');

		$plugin_data = get_plugin_data(MOZLV_PLUGIN_FILE);
		printf('<h2>%s</h2>', $plugin_data['Name']);
		printf('<p>%s</p>', $plugin_data['Description']);
		print('<h2>Settings</h2>');
		$this->main_settings();
		print('<h2>How to use it?</h2>');
		$this->main_howto();

		print('</div>');
	}

	private function main_settings() {
		$mozlv_options = Mozlv_Options::getInstance();
		print('<form method="post" action="options.php">');
		settings_fields($this->option_group);
		do_settings_sections($this->option_group);
		print('<table class="form-table">');
		printf('
			<tr>
				<th><label for="%1$s">Cache type</label></th>
				<td>
					<select name="%1$s" id="%1$s" required>
						<option label="---" disabled></option>
						<option value="%2$s"%3$s>WordPress Transients API</option>
						<option value="%4$s"%5$s>Files</option>
					</select>
					<p class="description">You can choose from two options. WordPress Transients API cache uses database to store the informations about the application version.</p>
				</td>
			</tr>
			',
			$mozlv_options->cache_type(),
			$mozlv_options->cache_type_transients_api(),
			$this->if_selected_cache_type($mozlv_options->cache_type_transients_api()),
			$mozlv_options->cache_type_files(),
			$this->if_selected_cache_type($mozlv_options->cache_type_files())
		);
		printf('
			<tr>
				<th><label for="%1$s">Cache expiration</label></th>
				<td>
					<input type="number" name="%1$s" id="%1$s" min="0" value="%2$s" required>
					<p class="description">This option set the cache expiration in seconds (default 3600 = 1 hour).</p>
				</td>
			</tr>
			',
			$mozlv_options->cache_expire(),
			esc_attr($mozlv_options->get_cache_expire())
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
			esc_attr($mozlv_options->get_links_lang())
		);
		print('</table>');
		submit_button();
		print('</form>');
	}

	private function if_selected_cache_type($cache_type) {
		if(Mozlv_Options::getInstance()->get_cache_type() == $cache_type) {
			return ' selected';
		} else {
			return '';
		}
	}

	private function main_howto() {
		print('
			<p>There are currently four shortcodes added by this plugin. Here are explained all of them with their attributes.</p>
			<h3 class="title">Shortcodes</h3>
			<ul>
				<li><code>[mozilla-latest-version product="<em>product</em>" channel="<em>channel</em>"]</code> - the latest version number in <em>channel</em> of the specified <em>product</em></li>
				<li><code>[mozilla-latest-download-url product="<em>product</em>" channel="<em>channel</em>" platform="<em>platform</em>"]</code> - download URL of the latest version of the specified <em>product</em> in <em>channel</em> for <em>platform</em></li>
				<li><code>[mozilla-latest-langpack-url product="<em>product</em>" channel="<em>channel</em>" platform="<em>platform</em>"]</code> - download URL of the latest langpack (.xpi) for the specified <em>product</em> in <em>channel</em> and <em>platform</em> (not available for <code>mobile</code>)</li>
				<li><code>[mozilla-latest-changelog-url product="<em>product</em>" channel="<em>channel</em>"]</code> - changelog page URL for the latest version of the specified <em>product</em> in <em>channel</em></li>
				<li><code>[mozilla-latest-requirements-url product="<em>product</em>" channel="<em>channel</em>"]</code> - requirements page URL for the latest version of the specified <em>product</em> in <em>channel</em></li>
			</ul>
			<p class="description">All URLs (where posible) will contain the language code specified above.</p>
			<h3 class="title">Attributes</h3>
			<ul>
				<li><code>product</code> possible values are <code>firefox</code> for desktop, <code>mobile</code> for Android, <code>thunderbird</code> and <code>seamonkey</code></li>
				<li><code>platform</code> specifies the platform for download links. Possible values are <code>win</code>, <code>lin</code> and <code>mac</code></li>
				<li><code>channel</code> specifies the channel of product are is product dependent (if no specified, release will be used)</li>
			</ul>
			<h3 class="title">Channel</h3>
			<ul>
				<li>Firefox: <code>release</code>, <code>beta</code>, <code>aurora</code>, <code>esr</code></li>
				<li>Mobile: <code>release</code></li>
				<li>Thundebird: <code>release</code></li>
				<li>SeaMonkey: <code>release</code>, <code>beta</code>, <code>aurora</code></li>
			</ul>
		');
	}

}
