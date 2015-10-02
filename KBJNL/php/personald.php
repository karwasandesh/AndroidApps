<?php
header("Access-Control-Allow-Origin: *");
include_once('db.php');

error_reporting(0);
$Newval =$_POST['Newval'];

$sQueryString="SELECT ENM.DESCRIPTION, ENM.DESCRIPTION_HINDI, CMA.CATEGORY_ID, CMA.CASTE, 
PER.FIRST_NAME, PER.FIRST_NAME_LOCAL, PER.GENDER, PR.PARTY_ID_FROM, PR.PARTY_ID_TO, 
PR.ROLE_TYPE_ID_FROM, PR.ROLE_TYPE_ID_TO, PR.PARTY_RELATIONSHIP_TYPE_ID, CM.CONTACT_MECH_ID, 
PA.ADDRESS1, PA.ADDRESS2, DST.GEO_NAME as geo1, DST.GEO_NAME_HINDI, TEH.GEO_NAME as geo2 , TEH.GEO_NAME_HINDI, 
VIL.GEO_NAME as geo3, VIL.GEO_NAME_HINDI, BAS.OFFICE_SITE_NAME as Office1, BAS.OFFICE_SITE_NAME_HINDI, CIR.OFFICE_SITE_NAME as Office2, 
CIR.OFFICE_SITE_NAME_HINDI, DIV.OFFICE_SITE_NAME as Office3, DIV.OFFICE_SITE_NAME_HINDI, SDIV.OFFICE_SITE_NAME as Office4, 
SDIV.OFFICE_SITE_NAME_HINDI, DAM.FIXED_ASSET_ID, DAM.FIXED_ASSET_NAME as project1, DAM.FIXED_ASSET_NAME_HINDI, 
CAN.FIXED_ASSET_ID, CAN.FIXED_ASSET_NAME as project2, CAN.FIXED_ASSET_NAME_HINDI, WUA.WUA_ID as wuaid, WUA.NAME_OF_WUA as wua_name, 
WUA.NAME_OF_WUA_HINDI, DISORMIN.FIXED_ASSET_NAME as project3, DISORMIN.FIXED_ASSET_NAME_HINDI, PI.ID_VALUE, 
WUA.NAME_OF_W_U_A_PRESIDENT, WUA.CONTACT_NO_OF_PRESIDENT as wuapres, FAD.PARTY_ID, FAD.SUB_CASTE, FAD.FATHER_NAME, 
FAD.FATHER_NAME_KAN, FAD.BASIN_ID, FAD.CIRCLE_ID, FAD.DIVISION_ID, FAD.SUB_DIVISION_ID, FAD.NAME_OF_WUA, 
FAD.VILLAGE_ID, FAD.DISTRICT_ID, FAD.DISTB_OR_MIN as distru, FAD.DISTB_OR_MIN_ID, FAD.TEHSIL_ID, FAD.IS_WATER_CONSUMER, 
FAD.CREATED_BY, FAD.USER_LOGIN_ID, FAD.LOGIN_OFFICE_ID, FAD.CONTACT_NO, FAD.EMAIL_ID, BA.BILLING_ACCOUNT_ID, 
BA.ACCOUNT_LIMIT, BA.ACCOUNT_CURRENCY_UOM_ID, BA.CONTACT_MECH_ID, BA.FROM_DATE, BA.THRU_DATE, BA.DESCRIPTION, 
BA.EXTERNAL_ACCOUNT_ID, BA.SECURITY_DEPOSIT, BA.BILLING_GENERATION_DAY, BA.BILLING_CYCLE FROM 
(((((((((((((((((((public.PERSON PER INNER JOIN public.PARTY_RELATIONSHIP PR ON PER.PARTY_ID = PR.PARTY_ID_TO) 
INNER JOIN public.FARMER_ADDITIONAL_DETAILS FAD ON PR.PARTY_ID_TO = FAD.PARTY_ID) LEFT OUTER JOIN 
public.PARTY_CONTACT_MECH_PURPOSE CM ON FAD.PARTY_ID = CM.PARTY_ID) LEFT OUTER JOIN public.POSTAL_ADDRESS PA ON 
CM.CONTACT_MECH_ID = PA.CONTACT_MECH_ID) INNER JOIN public.BILLING_ACCOUNT_ROLE BAR ON FAD.PARTY_ID = BAR.PARTY_ID) 
LEFT OUTER JOIN public.BILLING_ACCOUNT BA ON BAR.BILLING_ACCOUNT_ID = BA.BILLING_ACCOUNT_ID) INNER JOIN 
public.GEO DST ON FAD.DISTRICT_ID = DST.GEO_ID) INNER JOIN public.GEO TEH ON FAD.TEHSIL_ID = TEH.GEO_ID) 
INNER JOIN public.GEO VIL ON FAD.VILLAGE_ID = VIL.GEO_ID) INNER JOIN public.PARTY_GROUP BAS ON 
FAD.BASIN_ID = BAS.PARTY_ID) INNER JOIN public.PARTY_GROUP CIR ON FAD.CIRCLE_ID = CIR.PARTY_ID) 
INNER JOIN public.PARTY_GROUP DIV ON FAD.DIVISION_ID = DIV.PARTY_ID) INNER JOIN public.PARTY_GROUP SDIV ON
 FAD.SUB_DIVISION_ID = SDIV.PARTY_ID) LEFT OUTER JOIN public.PARTY_IDENTIFICATION PI ON FAD.PARTY_ID = PI.PARTY_ID) 
 LEFT OUTER JOIN public.FIXED_ASSET DAM ON FAD.PROJECT_ID = DAM.FIXED_ASSET_ID) LEFT OUTER JOIN 
 public.FIXED_ASSET CAN ON FAD.CANAL_ID = CAN.FIXED_ASSET_ID) LEFT OUTER JOIN public.CASTE_MASTER CMA ON 
 FAD.SUB_CASTE = CMA.CASTE_ID) LEFT OUTER JOIN public.ENUMERATION ENM ON CMA.CATEGORY_ID = ENM.ENUM_ID) 
 LEFT OUTER JOIN public.WATER_USER_ASSOCIATION WUA ON FAD.NAME_OF_WUA = WUA.WUA_ID) LEFT OUTER JOIN 
 public.FIXED_ASSET DISORMIN ON FAD.DISTB_OR_MIN_ID = DISORMIN.FIXED_ASSET_ID where FAD.party_id='10002'
";


$result = pg_query($sQueryString );
$aRows=array();
$ii=1;
while($row = pg_fetch_object($result)) {
  $aRows[]=$row;
  $ii++;
}

//print_r(json_encode($aRows)); 

print(json_encode($aRows, JSON_UNESCAPED_UNICODE));
//mysqli_close($conection);


?>