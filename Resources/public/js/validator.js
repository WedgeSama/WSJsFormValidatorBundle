/*!
 * This file is part of the WSJsFormValidatorBundle package.
 * 
 * (c) Benjamin Georgeault <https://github.com/WedgeSama/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
(function($) {
	var formValidators = new Array();
	
	/**
	 * Field class
	 */
	$.fieldValidator = function(element, options) {
		// Config
		var settings = {
				containerSuffix: "_errors",
				attrErrorName: "data-constraint",
				onChange: false,
				onLive: false
        };
		
		var fieldValidator = this;
		var $element = $(element), element = element;
		var csts = new Array();
		var $container;
		var $node = $element;
		
		/**
		 * Init
		 */
		fieldValidator.init = function() {
			// Init config
			settings = $.extend({}, settings, options);
    		var expanded = $element.attr('data-expanded');
    		
    		if(expanded !== undefined)
    			$node = $($('#' + expanded)[0]);
    		
    		$container = $("#" + $node.attr('id') + settings.containerSuffix);
    		
			$.each($node.context.attributes, function() {
        		var attr = this.name;
        		var value = this.value;
        		
        		if(attr.match(/^data-[A-z0-9]+$/g)) {
        			var type = attr.replace("data-", "");
        			var cst = "valid" + type.charAt(0).toUpperCase() + type.slice(1);
        			
        			if(typeof $[cst] == 'function') {
        				var constraint = new $[cst](fieldValidator, fieldValidator.parseAttr(type));
        				csts.push(constraint);
        			}
        		}
        	});
			
			var event = "";
			if(settings.onChange)
				event = event + "change ";
			if(settings.onLive)
				event = event + "keyup ";
			
				
			$('[name="' + fieldValidator.getName() + '"]').bind(event, function() {
				fieldValidator.isValid();
			});
			
        };
        
        /**
		 * Check if the field is valid.
		 */
        fieldValidator.isValid = function () {
        	var valid = true;
        	
        	for(var i = csts.length - 1; i >= 0; i--)
				if(!csts[i].isValid())
					return false;
        };
        
        /**
		 * Get the name of the field.
		 */
        fieldValidator.getName = function () {
        	return $element.attr('name');
        };
        
        /**
		 * Add a message violation.
		 */
        fieldValidator.addViolation = function(type, msg) {
        	var $exist = $container.find('[' + settings.attrErrorName + '="' + type + '"]');
        	
        	if($exist.length == 0)
        		$container.append('<li ' + settings.attrErrorName + '="' + type + '">' + msg +"</li>");
        };
        
        /**
		 * Remove a message violation.
		 */
        fieldValidator.rmViolation = function(type) {
        	var $exist = $container.find('[' + settings.attrErrorName + '="' + type + '"]');
        	
        	if($exist.length > 0)
        		$exist.remove();
        };
        
        /**
		 * Parse attributes for a specific constraint type.
		 */
        fieldValidator.parseAttr = function (type) {
        	var deb = "data-" + type + "-";
        	var regex = new RegExp("^" + deb, 'g') ;
        	var attrs = new Array();
        	
        	$.each($node.context.attributes, function() {
        		var attr = this.name;
        		var value = this.value;
        		
        		if(attr.match(regex)) {
        			attr = attr.replace(deb, "");
        			attrs[attr] = value;
        		}
        	});
        	
        	return attrs;
        };
        
        /**
		 * Get the jQuery object
		 */
        fieldValidator.getJElement = function () {
        	return $element;
        };
        
        fieldValidator.init();
	};
	
	/**
	 * Validator class
	 */
	$.validator = function(element, options) {
		// Config
		var settings = {};
		
		var fields = new Array();
		var validator = this;
		var $element = $(element), element = element;
		
		/**
		 * Init
		 */
		validator.init = function() {
			// Init config
			settings = $.extend({}, settings, options);
			
			// Catch form submit
			$element.submit({validator: this}, function(e) {
    			return validator.isValid();
    		});
			
			validator.parseFields();
        };
        
        /**
		 * Parse all fields in the form
		 */
        validator.parseFields = function (dom) {
    		var $dom = dom ? $element.find(dom): $element;
    		
    		$dom.find('input').each(function() {
        		var $input = $(this), input = this;
        		var name = $input.attr('name');
        		
        		for(var i = 0; i < fields.length; i++)
    				if(fields[i].getName() == name)
    					return this;
        		
        		fields.push(new $.fieldValidator(input, settings));
        	});
        };
		
        /**
		 * Check if the form is valid
		 */
        validator.isValid = function () {
        	var valid = true;
        	for(var i = 0; i < fields.length; i++)
        		if(typeof fields[i] == "object")
					if(!fields[i].isValid())
						valid = false;
        	
        	return valid;
        };
        
        /**
		 * Get the form DOM
		 */
        validator.getElement = function () {
        	return element;
        };
        
        /**
		 * Remove fields from a part of the current form.
		 */
        validator.rmFields = function (dom) {
    		var $dom = $element.find(dom);
        	
    		$dom.find('input').each(function() {
        		var $input = $(this), input = this;
        		var name = $input.attr('name');
        		
        		for(var i = 0; i < fields.length; i++)
    				if(fields[i].getName() == name)
    					delete fields[i];
        	});
        };
        
        validator.init();
	};
	
	/**
	 * Init the form validation
	 */
	$.fn.validator = function(options) {
		return this.each(function() {
			for(var i = 0; i < formValidators.length; i++)
				if(formValidators[i].getElement() == this)
					return this;
			
			formValidators.push(new $.validator(this, options));
			
			return this;
        });
	};
	
	/**
	 * Add more fields to selected form's validator
	 * 
	 * $('form[name="example"]').validatorMoreFields('#container-of-new-fields');
	 */
	$.fn.validatorMoreFields = function (dom) {
		var dom = dom;
		
		return this.each(function() {
			for(var i = 0; i < formValidators.length; i++)
				if(formValidators[i].getElement() == this) {
					$(this).each(function(){
						formValidators[i].parseFields(dom);
					});
					
					return this;
				}
			
			return this;
        });
	};
	
	/**
	 * Remove fields from a part of selected form.
	 * 
	 * $('form[name="example"]').validatorMoreFields('#container-of-fields-to-remove');
	 */
	$.fn.validatorRmFields = function (dom) {
		var dom = dom;
		
		return this.each(function() {
			for(var i = 0; i < formValidators.length; i++)
				if(formValidators[i].getElement() == this) {
					$(this).each(function(){
						formValidators[i].rmFields(dom);
					});
					
					return this;
				}
			
			return this;
        });
	};
	
}(jQuery));