# Stache #

Bastardized version of [Mustache](http://mustache.github.io/) without any of the feature richness.

# Usage #

Taken from [the fully featured](https://github.com/bobthecow/mustache.php) PHP implementation of Mustache, the syntax is very similar and limited to one main method:

```php
<?php
$m = new Stache();
echo $m->render('Hello {{planet}}', array('planet' => 'World!')); // "Hello World!"
```
