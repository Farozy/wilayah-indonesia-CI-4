<?php
$routes->group('home', ['namespace' => '\App\Modules\Home\Controllers'], function ($routes) {
	$routes->get('/', 'Home::index');
	$routes->add('getDataKabupaten', 'Home::getDataKabupaten');
	$routes->add('getDataKabupatenRajaOngkir', 'Home::getDataKabupatenRajaOngkir');
	$routes->add('getDataKabupatenDB', 'Home::getDataKabupatenDB');
	$routes->add('proses_pengiriman', 'Home::proses_pengiriman');
});
