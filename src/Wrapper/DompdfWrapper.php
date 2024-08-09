<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\DompdfBundle\Wrapper;

use Nucleos\DompdfBundle\DompdfEvents;
use Nucleos\DompdfBundle\Event\OutputEvent;
use Nucleos\DompdfBundle\Event\StreamEvent;
use Nucleos\DompdfBundle\Exception\PdfException;
use Nucleos\DompdfBundle\Factory\DompdfFactoryInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class DompdfWrapper implements DompdfWrapperInterface
{
    private DompdfFactoryInterface $dompdfFactory;

    private ?EventDispatcherInterface $eventDispatcher;

    public function __construct(DompdfFactoryInterface $dompdfFactory, ?EventDispatcherInterface $eventDispatcher = null)
    {
        $this->dompdfFactory   = $dompdfFactory;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param string               $html     The html sourcecode to render
     * @param string               $filename The name of the document
     * @param array<string, mixed> $options  The rendering options (see dompdf docs)
     */
    public function streamHtml(string $html, string $filename, array $options = []): void
    {
        $pdf = $this->dompdfFactory->create($options);
        $pdf->loadHtml($html);

        if ($this->eventDispatcher instanceof EventDispatcherInterface) {
            $event = new StreamEvent($pdf, $filename, $html);
            $this->eventDispatcher->dispatch($event, DompdfEvents::STREAM);
        }

        $pdf->render();
        $pdf->stream($filename, $options);
    }

    public function getPdf(string $html, array $options = []): string
    {
        $pdf = $this->dompdfFactory->create($options);
        $pdf->loadHtml($html);

        if ($this->eventDispatcher instanceof EventDispatcherInterface) {
            $event = new OutputEvent($pdf, $html);
            $this->eventDispatcher->dispatch($event, DompdfEvents::OUTPUT);
        }

        $pdf->render();
        $out = $pdf->output();

        if (null === $out) {
            throw new PdfException('Error creating PDF document');
        }

        return $out;
    }

    /**
     * @param array<string, mixed> $options
     */
    public function getStreamResponse(string $html, string $filename, array $options = []): StreamedResponse
    {
        $response = new StreamedResponse();
        $response->setCallback(function () use ($html, $filename, $options): void {
            $this->streamHtml($html, $filename, $options);
        });

        return $response;
    }
}
