<?php
//Generic interface to allow for writing different formats of output files if required.
//In this case, writing only .xml format but allowed for future extensibility.
interface OutputWriter
{
    public function writeOutput($detail, $fileName);
}
?>