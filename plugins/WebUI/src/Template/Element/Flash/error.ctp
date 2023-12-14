<?php

if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div lass="message error text-center alert-success" onclick="this.classList.add('hidden');"><?= $message ?></div>
