<div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
					
				
<?php
include 'includes/connect.php';
include 'header.php';

if(isset($_GET['person'])){
	$person=$_GET['person'];
	$user=$_SESSION['userid'];
	$sended=array();
	
	echo '<div class="page-header">
									<h1>Berichten van
									
									' . resolveuser($person) . '
									<h1></div>'; 

	
	$allmsg=mysqli_query($con,"SELECT message FROM mail WHERE user='$person' and touser='$user' or user='$user' and touser='$person' and datesend < NOW() ORDER BY datesend ASC ");
	$recievedmsg=mysqli_query($con,"SELECT message FROM mail WHERE user='$person' and touser='$user' OR user='$user' and touser ='$person' and datesend < NOW() ORDER BY datesend DESC  " );
	$sendedmsg=mysqli_query($con,"SELECT message FROM mail WHERE touser='$person' and user='$user'  and datesend < NOW() ORDER BY datesend DESC ");
	
	while($row=mysqli_fetch_array($sendedmsg)){
		array_push($sended,$row['message']);
	}
	echo '<div class=well> ';	
	while($row=mysqli_fetch_array($allmsg)){
		
		
		if(in_array($row['message'],$sended)){
			echo '<div class ="chatboxsended">' . $row['message'] .'<br> </div>';
		}
		else{
			echo $row['message'] . "<br>"  ;
		}
		
		
	}
	echo '</div>';
	echo ' 
	<div class="well">
	
                    <h4>Bericht vesturen</h4>
                    <form action="sendmail.php" method="post">
                        <div class="form-group">
                            <textarea name="bericht" colin="3" class="form-control"></textarea>
							<input type="hidden" name="person" value="' . $person . '">
                        </div>
                        <button onclick="sendmessage()" id="sendbutton" class="btn btn-primary">Verzenden</button>
                                            <!-- Button trigger modal -->
                                            


						<!-- Single button -->
						<div class="btn-group">
						  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							+ 
						  </button>
						  <ul class="dropdown-menu" role="menu">
							<li>
							<a href="#" data-target="#myModal" data-toggle="modal">
								<i class="fa fa-youtube"></i> YouTube
							</a> 
							</li>
							<li><a href="#" data-target="#imagemodal" data-toggle="modal"><i class="fa fa-picture-o"></i> Foto</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
						  </ul>
						</div>


						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel"> <i class="fa fa-youtube"></i> YouTube video invoegen</h4>
							  </div>
							  <div class="modal-body">
								<form action="includes/post.php" method="POST">
									<input class="form-control" id="video" autocomplete="off" onchange="check();" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();" placeholder="Youtube URL" type="text" style="width: 100%;" name="video">
									<hr><iframe id="youtubevideo" width="560" height="315" src="//www.youtube.com/embed/" frameborder="0" allowfullscreen=""></iframe>
								<input type="hidden" id="videoid" name="videoid">
							  </form></div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
								<button type="submit" class="btn btn-primary">Invoegen</button>
								
      </div>
    </div>
  </div>
</div>
</form>
                </div>
 	
	'; 
}

?>