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
	 * Validator for NotBlank constraint
	 */
	$.validNotblank = function(field, options) {
		var field = field;
		
		var settings = {
			msg: ""
		};
		
		settings = $.extend({}, settings, options);
		
		this.isValid = function () {
			var value = field.getJElement().val();
			
			if(value === undefined || value === false || value.length == 0 ) {
				field.addViolation("notblank", settings.msg);
				return false;
			}
			
			field.rmViolation("notblank");
			return true;
		};
	};
}(jQuery));