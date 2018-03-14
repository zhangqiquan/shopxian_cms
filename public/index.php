<?php namespace think;
        require __DIR__ . '/../include/base.php';
        Container::get('app')->run()->send();