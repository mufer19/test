<?php
require_once ('connect/crest.php');

$head = null;
$message = 'Руководитель не найден';

$user = CRest::call('user.get', [
     'ID' => preg_replace('/[^0-9]/', '', $_POST['properties']['user'])
]);

if(array_key_exists('result', $user)){
    $get_department = CRest::call('department.get', [
        'FILTER' => [
            'ID' => preg_replace('/[^0-9]/', '', $user['result'][0]['UF_DEPARTMENT']),
            '!=UF_HEAD' => ''
        ]
    ]);

    if(array_key_exists('result', $get_department) and $get_department['total'] >= 1){
        $head = 'user_'.$get_department['result'][0]['UF_HEAD'];
        $message = 'Руководитель найден';
    }
}

$event = CRest::call('bizproc.event.send', [
    'event_token' 	=> $_POST['event_token'],
    'log_message' 	=> $message,
    'return_values' => [
        'head' => $head
    ]
]);