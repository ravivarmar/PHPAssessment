<?php
//Class to derive policy type, format date and validate if all fields are furnished.
class PolicyDetail
{
    //Declaring all individual fields to map out their names. 
    //Also created a new field for policy type as derived.
    public $policyNo;
    public $policyStartDate;
    public $premium;
    public $membership;
    public $bonus;
    public $uplift;
    public $policyType;
    
    public function __construct($data)
    {
        $this->policyNo = $data["policy_number"];
        $this->policyStartDate = $data["policy_start_date"];
        $this->premium = $data["premiums"];
        $this->membership = $data["membership"];
        $this->bonus = $data["discretionary_bonus"];
        $this->uplift = $data["uplift_percentage"];
        $this->policyType = substr($data["policy_number"],0,1);
    }
    
    public function getFormattedDate()
    {
        $dateDD = substr($this->policyStartDate,0,2);
        $dateMM = substr($this->policyStartDate,3,2);
        $dateYYYY = substr($this->policyStartDate,6,4);
        
        return $dateMM."/".$dateDD."/".$dateYYYY;
    }
    
    public function validatePolicyDetail()
    {
        if (isset($this->policyNo) &&
            isset($this->policyStartDate) &&
            isset($this->premium) &&
            isset($this->membership) &&
            isset($this->bonus) &&
            isset($this->uplift)) {
            
            return true;
        }
        else {
            return false;
        }
    }
}
?>