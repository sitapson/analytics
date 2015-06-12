
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>travellr.io</title>
		<!-- jquery -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script>
			$(function() {
			    $('#openpanel').click(function(){
		            $('#box').animate({'bottom':'0'},150);
		        });
			  
			    $('#close').click(function(){

			        $('#box').animate({'bottom': 0 - $("body").height() + 168 + "px"},150);

			    });
			});
		</script>
		<!-- foundation -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.1/css/foundation.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.1/js/foundation.min.js"></script>
		<!-- font awesome -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<!-- google maps -->
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
  

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 
 <!-- geo location -->
	<script>

	</script>

  <style type='text/css'>
	html, body{
	  height:100%;
	  margin: 0px;
	}
     #map {
       height: 100%;
       width: 100%;
     }
     #results {
       z-index:9999;
       position:absolute;
       width:200px;
       height:388px;
       background:#222;
       top:0;
       bottom:0;
       left:60px;
       right:0px;
       color:#ccc;
       overflow-y:scroll;
       font-size:.82em;
       padding:12px 5px;
       line-height:1.333;
       display: none;
     }
     .bar {
       color:green;
     }
     .restaurant {
       color:orange;
     }
     .cafe {
       color:brown;
     }
     .museum {
       color:white;
     }
     .night_club {
       color:black;
     }
  </style>
 <!-- query string -->
 <script>
 function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
 </script>


<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){

	    $("#searchForm").submit(function(event) {
	        event.preventDefault();
	        var term = document.getElementById('searchInput').value;
	        window.location.href = window.location.pathname + '?search=' + term;
	    });

		if (navigator.geolocation) {
			var timeoutVal = 10 * 1000 * 1000;
			navigator.geolocation.getCurrentPosition(
				displayPosition, 
				displayError,
				{ enableHighAccuracy: true, timeout: timeoutVal, maximumAge: 0 }
			);
		}
		else {
			alert("Geolocation is not supported by this browser");
		}
		function displayPosition(position) {
			var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			console.log(pos);
			var lat = (pos["A"]);
			var lon = (pos["F"]);
			tryMap(lat, lon);
		}
		function displayError(error) {
			var errors = { 
				1: 'Permission denied',
				2: 'Position unavailable',
				3: 'Request timeout'
			};
			alert("Error: " + errors[error.code]);
		}
		function parseTimestamp(timestamp) {
			var d = new Date(timestamp);
			var day = d.getDate();
			var month = d.getMonth() + 1;
			var year = d.getFullYear();
			var hour = d.getHours();
			var mins = d.getMinutes();
			var secs = d.getSeconds();
			var msec = d.getMilliseconds();
			return day + "." + month + "." + year + " " + hour + ":" + mins + ":" + secs + "," + msec;
		}


    var map;
    var infowindow;

    function tryMap(lat, lon) {
    	console.log('lat:'+lat);
    	console.log('lon:'+lon);
      var styles = [
    {
        "featureType": "all",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#898989"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#444444"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "administrative.locality",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative.locality",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "administrative.locality",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#a3a3a3"
            }
        ]
    },
    {
        "featureType": "administrative.neighborhood",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.neighborhood",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "visibility": "off"
            },
            {
                "color": "#c2c2c2"
            }
        ]
    },
    {
        "featureType": "administrative.land_parcel",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.land_parcel",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.land_parcel",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "color": "#f2f2f2"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "lightness": "28"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": "59"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "color": "#46bcec"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#f3faff"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text",
        "stylers": [
            {
                "color": "#b5b5b5"
            },
            {
                "visibility": "simplified"
            }
        ]
    }
]

      var styledMap = new google.maps.StyledMapType(styles, {
        name: "Styled Map"
      });

      var pos = new google.maps.LatLng(lat, lon);
      var center = new google.maps.LatLng(lat, lon);

      map = new google.maps.Map(document.getElementById('map'), {
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: center,
        zoom: 12,
        streetViewControl: false,
        panControl: false,
        zoomControlOptions: {
          style: google.maps.ZoomControlStyle.SMALL
        },
        mapTypeControlOptions: {
          mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
        }
      });
      var image = 'https://developers.google.com/maps/documentation/javascript/examples/images/beachflag.png';
      marker = new google.maps.Marker({
        map: map,
        animation: google.maps.Animation.DROP,
        position: pos,
        icon: image
      });

var search_term = getParameterByName('search');

     var newPos = new google.maps.LatLng(lat, lon);
      var request = {
        location: pos,
        radius: 10000,
        keyword: search_term
      };
      infowindow = new google.maps.InfoWindow();
      var service = new google.maps.places.PlacesService(map);
      service.nearbySearch(request, callback);

      map.mapTypes.set('map_style', styledMap);
      map.setMapTypeId('map_style');
    }


    function callback(results, status) {
      if (status == google.maps.places.PlacesServiceStatus.OK) {
        for (var i = 0; i < results.length; i++) {
          createMarker(results[i]);
        }
      }
    }

    function createMarker(place) {
      var specific_icon;
      var black_marker = 'http://i.imgur.com/1dUZy7D.png';
      var blue_marker = 'http://i.imgur.com/5brRGlX.png';
      var green_marker = 'http://i.imgur.com/bGiOCif.png';
      var orange_marker = 'http://i.imgur.com/5gm14kD.png';
      var purple_marker = 'http://i.imgur.com/nQ4YHB8.png';
      var red_marker= 'http://i.imgur.com/fncQLus.png';

      switch (true) {
        case (place.types.indexOf('bar') != -1):
          specific_icon = orange_marker;
          break;
        case (place.types.indexOf('restaurant') != -1):
          specific_icon = red_marker;
          break;
        case (place.types.indexOf('cafe') != -1):
          specific_icon = green_marker;
          break;
        case (place.types.indexOf('museum') != -1):
          specific_icon = blue_marker;
          break;
        case (place.types.indexOf('night_club') != -1):
          specific_icon = black_marker;
          break;
        case (place.types.indexOf('pub') != -1):
          specific_icon = purple_marker;
          break;
		default:
		  specific_icon = blue_marker;
      }

      var placeLoc = place.geometry.location;
      var marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location,
        icon: specific_icon
      });

      placesList = document.getElementById('results');

      placesList.innerHTML += '<p class="' + place.types[0] + '">' + place.name + '</p>';
      
 

      totalSchool = $('.school').size();
      $('#school').text('Schools: ' + totalSchool);
      totalFood = $('.restaurants').size();
      $('#food').text('Restaurants: ' + totalFood);
      totalParks = $('.park').size();
      $('#park').text('Parks: ' + totalParks);

      google.maps.event.addListener(marker, 'click', function () {
        infowindow.setContent(place.name);
        infowindow.open(map, this);

      });
    }
});//]]>  

</script>
	    <!-- custom js -->
	    <script>
	    	//------------ Doc ready wait ------------//
			$( document ).ready(function() {
				runtime();
			});
			//------------ DOM Handling Classes ------------//
			function hasClass(el, name) {
			    return new RegExp('(\\s|^)' + name + '(\\s|$)').test(el.className);
			}

			function hasClassContainsString(el, name) {
			    return new RegExp(name).test(el.className);
			}

			function addClass(el, name) {
			    if (!hasClass(el, name)) {
			        el.className += (el.className ? ' ' : '') + name;
			    }
			}

			function removeClass(el, name) {
			    if (hasClass(el, name)) {
			        el.className = el.className.replace(new RegExp('(\\s|^)' + name + '(\\s|$)'), ' ').replace(/^\s+|\s+$/g, '');
			    }
			}
			function closest(el, fn) {
			    return el && (
			        fn(el) ? el : closest(el.parentNode, fn)
			    );
			}
			function findParentNode(el, att, val) {
			    var objj = el.parentNode;
			    var count = 1;
			    while(objj.getAttribute(att) != val) {
			        console.log(count + '-' + objj.getAttribute(att));
			        objj = objj.parentNode;
			        count++;
			    }
			    return objj;
			}
			//------------ Runtime ------------//
	    	function runtime() {
		    	var navButtons = document.getElementsByClassName("nav-button");
		    	console.log(navButtons);
		    	console.log(navButtons.length);
				for (var i = 0; i < navButtons.length; i++) {
				    navButtons[i].addEventListener("click", makeActive);
				}
				function makeActive(i) {
					for (var i = 0; i < navButtons.length; i++) {
					    removeClass(navButtons[i], "nav-active");
					}
					addClass(this, "nav-active");
				}
			}
	    </script>
	    <!-- custom css -->
		<style>
			.nav {
				width: 100%;
				height:100%;
				background-color: #ddd;
				position:fixed;
				bottom:-100%;
				bottom:calc(-100% + 168px);
				display: block;
				z-index:999999;
			}
			#map-canvas {
				width: 100%;
				height: 100%;
			}
			#frame {
				width: 100%;
				height: 100%;
				background-color: #eee;
			}

			.nav-row {
				width:100%;
				height: 84px;
				border-style: solid;
				border-width: 0 0 1px 0 !important;
				border-color: #eee;
			}
			.nav-element {
				font-size: 4em;
				padding: 10px;
				color: #bbb;
				background-color: #ccc;
			}
			.nav-active {
				background-color: #ddd;
				color: #bbb;
			}
			.nav-content {
				text-align: center;
				vertical-align: middle;
				line-height: 50px;       /* the same as your div height */
			}
			.nav-border {
				border-style: solid;
				border-width: 0 1px 0 0 !important;
				border-color: #eee;
			}
			::-webkit-input-placeholder { /* WebKit browsers */
			    color:    #ddd;
			}
			:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
			   color:    #ddd;
			   opacity:  1;
			}
			::-moz-placeholder { /* Mozilla Firefox 19+ */
			   color:    #ddd;
			   opacity:  1;
			}
			:-ms-input-placeholder { /* Internet Explorer 10+ */
			   color:    #ddd;
			}
    html, body{
      height:100%;
      margin: 0px;
    }
     #map-canvas {
       height: 100%;
       width: 100%;
     }
     #results {
       z-index:9999;
       position:absolute;
       width:200px;
       height:388px;
       background:#222;
       top:0;
       bottom:0;
       left:60px;
       right:0px;
       color:#ccc;
       overflow-y:scroll;
       font-size:.82em;
       padding:12px 5px;
       line-height:1.333;
       display: none;
     }
     .bar {
       color:green;
     }
     .restaurant {
       color:orange;
     }
     .cafe {
       color:brown;
     }
     .museum {
       color:white;
     }
     .night_club {
       color:black;
     }
		</style>

</head>
<body>
  <!DOCTYPE html>
<html>
  
  <head>
    <meta charset="utf-8">
    <title>Google Maps JavaScript API v3 Example: Place Search</title>
  </head>
  
  <body>
    <div id="map"></div>
    <div id="results"></div>
    <div id="school"></div>
    <div id="food"></div>
    <div id="park"></div>
			<div class="nav" id="box">
				<div class="nav-row row">
					<div class="small-3 columns nav-element nav-border nav-content nav-button">
						<i class="fa fa-globe fa-3"></i>
					</div>
					<div class="small-3 columns nav-element nav-active nav-border nav-content nav-button">
						<i class="fa fa-search fa-3"></i>
					</div>
					<div class="small-3 columns nav-element nav-border nav-content">
						<i class="fa fa-3" id="close">X</i>
					</div>
					<div class="small-3 columns nav-content nav-element nav-button">
						<a id="openpanel"><i class="fa fa-cog fa-3"></i></a>
					</div>
				</div>
				<div class="nav-row row">
					<div class="small-12 columns nav-element nav-active nav-content" style="color: #fff !important;">


						<script type="text/javascript">
						</script>
						<form id="searchForm">
							<input id="searchInput" type="text" style="border-width: 0px; box-shadow: inset 0 0px 0px rgba(0, 0, 0, 0); height: 64px; font-size: .5em; font-weight: lighter;" placeholder="Find a new location"></input>
						</form>
							

					</div>
				</div>
			</div>
  </body>

</html>
  
</body>


</html>

