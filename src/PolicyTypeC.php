<?php
//Separate class to calculate/return fees and bonus values for type 'C' policies
//Inherits from MaturityCalc class.
class PolicyTypeC extends MaturityCalc
{
    private $fees = 0.07; //Holds the management fees for policy type C.
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
        if ((new DateTime($this->detail->getFormattedDate()) >= new DateTime('01/01/1990')) &&
            ($this->detail->membership == 'Y')) {
            return $this->detail->bonus;
        }
        else {
            return 0.00;
        }
    }
}
?>
