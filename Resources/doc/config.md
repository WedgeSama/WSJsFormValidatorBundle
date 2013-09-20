WSJsFormValidatorBundle Configuration
==================================

Default configuration

``` yaml
# app/config/config.yml
ws_js_form_validator:
    enabled: true # enabled/disabled validation system
    config:
        containerSuffix: "_errors" # the suffix of errors container's id
        onChange: true # enabled the field validation on change javascript event
        onLive: true # enabled the field validation on keyup javascript event
```
