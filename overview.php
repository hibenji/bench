<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Benchmarks" property="og:title">
    <meta content="Benchmarks and comparison of cloud game streaming providers" property="og:description">
    <meta content="https://bench.benji.live" property="og:url">
    <meta content="/assets/controller.png" property="og:image">
    <meta content="#5a43b5" data-react-helmet="true" name="theme-color">
   
    <title>Benchmarks of Game Streaming Providers</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/dark-min.css" />
    <!-- <link rel="stylesheet" type="text/css" href="assets/custom.css" /> -->

    <script async src="https://arc.io/widget.min.js#a24jhCmw"></script>


  </head>
  <body>

  <?php

  include('conn.php');


  $id = $_GET['id'];
  $type = $_GET['type'];

  if($type == "hourly") {
    $sql = "SELECT * FROM hourly WHERE id = $id";
  } else {
    $sql = "SELECT * FROM monthly WHERE id = $id";
  }

  $result = $conn->query($sql);


  ?>

  <section class="section">
    <div class="container">
      <h1 class="title">
        Benchmarks of Game Streaming Providers
      </h1>
	  <p class="subtitle is-6">
			<i><small>
			This feature is still being developved, expect issues.<br>
			Please contact me on discord if you find bugs.
			</small></i>
		</p>
	  <a href="/" class="button is-primary">Back</a>
	  <br>

			<br>
			<br>
		<?php
      if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		?>
		Link:
		<u><a href="<?php echo $row["link"] ?>"><h2 class='title is-3'><?php echo $row["name"]; ?></h2></a></u>
		<br>

		<h5 class='title is-6'>Personal opinion and extra info:</h5>
		<p class="subtitle is-5"><?php echo $row["description"]; ?></p>
		<hr>
		<div class="columns">
			<div class="column">
				Price:
				<br>
				<p class="content is-large"><strong><?php echo $row["price"]; ?>$</strong></p>
			</div>
			<div class="column">
				FPS:
				<br>
				<?php

				if($row["fps"] < 30) {
					echo "<span class='tag is-danger is-large'>";
				} else if($row["fps"] < 60) {
					echo "<span class='tag is-warning is-large'>";
				} else {
					echo "<span class='tag is-success is-large'>";
				}
				?>

				<p class="content is-large"><?php echo $row["fps"]; ?></p>
				</span>
			</div>
			<div class="column">
				RTX-FPS:
				<br>
				<?php

				if($row["rtx-fps"] < 30) {
					echo "<span class='tag is-danger is-large'>";
				} else if($row["rtx-fps"] < 60) {
					echo "<span class='tag is-warning is-large'>";
				} else {
					echo "<span class='tag is-success is-large'>";
				}
				?>

				<p class="content is-large"><?php echo $row["rtx-fps"]; ?></p>
				</span>
			</div>
			<div class="column">
			Locations:
			<br>
			<p class="content is-large"><?php echo $row["locations"]; ?></p>
			</div>
		</div>


		<br>
		<!-- second row -->
		<div class="columns">
			<div class="column">
				vCores:
				<br>
				<p class="content is-large"><strong><?php echo $row["vcores"]; ?></strong></p>
			</div>
			<div class="column">
				RAM:
				<br>
				<p class="content is-large"><strong><?php echo $row["ram"]; ?></strong></p>
			</div>
			<div class="column">
				<span><abbr title="How much?/Is it Persitant?">Storage:</span>
				<br>
				<p class="content is-large"><strong><?php echo $row["storage"]; ?></strong></p>
			</div>
			<div class="column">
				GPU:
				<br>
				<p class="content is-large"><strong><?php echo $row["gpu"]; ?></strong></p>
			</div>
		</div>

		<hr>

		<!-- images -->
		<h3 class="title is-4">
			Screenshot of the Benchmark
		</h3>
		<div class="columns">
			<div class="column">
				NON RTX:
				<br>
				<figure class="image is-16by9">
					<img src="<?php echo $row["ss-non"]; ?>" alt="NON RTX">
				</figure>
			</div>
			<div class="column">
				RTX:
				<br>
				<figure class="image is-16by9">
					<img src="<?php echo $row["ss-rtx"]; ?>" alt="RTX">
				</figure>
			</div>
		</div>

		<?php

		}
      } else {
          echo "Failed!";
      }
      ?>
  
    </div>
  </section>
  <section class="section">
    <div class="container">
      <i class="fa fa-italic">*more storage can be added at setup</i> <br>
      <i class="fa fa-italic">**BYOG = Bring your own Games</i> <br>
      <i class="fa fa-italic">***GFN = Geforce Now</i>
    </div>
  </section>


  <footer class="footer">
    <div class="content has-text-centered">
      <p>
        <strong>Benchmarks</strong> by <a href="https://benji.link">Benji</a>.<br>
        If you have any problems or suggestions, please contact me on discord: Benji#1652 <br>
        Email: benjibordne@outlook.com
      </p>
    </div>
  </footer>

  </body>
</html>


