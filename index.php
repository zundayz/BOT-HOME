<?php 
 http_response_code(200);
 file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);
?>
