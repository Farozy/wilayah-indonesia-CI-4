<?php 
namespace App\Modules\Produk\Controllers;
use App\Modules\Produk\Models\ProdukModel;

class Produk extends \App\Controllers\BaseController
{
	public function __construct() {
		$this->model = new ProdukModel;
	}
	
	public function index()
	{
		echo view('themes\modern\header.php');
		echo view('\App\Modules\Produk\Views\result.php');
		echo view('themes\modern\footer.php');
	}
	
	public function edit() 
	{
		$this->data['title'] = 'Edit Data Produk';
		echo view('themes\modern\header.php');
		echo view('\App\Modules\Produk\Views\form-edit.php', $this->data);
		echo view('themes\modern\footer.php');
	}
	
	public function add() {
		
		$this->data['title'] = 'Tambah Produk';
		echo view('themes\modern\header.php');
		echo view('\App\Modules\Produk\Views\form-add.php', $this->data);
		echo view('themes\modern\footer.php');
	}
}