<?php
ini_set('display_errors', true);
require_once 'config.php';
require_once 'utils.php';
global $servers;
?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<title>Git Control Center</title>
</head>
<body data-spy="scroll">
<div class="container">
	<div class="row">
		<div class="span2">
			<ul class="nav nav-list well affix">
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
						<h3><?php echo $param['title']; ?></h3>

						<div class="pull-right"><span class="label"></span></div>
						<div class="btn-group toolbar-top">
							<button class="btn" onclick="callRequest('status', '<?php echo $id; ?>');">
								<i class="icon-refresh"></i> Status
							</button>
							<button class="btn" onclick="callRequest('pull', '<?php echo $id; ?>');">
								<i class="icon-arrow-down"></i> Pull
							</button>
						</div>
						<pre></pre>
						<div class="toolbar-bottom input-append">
							<input class="input-block-level" type="text" name="message" placeholder="Commit message">
							<button class="btn" onclick="callRequest('push', '<?php echo $id; ?>', document.querySelector('#<?php echo $id; ?> input[name=message]').value);">
								<i class="icon-arrow-up"></i> Push
							</button>
							<button class="btn" title="Force Push" onclick="callRequest('push force', '<?php echo $id; ?>', document.querySelector('#<?php echo $id; ?> input[name=message]').value);">
								<i class="icon-arrow-up"></i><i class="icon-arrow-up"></i>
							</button>
						</div>
					</section>
				<?php endforeach; ?>
				<hr>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<footer>
	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
</footer>
</body>
</html>
