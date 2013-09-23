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
	 * Validator for True constraint
	 */
	$.validTrue = function(field, options) {
		var field = field;

		var settings = {
			msg : ""
		};

		settings = $.extend({}, settings, options);

		this.isValid = function() {
			var $element = field.getJElement();
			var value;

			if ($element.is("input[type=checkbox]")
					|| $element.is("input[type=radio]"))
				value = $element.is(':checked');
			else
				value = field.getJElement().val();

			if (!(value == true || value == 1 || value == "1")) {
				field.addViolation("true", settings.msg);
				return false;
			}

			field.rmViolation("true");
			return true;
		};
	};
}(jQuery));