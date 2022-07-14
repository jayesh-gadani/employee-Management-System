<?php

config(['paginate'=>'6']);
config(['hr_email'=>'gadanijayesh@gmail.com']);
config(['admin_email'=>'parth.parmar12007@gmail.com']);
return [
    'roles' => ['ROLE_ADMIN' => 'Role Admin', 'ROLE_HR' => 'Role HR', 'ROLE_PM'=>'Role PM', 'ROLE_EMPLOYEE'=>'Role Employee'],
    'positions' => ['SENIOR_DEVELOPER'=>'Senior Developer', 'JUNIOR_DEVELOPER'=>'Junior Developer', 'TESTER'=>'Tester', 'TL'=>'Team Leader'],


];


?>