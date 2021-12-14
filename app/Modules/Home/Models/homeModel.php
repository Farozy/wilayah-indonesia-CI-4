<?php namespace App\Modules\Home\Models;

class homeModel extends \App\Models\BaseModel
{
	public function getDataKabupaten($kabupaten)
	{
		$this->dt = $this->db->table('m_provinsi as a ')
					->select('a.name as provinsi, b.name as kabupaten, c.name as kecamatan')
					->join('m_kabupaten as b', 'b.provinsi_id = a.id')
					->join('m_kecamatan as c', 'c.kabupaten_id = b.id')
					->like('b.name', $kabupaten)
					->orLike('c.name', $kabupaten);
		return $this->dt->get()->getResultArray();
	}

	public function getKabupaten()
	{
		$this->dt = $this->db->table('m_kabupaten')
					->select('*');
		return $this->dt->get()->getResultArray();
	}
}
