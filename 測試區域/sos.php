<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    // XML request
    $xml = '<sos:GetObservation
    xmlns:sos="http://www.opengis.net/sos/2.0"
    xmlns:fes="http://www.opengis.net/fes/2.0"
    xmlns:gml="http://www.opengis.net/gml/3.2"
    xmlns:swe="http://www.opengis.net/swe/2.0"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    xmlns:swes="http://www.opengis.net/swes/2.0"
    xmlns:sosrf="http://www.opengis.net/sosrf/1.0"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" service="SOS" version="2.0.0" xsi:schemaLocation="http://www.opengis.net/sos/2.0 http://schemas.opengis.net/sos/2.0/sos.xsd">
      <!-- response document includes observation of this procedure and omits all others (optional, multiple values possible) -->
    <sos:procedure>Thermometer_1285</sos:procedure>
    <!-- response document includes observation of this offering and omits all others (optional, multiple values possible) -->
    <sos:offering>Thermometer_1285_offering</sos:offering>
    <!-- response document includes observation of this observed property and omits all others (optional, multiple values possible) -->
    <sos:observedProperty>air_temperature</sos:observedProperty>
    <!-- observations are filtered by time (optional) -->
    <sos:temporalFilter>
        <fes:During>
            <fes:ValueReference>phenomenonTime</fes:ValueReference>
            <gml:TimePeriod gml:id="tp_1">
                <gml:beginPosition>2021-08-06T09:00:00.000+02:00</gml:beginPosition>
                <gml:endPosition>2021-08-06T10:00:00.000+02:00</gml:endPosition>
            </gml:TimePeriod>
        </fes:During>
    </sos:temporalFilter>
    <!-- response document includes observation of this feature of interest and omits all others (optional, multiple values possible) -->
    <sos:featureOfInterest>Muenster</sos:featureOfInterest>
    <!-- accepted response format (optional) -->
    <sos:responseFormat>http://www.opengis.net/om/2.0</sos:responseFormat>
</sos:GetObservation>';

    // URL of the SOS service
    $url = 'http://localhost:8080/52n-sos-webapp/service';

    // cURL request
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    $response = curl_exec($ch);
    curl_close($ch);

    // Display response
    echo 'GetObservation Response:<br>';
    echo htmlentities($response);


    ?>

</body>

</html>