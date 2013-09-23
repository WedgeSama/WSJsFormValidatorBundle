WSJsFormValidatorBundle
=============

A client side validator for Symfony2 using [jQuery framework](http://jquery.com/).
This bundle use Symfony validations rules set on forms and entities to generate a client-side validation.

Documentation
-------------

The documentation is stored in the `Resources/doc`

### Main
- [Installation](https://github.com/WedgeSama/WSJsFormValidatorBundle/blob/master/Resources/doc/install.md)
- [Configuration](https://github.com/WedgeSama/WSJsFormValidatorBundle/blob/master/Resources/doc/config.md)

### Usages
- [Basic](https://github.com/WedgeSama/WSJsFormValidatorBundle/blob/master/Resources/doc/basic.md)
- [Collection](https://github.com/WedgeSama/WSJsFormValidatorBundle/blob/master/Resources/doc/collection.md)

### List of constraints

##### Basic
- NotBlank
- Blank
- NotNull
- Null
- True
- False

##### String
- Length
- Choice

License
-------

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE

TODO
----
- Handle select and textarea type. (Currently, just input type works)
- Explain how to use custom constraint. (Already handle, just no doc :))
- Add remains Symfony constraint
