<!--HTML-->
<div id="project-wrapper">
	<div id="project-container">
		<div id="overlay"></div>
		<div id="content">
			<h2>Throne</h2>
			<h3>Bring Me The Horizon</h3>
			<input type="range" value="30" />
			<div id="controls">
				<div class="column"><i class="fa fa-refresh" aria-hidden="true"></i></div>
				<div class="column"><i class="fa fa-step-backward" aria-hidden="true"></i></div>
				<div class="column"><i class="fa fa-play play-btn fa-fw" aria-hidden="true"></i></div>
				<div class="column"><i class="fa fa-step-forward" aria-hidden="true"></i></div>
				<div class="column active"><i class="fa fa-random" aria-hidden="true"></i></div>
			</div>
		</div>
	</div>
</div>
<h1 id="dailyui">009</h1>


<!--CSS-->
<style>
$font: 'proxima-nova', 'Lato', sans-serif;
$primary: #9b59b6;

*:focus {
	outline: none;
}

body {
	min-height: 100vh;
	font-family: $font;
	background: $primary;
	
	#project-wrapper {
		height: 100vh;
		display: flex;
		display: -webkit-flex;
		-webkit-align-items: center;
		align-items: center;
		-webkit-justify-content: center;
		justify-content: center;
		
		#project-container {
			background: url('http://www.upsetmagazine.com/wp-content/uploads/2015/09/Bring-Me-The-Horizon_16.jpg');
			background-size: cover;
			background-position: top center;
			color: white;
			/* height: auto; */
			height: 180px;
			min-width: 300px;
			width: 300px;
			position: relative;
			z-index: 2;
			border-radius: 5px;
			overflow: hidden;
			-webkit-box-shadow: 0px 3px 15px 	-1px rgba(0,0,0,0.5);
			-moz-box-shadow: 0px 3px 15px -1px rgba(0,0,0,0.5);
			box-shadow: 0px 3px 15px -1px rgba(0,0,0,0.5);
			
			#overlay {
				position: absolute;
				height: calc(100% + 1px);
				width: calc(100% + 1px);
				z-index: 2;
				background: -moz-linear-gradient(-45deg, #333333 0%, #222222 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(-45deg, #333333 0%,#222222 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(135deg, #333333 0%,#222222 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
				opacity: .85;
			}
			
			#content {
				text-align: center;
				position: relative;
				z-index: 3;
				
				h2 {
					font-size: 1.3em;
					margin: 35px 0 0 0;
					font-weight: 600;
				}
				
				h3 {
					margin: 7px 0 15px 0;
					font-size: 0.9em;
					opacity: .4;
				}
				
				input {
					width: 100%;
					height: 2px;
					margin: 0 0 15px 0;
					background: -moz-linear-gradient(left, #3498db 0%, #9b59b6 72%); /* FF3.6-15 */
background: -webkit-linear-gradient(left, #3498db 0%,#9b59b6 72%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to right, #3498db 0%,#9b59b6 72%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
					-webkit-appearance: none;
   				-moz-appearance:    none;
   				appearance:         none;
					
					&::-webkit-slider-thumb {
						-webkit-appearance: none;
						height: 8px;
						width: 8px;
						border-radius: 10px;
						background: #ffffff;
						cursor: pointer;
					}
				}
				
				#controls {
					height: 50px;
					display: flex;
					display: -webkit-flex;
					-webkit-align-items: center;
					align-items: center;
					-webkit-justify-content: center;
					justify-content: center;
					
					.column {
						float: left;
						
						&:nth-child(even) {
							font-size: 1.3em;
						}
						
						&:nth-child(n+2):nth-child(-n+4) {
							color: white !important;
						}
						
						&:nth-child(3) {
							font-size: 2em;
						}
						
						&.active {
							color: $primary;
						}
						
						i {
							margin: 0 15px;
							cursor: pointer;
						}
					}
				}
			}
		}
	}
	
	#dailyui {
		position: fixed;
		font-size: 12em;
		font-weight: 700;
		margin: 0 0 -28px 0;
		padding: 0;
		right: 0;
		bottom: 0;
		color: rgba(0, 0, 0, .3);
		z-index: 1;
		text-align: right;
		font-family: 'proxima-nova', 'Lato', sans-serif;
	}
}
</style>

<!--JS-->
<script >
    $('.play-btn').click(function() {
	if ( $(this).hasClass("fa-play") ) {
		$(this).removeClass("fa-play");
		$(this).addClass("fa-pause");
	} else {
		$(this).removeClass("fa-pause");
		$(this).addClass("fa-play");
	}
});

$('.column').click(function() {
	$(this).toggleClass("active");
})
</script>

