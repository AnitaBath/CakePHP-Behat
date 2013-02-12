# Behat Shell

Shell for testing CakePHP Application using Behat

## Installation
### Composer installation

- Create a composer.json file at the root of your project. Add or
  complete the `repositories` section with the following code :
```
{
   "name" :        "YourProjectName"
 , "repositories": [
        {
            "type" : "vcs"
          , "url": "git://github.com/AnitaBath/CakePHP-Behat.git"
        }
   ]
  , "minimum-stability": "dev"
  , 
}
```

_The Plugin's composer file references a composer library called installers that contains
installation paths for many frameworks, including cakephp. This library
will create a Plugin directory in your current directory, so, if it happens
that the root of your project is a the same level as `app` and not `app`
itself, I would recommend you to add or complete the `extra` section of
your composer file in the following way :_

```
"extra" : {
        "installer-paths": {
            "app/Plugin/Behat": [ "AnitaBath/CakePHP-Behat" ]
        }
    }
```

- Add the plugin to your app/Config/bootstrap.php using `CakePlugin::load('Behat')`
- Set your application root url into app/Config/behat.yml
- Make behat executable `chmod +x Console/behat`
- Run `Console/behat -dl` to be sure that everything properly loaded

### Regular installation
- Unzip or clone this plugin into your app/Plugin/Behat folder.
- Add the plugin to your app/Config/bootstrap.php using `CakePlugin::load('Behat')`
- Run `Console/cake Behat.behat install` to install plugin
- Set your application root url into app/Config/behat.yml
- Make behat executable `chmod +x Console/behat`
- Run `Console/behat -dl` to be sure that everything properly loaded

## Requirements

* PHP version: PHP 5.3+
* CakePHP version: 2.x
* PHPUnit
 
## Further Reading

* [Quick Intro to Behat](http://docs.behat.org/quick_intro.html) - Read Quick Intro Guide.
* [Practical BDD with Behat and Mink](http://www.slideshare.net/jmikola1/pratical-bdd-with-behat-and-mink) - An introduction into behavior-driven development with Behat and Mink.
* [Behat Documentation](http://docs.behat.org/index.html) - Read Behat2 Documentation Guides.
* [Behat by example](https://speakerdeck.com/everzet/behat-by-example) - Check presentation from the creator.
* [Mink Documentation](http://mink.behat.org/) - Read about Mink and Web acceptance testing.

## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Added some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request
