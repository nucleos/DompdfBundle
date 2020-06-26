DompdfBundle
============
[![Latest Stable Version](https://poser.pugx.org/nucleos/dompdf-bundle/v/stable)](https://packagist.org/packages/nucleos/dompdf-bundle)
[![Latest Unstable Version](https://poser.pugx.org/nucleos/dompdf-bundle/v/unstable)](https://packagist.org/packages/nucleos/dompdf-bundle)
[![License](https://poser.pugx.org/nucleos/dompdf-bundle/license)](LICENSE.md)

[![Total Downloads](https://poser.pugx.org/nucleos/dompdf-bundle/downloads)](https://packagist.org/packages/nucleos/dompdf-bundle)
[![Monthly Downloads](https://poser.pugx.org/nucleos/dompdf-bundle/d/monthly)](https://packagist.org/packages/nucleos/dompdf-bundle)
[![Daily Downloads](https://poser.pugx.org/nucleos/dompdf-bundle/d/daily)](https://packagist.org/packages/nucleos/dompdf-bundle)

[![Continuous Integration](https://github.com/nucleos/NucleosDompdfBundle/workflows/Continuous%20Integration/badge.svg)](https://github.com/nucleos/NucleosDompdfBundle/actions)
[![Code Coverage](https://codecov.io/gh/nucleos/NucleosDompdfBundle/branch/main/graph/badge.svg)](https://codecov.io/gh/nucleos/NucleosDompdfBundle)

This bundle provides a wrapper for using [dompdf] inside symfony.

## Installation

Open a command console, enter your project directory and execute the following command to download the latest stable version of this bundle:

```
composer require nucleos/dompdf-bundle
```

### Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles in `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Nucleos\DompdfBundle\NucleosDompdfBundle => ['all' => true],
];
```

## Usage

Whenever you need to turn a html page into a PDF use dependency injection for your service:

```php
final class MyService
{
    public function __construct(DompdfFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function render()
    {
        // ...
        $this->factory->create();
        // ...
    }
}

final class MyOtherService
{
    public function __construct(DompdfWrapperInterface $wrapper)
    {
        $this->wrapper = $wrapper;
    }

    public function stream()
    {
        // ...
        $html = '<h1>Sample Title</h1><p>Lorem Ipsum</p>';

        $response = $this->wrapper->getStreamResponse($html, "document.pdf");
        $response->send();
        // ...
    }

    public function binaryContent()
    {
        // ...
        return $this->wrapper->getPdf($html);
        // ...
    }
}
```

If you use Twig to create the content, make sure to use `renderView()` instead of `render()`.
Otherwise you might get the following HTTP header printed inside your PDF:
> HTTP/1.0 200 OK Cache-Control: no-cache

```php
$html = $this->renderView('my_pdf.html.twig', array(
    // ...
));
$this->wrapper->getStreamResponse($html, 'document.pdf');
```

### Configure the Bundle

```yaml
# config/packages/nucleos_dompdf.yml

nucleos_dompdf:
    defaults:
        dpi: 150
        defaultPaperSize: A4
        ...
```

### Events

The dompdf wrapper dispatches events to convenient get the inner dompdf instance when creating the pdf.
- `dompdf.output` is dispatched in getPdf
- `dompdf.stream` is dispatched in streamHtml

See [Symfony event dispatcher documentation](https://symfony.com/doc/current/event_dispatcher.html) for more info.

## License

This bundle is under the [MIT license](LICENSE.md).

[dompdf]: https://github.com/dompdf/dompdf
