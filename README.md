# Stache #

Bastardized version of [Mustache](http://mustache.github.io/) without any of the feature richness.

# Usage #

Taken from [the fully featured](https://github.com/bobthecow/mustache.php) PHP implementation of Mustache, the syntax is very similar and limited to one main method:

```php
<?php
$s = new Stache;
echo $s->render('Hello {{planet}}', array('planet' => 'World!')); // "Hello World!"
```

You can also define values using the separate `->assign()` method, like this:

```php
// Typical associative array.
$s->assign(array(
	"foo" => "oof",
	"bar" => "rab",
));

// Direct assignment.
$s->assign("baz", "zab");

// Define a template and render a result.
$template = '
<pre>
foo: {{foo}}
bar: {{bar}}
baz: {{baz}}
</pre>
';
echo $s->render($template);
```

Outputs:

	foo: oof
	bar: rab
	baz: zab
