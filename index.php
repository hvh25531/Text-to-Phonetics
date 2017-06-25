<?php
	include( __DIR__ . '/detectmobilebrowser.php' );
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>IPA Phonetic Transcription of English Text</title>
	<meta name="title" content="IPA Phonetic Transcription of English Text" />
	<meta property="og:title" content="IPA Phonetic Transcription of English Text" />
	<meta property="og:image" content="img/logo.png" />
	<link rel="icon" href="/favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="common.min.css">
	<style>
		#ipa_result {
			display: none;
			background: #f1f3f7;
			padding: 10px;
			font-family: Menlo;
			font-size: 18px;
		    word-spacing: 5px;
		}
		.container {
			margin-top: 20px;
		}

		#input_text {
			min-height: 75px;
		}

		.transcr {
			font-family: "Lucida Sans Unicode",  "Lucida Grande", "Lucida Sans", sans-serif;
			font-size: smaller;
			color: #666666;
		}

		#show_hide {
			display: none;
			text-align: center;
			cursor: pointer;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", sans-serif;
		}

		.btn{ margin-bottom: 10px; }

		.contact{ text-align: center; }

	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<div class="card panel panel-default">
					<h5 class="card-header">
						IPA Phonetic Transcription of English Text
					</h5>
					<div class="card-block">
						<h4>Paste your English text here:</h4>
						<p class="card-text">
							<form name="ipaForm">
								<div class="form-group">
									<textarea id="input_text" class="form-control"></textarea>
								</div>

								<div class="form-group">
									<label for="American">American</label>
									<input class="output_dialect" type="radio" name="output_dialect" value="American" checked>
									<label for="British">British</label>
									<input class="output_dialect" type="radio" name="output_dialect" value="British">
								</div>

								<div class="form-group">
									<p id="show_hide">Show/Hide</p>
									<div id="ipa_result"></div>
								</div>

								<?php if(!isMobile()) : ?>
								<div class="form-group">
									<label for="rate">Rate:</label>
									<span class="rate-value">1</span>
									<input type="range" min="0.5" max="2" value="1" step="0.1" id="rate">
								</div>

								<div class="form-group">
									<label for="pitch">Pitch:</label>
									<span class="pitch-value">1</span>
									<input type="range" min="0" max="2" value="1" step="0.1" id="pitch">
								</div>

								<div class="form-group">
									<select class="form-control"></select>
								</div>
								<?php endif; ?>

								<div align="center">
									<?php if(!isMobile()) : ?>
										<button type="button" id="speak" onclick="_speak()" class="btn btn-success">
											<i class="glyphicon glyphicon-play"></i>
										</button>
										<button type="button" onclick="_pause_resume()" class="btn btn-warning">
											<i class="glyphicon glyphicon-pause"></i>
										</button>
										<button type="button" onclick="_stop()" class="btn btn-danger">
											<i class="glyphicon glyphicon-stop"></i>
										</button>
									<?php endif; ?>

									<button type="button" id="convert_btn" class="btn btn-primary">Show transcription</button>
								</div>
							</form>
						</p>
						<p class="contact">Comments to: hvh25531@gmail.com</p>
					</div>
				</div>
			</div>
		</div>
	</div>
<script src="script.js"></script>
</body>
</html>