<style>
.header-basic-light{
	padding: 10px 20px;  /* moves navbar text up and down */
	box-sizing:border-box;
	box-shadow: 0 0 7px 0 rgba(0, 0, 0, 0.15);
	height: 60px;
	background-color: #ffffff00; /* transparent */
	/* #002462 navy*/
}
.header-basic-light .header-limiter {
	max-width: 1200px;
	text-align: center;
	margin: 0 auto;
}
/* Logo */
.header-basic-light .header-limiter h1{
	float: left;
	font: normal 28px Cookie, Arial, Helvetica, sans-serif;
	line-height: 40px;
	margin: 0;
}
.header-basic-light .header-limiter h1 span { /*blue color for quiz)*/
	color: #EC123E; /*NJIT*/
}
/* The header links */
.header-basic-light .header-limiter a {
	color: #FFFFFF; /* white */ /*word "Professor" */
	text-decoration: none;
}
.header-basic-light .header-limiter nav{
	font:15px Arial, Helvetica, sans-serif;
	line-height: 40px;
	float: right;
}
.header-basic-light .header-limiter nav a{
	display: inline-block;
	padding: 0 5px;
	opacity: 0.9;
	text-decoration:none;
	color: #FFFFFF;  /* white "all texts on the right side" */
	line-height:1;
}
.header-basic-light .header-limiter nav a.selected {
	background-color: #86a3d5;
	color: #ffffff;
	border-radius: 3px;
	padding:6px 10px;
}
/* Making the header responsive. doesnt work that well at the moment */
@media all and (max-width: 600px) {
	.header-basic-light {
		padding: 20px 0;
		height: 85px;
	}
	.header-basic-light .header-limiter h1 {
		float: none;
		margin: -8px 0 10px;
		text-align: center;
		font-size: 24px;
		line-height: 1;
	}
	.header-basic-light .header-limiter nav {
		line-height: 1;
		float:none;
	}
	.header-basic-light .header-limiter nav a {
		font-size: 13px;
	}
}
/* Making the header responsive. doesnt work that well at the moment
@media all and (max-width: 600px) {
	.header-basic-light {
		padding: 20px 0;
		height: 85px;
	}
	.header-basic-light .header-limiter h1 {
		float: none;
		margin: -8px 0 10px;
		text-align: center;
		font-size: 24px;
		line-height: 1;
	}
	.header-basic-light .header-limiter nav {
		line-height: 1;
		float:none;
	}
	.header-basic-light .header-limiter nav a {
		font-size: 13px;
	}
}
/* For the headers to look good, be sure to reset the margin and padding of the body */
body {
	margin:0;
	padding:0;
}
</style>

<header class="header-basic-light">
	<div class="header-limiter">

		<h1><a href="#"><span>NJIT</span> Professor </a></h1>

		<nav>
			<a href="WelcomeInst.php">Instructor Home</a>
			<!-- <a href="AddQuestion.php">Add Questions</a> -->
			<a href="SplitScreenTryoutListNew.php">Make Test</a>
			<!-- <a href="ExamQuestion2.php">Create Test</a> -->
			<a href="GradeRelease.php">Review Test</a>
			<a style="float:right"><a class="active" href="index.html">Log Out</a></li>
    <!-- </ul> -->
		</nav>
	</div>

</header>
