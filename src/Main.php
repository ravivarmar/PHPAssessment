<?php
//Importing the required interfaces and classes.
require ('InputReaderInterface.php');
require ('CsvReader.php');
require ('InputProcessor.php');
require ('MaturityCalc.php');
require ('PolicyTypeA.php');
require ('PolicyTypeB.php');
require ('PolicyTypeC.php');
require ('PolicyDetail.php');
require ('OutputWriterInterface.php');
require ('XmlFormatter.php');
require ('OutputProcessor.php');

//define constants
define("CURRENCY", "£");

//Input file processing:
//Reads the file and converts the data into an array of associative arrays for ease of usage.
$csvFile = '../Input/MaturityData.csv';
$inputFile = new InputProcessor(new CsvReader, $csvFile);
$data = $inputFile->processInput();

//Main process:
//For each record, validate and skip if not valid.
//If valid, calculate maturity and save the details to an array.
foreach($data as $row) {
    
    $policyDetail = new PolicyDetail($row);
        
    if ($policyDetail->validatePolicyDetail($policyDetail) == false) {
        continue; //Skip the current record if all fields are not available.
    }
    
    switch ($policyDetail->policyType) {
        case 'A':
            $policyMaturity = new PolicyTypeA($policyDetail);
            break;
        case 'B':
            $policyMaturity = new PolicyTypeB($policyDetail);
            break;
        case 'C':
            $policyMaturity = new PolicyTypeC($policyDetail);
            break;
        default :
            continue 2; //Skip the record if policy type is invalid.
    }
    
    $maturity = $policyMaturity->calculateMaturity();
    $maturityFormatted = CURRENCY.number_format($maturity, 2);
    $output[] = array ("PolicyNumber" => $row["policy_number"], "MaturityValue" => $maturityFormatted);
}

//Output file processing:
//Create an xml output file by passing the policy number and maturity values.
$outfileName = '../Output/MaturityValues.xml';
$outputFile = new OutputProcessor(new XmlFormatter, $output, $outfileName);
$outputFile->processOutput();
echo "XML Output successfully generated";
exit(0);
?>
