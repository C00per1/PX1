
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

<!-- Bootstrap Validator CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>


<style>

  html,
  body {
  	height: 100%;

    /* The html and body elements cannot have any padding or margin. */
  }
  body {
  	background-color: #EBEBEB;
  }
  /* Wrapper for page content to push down footer */
 /* #wrap {
  	color: inherit;
	background-color: #6394BA;
    min-height: 100%;
    height: auto !important;
    height: 100%;*/
    /* Negative indent footer by it's height */
   /* padding-top: 5%;
    padding-bottom: 7%;
    margin: 0 auto -60px
  }*/
	#wrap {
		position: relative;
		z-index: 10;
		background: #EBEBEB;
		min-height: 100%;
		height: auto !important;
		height: 100%;
		margin: 0 auto 0px;
		padding-left: 200px;
		box-shadow: 0 0 6px #000;
		/*padding-bottom: 3000px !important;
		margin-bottom: -2980px !important;*/
		overflow: hidden;
		-webkit-transition: 0.1s;
		-moz-transition: 0.1s;
		-o-transition: 0.1s;
		transition: 0.1s;
	}
  /* Set the fixed height of the footer here */
	#footer {
	    height: 60px;
	    background-color: #353535;
	    text-align: center;
	    color: #f0f0f0;
	    z-index: 1000;
	    padding-top: 10px;
	    width: 100%;
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
	 .dropdown-menu {
	 	background-color: #f8f8f8;
	 	border-color: #e7e7e7;
	 }
	 #authentication {
	 	color: white;
	 	background-color: #333333;
	 } 
	 .table-hover.color-hover tbody tr:hover td {
	 	background-color: #bebc96;
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
	.panel-footer.login {
		background-color: #333333 !important;
		border: none;
	}
	.btn-resetPassword {
		font-family: "AtlasTypewriterRegular", "Andale Mono", "Consolas", "Lucida Console", "Menlo", "Luxi Mono", monospace;
		color: black;
		cursor: pointer;
	}
	.btn-submit:hover {
		color: white;
		background-color: #2a6496;
		border-color: #2a6496;
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
	    /*background-color: #ecf0f1;*/
	    overflow-x: hidden
	}
	
	.content {
	    position: relative;
	    display: block;
	    margin-left: 15px;
	    margin-right: 15px;
	    /*background-color: #ecf0f1;*/
	    min-height: 100vh;
	    -webkit-transition: all .3s ease;
	    -ms-transition: all .3s ease;
	    transition: all .3s ease
	}

	.content>.content-header {
	    height: 70px;
	    border-bottom: 1px solid #E0E4E8;
	    /*background-color: #ecf0f1;*/
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
	    /*background-color: #ecf0f1;*/
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
	.panel-default>.panel-heading.weather {
    	background-color: #808080!important;
    	background-image: none;
    	color: #ECF0F1 !important;
    	border: none
	}
	.panel-collapse>.panel-body.weather {
    	background-color: #808080!important;
    	background-image: none;
    	color: #ECF0F1 !important;
    	border: none
	}
	.panel-default>.panel-heading.piacalc {
    	background-color: #929292!important;
    	background-image: none;
    	color: #ECF0F1 !important;
    	border: none
	}
	.panel-collapse>.panel-body.piacalc {
    	background-color: #F8F8F8!important;
    	background-image: none;
    	border: none
	}
	.panel-default>.panel-heading.piacalc.active-panel {
		background-color: #7694ab!important;
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
	.fa-cube {
		color: black;
	}
	#top-link-block.affix-top {
	    position: absolute; /* allows it to "slide" up into view */
	    bottom: -180px; /* negative of the offset - height of link element */
	    left: 25px; /* padding from the left side of the window */
	}
	#top-link-block.affix {
	    position: fixed; /* keeps it on the bottom once in view */
	    bottom: 10px; /* height of link element */
	    left: 20px; /* padding from the left side of the window */
	    padding-bottom: 10px;
	    z-index: 1000;
	}
	.stickyButton {
	    position: fixed;
	    bottom: 55px;
	    left: 20px;
	    z-index: 1000;
	}
	.fusionCharts {
	  *,
	  *:before,
	  *:after {
	  -webkit-box-sizing: content-box;
	     -moz-box-sizing: content-box;
	          box-sizing: content-box;
	  }
	}
	.nav-tabs {
		border-bottom: none;
	}
	/* tab color */
	.nav-tabs>li>a {
	  background-color: #333333; 
	  border-color: #777777;
	  color:#fff;
	}
	
	/* active tab color */
	.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
	  color: #fff;
	  background-color: #666;
	  border: 1px solid #888888;
	}
	.navbar {
	  margin: 0;
	  border: 0;
	  position: fixed;
	  top:0;
	  left: 0;
	  width:100%;
	  -webkit-border-radius: 0;
	  -moz-border-radius: 0;
	  border-radius: 0;
	  z-index: 2000;
	}
	
	/* hover tab color */
	.nav-tabs>li>a:hover {
	  border-color: #000000;
	  background-color: #111111;
	}
	table.table-hover.color-hover {
		border-color: #000000;
		background-color: #F8F8F8;
	}
	thead th {
		height: 40px;
		font-size: 16px;
		vertical-align: middle;
	}
	.bv-form .bv-icon-input-group {
		top: 20px;
	}
	.form-control-feedback {
	    right: 10px;
	}
	a.show-sidebar {
	  float: left;
	  margin-left: 15px;
	  color:#9B9B9B;
	  outline: none;
	  -webkit-transition: 0.2s;
	  -moz-transition: 0.2s;
	  -o-transition: 0.2s;
	  transition: 0.2s;
	}
	a.show-sidebar:hover {
	  color:#A8A8A8;
	}
	#fixedContent {
		width: 100%;
		padding-left: 20px;
	}
	
	.nav.main-menu, .nav.msg-menu {
   		margin: 0 -15px;
	}
	.nav.main-menu, .nav.msg-menu {
	    margin: 0 -15px;
	}
	.nav.main-menu > li > a, .nav.msg-menu > li > a {
	    color: #f0f0f0;
	    min-height: 40px;
	    text-align: left;
	    transition: all 0.2s ease 0s;
	}
	.nav .open > a, .nav .open > a:hover, .nav .open > a:focus {
	    background: none repeat scroll 0 0 rgba(0, 0, 0, 0.1);
	}
	.nav.main-menu > li > a:hover, .nav.main-menu > li > a:focus, .nav.main-menu > li.active > a, .nav.main-menu .open > a, .nav.main-menu .open > a:hover, .nav.main-menu .open > a:focus, .dropdown-menu > li > a:focus, .dropdown-menu > li > a:hover, .dropdown-menu > li.active > a, .nav.msg-menu > li > a:hover, .nav.msg-menu > li > a:focus, .nav.msg-menu > li.active > a, .nav.msg-menu .open > a, .nav.msg-menu .open > a:hover, .nav.msg-menu .open > a:focus {
	    background: none repeat scroll 0 0 rgba(0, 0, 0, 0.1);
	    color: #f0f0f0;
	}
	.nav.main-menu a.active, .nav.msg-menu a.active {
	    background: none repeat scroll 0 0 rgba(0, 0, 0, 0.2);
	}
	.nav.main-menu a.active:hover, .nav.msg-menu a.active:hover {
	    background: none repeat scroll 0 0 rgba(0, 0, 0, 0.2);
	}
	.nav.main-menu a.active-parent, .nav.msg-menu a.active-parent {
	    background: none repeat scroll 0 0 rgba(0, 0, 0, 0.3);
	}
	.nav.main-menu a.active-parent:hover, .nav.msg-menu a.active-parent:hover {
	    background: none repeat scroll 0 0 rgba(0, 0, 0, 0.3);
	}
	.nav.main-menu > li > a > i, .nav.msg-menu > li > a > i {
	    display: block;
	    font-size: 18px;
	    text-align: left;
	    vertical-align: middle;
	    width: auto;
	}
	.main-menu .dropdown-menu {
	    background: url("../img/devoops_pattern_b10.png") repeat scroll 0 0 #6aa6d6;
	    border: 0 none;
	    border-radius: 0 4px 4px 0;
	    box-shadow: none;
	    float: none;
	    left: 100%;
	    margin: 0;
	    padding: 0;
	    position: absolute;
	    top: 0;
	    visibility: hidden;
	    z-index: 2001;
	}
	.main-menu .active-parent:hover + .dropdown-menu {
	    visibility: visible;
	}
	.main-menu .active-parent + .dropdown-menu:hover {
	    visibility: visible;
	}
	.main-menu .dropdown-menu > li > a {
	    color: #f0f0f0;
	    padding: 9px 15px 9px 40px;
	}
	.main-menu .dropdown-menu > li:first-child > a {
	    border-radius: 0 4px 0 0;
	}
	.main-menu .dropdown-menu > li:last-child > a {
	    border-radius: 0 0 4px;
	}
	#sidebar-left {
	  position: fixed;
	  z-index: 10;
	  left: 250px;
	  width: 200px;
	  height: 100%;
	  /*padding-bottom: 3000px !important;
	  margin-bottom: -3000px !important;*/
	  margin-left: -250px;
	  padding-top: 20px;
	  padding-left: 30px;
	  background:#6596BC;
	  -webkit-transition: 0.1s;
	  -moz-transition: 0.1s;
	  -o-transition: 0.1s;
	  transition: 0.1s;
	}
	
	#sidebar-left.col-xs-2 {
	  opacity: 0;
	  width: 0%;
	  padding: 0;
	}
	.sidebar-show #sidebar-left.col-xs-2 {
	  opacity: 1;
	  width: 16.666666666666664%;
	  padding: 0 15px;
	}
	.sidebar-show #content.col-xs-12 {
	  opacity: 1;
	  width: 83.33333333333334%;
	}
	.nav.main-menu > li > a > i, .nav.msg-menu > li > a > i {
		font-size: 18px;
		width: 20px;
		display: inline-block;
	  }
	@media (min-width: 768px) {
	  #sidebar-left.col-sm-2 {
	    opacity: 1;
	    width: 16.666666666666664%;
	    padding: 0 15px;
	  }
	  .sidebar-show #sidebar-left.col-sm-2 {
	    opacity: 0;
	    width:0;
	    padding:0;
	  }
	  .sidebar-show #content.col-sm-10 {
	    opacity: 1;
	    width:100%;
	  }
	  .page-404 .form-inline {
	    width: 60%;
	  }
	}

	
/*==================================================
=            Bootstrap 3 Media Queries             =
==================================================*/

    /*==========  Mobile First Method  ==========*/

    /* Custom, iPhone Retina */ 
    @media only screen and (min-width : 320px) {

    }

    /* Extra Small Devices, Phones */ 
    @media only screen and (min-width : 480px) {

    }

    /* Small Devices, Tablets */
    @media only screen and (min-width : 768px) {

    }

    /* Medium Devices, Desktops */
    @media only screen and (min-width : 992px) {

    }

    /* Large Devices, Wide Screens */
    @media only screen and (min-width : 1200px) {

    }


</style>