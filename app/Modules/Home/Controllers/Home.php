<?php 
namespace App\Modules\Home\Controllers;

use App\Modules\Home\Models\homeModel;

class Home extends \App\Controllers\BaseController
{
	public function __construct()
	{
		$this->home = new homeModel;
		$this->myapi = '3daf3abd85e866497fb5e83d6d7539ea';
		$this->kabupatenrajaongkir = 'https://api.rajaongkir.com/starter/city?key=' . $this->myapi;
	}
	
	public function index()
	{
		$data = [
			'title' => 'Latihan 2'
		];

		return view('App\Modules\Home\Views/result', $data);
	}

	public function getProvinsi()
	{
		if( $this->request->isAjax() ) {
		
			$msg = [
				'data' => 'http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json'
			];

			return $this->response->setJSON($msg);
		
		} else {
			return redirect()->back();
		}
	}

	public function getDataKabupaten()
	{
		$kabupaten = $this->request->getVar('term');

		if( $kabupaten != null ) {
			$getDataKabupaten = $this->home->getDataKabupaten($kabupaten);
			foreach( $getDataKabupaten as $row ) {
				$results[] = [
					'label' => $row['provinsi'] . ', ' . $row['kabupaten'] . ', ' . $row['kecamatan'],
					'kabupaten' => $row['kabupaten']
				];
			}
            return $this->response->setJSON(json_encode($results));
			// var_dump(json_encode($results));
			// die;
		}
	}

	public function getDataKabupatenRajaOngkir()
	{
		$kabupaten = json_decode(file_get_contents($this->kabupatenrajaongkir));
		$semuaDataKabupaten = $kabupaten->rajaongkir->results;
		foreach( $semuaDataKabupaten as $row ) {
			print_r($row->city_name);
			echo '<br>';
		}
		die;
	}

	public function getDataKabupatenDB()
	{
		$semuaKabupaten = $this->home->getKabupaten();
		foreach( $semuaKabupaten as $row ) {
			$namaKabupaten = $row['name'];
			$pisahKabNamaKabupaten = str_replace('KAB.', '', $namaKabupaten);
			$pisahKotaNamaKota = str_replace('KOTA', '', $pisahKabNamaKabupaten);
			$namaKabBaru = ucwords(strtolower($pisahKotaNamaKota));
			d( $namaKabBaru );
		}
		die;
	}

	public function proses_pengiriman()
	{
		$berat = $this->request->getVar('beratkirim');

		$berat_kirim = $berat * 1000;

		if( $berat_kirim > 3000 ) {
			return redirect()->back()->withInput();
		} else {
			$dataRajaOngkir = json_decode(file_get_contents($this->kabupatenrajaongkir));

			$kota_asal = $this->request->getVar('kotaasalrajaongkir');
			$pisahKabNamaKabupatendarikotaasal = str_replace('KAB. ', '', $kota_asal);
			$pisahKotaPisahKabupatenHasilPisahKabupatenAsal = str_replace('KOTA', '', $pisahKabNamaKabupatendarikotaasal);
			$namaKabBaruasal = ucwords(strtolower($pisahKotaPisahKabupatenHasilPisahKabupatenAsal));

			$kota_tujuan = $this->request->getVar('kotatujuanrajaongkir');
			$pisahKabNamaKabupatendarikotatujuan = str_replace('KAB. ', '', $kota_tujuan);
			$pisahKotaPisahKabupatenHasilPisahKabupatenTujuan = str_replace('KOTA', '', $pisahKabNamaKabupatendarikotatujuan);
			$namaKabBaruTujuan = ucwords(strtolower($pisahKotaPisahKabupatenHasilPisahKabupatenTujuan));

			$semuaKabupatenRajaOngkir = $dataRajaOngkir->rajaongkir->results;

			foreach( $semuaKabupatenRajaOngkir as $row ) {
				if( $namaKabBaruasal == $row->city_name ) {
					$origin = $row->city_id;
				}
				if( $namaKabBaruTujuan == $row->city_name ) {
					$destination = $row->city_id;
				}
			}
			if( $origin == null || $destination == null ) {
				return direct()->back()->withInput();
			}

			$kurir = ['jne', 'pos', 'tiki'];
			$dataKurir = [];
			foreach( $kurir as $value ) {
				$itemKurir = $this->_cost($origin, $destination, $berat_kirim, $value);
				array_push($dataKurir, $itemKurir);
			}
			$data = [
				'kota_asal' => $kota_asal,
				'kota_tujuan' => $kota_tujuan,
				'berat_kirim' => $berat,
				'hasil' => $dataKurir
			];

			return view('App\Modules\Home\Views/hasil', $data);
		}
	}

	private function _cost($origin, $destination, $berat_kirim, $value)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$berat_kirim&courier=$value",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: " . $this->myapi
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$data = json_decode($response);
			return $data;
		}
	}
}
