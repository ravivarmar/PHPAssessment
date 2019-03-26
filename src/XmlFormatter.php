<?php
//Class to format the output array into an xml using in-built php functions.
//Also, writes the xml to an output file at the end.
class XmlFormatter implements OutputWriter
{
    public function writeOutput($detail, $fileName)
    {
        $xw = xmlwriter_open_memory();
        xmlwriter_set_indent($xw, true);
        xmlwriter_set_indent_string($xw, ' ');
        
        xmlwriter_start_document($xw, '1.0', 'UTF-8');
        xmlwriter_start_element($xw, 'MaturityDetails');
        
        foreach($detail as $record) {
            xmlwriter_start_element($xw, 'MaturityDetail');
            xmlwriter_start_element($xw, 'PolicyNumber');
            xmlwriter_text($xw, $record["PolicyNumber"]);
            xmlwriter_end_element($xw);
            xmlwriter_start_element($xw, 'MaturityValue');
            xmlwriter_text($xw, $record["MaturityValue"]);
            xmlwriter_end_element($xw);
            xmlwriter_end_element($xw);
        }
        xmlwriter_end_element($xw);
        xmlwriter_end_document($xw);
        $xmlout = xmlwriter_output_memory($xw);
        $this->writeFile($xmlout,$fileName);
    }
    
    public function writeFile($stream,$fileName)
    {
        $handle = fopen("$fileName", "w");
        try {
            if (!$handle) {
                throw new Exception("Error opening output file...");
            }
            else {
                fwrite($handle, $stream);
                fclose($handle);
            }
        } catch (Exception $ex) {
            echo "Error: ". $ex->getMessage();
            exit(1);
        }
    }
}
?>