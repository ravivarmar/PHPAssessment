<?php
//Separate class to calculate/return fees and bonus values for type 'B' policies
//Inherits from MaturityCalc class.
class PolicyTypeB extends MaturityCalc
{
    private $fees = 0.05; //Holds the management fees for policy type B.
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
        if ($this->detail->membership == 'Y') {
            return $this->detail->bonus;
        }
        else {
            return 0.00;
        }
    }
}
?>
