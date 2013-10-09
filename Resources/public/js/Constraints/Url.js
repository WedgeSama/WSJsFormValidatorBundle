/*!
 * This file is part of the WSJsFormValidatorBundle package.
 * 
 * (c) Benjamin Georgeault <https://github.com/WedgeSama/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
(function($) {
	/**
	 * Validator for Url constraint
	 */
	$.validUrl = function(field, options) {
		var field = field;

		var settings = {
			msg : "",
			proto : "http"
		};

		settings = $.extend({}, settings, options);

		this.isValid = function() {
			var val = field.getJElement().val();
			
			var proto = '(' + settings.proto + '):\/\/';
			var domain = '([a-z\d]([a-z\d-]*[a-z\d])*\.)+[a-z]{2,}';
			var ipv4 = '(\d{1,3}\.){3}\d{1,3}';
			var ipv6 = '';
			var port = ':\d+';
			var end = '/?|/.*';
			
			//var regUrl = new RegExp('^(' + proto + ')((' + domain + ')|(' + ipv4 + ')|(' + ipv6 + '))(' + port + ')?' + end + '$';
			var regUrl = new RegExp('^(' + proto + ')((' + domain + ')|(' + ipv4 + '))(' + port + ')?' + end + '$';

			if (!regUrl.test(val)) {
				field.addViolation("url", settings.msg);
				return false;
			}

			field.rmViolation("url");
			return true;
		};
	};
}(jQuery));