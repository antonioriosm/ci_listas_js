
<!DOCTYPE html>
<html lang='es'>
<head>
	<meta charset='utf-8' />
	<title><?php echo $titulo?></title>
	<link rel="stylesheet" href="<?php echo base_url()?>css/bootstrap.css" />
	<script type="text/javascript" src="<?php echo base_url()?>js/jquery-1.7.2.js"></script>
	<script type="text/javascript">
	<?php echo $dpto_js?>;
	var path = '<?php echo base_url()?>';
	$(function() {

		cargarProvincias();

		$('#sDep').change(cargarProvincias);
		$('#sPro').change(cargarDistritos);
		$('#sDis').change(imprimirDetalle);

	});

	function cargarDistritos () {
		var codpro = $('#sPro').val();
		$('#sDis').empty();

		obPro = eval('prov_' + codpro);
	   
		for (var i=0; i<obPro.length; i++) {
			$('#sDis').append("<option value='"+obPro[i][0]+"'>"+ obPro[i][1]+'</option>');
		}
		imprimirDetalle();

	}

	function cargarProvincias () {
		var coddep = $('#sDep').val();
		$('#sPro').empty();
		$.getJSON(path + 'ubigeo/prov', {id: coddep}, function(resp) {
			$.each(resp, function(indice, valor) {
				option = $('<option></option>', {
					text: valor,
					value: indice
				});
				$('#sPro').append(option);
			});
			cargarDistritos();
		});
	}

	function imprimirDetalle () {

		obPro = eval('prov_' + $('#sPro').val());
		id = $("#sDis").prop("selectedIndex");
		$('#departamento').text($('#sDep :selected').text());
		$('#provincia').text($('#sPro :selected').text());
		$('#distrito').text($('#sDis :selected').text());
		$('#codigo').text(obPro[id][2]);
	}
	</script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="offset2 span8 well">
				<h1>Listas Desplegables con CI y jQuery</h1>
			</div>
			<div class="row">
				<div class="offset2 span4 well">
<?php echo form_label('Departamentos : ', 'dpto') ?>
<?php echo form_dropdown('sDep', $dptos, 6, "id='sDep'");?>
<?php echo form_label('Provincias : ', 'prov') ?>				
<?php echo form_dropdown('sPro', array(), null, "id='sPro'");?>					
<?php echo form_label('Distritos : ', 'dist') ?>				
<?php echo form_dropdown('sDis', array(), null, "id='sDis'");?>					
				</div>
				<div class="span4 well" id="detalle">
<?php echo form_label('Código : ', 'codigo') ?>
					<span id='codigo' class="label label-important"></span>
<?php echo form_label('Departamento : ', 'departamento') ?>
					<span id="departamento" class="label label-success"></span>
<?php echo form_label('Provincia : ', 'provincia') ?>
					<span id="provincia" class="label label-success"></span>
<?php echo form_label('Distrito : ', 'Distrito') ?>
					<span id="distrito" class="label label-success"></span>
				</div>
			</div>
		</div>
	</div>
</body>
</html>