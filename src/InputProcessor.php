<?php
//Input processor class to check for file existence and then handover to the respective reader class,
//which in this case is CsvReader.
class InputProcessor
{
    protected $readerType; //Holds the object of the file type reader i.e. CsvReader in this case.
    protected $fileName; //Holds the Input file name to be read.
        
    public function __construct(InputReader $readerType, $fileName)
    {
        $this->readerType = $readerType;
        $this->fileName = $fileName;
    }
    
    public function processInput()
    {
        try {
            if (!file_exists($this->fileName)) {
                throw new Exception ("Input file '$this->fileName' does not exist, please check and re-try..");
            }
            else {
                $data = $this->readerType->readInput($this->fileName);
                return $data;
            }
        } catch (Exception $ex) {
            echo "Error: ". $ex->getMessage();
            exit(1);
        }
    }
}
?>