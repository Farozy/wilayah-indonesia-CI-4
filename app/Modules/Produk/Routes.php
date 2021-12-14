<?php
$routes->group("produk", ["namespace" => "\App\Modules\Produk\Controllers"], function ($routes) {
	$routes->get("/", "Produk::index");
	$routes->add("add", "Produk::add");
	$routes->add("edit", "Produk::edit");
});