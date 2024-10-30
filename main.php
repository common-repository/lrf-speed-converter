<?php
/*
Plugin Name: LRF speed converter
Description: LRF Minutes per mile/km to speed/h
Plugin URI: http://wordpress.org/
Author: Fabrizio La Racca
Author URI: http://laracca.it/
Version: 1.0
*/

/*  Copyright 2017  Fabrizio La Racca

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* How to use it
	Just add [lrf_calculator] to any place in your site. This plugin uses Bootstrap 3
*/

add_shortcode ('lrf_calculator', 'lrf_calculator');
function lrf_calculator($atts)
{
	$style_time = 'style="width: 100px;"';
	$style_time_input = 'style="width: 100px;"';
	
	$pull_atts = shortcode_atts( array( 
		'showas' => 'horizontal' //horizontal or vertical
	), $atts ) ;

	$showas	= $pull_atts[ 'showas' ];
	?>
	
		<script language='JavaScript'>
			jQuery(document).ready(function() {
				
				jQuery("#hours").change( function() {
					calculate_speed();
				})
				
				jQuery("#minutes").change( function() {
					calculate_speed();
				})
				
				jQuery("#seconds").change( function() {
					calculate_speed();
				})
				
				jQuery("#km").change( function() {
					calculate_speed();
				})
				
				jQuery("#metres").change( function() {
					calculate_speed();
				})
				
				jQuery("#miles").change( function() {
					calculate_speed();
				})
				
				jQuery("#yards").change( function() {
					calculate_speed();
				})
				
				function calculate_speed (){
					
					var metres_in_km = 1000;
					var yards_in_mile = 1760;
					var seconds_in_hour = 60*60;
					
					var hours 	= jQuery("#hours").val();
					var minutes = jQuery("#minutes").val();
					var seconds = jQuery("#seconds").val();
					var km 		= jQuery("#km").val();
					var metres 	= jQuery("#metres").val();
					var miles 	= jQuery("#miles").val();
					var yards 	= jQuery("#yards").val();
					
					
					var sum_seconds = (hours*seconds_in_hour) + (minutes*60) + (seconds*1);
					
					//calculate kph
					var sum_metres = (km*metres_in_km) + (metres*1);
					var kph = ((sum_metres*seconds_in_hour)/sum_seconds)/metres_in_km;
					var kph_twodigits = kph.toFixed(2);
					
					//calculate mph
					var sum_yards = (miles*yards_in_mile) + (yards*1);
					var mph = ((sum_yards*seconds_in_hour)/sum_seconds)/yards_in_mile;
					var mph_twodigits = mph.toFixed(2);
					
					console.log('69) sum_seconds: ' + sum_seconds + ' | sum_yards: ' + sum_yards);
					jQuery("#kph").val(kph_twodigits);
					jQuery("#mph").val(mph_twodigits);
				}
			})//end of (document).ready
		</script>
	
	<?php
	if ($showas == 'horizontal'){
	$shortcode = '	
		<div class="form-inline">
			<div class="form-group has-warning">
				<label class="sr-only" for="hours"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Hours</div>
							<input type="number" class="form-control" id="hours" value="0" min="0" '.$style_time_input.'>
						
					</div>
			</div>
			
			<div class="form-group has-warning">
				<label class="sr-only" for="minutes"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Minutes</div>
							<input type="number" class="form-control" id="minutes" value="0"  min="0" '.$style_time_input.'>
						
					</div>
			</div>
			
			<div class="form-group has-warning">
				<label class="sr-only" for="seconds"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Seconds</div>
							<input type="number" class="form-control" id="seconds" value="0"  min="0" '.$style_time_input.'>
						
					</div>
			</div>
		
		</div>
		
		<div class="form-inline">
			<div class="form-group">
				<label class="sr-only" for="km"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Km</div>
							<input type="number" class="form-control" id="km" value="0" min="0" '.$style_time_input.'>
						
					</div>
			</div>
			
			<div class="form-group">
				<label class="sr-only" for="metres"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Metres</div>
							<input type="number" class="form-control" id="metres" value="0"  min="0" '.$style_time_input.'>
						
					</div>
			</div>
			
			<div class="form-group has-success">
				<label class="sr-only" for="kph"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Kph</div>
							<input type="number" class="form-control" id="kph" '.$style_time_input.' readonly>
						
					</div>
			</div>
		
		</div>
		
		<div class="form-inline">
			<div class="form-group">
				<label class="sr-only" for="miles"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Miles</div>
							<input type="number" class="form-control" id="miles" value="0" min="0" '.$style_time_input.'>
						
					</div>
			</div>
			
			<div class="form-group">
				<label class="sr-only" for="yards"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Yards</div>
							<input type="number" class="form-control" id="yards" value="0"  min="0" '.$style_time_input.'>
						
					</div>
			</div>
		
			<div class="form-group has-success">
				<label class="sr-only" for="mph"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Mph</div>
							<input type="number" class="form-control" id="mph" '.$style_time_input.' readonly>
						
					</div>
			</div>
		</div>';
	}
	
if ($showas == 'vertical'){
	$shortcode = '	
		<div class="row" style="padding: 5px;">
			<div class="col-md-12 has-warning">
				<label class="sr-only" for="hours"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Hours</div>
							<input type="number" class="form-control" id="hours" value="0" min="0" '.$style_time_input.'>
						
					</div>
			</div>
			
			<div class="col-md-12 has-warning">
				<label class="sr-only" for="minutes"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Minutes</div>
							<input type="number" class="form-control" id="minutes" value="0"  min="0" '.$style_time_input.'>
						
					</div>
			</div>
			
			<div class="col-md-12 has-warning">
				<label class="sr-only" for="seconds"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Seconds</div>
							<input type="number" class="form-control" id="seconds" value="0"  min="0" '.$style_time_input.'>
						
					</div>
			</div>
		
		
			<div class="col-md-12">
				<label class="sr-only" for="km"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Km</div>
							<input type="number" class="form-control" id="km" value="0" min="0" '.$style_time_input.'>
						
					</div>
			</div>
			
			<div class="col-md-12">
				<label class="sr-only" for="metres"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Metres</div>
							<input type="number" class="form-control" id="metres" value="0"  min="0" '.$style_time_input.'>
						
					</div>
			</div>
			
			<div class="col-md-12 has-success">
				<label class="sr-only" for="kph"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Kph</div>
							<input type="number" class="form-control" id="kph" '.$style_time_input.' readonly>
						
					</div>
			</div>
		
		
			<div class="col-md-12">
				<label class="sr-only" for="miles"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Miles</div>
							<input type="number" class="form-control" id="miles" value="0" min="0" '.$style_time_input.'>
						
					</div>
			</div>
			
			<div class="col-md-12">
				<label class="sr-only" for="yards"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Yards</div>
							<input type="number" class="form-control" id="yards" value="0"  min="0" '.$style_time_input.'>
						
					</div>
			</div>
		
			<div class="col-md-12 has-success">
				<label class="sr-only" for="mph"></label>
					<div class="input-group">
						<div class="input-group-addon" '.$style_time.'>Mph</div>
							<input type="number" class="form-control" id="mph" '.$style_time_input.' readonly>
						
					</div>
			</div>
		</div>';
	}
	
	return $shortcode;
}


?>

