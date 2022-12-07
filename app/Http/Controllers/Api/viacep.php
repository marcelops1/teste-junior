<?php

    $cep = '';

    $url = "viacep.com.br/ws/{$cep}/json/";

    $address = json_decode(file_get_contents($url));