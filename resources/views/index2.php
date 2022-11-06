
<?php

try {
    $opts = array(
        'http' => array(
            'user_agent' => 'PHPSoapClient'
        )
    );
    $context = stream_context_create($opts);

    $client = new SoapClient(
        'http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl',
        array('stream_context' => $context,
              'cache_wsdl'     => WSDL_CACHE_NONE)
    );

    $result = $client->checkVat(
        array(
            'countryCode' => 'PL',
            'vatNumber'   => '5242106963'
        )
    );
    print_r($result);
} catch (Exception $e) {
    echo $e->getMessage();
}
?>