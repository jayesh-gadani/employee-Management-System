<?php

config(['paginate' => '5']);
config(['hr_email' => 'gadanijayesh@gmail.com']);
config(['admin_email' => 'parth.parmar12007@gmail.com']);
config(['from_email' => 'jayesh.karavyasolutions@gmail.com']);
config(['from_name' => 'Gadani Jayesh']);
return [
    'roles' => ['ROLE_ADMIN' => 'Role Admin', 'ROLE_HR' => 'Role HR', 'ROLE_PM'=>'Role PM', 'ROLE_EMPLOYEE'=>'Role Employee'],
    'positions' => ['SENIOR_DEVELOPER'=>'Senior Developer', 'JUNIOR_DEVELOPER'=>'Junior Developer', 'TESTER'=>'Tester', 'TL'=>'Team Leader'],
    'task_status'=>['1'=>'Scoping','2'=>'Inprogress','3'=>'Hold','4'=>'QA','5'=>'Done'],
];


?>