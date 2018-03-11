#!/usr/bin/env php
<?php
namespace think;

// 加载基础文件
require __DIR__ . '/include/base.php';

// 应用初始化
Container::get('app')->path(__DIR__ . '/application/')->initialize();

// 控制台初始化
Console::init();