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
	 * Validator for Null constraint
	 */
	$.validNull = function(field, options) {
		var field = field;

		var settings = {
			msg : ""
		};
		
		settings = $.extend({}, settings, options);

		this.isValid = function() {
			var value = field.getJElement().val();

			console.log(value);

			if (typeof value != "undefined") {
				field.addViolation("null", settings.msg);
				return false;
			}

			field.rmViolation("null");
			return true;
		};
	};
}(jQuery));