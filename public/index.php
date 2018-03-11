<?php namespace think;
if(isset($_SERVER['PATH_INFO'])==false||$_SERVER['PATH_INFO']=='/')exit(header('Location:'.dirname($_SERVER['SCRIPT_NAME']).'/index.php/install-Index-index'));
require __DIR__ . '/../include/base.php';
Container::get('app')->run()->send();