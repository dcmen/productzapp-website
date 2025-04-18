<?php

$soapUrl = "https://vindicator.polk.com/Webservice/VINMatching.asmx"; // asmx URL of WSDL
$xml_post_string = '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:vin="http://www.polk.com.au/VINMatching/">
            <soap:Header>
               <vin:AuthHeader>
                  <!--Optional:-->
                  <vin:UserName>PolkServiceUser</vin:UserName>
                  <!--Optional:-->
                  <vin:Password>PolkServicePassword</vin:Password>
                  <!--Optional:-->
                  <vin:errorMessage></vin:errorMessage>
               </vin:AuthHeader>
            </soap:Header>
            <soap:Body>
               <vin:VinMatch>
                  <!--Optional:-->
                  <vin:requestObject>
                     <vin:CompanyCode>131</vin:CompanyCode>
                     <!--Optional:-->
                     <vin:UserName>Mediatag_poc</vin:UserName>
                     <vin:RetrievalType>DRDT_0005</vin:RetrievalType>
                     <!--Optional:-->
                     <vin:Vin>JS1BN121300100987</vin:Vin>
                     <!--Optional:-->
                     <vin:VehicleYear></vin:VehicleYear>
                     <!--Optional:-->
                     <vin:UserDefinedKey>carzapp</vin:UserDefinedKey>
                  </vin:requestObject>
               </vin:VinMatch>
            </soap:Body>
         </soap:Envelope>';

$headers = array(
    "Content-type: text/xml;charset=\"utf-8\"",
    "Accept: text/xml",
    "Cache-Control: no-cache",
    "Pragma: no-cache",
    "SOAPAction: http://www.polk.com.au/VINMatching/VinMatch",
    "Content-length: " . strlen($xml_post_string),
); //SOAPAction: your op URL

$url = $soapUrl;

// PHP cURL  for https connection with auth
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// converting
$response = curl_exec($ch);
curl_close($ch);

// converting
$response1 = str_replace("<soap:Body>", "", $response);
$response2 = str_replace("</soap:Body>", "", $response1);

// convertingc to XML
$parser = simplexml_load_string($response2);
var_dump($parser);
// user $parser to get your data out of XML response and to display it.
?>