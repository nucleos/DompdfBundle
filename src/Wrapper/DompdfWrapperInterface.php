<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\DompdfBundle\Wrapper;

use Nucleos\DompdfBundle\Exception\PdfException;
use Symfony\Component\HttpFoundation\StreamedResponse;

interface DompdfWrapperInterface
{
    /**
     * @param string               $html     The html sourcecode to render
     * @param string               $filename The name of the document
     * @param array<string, mixed> $options  The rendering options (see dompdf docs)
     */
    public function getStreamResponse(string $html, string $filename, array $options = []): StreamedResponse;

    /**
     * Renders a pdf document and return the binary content.
     *
     * @param string               $html    The html sourcecode to render
     * @param array<string, mixed> $options The rendering options (see dompdf docs)
     *
     * @throws PdfException
     */
    public function getPdf(string $html, array $options = []): string;
}
