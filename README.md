# Stache #

Bastardized version of [Mustache](http://mustache.github.io/) without any of the feature richness.

# Usage #

Taken from [the fully featured](https://github.com/bobthecow/mustache.php) PHP implementation of Mustache, the syntax is very similar and limited to one main method:

```php
<?php
$s = new Stache;
echo $s->render('Hello {{planet}}', array('planet' => 'World!')); // "Hello World!"
```

Alternative methods for defining values:

```php
// Assign separately using different styles.
// Typical associative array.
$s->assign(array(
	"foo" => "oof",
	"bar" => "rab",
));

// ... another way to use associative arrays.
$var1 = "test";
$var2 = "123";
$s->assign(compact("var1", "var2"));

// Direct assignment.
$baz = "zab";
$s->assign("baz", $baz);

// Define a template and render a result.
$template = '
<pre>
foo: {{foo}}
bar: {{bar}}
baz: {{baz}}
var1: {{var1}}
var2: {{var2}}
</pre>
';
echo $s->render($template);
```

Outputs:

	foo: oof
	bar: rab
	baz: zab
	var1: test
	var2: 123
