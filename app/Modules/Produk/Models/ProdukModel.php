<?php
namespace App\Modules\Produk\Models;

class ProdukModel extends \App\Models\BaseModel
{
	public function __construct() {
		parent::__construct();
	}
	
	public function getProduk($where) {
		// Script mendapatkan produk dari database
	}
	
	public function saveData($id) 
	{
		// Script menyimpan data produk ke database
	}
	
}