<?php
$options = array('driver' => 'mysqli',
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => 'demogram',
    'prefix' => ''
);

$db = \Joomla\Database\DatabaseDriver::getInstance($options);