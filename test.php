<?php
$restrictedWords = array('admin', 'moderator', 'support', 'spam', 'abuse');

// Check name
$name = "admin Done here ";
foreach ($restrictedWords as $word) {
    if (preg_match('/' . $word . '/i', $name)) {
        echo "Name contains restricted word: " . $word . ".";
        exit;
    }
}




?>