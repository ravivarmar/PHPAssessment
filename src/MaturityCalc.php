<?php
//Class to calculate the maturity value for a policy by calling methods from
//corresponding PolicyType class based on the policy type.
abstract class MaturityCalc
{
    abstract function getManagementFees();
    
    abstract function getBonusIfApplies();

    public function calculateMaturity()
    {
        $netPremium = ($this->detail->premium)*(1-$this->getManagementFees());
        $premiumInclBonus = $netPremium + $this->getBonusIfApplies();
        $maturityValue = $premiumInclBonus * (1+($this->detail->uplift/100));
        return $maturityValue;
    }
}
?>
