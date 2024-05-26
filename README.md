NucleosDompdfBundle
===================
[![Latest Stable Version](https://poser.pugx.org/nucleos/dompdf-bundle/v/stable)](https://packagist.org/packages/nucleos/dompdf-bundle)
[![Latest Unstable Version](https://poser.pugx.org/nucleos/dompdf-bundle/v/unstable)](https://packagist.org/packages/nucleos/dompdf-bundle)
[![License](https://poser.pugx.org/nucleos/dompdf-bundle/license)](LICENSE.md)

[![Total Downloads](https://poser.pugx.org/nucleos/dompdf-bundle/downloads)](https://packagist.org/packages/nucleos/dompdf-bundle)
[![Monthly Downloads](https://poser.pugx.org/nucleos/dompdf-bundle/d/monthly)](https://packagist.org/packages/nucleos/dompdf-bundle)
[![Daily Downloads](https://poser.pugx.org/nucleos/dompdf-bundle/d/daily)](https://packagist.org/packages/nucleos/dompdf-bundle)

[![Continuous Integration](https://github.com/nucleos/NucleosDompdfBundle/actions/workflows/continuous-integration.yml/badge.svg?event=push)](https://github.com/nucleos/NucleosDompdfBundle/actions?query=workflow%3A"Continuous+Integration"+event%3Apush)
[![Code Coverage](https://codecov.io/gh/nucleos/NucleosDompdfBundle/graph/badge.svg)](https://codecov.io/gh/nucleos/NucleosDompdfBundle)
[![Type Coverage](https://shepherd.dev/github/nucleos/NucleosDompdfBundle/coverage.svg)](https://shepherd.dev/github/nucleos/NucleosDompdfBundle)

This bundle provides a wrapper for using [dompdf] inside Symfony.

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
    Nucleos\DompdfBundle\NucleosDompdfBundle::class => ['all' => true],
];
```

## Configure the Bundle

```yaml
# config/packages/nucleos_dompdf.yaml

nucleos_dompdf:
    defaults:
        defaultFont: 'helvetica'
        # See https://github.com/dompdf/dompdf/wiki/Usage#options for available options
```

## Usage

Whenever you need to turn a html page into a PDF use dependency injection for your service:

```php
use Nucleos\DompdfBundle\Factory\DompdfFactoryInterface;
use Nucleos\DompdfBundle\Wrapper\DompdfWrapperInterface;

final class MyService
{
    public function __construct(DompdfFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function render()
    {
        // ...
        /** @var Dompdf\Dompdf $dompdf */
        $dompdf = $this->factory->create();
        // Or pass an array of options:
        $dompdf = $this->factory->create(['chroot' => '/home']);
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

        /** @var Symfony\Component\HttpFoundation\StreamedResponse $response */
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
### Render pdf using Twig

If you use Twig to create the content, make sure to use `renderView()` instead of `render()`.
Otherwise you might get the following HTTP header printed inside your PDF:
> HTTP/1.0 200 OK Cache-Control: no-cache

```php
$html = $this->renderView('my_pdf.html.twig', array(
    // ...
));
$this->wrapper->getStreamResponse($html, 'document.pdf');
```

### Using asset() to link assets


First, make sure your `chroot` is correctly set and `isRemoteEnabled` is true.

```yaml
# config/packages/nucleos_dompdf.yaml

nucleos_dompdf:
    defaults:
        chroot: '%kernel.project_dir%/public/assets'
        isRemoteEnabled: true
```

Second, use `{{ absolute_url( asset() ) }}`

```html
<img src={{ absolute_url( asset('assets/example.jpg') ) }}>
```

### Events

The dompdf wrapper dispatches events to conveniently get the inner dompdf instance when creating the PDF.
- `dompdf.output` is dispatched in `getPdf()`
- `dompdf.stream` is dispatched in `streamHtml()`

See [Symfony Events and Event Listeners](https://symfony.com/doc/current/event_dispatcher.html) for more info.

## License

This bundle is under the [MIT license](LICENSE.md).

[dompdf]: https://github.com/dompdf/dompdf
