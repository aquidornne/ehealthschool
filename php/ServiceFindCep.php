<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);

    try {
        $reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep);

        $data = array(
            'success' => (string)$reg->resultado,
            'address' => (string)$reg->tipo_logradouro . ' ' . $reg->logradouro,
            'neighborhood' => (string)$reg->bairro,
            'city' => (string)$reg->cidade,
            'state' => (string)$reg->uf
        );
    } catch (Exception $e) {
        $data = array('success' => FALSE, 'street' => '', 'neighborhood' => '', 'city' => '', 'state' => '');
    }

    header("Content-type: application/json");
    echo json_encode($data);
    exit;
}