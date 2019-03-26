<?php
// An interface for allowing to read various forms of input files e.g. '.csv', '.json', '.xml', etc.
//In this case, it is implemented by CsvReader only but supports future extensibility for other formats.
interface InputReader
{
    public function readInput($fileName);
}
?>