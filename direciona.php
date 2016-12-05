<?php
session_start();
 require 'init.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="refresh" content="6;URL=home.php" /> 
        <title>Ponto Eletrônico V 1.0</title>
        <link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
        <!--[if IE]>
        <link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
        <![endif]-->

        <!--  jquery core -->
        <script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script> 
        <!--  checkbox styling script -->
        <script src="js/jquery/ui.core.js" type="text/javascript"></script>
        <script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
        <script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
        <script type="text/javascript">
                $(function(){
                $('input').checkBox();
                $('#toggle-all').click(function(){
                $('#toggle-all').toggleClass('toggle-checked');
                $('#mainform input[type=checkbox]').checkBox('toggle');
                return false;
                });
            });
        </script>  
        <![if !IE 7]>
        <!--  styled select box script version 1 -->
        <script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.styledselect').selectbox({ inputClass: "selectbox_styled" });
            });
        </script>
        <!--  styled select box script version 2 --> 
        <script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
        <script type="text/javascript">
                $(document).ready(function() {
                $('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
                $('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
            });
        </script>
        <!--  styled select box script version 3 --> 
        <script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
        <script type="text/javascript">
                $(document).ready(function() {
                $('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
            });
        </script>
        <!--  styled file upload script --> 
        <script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>
        <script type="text/javascript" charset="utf-8">
                $(function() {
                $("input.file_1").filestyle({ 
                image: "images/forms/upload_file.gif",
                imageheight : 29,
                imagewidth : 78,
                width : 300
                });
            });
        </script>
        <!-- Custom jquery scripts -->
        <script src="js/jquery/custom_jquery.js" type="text/javascript"></script> 
        <!-- Tooltips -->
        <script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
        <script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>
        <script type="text/javascript">
                $(function() {
                    $('a.info-tooltip ').tooltip({
                        track: true,
                        delay: 0,
                        fixPNG: true, 
                        showURL: false,
                        showBody: " - ",
                        top: -35,
                        left: 5
                });
            });
        </script> 
        <!--  date picker script -->
        <link rel="stylesheet" href="css/datePicker.css" type="text/css" />
        <script src="js/jquery/date.js" type="text/javascript"></script>
        <script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
        $(function()
{

// initialise the "Select date" link
$('#date-pick')
	.datePicker(
		// associate the link with a date picker
		{
			createButton:false,
			startDate:'01/01/2005',
			endDate:'31/12/2020'
		}
	).bind(
		// when the link is clicked display the date picker
		'click',
		function()
		{
			updateSelects($(this).dpGetSelected()[0]);
			$(this).dpDisplay();
			return false;
		}
	).bind(
		// when a date is selected update the SELECTs
		'dateSelected',
		function(e, selectedDate, $td, state)
		{
			updateSelects(selectedDate);
		}
	).bind(
		'dpClosed',
		function(e, selected)
		{
			updateSelects(selected[0]);
		}
	);
	
var updateSelects = function (selectedDate)
{
	var selectedDate = new Date(selectedDate);
	$('#d option[value=' + selectedDate.getDate() + ']').attr('selected', 'selected');
	$('#m option[value=' + (selectedDate.getMonth()+1) + ']').attr('selected', 'selected');
	$('#y option[value=' + (selectedDate.getFullYear()) + ']').attr('selected', 'selected');
}
// listen for when the selects are changed and update the picker
$('#d, #m, #y')
	.bind(
		'change',
		function()
		{
			var d = new Date(
						$('#y').val(),
						$('#m').val()-1,
						$('#d').val()
					);
			$('#date-pick').dpSetSelected(d.asString());
		}
	);

// default the position of the selects to today
var today = new Date();
updateSelects(today.getTime());

// and update the datePicker to reflect it...
$('#d').trigger('change');
});
</script>

        <!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
        <script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
        <script type="text/javascript">
                $(document).ready(function(){
                $(document).pngFix( );
            });
        </script>
    </head>
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
                                <a href="#nogo"><b>Adicionar .TXT</b><!--[if IE 7]><!--></a><!--<![endif]-->
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
                                        <li><a href="#nogo">Categories Details 1</a></li>
                                        <li><a href="#nogo">Categories Details 2</a></li>
                                        <li><a href="#nogo">Categories Details 3</a></li>
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
        <div id="page-heading"><h1>Selecione abaixo a sua unidade:</h1></div>

        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
            <tr>
                <th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
                <th class="topleft"></th>
                <td id="tbl-border-top">&nbsp;</td>
                <th class="topright"></th>
                <th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
            </tr>
            <tr>
                <td id="tbl-border-left"></td>
                <td>
                <!--  start content-table-inner -->
                    <div id="content-table-inner">
	
                        <table border="0" width="100%" cellpadding="0" cellspacing="0">
                            <tr valign="top">
                                <td>
                                    <div id="message-yellow">
                                        <table border="0" width="100%" cellpadding="0" cellspacing="0">
                                            <div id="scroll">
    
<div class="loader">
    <span></span>
    <span></span>
    <span></span>
</div>                                                 
                                            </div>      
                                                    
                                                </div>                                                  
                                            </div>
                                        </table>
                                    </div>
                                </td>        
                            </tr>
                            <tr>
                                <td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
                            </tr>
                        </table>
                        <div class="clear"></div>
                    </div>
                </td>
                <td id="tbl-border-right"></td>
            </tr>
            <tr>
                <th class="sized bottomleft"></th>
                <td id="tbl-border-bottom">&nbsp;</td>
                <th class="sized bottomright"></th>
            </tr>
        </table>
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