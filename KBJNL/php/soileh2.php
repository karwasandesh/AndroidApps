<?php
header("Access-Control-Allow-Origin: *");
include_once('db.php');

error_reporting(0);
$Newval =$_POST['Newval'];

$sQueryString=" 
SELECT
replace((round(SSD.latitude::numeric,0):: text||':'||SUBSTR(cast( ((SSD.latitude-round(SSD.latitude::numeric,0))*60)as text),1,2) ::text
 ||':'||to_char((((SSD.latitude-round(SSD.latitude::numeric,0))*60-floor((SSD.latitude-round(SSD.latitude::numeric,0))*60)))*60 ::numeric,'99')) ,' ','') as LAT1,

  replace((round(SSD.longitude::numeric,0):: text||':'
 ||SUBSTR(cast( ((SSD.longitude-round(SSD.longitude::numeric,0))*60)as text),1,2) ::text||':'
 ||to_char((((SSD.longitude-round(SSD.longitude::numeric,0))*60-floor((SSD.longitude-round(SSD.longitude::numeric,0))*60)))*60 ::numeric,'99')),' ','')  as LONG1,
SSD.financial_year as year,
   LA.KHASRA_NO ,
    LA.KHATA_NUMBER ,
    LA.WET_LAND_AREA ,
    LA.DRY_LAND_AREA ,
     LA.AREA_OF_LAND ,
      LA.AREA_OF_SETTLEMENT ,
      LA.STATUS_OF_LAND ,
      FAD.FATHER_NAME ,
     PER.FIRST_NAME ,
 PER.GENDER,
     PGZ.OFFICE_SITE_NAME ,
       PGZ.OFFICE_SITE_NAME_HINDI ,
      PGC.OFFICE_SITE_NAME ,
     PGC.OFFICE_SITE_NAME_HINDI ,
      PGD.OFFICE_SITE_NAME ,
      PGD.OFFICE_SITE_NAME_HINDI ,
   PGS.OFFICE_SITE_NAME ,
     PGS.OFFICE_SITE_NAME_HINDI ,
     GEOD.GEO_NAME ,
        GEOD.GEO_NAME_HINDI   as DistrictKan,
   GEOT.GEO_NAME ,
      GEOT.GEO_NAME_HINDI   as talukaKan,
     GEOV.GEO_NAME ,
         GEOV.GEO_NAME_HINDI   as VillageKan,
     ENM.DESCRIPTION ,
         ENM.DESCRIPTION_HINDI   as SoilSampleKan,
    ENMS.DESCRIPTION ,
     ENMS.DESCRIPTION_HINDI   as Soil_TypeKan,
       ENMSD.DESCRIPTION ,
      ENMSD.DESCRIPTION_HINDI   as Soil_DepthKan,
    ENMW.DESCRIPTION ,
      ENMW.DESCRIPTION_HINDI   as Water_ResourceKan,
    ENMA.DESCRIPTION ,
             ENMA.DESCRIPTION_HINDI   as AreaUnderCultivationKan,
    SSD.SAMPLE_ID ,
       SSD.SAMPLE_CODE ,
     SSD.BASIN_ID ,
     SSD.CIRCLE_ID ,
         SSD.SUBDIVISION_ID ,
       SSD.DISTRICT_ID ,
     SSD.TALUKA_ID ,
      SSD.VILLAGE_ID ,
    SSD.FARMER_ID ,
        SSD.LAND_ID ,
    SSD.SAMPLE_NAME ,
     SSD.SAMPLE_COLLECTED_BY ,
  SSD.TELEPHONE_NUMBER ,
          SSD.EMAIL_ID ,
   SSD.SAMPLE_TYPE ,
     SSD.SOIL_TYPE ,
     SSD.SOIL_DEPTH ,
    SSD.AREA_UNDE_CULTIVATION ,
         SSD.WATER_RESOURCE ,
    SSD.SOIL_DETAILS ,
   SSD.SAMPLE_DATE ,
    SSD.CREATED_BY ,
   SSD.CREATED_BY_OFFICE_ID ,
      SSD.CARD_STATUS ,
    SSD.P_RABI ,
     SSD.P_KHARIF ,
    SSD.P_OTHERS ,
   SSD.C_RABI ,
   SSD.C_KHARIF ,
      SSD.C_OTHERS ,


    SSD.FINANCIAL_YEAR ,
    SSD.PROPOSAL_BY ,
      SSD.PROPOSAL_BY_OFFICE_ID ,
       SSD.PROPOSAL_REMARK ,
    STD.TEST_ID ,
     STD.REPORT_NO ,
    STD.TEST_CODE ,
   STD.FROM_DATE ,
      STD.REPORTING_DATE ,
     STD.SAMPLE_STORED ,
   STD.PH_CONTENT ,
      STD.SALT_CONTENT ,
   STD.AVAILABLE_NITROGEN ,
            STD.ORGANIC_CARBON ,
     STD.AVAILABLE_PHOSPHOROUS ,
      STD.AVAILABLE_POTASH ,
     STD.COPPER ,
     STD.IRON ,
               STD.SULPHUR ,
     STD.MANGANESE ,
       STD.ZINC ,
      STD.BORON ,
      STD.MOLYBDENUM

      FROM (((((((((((((((((public.SOIL_SAMPLE_DETAILS SSD LEFT OUTER JOIN public.FARMER_ADDITIONAL_DETAILS FAD
      ON SSD.FARMER_ID = FAD.PARTY_ID) LEFT OUTER JOIN public.PERSON PER ON FAD.PARTY_ID = PER.PARTY_ID)
      LEFT OUTER JOIN public.PARTY_GROUP PGZ ON SSD.BASIN_ID = PGZ.PARTY_ID) LEFT OUTER JOIN
      public.PARTY_GROUP PGC ON SSD.CIRCLE_ID = PGC.PARTY_ID) LEFT OUTER JOIN public.PARTY_GROUP PGD
      ON SSD.DIVISION_ID = PGD.PARTY_ID) LEFT OUTER JOIN public.PARTY_GROUP PGS
      ON SSD.SUBDIVISION_ID = PGS.PARTY_ID) LEFT OUTER JOIN public.GEO GEOD
      ON SSD.DISTRICT_ID = GEOD.GEO_ID) LEFT OUTER JOIN public.GEO GEOT
      ON SSD.TALUKA_ID = GEOT.GEO_ID) LEFT OUTER JOIN public.GEO GEOV
      ON SSD.VILLAGE_ID = GEOV.GEO_ID) LEFT OUTER JOIN public.LAND_ASSET_DETAILS LA
      ON SSD.LAND_ID = LA.FIXED_ASSET_ID) LEFT OUTER JOIN public.FIXED_ASSET_GEO_POINT FAGP
      ON LA.FIXED_ASSET_ID = FAGP.FIXED_ASSET_ID) LEFT OUTER JOIN public.GEO_POINT GP
      ON FAGP.GEO_POINT_ID = GP.GEO_POINT_ID) LEFT OUTER JOIN public.ENUMERATION ENM
      ON SSD.SAMPLE_TYPE = ENM.ENUM_ID) LEFT OUTER JOIN public.ENUMERATION ENMS
      ON SSD.SOIL_TYPE = ENMS.ENUM_ID) LEFT OUTER JOIN public.ENUMERATION ENMSD
      ON SSD.SOIL_DEPTH = ENMSD.ENUM_ID) LEFT OUTER JOIN public.ENUMERATION ENMW
      ON SSD.WATER_RESOURCE = ENMW.ENUM_ID) LEFT OUTER JOIN public.ENUMERATION ENMA
      ON SSD.AREA_UNDE_CULTIVATION = ENMA.ENUM_ID) LEFT OUTER JOIN public.SOIL_TEST_DETAILS STD
      ON SSD.SAMPLE_ID = STD.SAMPLE_ID WHERE FARMER_ID ='10010'
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
