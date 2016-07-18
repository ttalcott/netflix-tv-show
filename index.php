<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>
			Netflix TV Show Data Design Project
		</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<header>
			<h1>Netflix TV Show Data Design Project
			</h1>
		</header>
		<main>
			<h2>The following information contains a persona, use case, interaction flow, and a conceptual model about the landing page of a Netflix TV series.
			</h2>
			<h3>
				Persona:
			</h3>
			<ol class="use-case">
				<li>Age: 20 years old</li>
				<li>Occupation: Professional Netflix watcher and TV show aficionado</li>
				<li>Goals: Earn a living by watching every episode of his favorite TV show a world record setting number of times</li>
				<li>Dislikes: Slow loading content, slow wifi, Comcast, bad aesthetics on websites and apps, an app that is not easy to use</li>
				<li>Needs from an app: must be easy to use, can't be slow to load features, has too look "sharp", must be set up in a logical order, has to be easy to find intended content</li>
			</ol>
			<h3>
				Use Case:
			</h3>
			<ul class="use-case">
				<li>As a registered user I want to search for a TV series</li>
				<li>As a registered user I want to view what episodes of a series are available</li>
				<li>As a registered user I want to chose a certain episode in a series</li>
				<li>As a registered user I want to add an episode to my watch list</li>
			</ul>
			<h3>
				Interaction flow:
			</h3>
			<ol class="upper-alpha">
				<li><em>Assume user has already signed in</em></li>
				<li>User searches for tv series</li>
				<li>User selects what series they wish to view</li>
				<li>User reads an overview of current episode</li>
				<li>User selects their current episode <em>or</em> user clicks "episodes" button to view full list</li>
				<li>User selects episode to view and clicks play</li>
				<li>Episode begins playing</li>
				<li>User can rate show if they wish</li>
			</ol>
			<h3>
				Conceptual model:
			</h3>
			<ul class="use-case">
				<li>Each <strong>series</strong> can contain many <strong>episodes</strong></li>
				<li>Each <strong>episode</strong> can <em>only</em> belong to one <strong>series</strong></li>
				<li>Each <strong>user</strong> can only have one <strong>watch list</strong></li>
				<li>Each <strong>watch list</strong> belongs to only one <strong>user</strong></li>
				<li>Each user can add many <strong>episodes</strong> to their <strong>watch list</strong></li>
				<li>Each <strong>episode</strong> can belong to many <strong>watch lists</strong></li>
			</ul>
		</main>
	</body>
</html>