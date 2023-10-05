<?php
use ExemploCrudPoo\Produto;
require_once "../vendor/autoload.php";

$produto = new Produto;

$produto->setId($_GET['id']);
$produto->excluir();
header("location:visualizar.php");