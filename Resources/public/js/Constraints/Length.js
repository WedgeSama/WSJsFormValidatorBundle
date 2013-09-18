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
	 * Validator for Length constraint
	 */
	$.validLength = function(field, options) {
		var field = field;

		var settings = {
			min : null,
			max : null,
			exact : null,
			msg : "",
			'min-msg' : "",
			'max-msg' : ""
		};

		settings = $.extend({}, settings, options);

		this.isValid = function() {
			var value = field.getJElement().val();

			if (settings.exact != null) {
				if (settings.exact != value.length) {
					field.addViolation("length", settings.msg);
					return false;
				} else
					field.rmViolation("length");
			}

			if (settings.min != null) {
				if (settings.min > value.length) {
					field.addViolation("length-min", settings['min-msg']);
					return false;
				} else
					field.rmViolation("length-min");
			}

			if (settings.max != null) {
				if (settings.max < value.length) {
					field.addViolation("length-max", settings['max-msg']);
					return false;
				} else
					field.rmViolation("length-max");
			}

			return true;
		};
	};
}(jQuery));