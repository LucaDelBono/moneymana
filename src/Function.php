<?php
function flashMessage(): string
{
    if (empty($_SESSION["flash"])) {
        return "";
    }

    $allowedTypes = ["success", "danger", "warning"];
    $type = $_SESSION["flash"]["type"] ?? "light";

    if (!in_array($type, $allowedTypes)) {
        $type = "light";
    }

    $message = htmlspecialchars($_SESSION["flash"]["message"] ?? "", ENT_QUOTES, "UTF-8");

    unset($_SESSION["flash"]);

    return '
    <div id="flashMessage" class="alert alert-' . $type . '" role="alert" 
         style="position: fixed; bottom: 20px; right: 20px; z-index: 1050;">
        ' . $message . '
    </div>
    ';
}
