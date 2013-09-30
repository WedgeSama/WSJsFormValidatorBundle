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
	 * Validator for Repeated type
	 */
	$.validRepeated = function(field, options) {
		var field = field;

		var settings = {
			msg : "",
			id : null
		};

		settings = $.extend({}, settings, options);

		this.isValid = function() {
			var $sec = $('#' + settings.id);
			var first = field.getJElement().val();
			var second = $sec.val();
			
			if(first != second) {
				field.addViolation("repeated", settings.msg);
				return false;
			}

			field.rmViolation("repeated");
			return true;
		};
	};
}(jQuery));