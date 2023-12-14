
<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message error text-center alert-danger" onclick="this.classList.add('hidden');"><?= $message ?></div>
