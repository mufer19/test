<?php
require_once ('connect/crest.php');

if(array_key_exists('PLACEMENT_OPTIONS', $_POST)){
    $placement = json_decode($_POST['PLACEMENT_OPTIONS'], true);
    $value = 0;

    if($placement['MODE'] == 'view' and $placement['ENTITY_ID'] == 'CRM_CONTACT'){
        $contact = CRest::call('crm.contact.get', [
            'ID' => $placement['ENTITY_VALUE_ID']
        ]);

        if(array_key_exists('result', $contact)){
            if(!empty($contact['result']['UF_CRM_MY_EDUCATION']))                  $value++;
            if(!empty($contact['result']['UF_CRM_MY_NATIONALITY']))                $value++;
            if(!empty($contact['result']['UF_CRM_MY_ZODIAC_SIGN']))                $value++;
            if(!empty($contact['result']['UF_CRM_MY_FAVORITE_TIME_OF_THE_YEAR']))  $value++;
        }

        echo '<html>
            <head>
                <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                <script src="/js/jquery.circle-progress.min.js"></script>    
            </head>
            <body style="margin: 0;">
                <div class="progress"></div>
                
                <script>
                    jQuery(function($) {
                        $(".progress").circleProgress({
                            max: 4,
                            value: '.$value.',
                            clockwise: false,   
                            textFormat: "percent",
                        });
                    });
                </script>
            </body>
        </html>';
    }
}