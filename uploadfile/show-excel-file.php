<html>
  <head> 
  <title>Read Excel file</title>
  </head>
  <body>
	<?php
    echo $filename;    
		require_once 'uploadfile/reader.php';
    	$excel = new Spreadsheet_Excel_Reader();
                
	?>
	Sheet 1:<br/><br/>
    <table  border="1">
		<?php
        $excel->read($filename); // set the excel file name here   
        $x=1;
        while($x<=$excel->sheets[0]['numRows']) { // reading row by row 
          echo "\t<tr>\n";
          $y=1;
          while($y<=$excel->sheets[0]['numCols']) {// reading column by column 
            $cell = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
            echo "\t\t<td>$cell</td>\n";  // get each cells values
            $y++;
          }  
          echo "\t</tr>\n";
          $x++;
        }
        ?>    
    </table><br/>
    
    
   
	
  </body>
</html>
