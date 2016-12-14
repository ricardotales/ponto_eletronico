<?php
	//recebemos nosso par�metro vindo do form
	$parametro = isset($_POST['pesquisaServidor']) ? $_POST['pesquisaServidor'] : null;
	$msg = "";
	//come�amos a concatenar nossa tabela
	$msg .="<table class='table table-hover'>";
	$msg .="	<thead>";
	$msg .="		<tr>";
	$msg .="			<th>NOME:</th>";
	$msg .="			<th>ADICIONOU ARQUIVO EM:</th>";    
	$msg .="			<th>UNIDADE:</th>";         
	$msg .="		</tr>";
	$msg .="	</thead>";
	$msg .="	<tbody>";
				
				//requerimos a classe de conex�o
				require_once('class/Conexao.class.php');
					try {
						$pdo = new Conexao(); 
						$resultado = $pdo->select("SELECT distinct(C.user), C.registro_adm, A.unidade FROM unidades_prisionais A
                                                                           join users B on A.id = B.fk_id_unidades_prisionais 
                                                                           join  importartxt C on B.user = C.user 
                                                                           -- o like abaixo comentado server para usar o campo de busca (comentado) no arquivo log_file.php , linha 317 à 322
                                                                           -- where unidade LIKE '$parametro%'
                                                                           order by registro_adm");
						$pdo->desconectar();
								
						}catch (PDOException $e){
							echo $e->getMessage();
						}	
						//resgata os dados na tabela
						if(count($resultado)){
							foreach ($resultado as $res) {

	$msg .="				<tr>";
	$msg .="					<td>".$res['user']."</td>";
	$msg .="					<td>".$res['registro_adm']."</td>";      
	$msg .="					<td>".$res['unidade']."</td>";         
	$msg .="				</tr>";
							}	
						}else{
							$msg = "";
							$msg .="Nenhum resultado foi encontrado...";
						}
	$msg .="	</tbody>";
	$msg .="</table>";
	//retorna a msg concatenada
	echo $msg;
?>