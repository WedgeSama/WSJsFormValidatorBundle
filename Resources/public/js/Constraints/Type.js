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
	 * Validator for Type constraint
	 */
	$.validType = function(field, options) {
		var field = field;

		var settings = {
			msg : "",
			info : ""
		};

		settings = $.extend({}, settings, options);

		this.isValid = function() {
			var value = field.getJElement().val();
			var ok = true;

			switch (settings.info) {
			case 'numeric':
				if (!((typeof value === 'number' || typeof value === 'string')
						&& value !== '' && !isNaN(value)))
					ok = false;
				break;
			case 'string':
			case 'null':
				if (typeof (value) !== settings.info)
					ok = false;
				break;
			default:
				ok = false;
			}

			if (!ok) {
				field.upViolation("type", settings['msg'].replace(
						/{{ value }}/g, value));
			} else
				field.rmViolation("type");

			return ok;
		};
	};
}(jQuery));