<?php

function sanitize(string $data): string
{
    // Trim e htmlspecialchars ci proteggono da XSS e input sporchi prima che arrivino al DB.
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
