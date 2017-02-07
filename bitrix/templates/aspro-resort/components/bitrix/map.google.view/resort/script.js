if (!window.BX_GMapAddPlacemark)
{
	window.BX_GMapAddPlacemark = function(arPlacemark, map_id, path)
	{

		var map = GLOBAL_arMapObjects[map_id];
		
		if (null == map)
			return false;

		if(!arPlacemark.LAT || !arPlacemark.LON)
			return false;

		var root = path+'/images/marker.png';
				
		var image = new google.maps.MarkerImage(
			root,
			new google.maps.Size(64, 80),
			new google.maps.Point(0,0),
			new google.maps.Point(32,40)
		);
		
		var obPlacemark = new google.maps.Marker({
			'position': new google.maps.LatLng(arPlacemark.LAT, arPlacemark.LON),
			'map': map,
			'icon': image
		});
		
		if (BX.type.isNotEmptyString(arPlacemark.TEXT))
		{
			obPlacemark.infowin = new google.maps.InfoWindow({
				content: arPlacemark.TEXT.replace(/\n/g, '<br />')
			});
			
			google.maps.event.addListener(obPlacemark, 'click', function() {
				if (null != window['__bx_google_infowin_opened_' + map_id])
					window['__bx_google_infowin_opened_' + map_id].close();

				this.infowin.open(this.map, this);
				window['__bx_google_infowin_opened_' + map_id] = this.infowin;
			});
		}

		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				var root = path+'/images/my_marker.png';
				var image = new google.maps.MarkerImage( root,
					new google.maps.Size(64, 80),
					new google.maps.Point(0, 0),
					new google.maps.Point(32, 40)
				);
				
				obPlacemark.push = new google.maps.Marker({
					'position': new google.maps.LatLng(pos.lat, pos.lng),
					'map': map,
					'icon': image
				});
				
				directionsDisplay = new google.maps.DirectionsRenderer();
				directionsService = new google.maps.DirectionsService();
				
				var request = {
					origin: new google.maps.LatLng(pos),
					destination: new google.maps.LatLng(arPlacemark.LAT,arPlacemark.LON),
					travelMode: google.maps.DirectionsTravelMode.DRIVING,
				};
				
				directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						directionsDisplay.setDirections(response);
					}
				});
				
				directionsDisplay.setMap(map);
				directionsDisplay.setOptions({suppressMarkers: true, preserveViewport: true});
				
				var zoomLevel;
				var latDiff = pos.lat - arPlacemark.LAT;
				var lngDiff = pos.lng - arPlacemark.LON;

				var maxDiff = (Math.abs(lngDiff) > Math.abs(latDiff)) ? Math.abs(lngDiff) : Math.abs(latDiff);
				if (maxDiff < 360 / Math.pow(2, 20)) {
					zoomLevel = 21;
				} else {
					zoomLevel = Math.floor(-1*( (Math.log(maxDiff)/Math.log(2)) - (Math.log(360)/Math.log(2))));

					if (zoomLevel < 1)
						zoomLevel = 1;
				}
				map.setZoom(zoomLevel);
				
				if (latDiff > 0) {
					var mapCenterLAT = pos.lat - Math.abs(latDiff)/2;
				}else{
					var mapCenterLAT = pos.lat + Math.abs(latDiff)/2;
				}
				
				if (lngDiff > 0) {
					var mapCenterLON = pos.lng - Math.abs(lngDiff)/2;
				}else{
					var mapCenterLON = pos.lng + Math.abs(lngDiff)/2;
				}
				map.setCenter(new google.maps.LatLng(mapCenterLAT,mapCenterLON));
				//map.setCenter(pos);
			});

		}
		return obPlacemark;
	}
}

if (null == window.BXWaitForMap_view)
{
	function BXWaitForMap_view(map_id)
	{
		if (null == window.GLOBAL_arMapObjects)
			return;
	
		if (window.GLOBAL_arMapObjects[map_id])
			window['BX_SetPlacemarks_' + map_id]();
		else
			setTimeout('BXWaitForMap_view(\'' + map_id + '\')', 300);
	}
}