WSJsFormValidatorBundle Usage
==================================

# Usage in Collections

You may want to add the validation on fields dynamically add by javascript.
In order to to this, you just have to call this function after added fields.

``` js
    $('form[name=your_form_name]').validatorMoreFields("#your_fields_container");
```

Same use when you when to remove fields. Call this function before removing fields.

``` js
    $('form[name=your_form_name]').validatorRmFields("#your_fields_container");
```
