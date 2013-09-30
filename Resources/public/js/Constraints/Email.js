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
	 * Validator for Email constraint
	 */
	$.validEmail = function(field, options) {
		var field = field;

		var settings = {
			msg : ""
		};

		settings = $.extend({}, settings, options);

		this.isValid = function() {
			var val = field.getJElement().val();
			
			var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$','i');
			
			if(! regEmail.test(val)) {
				field.addViolation("email", settings.msg);
				return false;
			}

			field.rmViolation("email");
			return true;
		};
	};
}(jQuery));