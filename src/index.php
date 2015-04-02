<?php
    $title = "SPDX";
    include("function/_header.php");
    include("function/spdx_doc.php");
    $name = "";

    if(array_key_exists('document_name',$_POST)) {
    	$name = $_POST['document_name'];
    }
?>
			
<div class="container" >

  <div class="col-xs-12 blue-bord" style="height: 50px">
    <p>Search bar need to go here</p> 
  </div>
  <div class="col-xs-12 blue-bord">
    
    <h4 class="search-header"> <!-- id="moreOptions"  -->Advanced Search</h4>
  </div>

  <div class="col-xs-12 col-md-6 red-bord">
    
    <div><strong>Identifier</strong></div>
    <div id="identifier">Identifier</div> 
    
    <select class="LicenseListDropDown" name="charset">
      <option value="(license identifier)" selected="selected">license name</option>
      <?php
      $resultlist = getSPDX_LicenseList();
        while($row = mysql_fetch_assoc($resultlist)) {
          echo '<option value="' . $row['license_identifier'] . '">';
          echo         $row['license_fullname'];
          echo '</option>';
         }
      ?>
    </select>                
  </div>

  <div class="col-xs-12 col-md-6  red-bord">
    <form>
      <h5>Licences</h5>
      <!-- <label for="uri-charset"><strong>Licences</strong></label> -->

      <input id="" name="outline" type="checkbox" value="1" />
      <label title="SPDX approved" for="">SPDX approved</label>

      <input id="" name="No200" type="checkbox" value="1" />
      <label title="SPDX Not Approved" for="">SPDX Not Approved</label>

      <input id="uri-verbose2" name="" type="checkbox" value="1" />
      <label title="Not in SPDX list" for="">Not in SPDX list</label>
    </form>
  </div>
 
</div>

<div class="container">
  <div class="col-xs-12">  
    
  </div>
</div>
        
<div class="container">
 	<div class="col-xs-12">	 
       
    <table id="mytablesorter" class="table display">
        <thead> 
          <tr>
            <th>#</th>
            <th>Document Name</th>
            <th>Created on</th>
            <!-- <th>Last updated</th> -->
            <th>Licences</th>
            <th>Action</th>
          </tr>
        </thead>
  
        <tbody>
        <?php
          
          $count = 0;
		      $result = getSPDX_DocList($name);
		
          while($row = mysql_fetch_assoc($result)) {
            echo '<tr>';
	          echo     '<td>';
            echo        '<p>';++$count;'</p>';
            echo     '</td>';
            echo     '<td>';
            echo         '<a href="spdx_doc.php?doc_id=' . $row['spdx_pk'] . '">' . $row['document_name'] . '</a>';
            echo     '</td>';
            echo     '<td>';
            echo         date('m/d/Y', strtotime($row['created_date'])); 
            echo     '</td>';
            echo     '<td>';
            echo         '<img src="../src/images/flags.jpg" width="83" height="26" />';
            echo     '</td>';
            echo     '<td>';
            echo         '<div>';
            echo             '<button type="button" class="btn" onclick="window.location=\'spdx_doc.php?doc_id=' . $row['spdx_pk'] . '\'">View Details</button>';
            echo             '<button type="button" class="btn">Download</button>'; 
            echo         '</div>';
            echo     '</td>';
            echo '</tr>';
            ++$count;
          }

        ?>
        </tbody>
    </table>


  </div>     
</div>
 

<?php include("function/_footer.php"); ?>

<script>
	// $("#toggleTable").hide();
	// $(document).ready(function(){
	// 	$("#moreOptions").click(function(){
	// 		$("#toggleTable").toggle();
	// 	});

	// });
	

  $( ".LicenseListDropDown" )
    .change(function () {
      var str = "";
      $( "select option:selected" ).each(function() {
        str += $( this ).val() + " ";
      });
      $( "#identifier" ).text( str );
    }).change();

  function myFunction() {
      var x = document.getElementById("myBtn").value;
      document.getElementById("demo").innerHTML = x;
  }
</script>