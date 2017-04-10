<?php

require_once('../includes/config.php');
include('session.php');

if(isset($_GET['delpost'])){ 

	$stmt = $db->prepare('DELETE FROM blog_posts WHERE postID = :postID') ;
	$stmt->execute(array(':postID' => $_GET['delpost']));

	header('Location: index.php?action=deleted');
	exit;
} 

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin</title>
  <link rel="stylesheet" href="../style/main.css">
  <script language="JavaScript" type="text/javascript">
  function delpost(id, title)
  {
	  if (confirm("Are you sure you want to delete '" + title + "'"))
	  {
		window.location.href = 'index.php?delpost=' + id;
	  }
  }
  </script>
</head>
<body>

	<div id="wrapper">

	<h1>Admin</h1>
	<ul id='adminmenu'>
	<li><a href='index.php'>Blog</a></li>
	<li><a href="../" target="_blank">View Website</a></li>
	<li><a href='logout.php'>Logout</a></li>
	</ul>
	<div class='clear'></div>
	<hr />
	<?php 
	//show message from add / edit page
	if(isset($_GET['action'])){ 
		echo '<h3>Post '.$_GET['action'].'.</h3>'; 
	} 
	?>

	<table>
	<tr>
		<th>Title</th>
		<th>Date</th>
		<th>Action</th>
	</tr>
	<?php
		try {

			$datas = $db->query('SELECT postID, postTitle, postDate FROM blog_posts ORDER BY postID DESC')->fetchAll();

			foreach($datas as $data)
			{
				echo '<tr>';
				echo '<td>'.$data['postTitle'].'</td>';
				echo '<td>'.date('jS M Y', strtotime($data['postDate'])).'</td>';
				?>

				<td>
					<a href="edit-post.php?id=<?php echo $data['postID'];?>">Edit</a> | 
					<a href="javascript:delpost('<?php echo $data['postID'];?>','<?php echo $data['postTitle'];?>')">Delete</a>
				</td>
				
				<?php 
				echo '</tr>';
			}

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	?>
	</table>

	<p><a href='add-post.php'>Add Post</a></p>

</div>

</body>
</html>
