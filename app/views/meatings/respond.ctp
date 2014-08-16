
<script
	src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAUjfIcpUEZbeLszV95v3kihTq1alZeZrQekMY1umhpNBJU1DE9RSy60NxKXAq9UzlsC_-oVLlX5sXZw"
	type="text/javascript"></script>
<script type="text/javascript">
    function initialize() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map_canvas"))
        map.setCenter(new GLatLng(37.4419, -122.1419), 13);
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());

        // Create new geocoding object
        geocoder = new GClientGeocoder();

        // Retrieve location information, pass it to addToMap()
        geocoder.getLocations('<?php echo $meating['Meating']['address']; ?>', function(response) {
            // Retrieve the object
            place = response.Placemark[0];

            // Retrieve the latitude and longitude
            point = new GLatLng(place.Point.coordinates[1],
                                place.Point.coordinates[0]);

            // Center the map on this point
            map.setCenter(point, 13);

            // Create a marker
            marker = new GMarker(point);

            // Add the marker to map
            map.addOverlay(marker);

            // Add address information to marker
            marker.openInfoWindowHtml(place.address);             
        });
          
      }
    }

    function addLoadEvent(func) {
    	  var oldonload = window.onload;
    	  if (typeof window.onload != 'function') {
    	    window.onload = func;
    	  } else {
    	    window.onload = function() {
    	      if (oldonload) {
    	        oldonload();
    	      }
    	      func();
    	    }
    	  }
    	}

    	addLoadEvent(initialize);



    </script>

<?php
echo "Welcome ".$invitee['name'];
?>

<h2><?php echo $meating['Meating']['title'];?></h2>

<div id="invite_image" style="text-align:center; padding-top:15px; padding-bottom:30px;">
	<?php echo $html->image('sets/big/'.$meating['Meating']['img_name'], array('alt' => 'CakePHP'))?>
</div>


<div style="width: 300px; float:left;">
<?php $dt = strtotime($meating['Meating']['scheduled_for']); ?>
<div id="address"><?php echo $meating['Meating']['address']; ?></div>
<div id="time" style="font-weight: bold;"><?php echo date('jS F',$dt).' at '. date('g:i a',$dt); ?></div>
<div id="description" style="padding-top:15px;"><?php echo $meating['Meating']['description']; ?></div>
</div>

<div style="float: right; padding-right: 25px; padding-bottom:15px;">
	<div id="map_canvas" style="width: 350px; height: 300px;"></div>
</div>


<div class="respond"
	style="border-top: 3px solid #EEEEEE; border-bottom: 3px solid #EEEEEE; clear: both;";>
<h2>Respond</h2>
<?php echo $form->create('InviteeResponse',
array('action'=>'respond'));?> <?php echo $form->input('attending_status', array(
    		'options' => array("Yes Please","I'm not going make it","We'll See")
)); ?> <?php echo $form->hidden('identifier', array('value'=>$this->passedArgs[0])); ?>
<div class="input"><label for="message">Enter a message</label> <?php echo $form->textarea('message'); ?>
</div>
<?php echo $form->submit('Respond');?> <?php echo $form->end(); ?></div>



<?php echo $this->element('invitees',
array('invitees'=>$invitees, 'isUser'=>false)
); ?>