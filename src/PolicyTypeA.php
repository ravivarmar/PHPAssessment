<?php
//Separate class to calculate/return fees and bonus values for type 'A' policies
//Inherits from MaturityCalc class.
class PolicyTypeA extends MaturityCalc
{
    private $fees = 0.03; //Holds the management fees for policy type A.
    protected $detail; //Holds the detail policy record.
    
    public function __construct($detail)
    {
        $this->detail = $detail;
    }

    public function getManagementFees()
    {
        return $this->fees;
    }
    
    public function getBonusIfApplies()
    {
        if (new DateTime($this->detail->getFormattedDate()) < new DateTime('01/01/1990')) {
            return $this->detail->bonus;
        }
        else {
            return 0.00;
        }
    }
}
?>