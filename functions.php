<?php
function print_page_navi($num_records)
{
				//$num_records;	#holds total number of record
				$page_size;		#holds how many items per page
				$page;			#holds the curent page index
				$num_pages; 	#holds the total number of pages
				$page_size = 15;
				#get the page index
				if (empty($_GET[npage]) || !is_numeric($_GET[npage]))
				{$page = 1;}
				else
				{$page = $_GET[npage];}
				
				#caluculate number of pages to display
				if(($num_records%$page_size))
				{
					$num_pages = (floor($num_records/$page_size) + 1);
				}else{
					$num_pages = (floor($num_records/$page_size));
				}
		
				if ($num_pages != 1)
				{
					for ($i = 1; $i <= $num_pages; ++$i)
					{
						#if page is the same as the page being written to screen, don't write the link
						#page navigation logic is developed by "oneTarek" http://onetarek.com
						if ($i == $page)
						{
							echo "$i";	
						}
						else
						{
							echo "<a href=\"media-upload.php?type=upload&tab=quiz&npage=$i\">$i</a>";
			
						}
						if($i != $num_pages)
						{
							echo " | ";
						}
					}
				}
		
				#calculate boundaries for limit query
				$upper_bound = (($page_size * ($page-1)) + $page_size);/*$page_size;*/
				$lower_bound = ($page_size * ($page-1));
				$bound=array($lower_bound,$upper_bound,);
				return $bound;
		
}



function print_detail_form($num, $tab="upload", $file_url="", $dirname="")
{?>
	<div id="upload_detail_<?php echo $num ?>" style="display:none; margin-bottom:30px; margin-top:20px;">
		<input type="hidden" size="40" name="file_url_<?php echo $num ?>" id="file_url_<?php echo $num ?>" value="<?php echo $file_url ?>" />
		<input type="hidden" size="40" name="dir_name_<?php echo $num ?>" id="dir_name_<?php echo $num ?>" value="<?php echo $dirname ?>" />
		<?php if($tab=='upload'){ ?>
		<input type="hidden" id="file_name_<?php echo $num ?>" id="file_name_<?php echo $num ?>" value="" size="20" />
		<br /><label for="title"><strong>Title:</strong></label> <input type="text" size="20" name="title" id="title" value="" /><br /><br />
		<?php }?>		
		<strong>Insert As:</strong><br />

		<input type="radio" name="insert_as_<?php echo $num ?>" value="1" checked="checked" onclick="insert_as_clicked(<?php echo $num ?>)" /> iFrame<br />
		<input type="radio" name="insert_as_<?php echo $num ?>" value="2"  onclick="insert_as_clicked(<?php echo $num ?>)" /> Lightbox<br />
		<input type="radio" name="insert_as_<?php echo $num ?>" value="3"  onclick="insert_as_clicked(<?php echo $num ?>)" /> Link that opens in a new window<br />
		<input type="radio" name="insert_as_<?php echo $num ?>" value="4"  onclick="insert_as_clicked(<?php echo $num ?>)" /> Link that opens in the same window<br />
		<br />
		<div id="lightbox_option_box_<?php echo $num ?>" style="display:none">
			<strong>Lightbox options:</strong><br />
			<input type="radio" name="lightbox_option_<?php echo $num ?>" value="1" onclick="lightbox_option_clicked(<?php echo $num ?>)" /> With Title <input type="text"  name="lightbox_title_<?php echo $num ?>" id="lightbox_title_<?php echo $num ?>" size="30" style="display:none;" /><br />
			<input type="radio" name="lightbox_option_<?php echo $num ?>" value="2"  checked="checked"  onclick="lightbox_option_clicked(<?php echo $num ?>)" /> No Title<br />
			<br />
			<strong>More Lightbox options:</strong><br />
			<input type="radio" name="more_lightbox_option_<?php echo $num ?>" value="1"  onclick="more_lightbox_option_clicked(<?php echo $num ?>)"/> Link Text <input type="text"  name="lightbox_link_text_<?php echo $num ?>" id="lightbox_link_text_<?php echo $num ?>" size="30" style="display:none;" /><br />
			<input type="radio" name="more_lightbox_option_<?php echo $num ?>" value="2"  checked="checked"   onclick="more_lightbox_option_clicked(<?php echo $num ?>)"/> Use 'Launch Presentation' button<br />
		</div>
	
		<div id="new_window_option_box_<?php echo $num ?>" style="display:none">
		<strong>Link that opens in a new window options:</strong><br />
		<input type="radio" name="open_new_window_option_<?php echo $num ?>" value="1" onclick="open_new_window_option_clicked(<?php echo $num ?>)" /> Link Text <input type="text"  name="open_new_window_link_text_<?php echo $num ?>" id="open_new_window_link_text_<?php echo $num ?>" size="30"  style="display:none;"/><br />
		<input type="radio" name="open_new_window_option_<?php echo $num ?>" value="2"  checked="checked"  onclick="open_new_window_option_clicked(<?php echo $num ?>)" /> Use 'Launch Presentation' button<br />
		</div>
		<div id="same_window_option_box_<?php echo $num ?>" style="display:none">
		<strong>Link that opens in  same window options:</strong><br />
		<input type="radio" name="open_same_window_option_<?php echo $num ?>" value="1" onclick="open_same_window_option_clicked(<?php echo $num ?>)" /> Link Text <input type="text"  name="open_same_window_link_text_<?php echo $num ?>" id="open_same_window_link_text_<?php echo $num ?>" size="30" style="display:none;" /><br />
		<input type="radio" name="open_same_window_option_<?php echo $num ?>" value="2"  checked="checked" onclick="open_same_window_option_clicked(<?php echo $num ?>)" /> Use 'Launch Presentation' button<br />
		</div>
		<br /><br />
		<div>
		<input type="button" class="button" name="insert_<?php echo $num ?>" id="insert_<?php echo $num ?>" value="Insert Into Post" onclick="add_to_post(<?php echo $num ?>)" /> 
			<span id="delete_<?php echo $num ?>" onclick="delete_dir(<?php echo $num ?>)"  style="text-decoration:underline; cursor:pointer; color:#0000FF; margin-left:20px;" />Delete</span> &nbsp; &nbsp;
			<span id="insert_msg_<?php echo $num ?>"></span>
			
		</div>
	</div>
<?php
}#end print_detail_form()




function printInsertForm()
{
//echo "<h3>Start printInsertForm</h3>";
	$dirs = getDirs();
	if (count($dirs)>0)
	{
	print_js("quiz");
	?>
	<title>Media Library</title>
	<?php
	 $uploadDirUrl=getUploadsUrl();
	 //START PAGIGNATION
	 ?>
	 <div style="text-align:right; padding:5px; padding-right:10px; margin:5px 20px;"> 
	 <?php  $bound= print_page_navi(count($dirs)); // print the pagignation and return upper and lower bound ?>
	 </div>
	 <?php
	 
	  $lower_bound=$bound[0];
	  $upper_bound=$bound[1]; 
	  echo '<div style="text-align:right; margin:5px 20px;padding-right:10px;">Showing Content '.$lower_bound.' - '.$upper_bound.' of '.count($dirs);echo '</div>';
	  //$dirs = array_slice($dirs, $lower_bound, $upper_bound);
	  $dirs = array_slice($dirs, $lower_bound, 15);
	  //END PAGIGNATION
	 	
		echo "<table class='widefat'>";
			foreach ($dirs as $i=>$dir):
				extract($dir);
				$dir1 = str_replace("_"," " ,$dir);


				echo '<tr id="content_item_'.$i.'" class="'; if ($i % 2 == 1)echo 'alternate '; echo 'iedit">
						<td>
						<div>';
						echo $dir1;
						echo '<span style="float:right">';
						echo '<span id="show_button_'.$i.'" flag="1" onclick="show_hide_detail( '.$i.' )" style="text-decoration:underline; color:#000099; cursor:pointer;">Show</span> | ';
						echo '<span id="delete_button_'.$i.'"  onclick="delete_dir( '.$i.' )" style="text-decoration:underline; color:#990000; cursor:pointer;">Delete</span>';
						echo '<span id="loading_box_'.$i.'"></span>';
						echo '</span>';
						echo '</div>';
						print_detail_form($i, "quiz" , $uploadDirUrl.$dir."/".$file, $dir);
						echo '
						</td>
					 </tr>';

			endforeach;
		echo "</table>";
	
	}
	else
	{
	echo "no directories available";
	}
//echo "<h3>End printInsertForm</h3>";	
}

function getUploadsPath()
{
$dir = wp_upload_dir();
return ($dir['basedir'] . "/articulate_uploads/");
}
function getUploadsUrl()
{
$dir = wp_upload_dir();
return $dir['baseurl'] . "/articulate_uploads/";
}
function getPluginUrl()
{
return WP_PLUGIN_URL."/insert-or-embed-articulate-content-into-wordpress/";
}
function getDirs()
{
$myDirectory = opendir(getUploadsPath());
$dirArray = array();
$i=0;
// get each entry
while($entryName = readdir($myDirectory)) {
	if ($entryName != "." && $entryName !=".." && is_dir(getUploadsPath().$entryName)):
	$dirArray[$i]['dir'] = $entryName;
	// store the filenames - need to iterate to get story.html or player.html
	$dirArray[$i]['file'] = getFile(getUploadsPath().$entryName);
	$i++;
	endif;
}

// close directory
closedir($myDirectory);

return $dirArray;
}

function getFile($dir)
{
$myDirectory = opendir($dir);
$fileArray = array();
// get each entry
while($entryName = readdir($myDirectory)) {
	if ($entryName != "." && $entryName !="..")
	{
	$f = getUploadsPath().$entryName;
	
	// need to get the filename without the extension
	$fname = pathinfo ($f, PATHINFO_FILENAME);
	// need the extension as well
	$ext = pathinfo ($f,PATHINFO_EXTENSION);
	
	// need to check the filename and only return player.html or story.html
	if (($fname == "player" || $fname == "story" || $fname == "engage" || $fname =="quiz" || $fname =="index") && $ext == "html"):
	closedir($myDirectory);
	return $entryName;
	endif;
	}
}
return false;


}

function print_js($tab="upload") #added by oneTarek
{
wp_enqueue_script("jquery");
?>
<script src="<?php echo getPluginUrl()."jquery.form.js";?>" ></script>
<script>
jQuery(document).ready(function() { 

			jQuery("#media_loading").hide();
			
            jQuery('#myForm1').ajaxForm(
			{
			success : function(data) { 
				data = eval('(' + data + ')');
              if (data[0] == "uploaded")
			  {
				dir = data[1];
				var uploaded_dir_neme=data[2];
				var win = window.dialogArguments || opener || parent || top; 
				jQuery("#file_url_1").val(dir);
				jQuery("#dir_name_1").val(uploaded_dir_neme);
				jQuery("#file_name_1").val(data[3]);
				<?php if($tab=="upload"){?>
				var regex = new RegExp('_', 'g');
				jQuery("#title").val(uploaded_dir_neme.replace(regex," "));
				<?php }?>
				show_detail(1);
				//win.send_to_editor("[iframe_loader width='100%' height='600' frameborder='0' src='"+dir+"']");
				//win.send_to_editor('<a class="colorbox_iframe" href="'+dir+'">Colorbox (Iframe)</a>');
				jQuery("#media_loading").hide();
			  }else{
			  jQuery("#media_loading").hide();
			  alert(data);
			  }
			  
            },
			beforeSubmit: function()
			{
			jQuery("#media_loading").show();
			}
			
			});  
});

function show_detail(number)
{
jQuery("#upload_detail_"+number+"").show('slow');
}

function show_hide_detail(number)
{
var flag=jQuery("#show_button_"+number+"").attr("flag");
	if(flag=="1")
	{
	jQuery("#show_button_"+number+"").attr("flag", "2");
	jQuery("#show_button_"+number+"").html("Hide");
	jQuery("#upload_detail_"+number+"").show('slow');
	}
	else
	{
	jQuery("#show_button_"+number+"").attr("flag", "1");
	jQuery("#show_button_"+number+"").html("Show");
	jQuery("#upload_detail_"+number+"").hide('slow');
	
	}

}


function show_box(box, number)
{
jQuery("#"+box+"_"+number+"").show('slow');
}

function hide_box(box, number)
{
jQuery("#"+box+"_"+number+"").hide();
}

function insert_as_clicked(number)
{
var insert_as= parseInt(jQuery('input[name=insert_as_'+number+']:checked').val());
switch(insert_as)
	{
	 case 1:
	  {
	  hide_box("lightbox_option_box", number);
	  hide_box("new_window_option_box", number);
	  hide_box("same_window_option_box", number);
	  break;
	  }
	 case 2:
	  {
	  show_box("lightbox_option_box", number);
	  hide_box("new_window_option_box", number);
	  hide_box("same_window_option_box", number);
	  break;
	  }
	 case 3:
	  {
	  hide_box("lightbox_option_box", number);
	  show_box("new_window_option_box", number);
	  hide_box("same_window_option_box", number);
	  break;
	  }
	 case 4:
	  {
	  hide_box("lightbox_option_box", number);
	  hide_box("new_window_option_box", number);
	  show_box("same_window_option_box", number);
	  break;
	  }	  
	}// end switch
}

function lightbox_option_clicked(number)
{
var lightbox_option= parseInt(jQuery('input[name=lightbox_option_'+number+']:checked').val());
	switch(lightbox_option)
	{
	  case 1:
	  {
	  show_box("lightbox_title", number);
	  break;
	  }
	  case 2:
	  {
	  hide_box("lightbox_title", number);
	  break;
	  }
	}

}

function more_lightbox_option_clicked(number)
{
var more_lightbox_option= parseInt(jQuery('input[name=more_lightbox_option_'+number+']:checked').val());
	switch(more_lightbox_option)
	{
	  case 1:
	  {
	  show_box("lightbox_link_text", number);
	  break;
	  }
	  case 2:
	  {
	  hide_box("lightbox_link_text", number);
	  break;
	  }
	}
}

function open_new_window_option_clicked(number)
{
var open_new_window_option= parseInt(jQuery('input[name=open_new_window_option_'+number+']:checked').val());
	switch(open_new_window_option)
	{
	  case 1:
	  {
	  show_box("open_new_window_link_text", number);
	  break;
	  }
	  case 2:
	  {
	  hide_box("open_new_window_link_text", number);
	  break;
	  }
	}

}

function open_same_window_option_clicked(number)
{
var open_same_window_option= parseInt(jQuery('input[name=open_same_window_option_'+number+']:checked').val());
	switch(open_same_window_option)
	{
	  case 1:
	  {
	  show_box("open_same_window_link_text", number);
	  break;
	  }
	  case 2:
	  {
	  hide_box("open_same_window_link_text", number);
	  break;
	  }
	}

}

function add_to_post(number)
{
	<?php if($tab=="upload"){?>
	  //rename action will fired.
	  var old_name=jQuery("#dir_name_1").val();
	  var regex = new RegExp('_', 'g');
	  var temp=old_name.replace(regex," ");
	  var new_name=jQuery.trim(jQuery("#title").val());
	  if(new_name!="" && new_name!=temp)
	  {
	  rename_dir(old_name, new_name);
	  }
	  else
	  {
	  insert_into_post(number);
	  }
	<?php }else{?>insert_into_post(number);<?php }?>
	


}


function insert_into_post(number)
{


var link_text='<img src="<?php echo WP_QUIZ_EMBEDER_PLUGIN_URL;?>launch_presentation.gif" alt="Launch Presentation" />';
var uploaded_file_url=jQuery("#file_url_"+number+"").val();
if(uploaded_file_url==""){alert("Please Upload A Zip File"); return;}
var win = window.dialogArguments || opener || parent || top; 
var insert_as= parseInt(jQuery('input[name=insert_as_'+number+']:checked').val());
//alert(insert_as);

	switch(insert_as)
	{
	 case 1:
	  {
	  //alert("iFrame");
	  win.send_to_editor("[iframe_loader width='100%' height='600' frameborder='0' src='"+uploaded_file_url+"']");
	  break;
	  }
	 case 2:
	  {
	  //alert("Lightbox");
	  	var more_lightbox_option= parseInt(jQuery('input[name=more_lightbox_option_'+number+']:checked').val());
		//var link_text="";
			if(more_lightbox_option==1)
			{
			  link_text=jQuery('#lightbox_link_text_'+number+'').val();
			}
			else
			{
			//link_text="Launch Presentation button";
			}
		var lightbox_option= parseInt(jQuery('input[name=lightbox_option_'+number+']:checked').val());
			if(lightbox_option==1)
			{
			var lightbox_title= jQuery('#lightbox_title_'+number+'').val();
			win.send_to_editor('<a class="colorbox_iframe" title="'+lightbox_title+'" href="'+uploaded_file_url+'">'+link_text+'</a>');
			}
			else
			{
			win.send_to_editor('<a class="colorbox_iframe" href="'+uploaded_file_url+'">'+link_text+'</a>');
			}
	  break;
	  }
	 case 3:
	  {
	  	//alert("Link that opens in a new window");
	  	var open_new_window_option= parseInt(jQuery('input[name=open_new_window_option_'+number+']:checked').val());
		//var link_text="";
			if(open_new_window_option==1)
			{
			  link_text=jQuery('#open_new_window_link_text_'+number+'').val();
			}
			else
			{
			//link_text="Launch Presentation button";
			}
	  	win.send_to_editor('<a target="_blank" href="'+uploaded_file_url+'">'+link_text+'</a>');
	  break;
	  }
	 case 4:
	  {
	 // alert("Link that opens in the same window");
	  	var open_same_window_link_text= parseInt(jQuery('input[name=open_same_window_link_text_'+number+']:checked').val());
		//var link_text="";
			if(open_same_window_link_text==1)
			{
			  link_text=jQuery('#open_same_window_link_text_'+number+'').val();
			}
			else
			{
			//link_text="Launch Presentation button";
			}
	  	win.send_to_editor('<a  href="'+uploaded_file_url+'">'+link_text+'</a>');
		
	  break;
	  }	  
	}


}// end insert_into_post()

function rename_dir(old_name, new_name)
{

var loading_text='<img src="<?php echo WP_QUIZ_EMBEDER_PLUGIN_URL;?>loading_16x16.gif" alt="Loading" /> Saving....';
	jQuery('#insert_msg_1').html(loading_text);	
		
			
			jQuery.getJSON("<?PHP bloginfo('url') ?>/wp-admin/admin-ajax.php?action=rename_dir&dir_name="+old_name+"&title="+new_name, function(data) {
			
				//alert(data[0]); 
				if(data[0]=="success")
				{
				 var new_renamed_dir_name=data[1];
				 var old_file_name = jQuery('#file_name_1').val();
				 jQuery('#file_url_1').val("<?php echo getUploadsUrl();?>"+new_renamed_dir_name+"/"+old_file_name);	
				 jQuery('#insert_msg_1').html("");
				 insert_into_post(1);
				}
				else
				{
				jQuery('#insert_msg_1').html("");
				alert(data[1])
				}
			});

}

function delete_dir(number)
{

	var dir_name=jQuery("#dir_name_"+number+"").val();
	var loading_image='&nbsp;&nbsp;<img src="<?php echo WP_QUIZ_EMBEDER_PLUGIN_URL;?>loading_16x16.gif" alt="Launch Presentation" />&nbsp;Deleting..'
	var loading_text='<img src="<?php echo WP_QUIZ_EMBEDER_PLUGIN_URL;?>loading_16x16.gif" alt="Loading" /> Deleting....';
	
	
	if(dir_name!="")
	{			
		if (confirm("Are you sure?"))
		{
		jQuery("#delete_button_"+number+"").hide();
		jQuery("#loading_box_"+number+"").html(loading_image);
		jQuery("#insert_msg_"+number+"").html(loading_text);
		
		jQuery.post("admin-ajax.php",{dir : dir_name,action:'del_dir'},function(data){
			//alert("Deleted");
			<?php if($tab=="upload"){?>
			jQuery("#insert_msg_"+number+"").html("");
			jQuery("#upload_detail_"+number+"").remove();
			location.reload();
			<?php }else{?>
			jQuery("#content_item_"+number+"").remove();
			<?php }?>
				
			
			});
		}
	}else{alert("No Data Found To Delete");}
					
}// end delete_dir()	
		
</script>
<?php
}#end function print_js()

function print_upload()
{
// echo "<h3>Start print_upload</h3>";
print_js();
?>
<form enctype="multipart/form-data" id="myForm1" action="admin-ajax.php" method="POST">
<input type="hidden" name="action" value="quiz_upload" />
<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
<table style="margin-left:-15px;">
<tr><td>
<strong>Choose a file to upload:</strong></td><td> <input name="uploadedfile"  id="uploadedfile" type="file" /></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" value="Upload File" class="button" /></td></tr>
</table>
</form>
<p><i>Please choose a .zip file that you published with the Articulate software</i></p>
<img id="media_loading" style='display:none;' src= "<?php echo getPluginUrl() . "loading.gif" ;?>" /><br />
<?php print_detail_form(1);?>


<p><b>Need help?  See the screencast below:</b></p>
<iframe src="http://www.screenr.com/embed/E5D8" width="600" height="366" frameborder="0"></iframe>
<p/>
<p/>
<iframe src="http://www.articulatefreak.com/wordpresspluginlatest.html" width="600px" frameborder="0">
</iframe><p/>
<?php
 //echo "<h3>END print_upload</h3>";
}



function wp_ajax_del_dir()
{
$dir = getUploadsPath().$_POST['dir'];
rrmdir($dir);
die();
}


function wp_ajax_rename_dir()
{
$arr=array();
	if(isset($_REQUEST['dir_name']) && $_REQUEST['dir_name']!="")
	{
	$target = getUploadsPath().$_REQUEST['dir_name'];
		if(file_exists($target))
		{
			
			if(isset($_REQUEST['title']) && $_REQUEST['title']!="")
			{
			$title=trim($_REQUEST['title']);
				if($title)
				{   
					$title=str_replace(" ","_" , $title);
					$new_file=getUploadsPath().$title;
					while(file_exists($new_file))
					{
					$r = rand(1,10);
					$new_file .= $r;
					$title .= $r;
					}
					rename($target, $new_file);
					$arr[0]="success";
					$arr[1]=$title;
				}
				else
				{
				$arr[0]="error";
				$arr[1]="Failed: New Title Was Not Given";
				}
			}
			else
			{
			$arr[0]="error";
			$arr[1]="Failed: New Title Was Not Given";
			}
		}
		else
		{
		$arr[0]="error";
		$arr[1]="Failed: Given File is Not Exits";
		}
	}
	else
	{
	$arr[0]="error";
	$arr[1]="Failed: Targeted Directory Name Was Not Given";
	}
echo json_encode($arr);	
	
die();
}

function wp_ajax_quiz_upload()
{
 $arr = array();
$file = $_FILES['uploadedfile']['tmp_name'];
$dir = explode(".",$_FILES['uploadedfile']['name']);
$dir[0] = str_replace(" ","_",$dir[0]);
/*
$title=trim($_REQUEST['title']);
	if($title!="")
	{
	$dir[0] = str_replace(" ","_",$title);
	}
	else
	{
	$dir[0] = str_replace(" ","_",$dir[0]);
	}
*/	

$target = getUploadsPath().$dir[0];
$index = count($dir) -1;
if (!isset($dir[$index]) || $dir[$index] != "zip")
$arr[0] = "the file must be zip archive";
else{
while(file_exists($target))
{
$r = rand(1,10);
$target .= $r;
$dir[0] .= $r;
}
if (!empty($file))
$arr = extractZip($file,$target,$dir[0]);
else
$arr[0] ="file is too big";

}
echo json_encode($arr);
die();
}
function extractZip($fileName,$target,$dir)
{
		 $arr = array();
 $zip = new ZipArchive;
     $res = $zip->open($fileName);
     if ($res === TRUE) {
         $zip->extractTo($target);
         $zip->close();
		 $file = getFile($target);

		 $arr[0] = 'uploaded'; 
		 $arr[1] = getUploadsUrl().$dir."/".$file; 
		 $arr[2] = $dir;
		 $arr[3] =$file;
         
     } else {
		$arr[0] ="file upload failed";
      
     }
	 return  $arr;

}

function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
       }
     }
     reset($objects);
     rmdir($dir);
   }
 } 

/*-----added by oneTarek-----*/

function quiz_embeder_wp_head()
{?>
	<!--QUIZ_EMBEDER START-->
	<link rel="stylesheet" href="<?php echo WP_QUIZ_EMBEDER_PLUGIN_URL."colorbox/colorbox.css" ;?>" />
	<!--<script type="text/javascript" src="<?php ?>" ></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo WP_QUIZ_EMBEDER_PLUGIN_URL."colorbox/jquery.colorbox-min.js" ;?>" ></script>
	<script>
		$(document).ready(function(){
			//Examples of how to assign the ColorBox event to elements
			$(".colorbox_iframe").colorbox({iframe:true, width:"80%", height:"80%"});
		});
	</script>	
	<!--QUIZ_EMBEDER END-->
<?
}

?>