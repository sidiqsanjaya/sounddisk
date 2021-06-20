
      <div class="row">
        <?php
        $search = $_GET["search"];
        if(!isset($search)){
			    $data = mysqli_query($conn, "SELECT `t_music`.`id_music`, `t_music`.`name`, `t_music`.`artist`, `d_music`.`poster` FROM `t_music` LEFT JOIN `d_music` ON `d_music`.`id_music` = `t_music`.`id_music`");
        }else{
          $data = mysqli_query($conn, "SELECT t_music.id_music, t_music.name, t_music.artist, d_music.poster FROM t_music LEFT JOIN d_music ON d_music.id_music = t_music.id_music WHERE t_music.name LIKE '%$search%' OR t_music.artist LIKE '%$search%'");
        }
      while($hasil=mysqli_fetch_array($data)){
			?>
        <div class="col-md-0 p-4">
          <div class="card" style="width: 10rem;">          
            <img class="card-img-top" src="<?php echo $hasil['poster']; ?>" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><?php echo $hasil['name'];?></h5>
              <p class="card-title"><?php echo $hasil['artist'];?></p>            
              <button onclick="proses(this)" id="dataplay[<?php echo $ref = base64_encode($hasil['id_music']);?>]" value="<?php echo $ref = base64_encode($hasil['id_music']);?>" class="btn btn-primary">PLAY</button>
            </div>
          </div>
        </div>
        
          
		<?php } ?>
    	
      </div>
    </main>