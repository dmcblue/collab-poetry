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
			<meta property="og:image" content="<?= $BASE_URL; ?>/opengraph.png" />
			<meta property="og:description" content="<?= $DESCRIPTION; ?>" />
			<meta property="og:locale" content="en_US" />
			
			<!-- END OpenGraph -->
			<!-- TwitterCard -->
		
			<meta name="twitter:card" content="summary_large_image">
			<meta name="twitter:site" content="@dmcblue">
			<meta name="twitter:creator" content="@dmcblue">
			<meta name="twitter:title" content="dmcblue">
			<meta name="twitter:description" content="<?= $DESCRIPTION; ?>">
			<meta name="twitter:image" content="<?= $BASE_URL; ?>/opengraph.png">
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
                    "@id":"<?= $JSON_BASE_URL; ?>\/opengraph.png",
                    "url":"<?= $JSON_BASE_URL; ?>\/opengraph.png",
                    "width":1273,
                    "height":775
                },{
                    "@type":"WebPage",
                    "@id":"<?= $JSON_BASE_URL; ?>\/",
                    "url":"<?= $JSON_BASE_URL; ?>\/",
                    "inLanguage":"en-US",
                    "name":"dmcblue",
                    "isPartOf":{"@id":"<?= $JSON_BASE_URL; ?>\/"},
                    "primaryImageOfPage":{"@id":"<?= $JSON_BASE_URL; ?>\/opengraph.png"},
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
                    "image":{"@id":"<?= $JSON_BASE_URL; ?>\/opengraph.png"},
                    "keywords":"",
                    "articleSection":""
                },{
                    "@type":["Person"],
                    "@id":"https:\/\/www.dmcblue.com\/about",
                    "name":"dmcblue",
                    "image":{
                        "@type":"ImageObject",
                        "@id":"\/opengraph.png",
                        "url":"\/opengraph.png",
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
        <script>
            // createExercise(collabCount, themes)
            function go() {
                console.log('hi');
                const collabCount = parseInt(document.getElementById('collabCount').value);
                const themes = document.getElementById('themes').value.split("\n");
                const [works, collabs] = createExercise(collabCount, themes);
                console.log(works, collabs);
                console.table(collabs[1], ['id', 'theme', 'range', 'rhyme']);
                const doc = new jspdf.jsPDF({
                    orientation: "portrait",
                    unit: "in",
                    format: "letter"
                });

                // for (let i = 0, ilen = collabs.length; i < ilen; i++)
                doc.text("Hello world!", 1, 1);
                doc.save("two-by-four.pdf");
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
            <div class="row">
                <label for="collabCount">
                    # of Participants
                </label>
                <input id="collabCount" type="number" min="0" value="1" />
            </div>
            <div class="row">
                <label for="themes">
                    Themes
                    <span>Each on its own line</span>
                </label>
                <textarea id="themes"></textarea>
            </div>
            <div class="row">
                <label></label>
                <button onclick="go()">Button</button>
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
