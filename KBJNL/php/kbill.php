<?php
header("Access-Control-Allow-Origin: *");

include_once('db.php');

error_reporting(0);
$value1 =$_POST['value1'];

//$data = $value1;




$sQueryString=" 
SELECT IR.IRRIGATION_RECORD_ID, IR.AGREEMENT_ID, IR.TOTAL_AREA, LAD.KHATA_NUMBER, LAD.KHASRA_NO, LAD.SURVEY_NO_OF_LAND, LAD.AREA_OF_SETTLEMENT, LAD.LAND_HOLDING_TYPE, IR.IRRIGATION_TYPE, ENU.DESCRIPTION AS EnuDesc, ENU.DESCRIPTION_HINDI AS EnuDescH, IR.WATERING_TYPE, PPT.DESCRIPTION AS PptDesc, PPT.DESCRIPTION_HINDI AS PptDescH, PR.PRODUCT_ID, PR.PRODUCT_NAME, PR.DESCRIPTION AS PrDesc, PR.DESCRIPTION_HINDI AS PrDescH, PP.PRICE, AG.CONTRACT_NO, AG.ELAN_ID, FA.FIXED_ASSET_NAME, FA.FIXED_ASSET_NAME_HINDI, AG.AGREEMENT_DATE, IR.FROM_DATE, IR.TO_DATE, AAD.SINGLE_RATE, IR.SINGLE_RATE_AREA, AAD.EXTRA_TEN_PER, IR.EXTRA_RATE_AREA, AAD.UN_AUTHORIZED_RATE, IR.UN_AUTHORIZED, IR.STATUS, IR.FIXED_ASSET_ID, IR.AUTHORIZED_WATERING, IR.EXTRA_WATERING, IR.UN_AUTHORIZED_WATERING, IR.APPLY_SINGLE_RATE, IR.APPLY_EXTRA_TEN_PER_RATE, IR.APPLY_UN_AUTHORIZED, IR.WATERING_COUNT, IR.WATERING_PRODUCT_ID, AAD.AGREEMENT_AREA, IR.AMOUNT, NT.CROP_NAME, PC.DESCRIPTION AS PcDesc, PC.DESCRIPTION_HINDI AS PcDescH, NT.LAST_DATE_OF_AGREEMENT, NT.YEAR, IR.INVOICE_ID, IV.PREVIOUS_BALANCE, IV.CURRENT_BALANCE, IV.REMISSION_AMOUNT, IV.PENALITY_AMOUNT, IV.NET_BALANCE, IV.STATUS, IV.DESCRIPTION AS IvDesc, IV.DUE_DATE, IV.INVOICE_DATE, IV.TAX, IV.STATUS_ID, IV.INVOICE_MESSAGE, IV.INTEREST, IV.TAX_BALANCE, IV.PREVIOUS_PAYMENT, IV.BILL_PREVIOUS_AMOUNT, IV.BILL_CURRENT_AMOUNT, IV.REMISSION_AGAINST_PREVIOUS, IV.REMISSION_AGAINST_CURRENT, LAD.WET_LAND_AREA, LAD.DRY_LAND_AREA, IV.BILL_AMOUNT,COALESCE(IV.INTEREST,0::NUMERIC)+COALESCE(IV.BILL_AMOUNT,0::NUMERIC) AS NET_PAID_AMOUNT,IV.PERIOD, IV.AMOUNT_AFTER_REMISSION, IV.TOTAL_CURRENT_AMOUNT, IV.TOTAL_CURRENT_BALANCE, PCNAG.PRODUCT_CATEGORY_ID, PC.DESCRIPTION AS PcDescr, PRNAG.PRODUCT_ID, PRNAG.PRODUCT_NAME, PRNAG.DESCRIPTION AS PrnagDesc, PRNAG.DESCRIPTION_HINDI PrangDescH, PPNAG.PRICE, NAG.STATUS, NTNAG.NOTIFICATION_ID, FANAG.FIXED_ASSET_NAME AS FanagName, FANAG.FIXED_ASSET_NAME_HINDI AS FanagNameH, PCNAG.DESCRIPTION AS PcnagDesc, PCNAG.DESCRIPTION_HINDI AS PcnagDescH, PPNAG.PRODUCT_PRICE_UOM_ID, PPNAG.PRODUCT_PRICE_CATEGORY_ID, PPNAG.PRODUCT_PRICE_UNAUTHORIZED, NTNAG.YEAR, SI.DESCRIPTION AS SiDesc, IV.REMISSION_APPLICATION_ID, CRD.EE_REMISSION_AMOUNT, CRD.EE_PREVIOUS_REMISSION_AMOUNT, CRD.REMISSION_AMOUNT, CRD.PREVIOUS_REMISSION_AMOUNT, FDV.ENM_DESCRIPTION, FDV.ENM_DESCRIPTION_HINDI, FDV.PER_FIRST_NAME, FDV.PER_GENDER, FDV.PR_PARTY_ID_FROM, FDV.PR_PARTY_ID_TO, FDV.PR_ROLE_TYPE_ID_FROM, FDV.PR_ROLE_TYPE_ID_TO, FDV.PR_PARTY_RELATIONSHIP_TYPE_ID, FDV.CM_CONTACT_MECH_ID, FDV.PA_ADDRESS1, FDV.DST_GEO_NAME, FDV.DST_GEO_NAME_HINDI, FDV.TEH_GEO_NAME, FDV.TEH_GEO_NAME_HINDI, FDV.VIL_GEO_NAME, FDV.VIL_GEO_NAME_HINDI, FDV.BAS_OFFICE_SITE_NAME, FDV.BAS_OFFICE_SITE_NAME_HINDI, FDV.CIR_OFFICE_SITE_NAME, FDV.CIR_OFFICE_SITE_NAME_HINDI, FDV.DIV_OFFICE_SITE_NAME, FDV.DIV_OFFICE_SITE_NAME_HINDI, FDV.SDIV_OFFICE_SITE_NAME, FDV.SDIV_OFFICE_SITE_NAME_HINDI, FDV.DAM_FIXED_ASSET_ID, FDV.DAM_FIXED_ASSET_NAME, FDV.DAM_FIXED_ASSET_NAME_HINDI, FDV.CAN_FIXED_ASSET_ID, FDV.CAN_FIXED_ASSET_NAME, FDV.CAN_FIXED_ASSET_NAME_HINDI, FDV.WUA_WUA_ID, FDV.WUA_NAME_OF_WUA, FDV.WUA_NAME_OF_WUA_HINDI, FDV.DISORMIN_FIXED_ASSET_NAME, FDV.DISORMIN_FIXED_ASSET_NAME_HINDI, FDV.PI_ID_VALUE, FDV.FAD_PARTY_ID, FDV.FAD_CASTE, FDV.FAD_FATHER_NAME, FDV.FAD_BASIN_ID, FDV.FAD_CIRCLE_ID, FDV.FAD_DIVISION_ID, FDV.FAD_SUB_DIVISION_ID, FDV.FAD_NAME_OF_WUA, FDV.FAD_VILLAGE_ID, FDV.FAD_DISTRICT_ID, FDV.FAD_DISTB_OR_MIN, FDV.FAD_DISTB_OR_MIN_ID, FDV.FAD_TEHSIL_ID, FDV.FAD_IS_WATER_CONSUMER, FDV.FAD_CREATED_BY, FDV.BA_BILLING_ACCOUNT_ID, FDV.BA_ACCOUNT_LIMIT, FDV.BA_ACCOUNT_CURRENCY_UOM_ID, FDV.BA_CONTACT_MECH_ID, FDV.BA_FROM_DATE, FDV.BA_THRU_DATE, FDV.BA_DESCRIPTION AS BaDesc, FDV.BA_EXTERNAL_ACCOUNT_ID, FDV.BA_SECURITY_DEPOSIT, FDV.BA_BILLING_GENERATION_DAY, FDV.BA_BILLING_CYCLE FROM ((((((((((((((((((((public.IRRIGATION_RECORD IR LEFT OUTER JOIN public.AGREEMENT_ADDITIONAL_DETAIL AAD ON IR.AGREEMENT_ID = AAD.AGREEMENT_ID AND IR.FIXED_ASSET_ID = AAD.KHASRA_NO AND IR.IRRIGATION_TYPE = AAD.IRRIGATION_TYPE AND IR.WATERING_TYPE = AAD.PRODUCT_PRICE_TYPE_ID) INNER JOIN public.ENUMERATION ENU ON IR.IRRIGATION_TYPE = ENU.ENUM_ID) INNER JOIN public.PRODUCT_PRICE_TYPE PPT ON IR.WATERING_TYPE = PPT.PRODUCT_PRICE_TYPE_ID) INNER JOIN public.LAND_ASSET_DETAILS LAD ON IR.FIXED_ASSET_ID = LAD.FIXED_ASSET_ID) INNER JOIN (SELECT ENM.DESCRIPTION AS ENM_DESCRIPTION, ENM.DESCRIPTION_HINDI AS ENM_DESCRIPTION_HINDI, PER.FIRST_NAME AS PER_FIRST_NAME, PER.GENDER AS PER_GENDER, PR.PARTY_ID_FROM AS PR_PARTY_ID_FROM, PR.PARTY_ID_TO AS PR_PARTY_ID_TO, PR.ROLE_TYPE_ID_FROM AS PR_ROLE_TYPE_ID_FROM, PR.ROLE_TYPE_ID_TO AS PR_ROLE_TYPE_ID_TO, PR.PARTY_RELATIONSHIP_TYPE_ID AS PR_PARTY_RELATIONSHIP_TYPE_ID, CM.CONTACT_MECH_ID AS CM_CONTACT_MECH_ID, PA.ADDRESS1 AS PA_ADDRESS1, DST.GEO_NAME AS DST_GEO_NAME, DST.GEO_NAME_HINDI AS DST_GEO_NAME_HINDI, TEH.GEO_NAME AS TEH_GEO_NAME, TEH.GEO_NAME_HINDI AS TEH_GEO_NAME_HINDI, VIL.GEO_NAME AS VIL_GEO_NAME, VIL.GEO_NAME_HINDI AS VIL_GEO_NAME_HINDI, BAS.OFFICE_SITE_NAME AS BAS_OFFICE_SITE_NAME, BAS.OFFICE_SITE_NAME_HINDI AS BAS_OFFICE_SITE_NAME_HINDI, CIR.OFFICE_SITE_NAME AS CIR_OFFICE_SITE_NAME, CIR.OFFICE_SITE_NAME_HINDI AS CIR_OFFICE_SITE_NAME_HINDI, DIV.OFFICE_SITE_NAME AS DIV_OFFICE_SITE_NAME, DIV.OFFICE_SITE_NAME_HINDI AS DIV_OFFICE_SITE_NAME_HINDI, SDIV.OFFICE_SITE_NAME AS SDIV_OFFICE_SITE_NAME, SDIV.OFFICE_SITE_NAME_HINDI AS SDIV_OFFICE_SITE_NAME_HINDI, DAM.FIXED_ASSET_ID AS DAM_FIXED_ASSET_ID, DAM.FIXED_ASSET_NAME AS DAM_FIXED_ASSET_NAME, DAM.FIXED_ASSET_NAME_HINDI AS DAM_FIXED_ASSET_NAME_HINDI, CAN.FIXED_ASSET_ID AS CAN_FIXED_ASSET_ID, CAN.FIXED_ASSET_NAME AS CAN_FIXED_ASSET_NAME, CAN.FIXED_ASSET_NAME_HINDI AS CAN_FIXED_ASSET_NAME_HINDI, WUA.WUA_ID AS WUA_WUA_ID, WUA.NAME_OF_WUA AS WUA_NAME_OF_WUA, WUA.NAME_OF_WUA_HINDI AS WUA_NAME_OF_WUA_HINDI, DISORMIN.FIXED_ASSET_NAME AS DISORMIN_FIXED_ASSET_NAME, DISORMIN.FIXED_ASSET_NAME_HINDI AS DISORMIN_FIXED_ASSET_NAME_HINDI, PI.ID_VALUE AS PI_ID_VALUE, FAD.PARTY_ID AS FAD_PARTY_ID, FAD.CASTE AS FAD_CASTE, FAD.FATHER_NAME AS FAD_FATHER_NAME, FAD.BASIN_ID AS FAD_BASIN_ID, FAD.CIRCLE_ID AS FAD_CIRCLE_ID, FAD.DIVISION_ID AS FAD_DIVISION_ID, FAD.SUB_DIVISION_ID AS FAD_SUB_DIVISION_ID, FAD.NAME_OF_WUA AS FAD_NAME_OF_WUA, FAD.VILLAGE_ID AS FAD_VILLAGE_ID, FAD.DISTRICT_ID AS FAD_DISTRICT_ID, FAD.DISTB_OR_MIN AS FAD_DISTB_OR_MIN, FAD.DISTB_OR_MIN_ID AS FAD_DISTB_OR_MIN_ID, FAD.TEHSIL_ID AS FAD_TEHSIL_ID, FAD.IS_WATER_CONSUMER AS FAD_IS_WATER_CONSUMER, FAD.CREATED_BY AS FAD_CREATED_BY, BA.BILLING_ACCOUNT_ID AS BA_BILLING_ACCOUNT_ID, BA.ACCOUNT_LIMIT AS BA_ACCOUNT_LIMIT, BA.ACCOUNT_CURRENCY_UOM_ID AS BA_ACCOUNT_CURRENCY_UOM_ID, BA.CONTACT_MECH_ID AS BA_CONTACT_MECH_ID, BA.FROM_DATE AS BA_FROM_DATE, BA.THRU_DATE AS BA_THRU_DATE, BA.DESCRIPTION AS BA_DESCRIPTION, BA.EXTERNAL_ACCOUNT_ID AS BA_EXTERNAL_ACCOUNT_ID, BA.SECURITY_DEPOSIT AS BA_SECURITY_DEPOSIT, BA.BILLING_GENERATION_DAY AS BA_BILLING_GENERATION_DAY, BA.BILLING_CYCLE AS BA_BILLING_CYCLE FROM ((((((((((((((((((public.PERSON PER INNER JOIN public.PARTY_RELATIONSHIP PR ON PER.PARTY_ID = PR.PARTY_ID_TO) INNER JOIN public.FARMER_ADDITIONAL_DETAILS FAD ON PR.PARTY_ID_TO = FAD.PARTY_ID) LEFT OUTER JOIN public.PARTY_CONTACT_MECH_PURPOSE CM ON FAD.PARTY_ID = CM.PARTY_ID) LEFT OUTER JOIN public.POSTAL_ADDRESS PA ON CM.CONTACT_MECH_ID = PA.CONTACT_MECH_ID) INNER JOIN public.BILLING_ACCOUNT_ROLE BAR ON FAD.PARTY_ID = BAR.PARTY_ID) LEFT OUTER JOIN public.BILLING_ACCOUNT BA ON BAR.BILLING_ACCOUNT_ID = BA.BILLING_ACCOUNT_ID) INNER JOIN public.GEO DST ON FAD.DISTRICT_ID = DST.GEO_ID) INNER JOIN public.GEO TEH ON FAD.TEHSIL_ID = TEH.GEO_ID) INNER JOIN public.GEO VIL ON FAD.VILLAGE_ID = VIL.GEO_ID) INNER JOIN public.PARTY_GROUP BAS ON FAD.BASIN_ID = BAS.PARTY_ID) INNER JOIN public.PARTY_GROUP CIR ON FAD.CIRCLE_ID = CIR.PARTY_ID) INNER JOIN public.PARTY_GROUP DIV ON FAD.DIVISION_ID = DIV.PARTY_ID) INNER JOIN public.PARTY_GROUP SDIV ON FAD.SUB_DIVISION_ID = SDIV.PARTY_ID) LEFT OUTER JOIN public.PARTY_IDENTIFICATION PI ON FAD.PARTY_ID = PI.PARTY_ID) LEFT OUTER JOIN public.FIXED_ASSET DAM ON FAD.PROJECT_ID = DAM.FIXED_ASSET_ID) LEFT OUTER JOIN public.FIXED_ASSET CAN ON FAD.CANAL_ID = CAN.FIXED_ASSET_ID) LEFT OUTER JOIN public.ENUMERATION ENM ON FAD.CASTE = ENM.ENUM_ID) LEFT OUTER JOIN public.WATER_USER_ASSOCIATION WUA ON FAD.NAME_OF_WUA = WUA.WUA_ID) LEFT OUTER JOIN public.FIXED_ASSET DISORMIN ON FAD.DISTB_OR_MIN_ID = DISORMIN.FIXED_ASSET_ID) FDV ON IR.CONSUMER_ID = FDV.PR_PARTY_ID_TO) LEFT OUTER JOIN public.INVOICE IV ON IR.INVOICE_ID = IV.INVOICE_ID) LEFT OUTER JOIN public.PRODUCT PR ON AAD.PRODUCT_ID = PR.PRODUCT_ID) LEFT OUTER JOIN public.NON_AGREEMENT_RECORDING NAG ON IR.AGREEMENT_ID = NAG.NON_AGREEMENT_ID) LEFT OUTER JOIN public.PRODUCT PRNAG ON IR.PRODUCT_ID = PRNAG.PRODUCT_ID) LEFT OUTER JOIN public.STATUS_ITEM SI ON NAG.STATUS = SI.STATUS_ID) LEFT OUTER JOIN public.PRODUCT_PRICE PP ON PR.PRODUCT_ID = PP.PRODUCT_ID) LEFT OUTER JOIN public.PRODUCT_PRICE PPNAG ON PRNAG.PRODUCT_ID = PPNAG.PRODUCT_ID) LEFT OUTER JOIN public.AGREEMENT AG ON AAD.AGREEMENT_ID = AG.AGREEMENT_ID) LEFT OUTER JOIN public.NOTIFICATION NT ON AG.ELAN_ID = NT.NOTIFICATION_ID) LEFT OUTER JOIN public.FIXED_ASSET FA ON NT.TANK_ID = FA.FIXED_ASSET_ID) LEFT OUTER JOIN public.NOTIFICATION NTNAG ON NAG.ELAN_ID = NTNAG.NOTIFICATION_ID) LEFT OUTER JOIN public.FIXED_ASSET FANAG ON NTNAG.TANK_ID = FANAG.FIXED_ASSET_ID) LEFT OUTER JOIN public.PRODUCT_CATEGORY PC ON NT.CROP_NAME = PC.PRODUCT_CATEGORY_ID) LEFT OUTER JOIN public.PRODUCT_CATEGORY PCNAG ON NTNAG.CROP_NAME = PCNAG.PRODUCT_CATEGORY_ID) LEFT OUTER JOIN public.ENUMERATION ENUMNAG ON PPNAG.PRODUCT_PRICE_UOM_ID = ENUMNAG.ENUM_ID) LEFT OUTER JOIN public.CONSUMER_REMISSION_DETAIL CRD ON IV.REMISSION_APPLICATION_ID = CRD.REMISSION_APPLICATION_ID where  NT.YEAR='2014-2015'
";


$result = pg_query($sQueryString );

/*
$aRows=array();
$ii=1;
while($row = pg_fetch_object($result)) {
  $aRows[]=$row;
  $ii++;
}*/
 while($row = pg_fetch_assoc ($result))
{
	echo $row['invoice_date'];
 $data =  

"

<table width='100%'style='
    border-right: 1px solid black;
    border-left: 1px solid black;
    border-top: 1px solid black;
	border-bottom: 1px solid black;

    padding: 10px 10px 0px 10px;
'>
<tr><td colspan='4'>
<div> <center><img src='http://192.168.1.19:8081/ab/DB/php/KBJNqL.JPG'style='
    width: 20px;' ></center></div>
  </td></tr>
  <tr><td colspan='4' scope='col' class='tel'>Irrigation Water Bill For Agreemented</td></tr>
  <tr>
    <th colspan='4' scope='col' class='tel'>View Irrigation Water Bill Payment Detail</th>
  </tr>
  <tr>
    <td colspan='2' class='tel1'>Name of Division </td>
    <td colspan='2' class='tel1'>{$row['div_office_site_name']}</td>
  </tr>
  <tr>
    <td colspan='2' class='tel1'>Name of Sub-Division</td>
    <td colspan='2' class='tel1'>{$row['sdiv_office_site_name']}</td>
  </tr>
   <tr>
    <td colspan='2' class='tel1'>Name Of Scheme</td>
    <td colspan='2' class='tel1'>{$row['dam_fixed_asset_name']}</td>
  </tr>
   <tr>
    <td colspan='2' class='tel1'>Name of WUCS</td>
    <td colspan='2' class='tel1'>{$row['wua_name_of_wua']}</td>
  </tr>
   <tr>
    <td colspan='2' class='tel1'>Name of District</td>
    <td colspan='2' class='tel1'>{$row['dst_geo_name']}</td>
  </tr>
   <tr>
    <td colspan='2' class='tel1'>Name of Taluk 	</td>
    <td colspan='2' class='tel1'>{$row['teh_geo_name']}</td>
  </tr>
   <tr>
    <td colspan='2' class='tel1'>Name of Village</td>
    <td colspan='2' class='tel1'>{$row['vil_geo_name']}</td>
  </tr>
    <tr>
    <td colspan='2' class='tel1'>Land Survey No.</td>
    <td colspan='2' class='tel1'>{$row['khasra_no']}</td>
  </tr>
    <tr>
    <td colspan='2' class='tel1'>Year</td>
    <td colspan='2' class='tel1'>{$row['period']} </td>
  </tr>
      <tr>
    <td colspan='2' class='tel1'>Name of Farmer</td>
    <td colspan='2' class='tel1'>{$row['per_first_name']} </td>
  </tr>
      <tr>
    <td colspan='2' class='tel1'>Season</td>
    <td colspan='2' class='tel1'>{$row['pcdesc']} </td>
  </tr>
      <tr>
    <td colspan='2' class='tel1' style='color: blue;'>Date of issue</td>
    <td colspan='2' class='tel1'>{$row ['invoice_date']}</td>
  </tr>
      <tr>
    <td colspan='2' class='tel1' style='color: red;'>Due Date</td>
    <td colspan='2' class='tel1'>{$row ['due_date'] } </td>
  </tr>
 
  <tr>
    <td colspan='4' class='tel'>Bill Detail</td>
  </tr>
    <tr>
    <td colspan='2' class='tel1'style='background-color:#CCFFFF;'>Account No.</td>
    <td colspan='2' class='tel1'>{$row['khata_number']}</td>
  </tr>
     <tr>
    <td colspan='2' class='tel1' style='background-color:#CCFFFF;'>Survey No.</td>
    <td colspan='2' class='tel1'>{$row['khasra_no']}</td>
  </tr>
     <tr>
    <td colspan='2' class='tel1' style='background-color:#CCFFFF;'>Type of Irrigation

</td>
    <td colspan='2' class='tel1'>{$row['enudesc']}</td>
  </tr>
 
    <tr>
    <td colspan='2' class='tel1' style='background-color:#CCFFFF;'>Total Area </td>
    <td colspan='2' class='tel1'>{$row['total_area']}</td>
  </tr>
     <tr>
    <td colspan='2' class='tel1'style='background-color:#CCFFFF;'>Crop</td>
    <td colspan='2' class='tel1'>{$row['prdesc']}</td>
  </tr>
     <tr>
    <td colspan='2' class='tel1'style='background-color:#CCFFFF;'>No. of Watering</td>
    <td colspan='2' class='tel1'>{$row['pptdesc']}</td>
  </tr>  
  <tr>
    <td colspan='2' class='tel1'style='background-color:#CCFFFF;'>Current Amount
(In)<span class='rupyaINR'>rs</span></td>
    <td colspan='2' class='tel1'>{$row['price']}</td>
  </tr>   
  <tr>
    <td colspan='2' class='tel1'style='background-color:#CCFFFF;'>Previous Years Arrear's Amount (In)<span class='rupyaINR'>rs</span></td>
    <td colspan='2' class='tel1'>{$row['previous_balance']}</td>
  </tr>  
  <tr>
    <td colspan='2' class='tel1'style='background-color:#CCFFFF;'>Total Amount (In) <span class='rupyaINR'>rs</span></td>
    <td colspan='2' class='tel1'>{$row['current_balance']}</td>
  </tr>
  <tr>
    <td colspan='4' class='tel'>-----------------</td>
  </tr>
    <tr>
    <td colspan='2' class='tel1'>Total Amount (In) <span class='rupyaINR'>rs</span></td>
    <td colspan='2' class='tel1'>{$row['current_balance']}</td>
  </tr>   
  <tr>
    <td colspan='2' class='tel1'>Penalty On Arrears Amount(In) <span class='rupyaINR'>rs</span></td>
    <td colspan='2' class='tel1'>{$row['c_others']}</td>
  </tr>   
  <tr>
    <td colspan='2' class='tel1'>Irrigation Tax ( 100 Per ha.) <span class='rupyaINR'>rs</span></td>
    <td colspan='2' class='tel1'>{$row['tax']}</td>
  </tr>   

    <td colspan='2' class='tel1'>Apply Penalty After Due Date (In)<span class='rupyaINR'>rs</span></td>
    <td colspan='2' class='tel1'>{$row['interest']}</td>
  </tr>  
  <tr>
    <td colspan='2' class='tel1' class='tel1' style='color:red'>Total Amount to be Paid (In)<span class='rupyaINR'>rs</span></td>
    <td colspan='2' class='tel1' style='color:red'>{$row['net_paid_amount']} <span class='rupyaINR'>rs</span></td>
  </tr>
     
    <td colspan='2' class='tel1'>{$row['net_parid_amount']}</td>
   
  </tr>

</table><br><br>
"           ;
}
//print_r(json_encode($aRows)); 

//print(json_encode($aRows, JSON_UNESCAPED_UNICODE));
//mysqli_close($conection);

echo $data;


?>
