<?php 

/**
* 
*/
class Ubigeo_modelo extends CI_Model
{
	function devolverDepartamentos()
	{
		$sql = $this->db->query("SELECT id,desdep,coddep FROM departamentos");
		foreach ($sql->result() as $reg) {
			$data[$reg->id] = $reg->desdep; 
		}
		return $data;
	}

	function devolverDistritos()
	{
		$sql = $this->db->select('id')->get('provincias');
		$retorna = "";

		foreach ($sql->result() as $reg) {
			$r = $this->db->where('provincia_id', $reg->id)->get('distritos');

			$arreglo = $r->result_array();
			$cadena = "";
			for ($i=0; $i < count($arreglo); $i++) { 
				if ($i != 0) $cadena.=",";

				$cadena.="new Array({$arreglo[$i]['id']},'{$arreglo[$i]['desdist']}','{$arreglo[$i]['coddis']}')";
			}
			$retorna.="var prov_{$reg->id} = new Array($cadena);\n";
		}
		return $retorna;
	}

	function devolverProvincias($codpro)
	{
		$sql = $this->db->select('id, despro descri')
				->where('departamento_id', $codpro)
				->get('provincias');
		
		$data = array();
		foreach ($sql->result() as $reg) {
			$data[$reg->id] = $reg->descri;
		}
		echo json_encode($data);
	}

}
