<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
include 'config.php';
$id = base64_decode($_POST['id']);

$sql = mysqli_query($conn,"SELECT `t_music`.*, `d_music`.*
FROM `t_music` 
	LEFT JOIN `d_music` ON `d_music`.`id_music` = `t_music`.`id_music`
");


  ?>
  let player = new cplayer({
    element: document.getElementById('app'),
    autoplay: true,
    playlist: [
      <?php while($listdata = mysqli_fetch_array($sql)){?>
      {
        src: '<?php echo $listdata['src']; ?>',
        poster: '<?php echo $listdata['poster']; ?>',
        name: '<?php echo $listdata['name']; ?>',
        artist: '<?php echo $listdata['artist']; ?>',
      },
      <?php } ?>
    ]
  })
<?php
}
?>