<?php
require_once (__DIR__.'/crest.php');

$domain = 'https://example.com';
$result = CRest::installApp();

CRest::call('userfieldtype.add', [
    'USER_TYPE_ID' => 'progress_circle',
    'HANDLER' => $domain.'/get_progress.php',   // Путь к файлу
    'TITLE' => 'Прогресс заполнения',
    'DESCRIPTION' => '',
    'OPTIONS' => [
        'height' => 100
    ],
]);

CRest::call('crm.contact.userfield.add', [
    'FIELD_NAME' => 'MY_EDUCATION',
    'EDIT_FORM_LABEL' => 'Образование',
    'LIST_COLUMN_LABEL' => 'Образование',
    'USER_TYPE_ID' => 'string',
    'XML_ID' => 'UF_CRM_MY_EDUCATION',
]);

CRest::call('crm.contact.userfield.add', [
    'FIELD_NAME' => 'MY_NATIONALITY',
    'EDIT_FORM_LABEL' => 'Национальность',
    'LIST_COLUMN_LABEL' => 'Национальность',
    'USER_TYPE_ID' => 'string',
    'XML_ID' => 'UF_CRM_MY_NATIONALITY',
]);

CRest::call('crm.contact.userfield.add', [
    'FIELD_NAME' => 'MY_ZODIAC_SIGN',
    'EDIT_FORM_LABEL' => 'Знак зодиака',
    'LIST_COLUMN_LABEL' => 'Знак зодиака',
    'USER_TYPE_ID' => 'string',
    'XML_ID' => 'UF_CRM_MY_ZODIAC_SIGN',
]);

CRest::call('crm.contact.userfield.add', [
    'FIELD_NAME' => 'MY_FAVORITE_TIME_OF_THE_YEAR',
    'EDIT_FORM_LABEL' => 'Любимое время года',
    'LIST_COLUMN_LABEL' => 'Любимое время года',
    'USER_TYPE_ID' => 'string',
    'XML_ID' => 'UF_CRM_MY_FAVORITE_TIME_OF_THE_YEAR',
]);

CRest::call('bizproc.activity.add', [
    'CODE' => 'get_head',
    'HANDLER' => $domain.'/get_head.php', // Путь к файлу
    'AUTH_USER_ID' => 1,
    'USE_SUBSCRIPTION' => 'Y',
    'NAME' => [
        'ru' => 'Получение руководителя'
    ],
    'PROPERTIES' => [
        'user' => [
            'Name' => [
                'ru' => 'Пользователь'
            ],
            'Type' => 'user',
            'Required' => 'Y'
        ]
    ],
    'RETURN_PROPERTIES' => [
        'head' => [
            'Name' => [
                'ru' => 'Руководитель'
            ],
            'Type' => 'user',
            'Default' => 'N'
        ]
    ]
]);

if($result['rest_only'] === false):?>
<head>
	<script src="//api.bitrix24.com/api/v1/"></script>
	<?if($result['install'] == true):?>
	<script>
		BX24.init(function(){
			BX24.installFinish();
		});
	</script>
	<?endif;?>
</head>
<body>
	<?if($result['install'] == true):?>
		installation has been finished
	<?else:?>
		installation error
	<?endif;?>
</body>
<?endif;