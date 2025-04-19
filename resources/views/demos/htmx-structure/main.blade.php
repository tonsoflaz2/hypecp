<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script src='https://unpkg.com/htmx.org@2.0.4'></script>

	<style>
		* {
			margin: 0;
		}
		body {
			margin-top: 0;
			padding-top: 0;
			background: #ededed;
			padding: 30px;
			font-family: monospace;
		}
		#app {
			background: white;
			margin:auto;
			border-radius: 16px;
			padding: 30px;
			min-height: 80vh;
			box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);

		}
		#navigation {
			background: #efefff;
			border-radius: 8px;
			padding: 30px;
			display: flex;
			list-style: none;
			justify-content: end;
		}
		#navigation li {
			padding: 10px 20px;
			color: #777;
			font-weight: bold;
			cursor:pointer;
			margin: 0px 10px;
		}
		#navigation li.active {
			color:black;
			background: white;
			border-radius: 8px;
		}
		#navigation li:hover {
			color:#222;
		}
		#emails {
			background: #ffdfdf;
			border-radius: 8px;
			margin-top: 30px;
			padding: 20px;
			min-height: 520px;
		}
		.row {
			display:flex;
			background: #dfffdf;
			margin: 10px 10px 30px 10px;
			padding: 20px;
			border-radius: 8px;
		}
		.row > div {
			flex: 1;
		}
		.links {
			padding: 20px;
			margin: 10px;
			background: #aaffaa;
			border-radius: 8px;
		}
	</style>
</head>
<body>
	<div id="app">
		<ul id="navigation">
			<li style="margin-right:auto; cursor:default; color:#333; font-weight:bolder;color:#44d">PortBlaster Emails</li>
			<li class="active">Process Emails</li>
			<li>People</li>
			<li>Tags</li>
			<li>Campaigns</li>
		</ul>
		<div id="emails">
			<div id="row_" class="row">
				<div>Subject</div>
				<div>
					<div class="links"></div>
				</div>
			</div>
			<div id="row_" class="row">
			</div>
		</div>
	</div>
</body>
</html>