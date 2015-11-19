




/*--------------------------Contact Map1-------------------------------------*/
function contact_map(coords1,coords2,id){
	
	function initialize_contact_map() {
		var map, marker;
		
		var image = {
		url: '_i/icons/icon_map.png'}
		
		


	
		var addr1 = new google.maps.LatLng(coords1, coords2);
		
		var styles = [
	  {
		stylers: [
		  { hue: "#ffffff" },
		  { saturation: -100,
		  lightness: 100}
		]
	  }
	];
	
	
    var center = new google.maps.LatLng(coords1, coords2);
    
    
    map = new google.maps.Map(document.getElementById(id), {
         zoom: 15,
         center: center,

         streetViewControl: false,
		 zoomControl: false,
		 panControl: false,
		 streetViewControl: false,
		 mapTypeControl: false
      
    });
    map.setOptions({styles: styles});
    marker = new google.maps.Marker({
        map: map,
        position: addr1,
        visible: true,
		icon:image
    });
	
	

	
}




google.maps.event.addDomListener(window, 'load', initialize_contact_map);

google.maps.event.addDomListener(window, "resize", function() {
    var center = map.getCenter();
    google.maps.event.trigger(map, "resize");
    map.setCenter(center); 
});

}






