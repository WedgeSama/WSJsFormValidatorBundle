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
	 * Validator for Choice constraint
	 */
	$.validChoice = function(field, options) {
		var field = field;

		var settings = {
			min : null,
			max : null,
			'min-msg' : "",
			'max-msg' : ""
		};

		settings = $.extend({}, settings, options);

		this.isValid = function() {
			var $element = field.getJElement(), value;

			if ($element.is('select')) {
				value = $element.val();
			} else {
				var name = field.getJElement().attr('name');
				var type = field.getJElement().attr('type');
				var $inputs = $('input:' + type + '[name="' + name
						+ '"]:checked');
				value = new Array();

				$inputs.each(function() {
					value.push($(this).val());
				});
			}

			if (settings.min != null) {
				if (settings.min > value.length) {
					field.addViolation("choice-min", settings['min-msg']);
					return false;
				} else
					field.rmViolation("choice-min");
			}

			if (settings.max != null) {
				if (settings.max < value.length) {
					field.addViolation("choice-max", settings['max-msg']);
					return false;
				} else
					field.rmViolation("choice-max");
			}

			return true;
		};
	};
}(jQuery));