---
title: Parser
description: Create custom parsing logic for utility classes
---

# Parser

The Parser interface allows you to create custom parsing logic for utility classes. Implement this interface to control how class names are converted into CSS styles.

## Parser Interface

```php
namespace LarsKlopstra\Envelop\Atomic\Contracts;

use LarsKlopstra\Envelop\Atomic\ValueObjects\Style;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;

interface Parser
{
    /**
     * Parse class names into a Style object.
     *
     * @param  Theme  $theme  Design token configuration
     * @param  array<int, Rule>  $rules  Parsing rules to match against
     * @param  string  $className  Space-separated class names
     * @return Style Combined CSS styles
     */
    public function parse(Theme $theme, array $rules, string $className): Style;
}
```

## DefaultParser

Envelop ships with `DefaultParser`, which implements the standard parsing logic:

1. Split class names by spaces
2. For each class, iterate through rules
3. Match class against rule patterns
4. If matched, extract values and generate styles
5. Merge all generated styles into one Style object

```php
use LarsKlopstra\Envelop\Atomic\Parsers\DefaultParser;

$parser = new DefaultParser();
$style = $parser->parse($theme, $rules, 'bg-blue-500 text-white p-4');
```

## Creating a Custom Parser

Create a custom parser to change how classes are processed:

```php
use LarsKlopstra\Envelop\Atomic\Contracts\Parser;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Style;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;

class CustomParser implements Parser
{
    public function parse(Theme $theme, array $rules, string $className): Style
    {
        // Your custom parsing logic
        $style = new Style([]);

        // Split classes
        $classes = explode(' ', trim($className));

        foreach ($classes as $class) {
            // Match against rules
            foreach ($rules as $rule) {
                if (preg_match($rule->pattern, $class, $matches)) {
                    $ruleStyle = $rule->style;

                    if (is_callable($ruleStyle)) {
                        $ruleStyle = $ruleStyle($theme, $matches);
                    }

                    if ($ruleStyle instanceof Style) {
                        $style = $style->merge($ruleStyle);
                    }

                    break; // First match wins
                }
            }
        }

        return $style;
    }
}
```

## Example: Strict Parser

Throw exceptions for unknown classes to catch typos during development:

```php
class StrictParser implements Parser
{
    private Parser $innerParser;

    public function __construct()
    {
        $this->innerParser = new DefaultParser();
    }

    public function parse(Theme $theme, array $rules, string $className): Style
    {
        $classes = explode(' ', trim($className));

        foreach ($classes as $class) {
            if (empty($class)) {
                continue;
            }

            $matched = false;

            foreach ($rules as $rule) {
                if (preg_match($rule->pattern, $class)) {
                    $matched = true;
                    break;
                }
            }

            if (!$matched) {
                throw new \InvalidArgumentException(
                    "Unknown utility class: {$class}"
                );
            }
        }

        return $this->innerParser->parse($theme, $rules, $className);
    }
}
```

## Registering a Custom Parser

Register your parser in a service provider:

```php
use LarsKlopstra\Envelop\Atomic\Atomic;
use LarsKlopstra\Envelop\Atomic\Presets\DefaultPreset;

$this->app->singleton(Atomic::class, function () {
    return new Atomic(
        presets: [new DefaultPreset()],
        parser: new StrictParser()
    );
});
```

Now all `atomic()` calls will use your custom parser.

## Best Practices

- **Keep it simple**: Most use cases don't need a custom parser. The DefaultParser handles nearly everything.
- **Decorator pattern**: Use decorators to add behavior without replacing the default parser.
- **Performance**: Parsers run frequently. Keep parsing logic fast.
- **Error handling**: Decide how to handle invalid classes. Silent failure vs exceptions.

## When to Use Custom Parsers

Consider a custom parser when you need:

- **Performance optimization** (caching, memoization)
- **Debugging tools** (logging, validation)
- **Different syntax** (prefixes, custom separators)
- **Integration** (with external CSS systems)
- **Special behaviors** (priority systems, conflict resolution)

For most projects, DefaultParser is sufficient. Focus on creating custom Presets instead.

## Next Steps

- [Learn about Presets](/atomic/presets) for adding custom utilities
- [Explore Themes](/atomic/themes) for customizing design tokens
- Review the [DefaultParser source](https://github.com/larsklopstra/envelop/blob/master/src/Atomic/Parsers/DefaultParser.php) for implementation details
