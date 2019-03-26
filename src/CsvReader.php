<?php
//CsvReader class to read input file and convert the data into an array of associative arrays.
//For associative arrays, the file headings are used as keys and detail rows are used as values.
//Returns data as an array of associative arrays.
class CsvReader implements InputReader
{
    public function readInput($fileName)
    {
        $handle = fopen($fileName,"r");
        try {
            if (!$handle) {
                throw new Exception("Error opening input file...");
            }
            else {
                $line = fgets($handle);
                $header = str_getcsv($line, $delimiter = ",");
                $data = array();
                while(!feof($handle)) {
                    $line = fgets($handle);
                    $data[] = array_combine($header, str_getcsv($line, $delimiter = ","));
                }
                fclose($handle);
            }
        } catch (Exception $ex) {
            echo "Error: ". $ex->getMessage();
            exit(1);
        }
        return $data;
    }
}
?>