
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- jQuery CSS -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />

<!-- Dropzone CSS -->
<link rel="stylesheet" href="css/dropzone.css" />

<!-- atom.SaveOnBlur CSS -->
<link rel="stylesheet" href="css/jquery.atom.SaveOnBlur.css" />

<!-- Progressbar CSS -->
<link rel="stylesheet" href="css/progressbar.css" />

<!-- FontAwesome CSS -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<!-- X-editable CSS -->
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>


<style>

  html,
  body {
  	height: 100%
    /*margin-bottom: 60px;*/
    /* The html and body elements cannot have any padding or margin. */
  }

  /* Wrapper for page content to push down footer */
  #wrap {
  	color: inherit;
	background-color: inherit;
    min-height: 100%;
    height: auto !important;
    height: 100%;
    /* Negative indent footer by it's height */
    margin-top: 40px;
    margin-bottom: -60px;
    padding: 0 0 60px
  }

  /* Set the fixed height of the footer here */
	#footer {
	    height: 60px;
	    background-color: #f8f8f8;
	}
	#btn-debug {
	  	margin-top: 10px;
	}
	#console-debug {
		position: absolute;
	  	z-index: 1000;
	  	top: 50px;
	  	width: 100%;
	  	height: 100%;
	  	overflow-y: scroll;
	  	background-color: #FFFFFF;
	  	box-shadow: 2px 2px 5px #CCCCCC;
	 }
	  	
	 #authentication {
	 	color: white;
	 	background-color: #333333;
	 } 
	  
	.form-signin {
		padding: 10px;
		margin: 0 auto;
		font-family: "AtlasTypewriterRegular", "Andale Mono", "Consolas", "Lucida Console", "Menlo", "Luxi Mono", monospace;
	}
	/*.form-signin .checkbox {
	  font-weight: normal;
	}*/
	.form-signin .form-control {
		position: relative;
		height: auto;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
			box-sizing: border-box;
		padding: 10px;
		font-size: 16px;
	}
	.form-signin .form-control:focus {
		z-index: 2;
	}
	.form-signin input[type="email"] {
		margin-bottom: 2px;
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0;
		background-color: #C4C4C4;
		border-color: #C4C4C4;
		color: #333333;
	}
	.form-signin input[type="email"]:focus {
		margin-bottom: 2px;
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0;
		background-color: white;
		border-color: white;
	}
	.form-signin input[type="password"] {
		margin-bottom: 10px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
		background-color: #C4C4C4;
		border-color: #C4C4C4;
		color: #333333;
	}
	.form-signin input[type="password"]:focus {
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0;
		background-color: white;
		border-color: white;
	}
	.form-signin .btn-submit {
		background-color: black;
		border-color: black;
		color: white
	}
	.avatar-container {
		width: 100px;
		height: 100px;
		border-radius: 3px;
		background-size: cover;
		background-position: center center;
	}
	
	.panel-default>.panel-heading.login {
		font-family: "AtlasTypewriterRegular", "Andale Mono", "Consolas", "Lucida Console", "Menlo", "Luxi Mono", monospace;
		color: white !important;
		background-color: #333333 !important;
		padding-top: 20%;

	}
	
	.panel-body.login {
		background-color: #333333 !important;
	}

	#system-stats {
	}
	
	#overall-visitor {
	}
	
	#overall-users {
	}
	
	#overall-orders {
	}
	
	.section {
		position: relative;
	    display: block;
	    height: 100%;
	    background-color: #ecf0f1;
	    overflow-x: hidden
	}
	
	.content {
	    position: relative;
	    display: block;
	    margin-left: 15px;
	    margin-right: 15px;
	    background-color: #ecf0f1;
	    min-height: 100vh;
	    -webkit-transition: all .3s ease;
	    -ms-transition: all .3s ease;
	    transition: all .3s ease
	}

	.content>.content-header {
	    height: 70px;
	    border-bottom: 1px solid #E0E4E8;
	    background-color: #ecf0f1;
	    color: #394264;
	    overflow: hidden;
	    margin-left: 15px
	}
	
	.content>.content-header .content-title {
	    margin: 0;
	    padding: 0;
	    font-size: 1.3em;
	    font-weight: 500;
	    line-height: 60px
	}

	.content>.content-body {
	    position: relative;
	    padding-left: 15px;
	    padding-right: 15px;
	    font-size: 13px;
	    background-color: #ecf0f1;
	    color: #394264;
	    min-height: 100%
	}

	.margin-top {
	    margin-top: 20px
	}
	
	.margin-bottom {
	    margin-bottom: 20px
	}
	
	.margin-left {
	    margin-left: 20px
	}
	
	.margin-right {
	    margin-right: 20px
	}
	
	.panel-body {
		width: 100%
	}
	
	.lead {
		margin-bottom:10px;
		font-size: 16px;
		font-weight: 200;
		line-height: 1.4
	}
	
	.text-ellipsis {
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	
	.list-percentages {
		margin: 0 0 15px;
	    padding: 0;
	    list-style: none;
	    position: relative;
	    width: 100%
	}
	
	.list-percentages li:first-child {
	    border-left: 0
	}
	
	.list-percentages li {
	    list-style: none;
	    position: relative;
	    margin: 0;
	    padding: 10px 0;
	    border-left: 1px solid rgba(0,0,0,.1);
	    text-align: center
	}

	.text-ellipsis {
	    overflow: hidden;
	    text-overflow: ellipsis;
	    white-space: nowrap
	}
	
	.text-lg {
	    font-size: 1.2em!important
	}
	
	.panel {
		position: relative;
	    border-bottom-width: 2px
	}
	
	.panel-primary {
		border-color: #428bca;
	}
	.panel.panel-primary {
		border-color: rgba(19,168,158,.8);
	}
	
	.panel-success {
		border-color: #d6e9c6;
	}
	
	.panel.panel-success {
		border-color: rgba(91,183,91,.8);
	}
	
	.panel-danger {
		border-color: #ebccd1;
	}
	
	.panel.panel-danger {
		border-color: rgba(218,79,73,.8);
	}

	.panel-action-fly {
		position: absolute;
		top: 15px;
		right: 20px;
		z-index: 9
	}

	.bg-primary {
		background-color: #13A89E!important;
		color: #ecf0f1!important
	}
	
	.bg-inverse {
		background-color: #394264!important;
		color: #ecf0f1!important;
	}
	
	.bg-transparent {
		background-color: rgba(0,0,0,.1)!important;
		color: inherit!important;
	}
	
	.bg-success {
		background-color: #5BB75B!important;
		color: #ecf0f1!important;
	}

	.bg-danger {
		background-color: #DA4F49!important;
		color: #ecf0f1!important;
	}
	
	.bg-grey {
		background-color: #5a5a5a!important;
		color: #ecf0f1!important;
	}
	
	.bg-ltgrey {
		background-color: #808080!important;
		color: #ecf0f1!important;
	}

	.border-danger {
		border-color: #DA4F49!important;
	}
	
	.border-grey {
		border-color: #808080!important;
	}

	element.style {
		visibility: visible;
	}
	
	.panel.panel-default {
		border-color: #E0E4E8;
	}

	.panel-heading {
		padding: 10px 5px;
		border-bottom: 1px solid transparent;
		border-top-left-radius: 3px;
		border-top-right-radius: 3px;
	}

	.panel .panel-actions-fly {
		position: absolute;
		top: 15px;
		right: 20px;
		z-index: 9;
	}
	
	.panel-default>.panel-heading {
		border-color: #E0E4E8;
	}
	
	.panel-primary .btn-panel, .panel-success .btn-panel, .panel-warning .btn-panel, .panel-danger .btn-panel, .panel-info .btn-panel {
		border-right-color: rgba(255,255,255,.1);
		border-left-color: rgba(0,0,0,.1);
	}

	.panel-actions-fly>.btn-panel {
		background: 0 0;
		box-shadow: none;
		outline: 0;
		border: 0;
		color: rgba(0,0,0,.5)!important;
		font-size: 11px;
		text-decoration: none;
	}

	.border-transparent {
		border-color: rgba(0,0,0,.2)!important;
	}

	.bordered-bottom {
		border-bottom: 1px solid #E0E4E8!important;
	}
	
	.no-border {
		border: 0 none!important;
	}

	.text-64 {
		font-size: 64px!important;
	}

	* {
	    -webkit-box-sizing: border-box;
	    -moz-box-sizing: border-box;
	    box-sizing: border-box
	}
	
	:before,:after {
	    -webkit-box-sizing: border-box;
	    -moz-box-sizing: border-box;
	    box-sizing: border-box
	}

	audio, canvas, progress, video {
		display: inline-block;
		vertical-align: baseline;
	}
	
	.list-group-item .db {
	    background-color: #808080;
	    border-color: #E0E4E8;
	    color: white
	}
	
	.list-group[class*=bg-] .list-group-item .db {
	    background-color: transparent;
	    border-color: rgba(0,0,0,.1)
	}
	
	.list-group-item .db canvas {
	    margin-right: 5px;
	    margin-left: auto
	}
	
	.list-group-item .db canvas.pull-right {
		margin-right: auto;
		margin-left: 5px
	}

	.list-group-item-text {
		margin-bottom: 0;
		line-height: 1.3;
	}
	
	.list-group[class*=bg-] a.list-group-item,.list-group[class*=bg-] a.list-group-item .db .list-group-item-heading {
    	color: inherit
	}
	
	a canvas {
	    margin-right: 5px;
	    margin-left: 10px
	}
	
	.panel-default {
		border: none
	}
	.panel-default>.panel-heading {
    	background-color: #808080!important;
    	background-image: none;
    	color: #ECF0F1 !important;
    	border: none
	}
	.panel-collapse>.panel-body {
    	background-color: #808080!important;
    	background-image: none;
    	color: #ECF0F1 !important;
    	border: none
	}
	
	a:hover{
	  text-decoration: none;
	}
	a:focus{
	  text-decoration: none;
	}

	.animated {
		-webkit-animation-duration: 1s;
		animation-duration: 1s;
		-webkit-animation-fill-mode: both;
		animation-fill-mode: both
	}

	.fadeInUp {
		-webkit-animation-name: fadeInUp;
		animation-name: fadeInUp;
	}

	#weather {
		background: transparent;
		width: 720px;
		height: 250px;
		overflow: hidden;
	}

	.panel-body {
		padding: 15px;
	}
	
	.panel-default {
		border-color: #ddd;
	}
	
	.text-center {
		text-align: center;
	}
	
	.content>.content-body {
		position: relative;
		padding: 15px 15px 30px;
		font-size: 13px;
		background-color: #fff;
		color: #394264;
		min-height: 100%;
	}
	
	.dropdown:hover .dropdown-menu {
		display: block;
	}
	
	.popover .popover-title {
		font-weight: bold;
		background-color:#989898;
		color: #fff
	}
	
	#mapX {
		height: 100%; 
		width: 100%
		margin: 0 auto; 
	}
	.loading {
		margin-top: 10em;
		text-align: center;
		color: gray;
	}

</style>
