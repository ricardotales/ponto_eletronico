<?php
	//recebemos nosso par�metro vindo do form
	//$parametro = isset($_POST['pesquisaServidor']) ? $_POST['pesquisaServidor'] : null;
	$msg = "";
	//come�amos a concatenar nossa tabela
	$msg .="<table class='table table-hover'>";
	$msg .="	<thead>";
	$msg .="		<tr>";
	$msg .="			<th>#</th>";
	$msg .="			<th>NOME:</th>";
	$msg .="			<th>MASP:</th>";
	$msg .="			<th>UNIDADE:</th>";        
	$msg .="		</tr>";
	$msg .="	</thead>";
	$msg .="	<tbody>";
				
	//inclui as bibliotecas
	require_once('class/Conexao.class.php');
	//faz a conexão com o BD
	$pdo = new Conexao(); 

	//pega o valor da pagina atual
	$parametro = isset($_GET['pesquisaServidor']) ? ($_GET['pesquisaServidor']) : '1'; 

	//guardo o resultado na variavel pra exibir os dados na pagina		
	//$resultado = $pdo->select("SELECT * FROM funcionarios ORDER BY nome LIMIT $inicio,$maximo");
	$resultado = $pdo->select("SELECT A.id, A.nome, A.masp, B.unidade FROM funcionarios A "
                                  . "inner join unidades_prisionais B on A.fk_id_unidades_prisionais = B.id "
                                  .  "ORDER BY nome ASC "                                 );      
						//resgata os dados na tabela
						if(count($resultado)){
							foreach ($resultado as $res) {

	$msg .="				<tr>";
	$msg .="					<td>".$res['id']."</td>";
	$msg .="					<td>".$res['nome']."</td>";
	$msg .="					<td>".$res['masp']."</td>";
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