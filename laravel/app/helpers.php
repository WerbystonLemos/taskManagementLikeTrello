<?php

function gera_slug($nome)
{
    $partes = preg_split('/\s+/', trim($nome));

    if (count($partes) === 1) {
        return strtoupper(substr($nome, 0, 2));
    }

    return strtoupper(
        substr($partes[0], 0, 1) .
        substr(end($partes), 0, 1)
    );
}
