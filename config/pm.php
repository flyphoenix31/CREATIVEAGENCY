<?php

return [
	'pagination'         => env('PAGINATION', 25),
    'cmspagination'      => env('CMSPAGINATION', 25),
    'powerrole'          => 'superadmin',
    'deploy_branch'      => 'master',
    'from_mail'          => env('MAIL_FROM_ADDRESS', 'test@gmail.com'),
];
