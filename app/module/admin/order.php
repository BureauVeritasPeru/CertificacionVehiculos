<?php
$oItem = new eShopOrder();

$oItem->orderID	=$kID;

$customerPO =OWASP::RequestString('customerPO');
$startDate  =OWASP::RequestString('startDate');
$endDate    =OWASP::RequestString('endDate');

$MODULE->processFormAction(new ShopOrder(), $oItem);

if($MODULE->FormView=="edit"){
    $result=ShopOrder::getItem($kID);
    if($rs=ShopOrder::fetchArray($result)){
        $id_order       =$kID;
        $customer       =$rs["customer"];
        $customerPO     =$rs["customerPO"];
        $registerDate	=$rs["registerDate"];
        $total          =$rs["total"];
        $tax            =$rs["freightage"];
        $gtotal         =$rs["gtotal"];

        $shipFirstName  =$rs["shipFirstName"];
        $shipLastName   =$rs["shipLastName"];
        $shipPostalCode =$rs["shipPostalCode"];
        $shipCity       =$rs["shipCity"];
        $shipCountry    =$rs["shipCountry"];
        $shipState      =$rs["shipState"];
        $shipAddress    =$rs["shipAddress1"] ."<br>".$rs["shipAddress2"];
        $shipPhone      =$rs["shipPhone"];
        $shipEmail      =$rs["shipEmail"];

        $billFirstName  =$rs["billFirstName"];
        $billLastName   =$rs["billLastName"];
        $billPostalCode =$rs["billPostalCode"];
        $billCity       =$rs["billCity"];
        $billCountry    =$rs["billCountry"];
        $billState      =$rs["billState"];
        $billAddress    =$rs["billAddress1"] ."<br>".$rs["billAddress2"];
        $billPhone      =$rs["billPhone"];
        $billEmail      =$rs["billEmail"];
    }
    else
        $MODULE->addError(ShopOrder::GetErrorMsg());

    $MODULE->ItemTitle=$kID;
}

$MODULE->FormTitle="Orden";
?>
