WSJsFormValidatorBundle Usage
==================================

# Basic Usage

## Include JS files

You have to include some JS files in your pages. And do not forget to include [jQuery framework](http://jquery.com/).

Include JS files with assetic:

``` html+jinja
    {% javascripts output="validator.js"
        '@WSJsFormValidatorBundle/Resources/public/js/validator.js'
        '@WSJsFormValidatorBundle/Resources/public/js/Constraints/*.js'
     %}
        <script src="{{ asset_url }}"></script>
    {% endjavascripts %}
```

And you have to call the validator for your form:

``` html+jinja
    {{ form_validation(form) }}
```