<?php
session_start();
 require 'init.php';


	require_once('class/Conexao.class.php');
	//faz a conexão com o BD
	$pdo = new Conexao(); 
	//determina o numero de registros que serão mostrados na tela
	$maximo = 20;
	//pega o valor da pagina atual
	$pagina = isset($_GET['pagina']) ? ($_GET['pagina']) : '1'; 
	
	//subtraimos 1, porque os registros sempre começam do 0 (zero), como num array
	$inicio = $pagina - 1;
	//multiplicamos a quantidade de registros da pagina pelo valor da pagina atual 
	$inicio = $maximo * $inicio; 
	//fazemos um select na tabela que iremos utilizar para saber quantos registros ela possui
	$strCount = $pdo->select("SELECT COUNT(*) AS 'cidade' FROM unidades_prisionais");
	//iniciamos uma var que será usada para armazenar a qtde de registros da tabela  
	$total = 0;
	if(count($strCount)){
		foreach ($strCount as $row) {
			//armazeno o total de registros da tabela para fazer a paginação
			$total = $row["cidade"]; 
		}
	} 
        	//guardo o resultado na variavel pra exibir os dados na pagina		
	//$resultado = $pdo->select("SELECT * FROM funcionarios ORDER BY nome LIMIT $inicio,$maximo");
	$resultado = $pdo->select("SELECT * FROM unidades_prisionais "
                                  .  "ORDER BY cidade ASC "  
                                  . "LIMIT $inicio,$maximo");         
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Ponto Eletrônico V 1.0</title>
        <link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />        
	<style type="text/css">
		#pesquisaServidor{
			width:500px;
		}
		#form_pesquisa{
			margin-top:50px;
		}
	</style>        

        <script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script> 
	<script src="" type="text/javascript"></script>        
        <!--  checkbox styling script -->
        <script src="js/jquery/ui.core.js" type="text/javascript"></script>
        <script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
        <script src="js/jquery/jquery.bind.js" type="text/javascript"></script>


    </head>
	<script type="text/javascript">
	$(document).ready(function(){

    //Aqui a ativa a imagem de load
    function loading_show(){
		$('#loading').html("<img src='img/loading.gif'/>").fadeIn('fast');
    }
    
    //Aqui desativa a imagem de loading
    function loading_hide(){
        $('#loading').fadeOut('fast');
    }       
    
    
    // aqui a fun��o ajax que busca os dados em outra pagina do tipo html, n�o � json
    function load_dados(valores, page, div)
    {
        $.ajax
            ({
                type: 'POST',
                dataType: 'html',
                url: page,
                beforeSend: function(){//Chama o loading antes do carregamento
		              loading_show();
				},
                data: valores,
                success: function(msg)
                {
                    loading_hide();
                    var data = msg;
			        $(div).html(data).fadeIn();				
                }
            });
    }
    
    //Aqui eu chamo o metodo de load pela primeira vez sem parametros para pode exibir todos
    load_dados(null, 'pesquisa.php', '#MostraPesq');
    
    
    //Aqui uso o evento key up para come�ar a pesquisar, se valor for maior q 0 ele faz a pesquisa
    $('#pesquisaServidor').keyup(function(){
        
        var valores = $('#form_pesquisa').serialize()//o serialize retorna uma string pronta para ser enviada
        
        //pegando o valor do campo #pesquisaServidor
        var $parametro = $(this).val();
        
        if($parametro.length >= 1)
        {
            load_dados(valores, 'pesquisa.php', '#MostraPesq');
        }else
        {
            load_dados(null, 'pesquisa.php', '#MostraPesq');
        }
    });

	});
	</script>    
    <body> 
        <?php
            if ( isset($_SESSION['logged_in'])) {        
        ?>        
        <div class="clear">&nbsp;</div>
        <div class="nav-outer-repeat"> 
        <!--  start nav-outer -->
            <div class="nav-outer"> 
		<!-- start nav-right -->
		<div id="nav-right">		
			<!--<div class="nav-divider">&nbsp;</div>
			<div class="showhide-account"><img src="images/shared/nav/nav_myaccount.gif" width="93" height="14" alt="" /></div>
			<div class="nav-divider">&nbsp;</div> -->
                        <a href="logout.php" id="logout"><img src="images/shared/nav/nav_logout.gif" width="64" height="14" alt="" /></a>
			<div class="clear">&nbsp;</div>		
		</div> 
		<!-- end nav-right -->
		<!--  start nav -->
		<div class="nav">
                    <div class="table">                    
                        <ul class="select">
                            <li>
                                <a href="home.php"><b>Home</b><!--[if IE 7]><!--></a><!--<![endif]-->
                            </li>
                        </ul>                            
                        <div class="nav-divider">&nbsp;</div>                    		
                        <ul class="select">
                            <li>
                                <a href="add_txt_list_unidades.php"><b>Adicionar .TXT</b><!--[if IE 7]><!--></a><!--<![endif]-->
                            </li>
                        </ul>		
                        <div class="nav-divider">&nbsp;</div>		                    
                        <ul class="select">
                            <li>
                                <a href="#nogo"><b>Cadastrar/Editar</b><!--[if IE 7]><!--></a><!--<![endif]-->
                                <div class="select_sub show">
                                    <ul class="sub">
                                        <li><a href="#nogo">Pessoas</a></li>
                                        <li class="sub_show"><a href="#nogo">Add product</a></li>
                                        <li><a href="#nogo">Delete products</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>		
                        <div class="nav-divider">&nbsp;</div>		
                        <ul class="select">
                            <li>
                                <a href="#nogo"><b>Relatório</b><!--[if IE 7]><!--></a><!--<![endif]-->
                                <div class="select_sub">
                                    <ul class="sub">
                                        <li><a href="user.php">Funcionários por Unidade</a></li>
                                        <li><a href="log_file.php">LOG's de Registro TXT</a></li>
                                        <li><a href="unidades_cadastradas.php">Unidades Cadastradas</a></li>                                        
                                    </ul>
                                </div>
                            </li>
                        </ul>		
                        <div class="nav-divider">&nbsp;</div>		
                        <ul class="select">
                            <li>
                                <a href="#nogo"><b>Folha de Ponto</b><!--[if IE 7]><!--></a><!--<![endif]-->
                                <div class="select_sub">
                                    <ul class="sub">
                                        <li><a href="#nogo">Clients Details 1</a></li>
                                        <li><a href="#nogo">Clients Details 2</a></li>
                                        <li><a href="#nogo">Clients Details 3</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>			
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
		</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div id="content-outer">
        <div id="content">
            <div id="page-heading"><h1><center>Funcionários por Unidade:</center></h1></div>
	<center>
		<article>

                    	<table class="table table-hover">


				<tr>
					<th>ID</th>
					<th>CIDADE</th>
					<th>UNIDADE</th>
				</tr>

			
			<?php
				//se a tabela nao estiver vazia, percorremos linha por linha pegando os valores
				if(count($resultado)){
					foreach ($resultado as $res) {
						echo "<tr>";
						echo "	<td>".$res['id']."</td>";                                                
						echo "	<td>".$res['cidade']."</td>";
						echo "	<td>".$res['unidade']."</td>";
						echo "</tr>";

					}
				}
			?>
                        </table>
		</article>
	</center>        
		<div id="alignpaginacao">            
<?php 
			//determina de quantos em quantos links serão adicionados e removidos
			$max_links = 6;
			//dados para os botões
			$previous = $pagina - 1; 
			$next = $pagina + 1; 
			//usa uma funcção "ceil" para arrendondar o numero pra cima, ex 1,01 será 2
			$pgs = ceil($total / $maximo); 
			//se a tabela não for vazia, adiciona os botões
			if($pgs > 1 ){   
				echo "<br/>"; 
				//botao anterior
				if($previous > 0){
					echo "<div id='botaoanterior'><a href=".$_SERVER['PHP_SELF']."?pagina=$previous><input type='submit'  name='bt-enviar' id='bt-enviar' value='Anterior' class='button' /></a></div>";
				} else{
					echo "<div id='botaoanteriorDis'><a href=".$_SERVER['PHP_SELF']."?pagina=$previous><input type='submit'  name='bt-enviar' id='bt-enviar' value='Anterior' class='button' disabled='disabled'/></a></div>";
				}	
				
				echo "<div id='numpaginacao'>";
					for($i=$pagina-$max_links; $i <= $pgs-1; $i++) {
						if ($i <= 0){
						//enquanto for negativo, não faz nada
						}else{
							//senão adiciona os links para outra pagina
							if($i != $pagina){
								if($i == $pgs){ //se for o final da pagina, coloca tres pontinhos
									echo "<a href=".$_SERVER['PHP_SELF']."?pagina=".($i).">$i</a> ..."; 
								}else{
									echo "<a href=".$_SERVER['PHP_SELF']."?pagina=".($i).">$i</a>"; 
								}
							} else{
								if($i == $pgs){ //se for o final da pagina, coloca tres pontinhos
									echo "<span class='current'> ".$i."</span> ..."; 
								}else{
									echo "<span class='current'> ".$i."</span>";
								}
							} 
						}
					}
					
				echo "</div>";
				
				//botao proximo
				if($next <= $pgs){
					echo " <div id='botaoprox'><a href=".$_SERVER['PHP_SELF']."?pagina=$next><input type='submit'  name='bt-enviar' id='bt-enviar' value='Proxima' class='button'/></a></div>";
				}else{
					echo " <div id='botaoproxDis'><a href=".$_SERVER['PHP_SELF']."?pagina=$next><input type='submit'  name='bt-enviar' id='bt-enviar' value='Proxima' class='button' disabled='disabled'/></a></div>";
				}
							
			}
?>   
                        
                    
</div>
        <div class="clear">&nbsp;</div>
        </div>
        <div class="clear">&nbsp;</div>
        </div>
        <div class="clear">&nbsp;</div>       
        <div id="footer">
            <!--  start footer-left -->
            <div id="footer-left">
                 Admin Skin &copy; Copyright 4Udevp Ltd<a href=""></a>. All rights reserved.
            </div>
            <div class="clear">&nbsp;</div>
        </div>
        <?php } else { 
            //exit ( include "login.php" );
            echo "<script>
                location.href='404.php';
                </script>";
        } ?>         
    </body>
</html>