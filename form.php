<?php 
if(!isset($_GET['searchbox']))
	header('location: index.html');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>BINGO - Search Engine</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="AdminLTE/css/AdminLTE.min.css">
  <link rel="stylesheet" href="AdminLTE/css/skins/_all-skins.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/jquery-ui.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>
  <script src="AdminLTE/js/app.js"></script>
<style>
  body {
  /* Margin bottom by footer height */
  margin-bottom: 60px;
}
.footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  background-color: #f5f5f5;
}
</style>
</head>
<body>
	<div class="row">
	<div class="col-sm-10 col-sm-offset-1" style="padding-top: 3%; padding-bottom: 2%">
        <div class="panel panel-danger">
        	<ul class="nav nav-tabs">
              <li class="col-sm-4"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><center><h4><b>Intranet</b></h4></center></a></li>
              <li class="col-sm-4 "><a href="#tab_2" data-toggle="tab" aria-expanded="false"><center><h4><b>Images</b></h4></center></a></li>
              <li class="active col-sm-4"><a href="#tab_3" data-toggle="tab" aria-expanded="false"><center><h4><b>Forms</b></h4></center></a></li>
            </ul>
          	<div class="tab-content">
            <div class="tab-pane" id="tab_1">
	            <div class="panel-title">
	              <center><a href="index.html">
	              	<img src="bingo.png" style="height: 100px; width: 300px"/></a></center><br>
	              <form class="form-horizontal" role="form" method="get" action="ab.php">
	                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-1">
                          <div class="col-sm-10">
                            <input id="intranet" type="text" class="form-control" name="searchbox" required></div>
                           <div class="col-sm-1"><a data-toggle="tooltip" data-placement="bottom" title="Play">
                             <button id="button-play-ws" type="button" class="btn btn-sm btn-success"><i class="fa fa-fw fa-microphone"></i></button></a></div>
                             <div class="col-sm-1"><a data-toggle="tooltip" data-placement="bottom" title="Stop">
                             <button id="button-stop-ws" type="button" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-microphone-slash"></i></button></a></div>
                            
                            
                              <script>
        // Test browser support
        window.SpeechRecognition = window.SpeechRecognition       ||
                                   window.webkitSpeechRecognition ||
                                   null;

        if (window.SpeechRecognition === null) {
          document.getElementById('ws-unsupported').classList.remove('hidden');
          document.getElementById('button-play-ws').setAttribute('disabled', 'disabled');
          document.getElementById('button-stop-ws').setAttribute('disabled', 'disabled');
        } else {
          var recognizer = new window.SpeechRecognition();
          var transcription = document.getElementById('intranet');
          var log = document.getElementById('log');

          // Recogniser doesn't stop listening even if the user pauses
          recognizer.continuous = true;

          // Start recognising
          recognizer.onresult = function(event) {
            transcription.value = '';

            for (var i = event.resultIndex; i < event.results.length; i++) {
              if (event.results[i].isFinal) {
                transcription.value = event.results[i][0].transcript;
              } else {
                transcription.value += event.results[i][0].transcript;
              }
            }
          };

          // Listen for errors
          recognizer.onerror = function(event) {
            log.innerHTML = 'Recognition error: ' + event.message + '<br />' + log.innerHTML;
          };

          document.getElementById('button-play-ws').addEventListener('click', function() {
            // Set if we need interim results
            recognizer.interimResults = true;


            try {
              recognizer.start();
              log.innerHTML = 'Recognition started' + '<br />' + log.innerHTML;
            } catch(ex) {
              log.innerHTML = 'Recognition error: ' + ex.message + '<br />' + log.innerHTML;
            }
          });

          document.getElementById('button-stop-ws').addEventListener('click', function() {
            recognizer.stop();
            log.innerHTML = 'Recognition stopped' + '<br />' + log.innerHTML;
          });

          document.getElementById('clear-all').addEventListener('click', function() {
            transcription.value = '';
            log.value = '';
          });
        }
      </script>
                      <input type="hidden" name="startrow" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <center><button type="submit" name="search" class="btn btn-lg btn-default"><i class="fa fa-fw fa-search"></i>&nbspSearch Bingo</button>&nbsp&nbsp
                              <button type="submit" name="lucky" class="btn btn-lg btn-default"><i class="fa fa-fw fa-hand-peace-o"></i>&nbsp I'm feeling lucky</button></center>
                        </div>
                    </div>
                     <center><h3><b>NOTE:</b> The Voice search feature only works in Chrome!!!</h3></center>
	                </form>
	            </div>
	               
	        </div>
	         <div class="tab-pane" id="tab_2">
	            <div class="panel-title">
	              <center><a href="index.html">
	              	<img src="bingo.png" style="height: 100px; width: 300px"/></a></center>
	              	</div>
            <div class="panel-body">
	              <form class="form-horizontal" role="form" method="get" action="a.php">
	                    <div class="form-group">
	                        <div class="col-sm-8 col-sm-offset-2">
	                            <input type="text" class="form-control" name="searchbox" required>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <div class="col-sm-offset-3 col-sm-6">
	                            <center><button type="submit" name="search" class="btn btn-lg btn-default">
	                            <i class="fa fa-fw fa-search"></i>&nbspSearch Images</button>
	                        	</center>
	                        </div>
	                    </div>
	                </form>
	            </div>
	            </div>
	        <div class="tab-pane active" id="tab_3">
                <div class="panel-title">
              <center><a href="index.html">
	              	<img src="bingo.png" style="height: 100px; width: 300px"/></a></center>
            </div>
                <form class="form-horizontal" role="form" method="get" action="form.php">
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <input type="text" class="form-control" name="searchbox" required>
                            <input type="hidden" name="startrow" value="0">
                            <center><h3>
                            <label class="checkbox-inline"><input type="checkbox" name="pdf" value=".pdf">pdf</label>
                            <label class="checkbox-inline"><input type="checkbox" name="doc" value=".doc">doc</label>
                            <label class="checkbox-inline"><input type="checkbox" name="exe" value=".exe">exe</label>
                            <label class="checkbox-inline"><input type="checkbox" name="zip" value=".zip">zip</label>
                            <label class="checkbox-inline"><input type="checkbox" name="iso" value=".iso">iso</label>
                            </h3></center>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <center><button type="submit" name="search" class="btn btn-lg btn-default"><i class="fa fa-fw fa-search"></i>&nbspSearch Forms</button>
                              </center>
                        </div>
                    </div>
                </form>
           <div class="panel-body">
			<?php 
			$data = array('search'=>$_GET['searchbox']);
			$query = $_GET['searchbox'];
			$startrow = (int)$_GET['startrow'];
			// Execute the python script with the JSON data
			exec('/var/www/html/search/search_doc.py ' . escapeshellarg(json_encode($data)) , $output);
			// exec('/var/www/html/search/search.py ' . escapeshellarg(json_encode($data)) , $output1);
			// var_dump($output);
			// echo $_GET['type'];
			$pdf="";
			$doc="";
			$exe="";
			$zip="";
			$iso="";
			if(isset($_GET['pdf']))
				$pdf=$_GET['pdf'];
			if(isset($_GET['doc']))
				$doc=$_GET['doc'];
			if(isset($_GET['exe']))
				$exe=$_GET['exe'];
			if(isset($_GET['zip']))
				$zip=$_GET['zip'];
			if(isset($_GET['iso']))
				$iso=$_GET['iso'];
			$str ="";
			if(!empty($_GET['pdf']))
				$str.='&pdf=.pdf';
			if(!empty($_GET['doc']))
				$str.='&doc=.doc';
			if(!empty($_GET['exe']))
				$str.='&exe=.exe';
			if(!empty($_GET['zip']))
				$str.='&zip=.zip';
			if(!empty($_GET['iso']))
				$str.='&iso=.iso';
			if(!empty($output)){
				// Decode the result
				$ext = json_decode($output[0], true);
				$path = json_decode($output[1], true);
				$correct = json_decode($output[2], true);
				// var_dump($correct);
				 	if(count($path)==0)
					{
						echo '<center><h3>Try searching for <a href="ab.php?startrow=0&searchbox='.htmlspecialchars($query, ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($query, ENT_QUOTES, 'UTF-8')."</a> in Intranet Section.</center>";
					}
				else{
						echo '<center><h3>For more results search for <a href="ab.php?startrow=0&searchbox='.htmlspecialchars($query, ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($query, ENT_QUOTES, 'UTF-8')."</a> in Intranet Section.</center>";
					if(count($correct))
					{
						?>
						<h3>Did u mean - <a href="<?php echo $_SERVER['PHP_SELF'].'?startrow=0'.$str.'&searchbox='.$correct['corr']; ?>">
							<i><b style="color: blue"><?php echo $correct['corr']; ?></b></i></a></h3>
						<h4>Showing results for <a href="<?php echo $_SERVER['PHP_SELF'].'?startrow=0'.$str.'&searchbox='.$correct['corr']; ?>">
							<i><b style="color: blue"><?php echo $correct['corr']; ?></b></i></a></h4>
						<?php
					}
					for($i=$startrow; $i < min($startrow+10,count($path)) ;$i++)
					{
						if(strtolower($ext[$i])!='.jpg'){
						if((!empty($pdf)&&$ext[$i]==$pdf)||(!empty($doc)&&($ext[$i]==$doc||$ext[$i]=='.docx'))||(!empty($exe)&&$ext[$i]==$exe)||(!empty($iso)&&$ext[$i]==$iso)||(!empty($zip)&&$ext[$i]==$zip))
						{
						?>
						<h3><a href="<?php echo $path[$i]; ?>"><?php echo $path[$i]; ?></a></h3>
						<?php
						}
						if(empty($pdf)&&empty($exe)&&empty($zip)&&empty($iso)&&empty($doc))
						{
							?>
						<h3><a href="<?php echo $path[$i]; ?>"><?php echo $path[$i]; ?></a></h3>
						<?php
						}
					}
					}
					
				}
			}
			else
			{
				?>
				<h3>No output found!</h3>
				<?php
			}
			
			?><br><center><button type="button" class="btn btn-lg btn-default">
			<a href="<?php echo $_SERVER['PHP_SELF'].'?searchbox='.$query.$str.'&startrow='.($startrow-10); ?>">Previous</a></button>
			&nbsp&nbsp&nbsp&nbsp&nbsp
			<button type="button" class="btn btn-lg btn-default">
			<a href="<?php echo $_SERVER['PHP_SELF'].'?searchbox='.$query.$str.'&startrow='.($startrow+10); ?>">Next</a></button>
			</center>
			</div>
            </div>
	    	</div>
        </div>
    </div>
</div>
<footer class="footer">
      <div class="container">
        <center><h4 class="text-muted" style="color: black"><b>Developed by: &nbsp&nbsp&nbsp</b> <a href="https://www.facebook.com/abhiyadav1323">Abhishek Yadav</a>, <a href="https://www.facebook.com/vistaar.juneja?fref=ts">Vistaar Juneja</a>, <a href="https://www.facebook.com/tyagironaldo9?fref=ts">
Abhishek Tyagi</a></h4></center>
<div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <b>Copyright © 2016 <a href="https://www.facebook.com/abhiyadav1323">Abhishek Yadav</a>, <a href="https://www.facebook.com/vistaar.juneja?fref=ts">Vistaar Juneja</a>, <a href="https://www.facebook.com/tyagironaldo9?fref=ts">
Abhishek Tyagi</a>.</b> All rights reserved.
      </div>
    </footer>
</body>
</html>