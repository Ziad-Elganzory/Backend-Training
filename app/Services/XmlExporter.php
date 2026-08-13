<?php 

namespace App\Services;

use App\Contracts\ExporterInterface;
use SimpleXMLElement;

class XmlExporter implements ExporterInterface
{
    public function export(array $data): string
    {
        // Use a backslash or use statement for SimpleXMLElement
        $xml = new SimpleXMLElement('<root/>');
        
        $this->arrayToXml($data, $xml);

        return $xml->asXML();
    }

    private function arrayToXml(array $data, SimpleXMLElement $xml): void
    {
        foreach ($data as $key => $value) {
            // Fix numeric keys (e.g., convert index 0 into 'item0')
            if (\is_numeric($key)) {
                $key = 'item' . $key;
            }

            if (\is_array($value)) {
                // If nested, create a child block and recurse down
                $subnode = $xml->addChild($key);
                $this->arrayToXml($value, $subnode);
            } else {
                // If flat, safely sanitize string and add
                $xml->addChild($key, \htmlspecialchars((string)$value));
            }
        }
    }
}
