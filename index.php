<?php
ini_set('display_errors', true);
require_once 'config.php';
require_once 'utils.php';
global $servers;
?><!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/styles.css">
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
		<title>Git Control Center</title>
	</head>
	<body data-spy="scroll">

		<div class="container">
			<div class="row">
				<div class="span3">
					<ul class="nav nav-list well affix span3">
						<?php foreach ($servers as $pays => $ssh): ?>
							<li class="nav-header"><?php echo $pays; ?></li>
							<?php foreach ($ssh as $id => $param): ?>
								<li><a href="#<?php echo $id; ?>"><?php echo $param['title']; ?></a></li>
							<?php endforeach; ?>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="span9">
					<?php foreach ($servers as $pays => $ssh): ?>
						<h1><?php echo $pays; ?></h1>
						<?php foreach ($ssh as $id => $param): ?>
							<section id="<?php echo $id; ?>">
								<h3><?php echo $param['title']; ?> <span class="label"></span></h3>
								<div class="btn-group">
									<button class="btn" onclick="callRequest('status', '<?php echo $id; ?>');">
										<i class="icon-refresh"></i> Status
									</button>
									<button class="btn" onclick="callRequest('pull', '<?php echo $id; ?>');">
										<i class="icon-arrow-down"></i> Pull
									</button>
									<div class="input-prepend">
										<button class="btn" type="button" onclick="callRequest('push', '<?php echo $id; ?>', document.querySelector('#<?php echo $id; ?> input[name=message]').value);">
											<i class="icon-arrow-up"></i> Push
										</button>
										<input type="text" name="message" placeholder="Commit message">
									</div>
								</div>
								<pre></pre>
							</section>
						<?php endforeach; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

	</body>
</html>
