<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>IPA Phonetic Transcription of English Text</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="common.min.css">
	<style>
		#ipa_result {
			display: none;
			background: #f1f3f7;
			padding: 10px;
			font-family: Helvetica, Gadget, sans-serif;
			font-size: 18px;
		    word-spacing: 5px;
		}
		.container {
			margin-top: 20px;
		}

		.transcription_missing {
			color: red;
		}
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
									<label for="am">American</label>
									<input class="output_dialect" type="radio" name="output_dialect" value="am" checked>
									<label for="br">British</label>
									<input class="output_dialect" type="radio" name="output_dialect" value="br">
								</div>

								<div class="form-group">
									<div id="ipa_result"></div>
								</div>

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

								<button type="button" id="convert_btn" class="btn btn-primary">Show transcription</button>
								<button type="submit" id="play" class="btn btn-success">Play</button>
							</form>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
<script src="script.js"></script>
</body>
</html>