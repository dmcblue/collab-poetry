<?php
	$BASE_URL = $_ENV['BASE_URL'];
	$SITE_NAME = $_ENV['SITE_NAME'];
	$JSON_BASE_URL = json_encode($BASE_URL);
	$DESCRIPTION = "";
?><!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<style>
			@-ms-viewport{
				width: device-width;
			}
		</style>
		<link rel="icon" href="<?= $BASE_URL; ?>/favicon.png">
		<link rel="canonical" href="<?= $BASE_URL; ?>/home.html" />
		<meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
		<!-- Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300&family=Open+Sans:ital,wght@0,300;0,400;0,600;1,300;1,400;1,600&display=swap" rel="stylesheet">
		<!-- END Fonts -->

		
		<!-- Metadata -->
			<!-- Standard -->
			<title><?= $SITE_NAME; ?></title>
			<meta name="description" content="<?= $DESCRIPTION; ?>" />		
		
			<!-- END Standard -->
			<!-- OpenGraph -->
			<meta property="og:title" content="<?= $SITE_NAME; ?>" />
			<meta property="og:type" content="website" />
			<meta property="og:url" content="<?= $BASE_URL; ?>/" />
			<meta property="og:image" content="<?= $BASE_URL; ?>/opengraph.jpg" />
			<meta property="og:description" content="<?= $DESCRIPTION; ?>" />
			<meta property="og:locale" content="en_US" />
			
			<!-- END OpenGraph -->
			<!-- TwitterCard -->
		
			<meta name="twitter:card" content="summary_large_image">
			<meta name="twitter:site" content="@dmcblue">
			<meta name="twitter:creator" content="@dmcblue">
			<meta name="twitter:title" content="dmcblue">
			<meta name="twitter:description" content="<?= $DESCRIPTION; ?>">
			<meta name="twitter:image" content="<?= $BASE_URL; ?>/opengraph.jpg">
			<!-- END TwitterCard -->
			<!-- Json LD -->
			<script type='application/ld+json'>{
				"@context":"https:\/\/schema.org",
				"@graph":[{
					"@type":"WebSite","@id":"<?= $JSON_BASE_URL; ?>\/",
					"url":"<?= $JSON_BASE_URL; ?>\/",
					"name":"<?= $SITE_NAME; ?>",
					"publisher":{"@id":"https:\/\/www.dmcblue.com\/about"}
				},{
					"@type":"ImageObject",
					"@id":"<?= $JSON_BASE_URL; ?>\/opengraph.jpg",
					"url":"<?= $JSON_BASE_URL; ?>\/opengraph.jpg",
					"width":1273,
					"height":775
				},{
					"@type":"WebPage",
					"@id":"<?= $JSON_BASE_URL; ?>\/",
					"url":"<?= $JSON_BASE_URL; ?>\/",
					"inLanguage":"en-US",
					"name":"dmcblue",
					"isPartOf":{"@id":"<?= $JSON_BASE_URL; ?>\/"},
					"primaryImageOfPage":{"@id":"<?= $JSON_BASE_URL; ?>\/opengraph.jpg"},
					"datePublished":null,"dateModified":null
				},{
					"@type":"Article",
					"@id":"<?= $JSON_BASE_URL; ?>\/",
					"isPartOf":{"@id":"<?= $JSON_BASE_URL; ?>\/"},
					"author":{"@id":"<?= $JSON_BASE_URL; ?>\/about"},
					"headline":"dmcblue",
					"datePublished":null,
					"dateModified":null,
					"commentCount":0,
					"mainEntityOfPage":{"@id":"<?= $JSON_BASE_URL; ?>\/"},
					"publisher":{"@id":"<?= $JSON_BASE_URL; ?>\/about"},
					"image":{"@id":"<?= $JSON_BASE_URL; ?>\/opengraph.jpg"},
					"keywords":"",
					"articleSection":""
				},{
					"@type":["Person"],
					"@id":"https:\/\/www.dmcblue.com\/about",
					"name":"dmcblue",
					"image":{
						"@type":"ImageObject",
						"@id":"\/opengraph.jpg",
						"url":"\/opengraph.jpg",
						"caption":"dmcblue"
					},
					"sameAs":[]
				}]
			}</script>
			<!-- END Json LD -->
		<!-- END Metadata -->

		<style>
			<?= file_get_contents('style.css'); ?>
		</style>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
		<script src="https://unpkg.com/jspdf-autotable@3.8.0/dist/jspdf.plugin.autotable.js"></script>
		<script>
			function go() {
				const collaborators = document.getElementById('collabCount').value.split("\n");
				const collabCount = collaborators.length;
				const themes = document.getElementById('themes').value.split("\n");
				const [works, collabs] = createExercise(collabCount, themes);

				const tables = [];
				const doc = new jspdf.jsPDF({
					orientation: "portrait",
					unit: "in",
					format: "letter"
				});

				for(let i in collabs) {
					const collab = collabs[i].map((row) => {
						return Object.assign(row, {text: ''});
					});

					doc.text(collaborators[i], 0.55, 0.65);
					doc.autoTable({
						startY: 0.85,
						styles: { halign: 'center' },
  						bodyStyles: { minCellHeight: 0.5, valign: 'middle' },
						columnStyles: {
							id: { textColor: [155, 155, 155], },
							text: { minCellWidth: '4' }
						},
						body: collab,
						columns: [
							{ header: 'id', dataKey: 'id' },
							{ header: 'Theme', dataKey: 'theme' },
							{ header: '# Syllables', dataKey: 'range' },
							// { header: 'Sound', dataKey: 'rhyme' },
							{ header: 'Rhymes With', dataKey: 'rhymesWith' },
							{ header: '', dataKey: 'text' },
						],
					});
					if (i < collabs.length - 1) {
						doc.addPage("letter", "portrait")
					}
				}

				doc.save("poems.pdf");
			}
		</script>
	</head>
	<body>
		<header class="page-row">
			<h1>
				Collaborative Poetry
			</h1>
		</header>
		<section class="page-row page-row-expanded">
			<div class="table">
				<div class="row">
					<p>
						This is a collaborative art activity that provides a low-stakes way for people
						to interact with poetry.
					</p>
					<p>
						The below tool accepts a list of participants and a list of themes.
						It them creates a poetic rhyme scheme for each theme and assigns the lines of
						the scheme to the participants, randomzing their order.
					</p>
					<p>
						Thus, each participant receives a list of lines to fill out, each with a theme,
						a syllable length for the line and rhyme sound that the line should end with.
						They fill out each line not knowing the rest of the poems content, so they just
						respond to the theme with a single creative line.
					</p>
					<p>
						Then the page can be cut up line by line and all the lines can be ordered according
						to their <strong><em>&ldquo;id&rdquo;</em></strong>, creating complete, rhyming poems for each theme.
					</p>
				</div>
			</div>
			<div class="table">
				<div class="row">
					<label for="collabCount">
						Names of Participants
						<span>Each on its own line</span>
					</label>
					<textarea id="collabCount" rows="5" cols="33"></textarea>
				</div>
				<div class="row">
					<label for="themes">
						Themes
						<span>Each on its own line</span>
					</label>
					<textarea id="themes" rows="5" cols="33"></textarea>
				</div>
				<div class="row">
					<label></label>
					<button onclick="go()">Create!</button>
				</div>
			</div>
		</section>
		<footer class="page-row">
			<div>
				&copy; <?= (new DateTime())->format('Y') ?> dmcblue - <a href="https://github.com/dmcblue/collab-poetry" target="_blank">source</a>
			</div>
		</footer>

		<script type="text/javascript" src="index.js"></script>
	</body>
</html>
