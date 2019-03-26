<?php
//Output processor class to check initially if the file already exists before
//proceeding to format the output into an xml and then write out to a file.
class OutputProcessor
{
    protected $writerType; //Holds the object of the Output formatter i.e. XmlFormatter in this case.
    protected $detail; //Holds the output data as an array of associated arrays.
    protected $fileName; //Holds the output file name to be written.
        
    public function __construct(OutputWriter $writerType, $detail, $fileName)
    {
        $this->writerType = $writerType;
        $this->detail = $detail;
        $this->fileName = $fileName;
    }
    
    public function processOutput()
    {
        try {
            if (file_exists($this->fileName)) {
                throw new Exception("Output file '$this->fileName' already exists in the directory..");
            }
            else {
                $this->writerType->writeOutput($this->detail, $this->fileName);
            }
        } catch (Exception $ex) {
            echo "Error: ". $ex->getMessage();
            exit(1);
        }    
            
    }
}
?>