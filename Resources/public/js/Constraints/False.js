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
	$.validFalse = function(field, options) {
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

			if (!(value == false || value == 0 || value == "0")) {
				field.addViolation("false", settings.msg);
				return false;
			}

			field.rmViolation("false");
			return true;
		};
	};
}(jQuery));