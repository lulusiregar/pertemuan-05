<?php

function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function validNIM($nim)
{
    return preg_match('/^[0-9]{8,15}$/', $nim);
}

function validPilihan($value, $daftar)
{
    return in_array($value, $daftar, true);
}