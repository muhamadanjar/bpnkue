/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

eval("var map;\r\nvar markers = [];\r\nvar polyline;\r\nvar id = \"points\";\r\n\r\nfunction showPolyline() {\r\n    if (polyline) {\r\n        polyline.setMap(null);\r\n    }\r\n    var path = [];\r\n    for (var i = 0; i < markers.length; i++) {\r\n        var latlng = markers[i].getPosition();\r\n        path.push(latlng);\r\n        markers[i].setTitle(\"#\" + i + \": \" + latlng.toUrlValue());\r\n    }\r\n    polyline = new google.maps.Polyline({\r\n            map: map,\r\n            path: path,\r\n            strokeColor: \"#0000FF\",\r\n            strokeOpacity: 0.5,\r\n            strokeWeight: 8,\r\n        });\r\n}\r\n\r\nfunction clearMarkers() {\r\n    for (var i = 0; i < markers.length; i++) {\r\n        markers[i].setMap(null);\r\n    }\r\n    markers = [];\r\n    showPolyline();\r\n}\r\n\r\nfunction getMarkerIndex(marker) {\r\n    for (var i = 0; i < markers.length; i++) {\r\n        if (marker == markers[i]) {\r\n            return i;\r\n        }\r\n    }\r\n    return -1;\r\n}\r\n\r\nfunction addMarker(latlng, i) {\r\n    var marker = new google.maps.Marker({\r\n            map: map,\r\n            position: latlng,\r\n            draggable: true,\r\n        });\r\n    /*\r\n    google.maps.event.addListener(marker, 'click', function() {\r\n            var infoWindow = new google.maps.InfoWindow({\r\n                    content: marker.getPosition().toUrlValue(),\r\n                });\r\n            infoWindow.open(map, marker);\r\n        });\r\n    */\r\n    google.maps.event.addListener(marker, 'dragend', function(event) {\r\n            showPolyline();\r\n            displayMarkers();\r\n        });\r\n    google.maps.event.addListener(marker, 'rightclick', function(event) {\r\n            removeMarker(marker);\r\n            showPolyline();\r\n            displayMarkers();\r\n        });\r\n    google.maps.event.addListener(marker, 'dblclick', function(event) {\r\n            var i = getMarkerIndex(marker);\r\n            if (i > 0 && i == markers.length - 1) {\r\n                i--;\r\n            }\r\n            if (i < markers.length - 1) {\r\n                var lat0 = markers[i].getPosition().lat();\r\n                var lng0 = markers[i].getPosition().lng();\r\n                var lat1 = markers[i+1].getPosition().lat();\r\n                var lng1 = markers[i+1].getPosition().lng();\r\n                var latlng = new google.maps.LatLng((lat0+lat1)/2, (lng0+lng1)/2);\r\n                addMarker(latlng, i+1);\r\n            }\r\n        });\r\n    if (i == null || i >= markers.length) {\r\n        markers.push(marker);\r\n    } else {\r\n        markers.splice(i, 0, marker);\r\n    }\r\n    showPolyline();\r\n}\r\n\r\nfunction removeMarker(marker) {\r\n    var i = getMarkerIndex(marker);\r\n    marker.setMap(null);\r\n    markers.splice(i, 1);\r\n    showPolyline();\r\n}\r\n\r\nfunction displayMarkers() {\r\n    var txt = document.getElementById(id);\r\n    txt.value = \"\";\r\n    for (var i = 0; i < markers.length; i++) {\r\n        var latlng = markers[i].getPosition();\r\n        txt.value += latlng.toUrlValue() + \",\\n\";\r\n    }\r\n}\r\n\r\nfunction setMarkers() {\r\n    var txt = document.getElementById(id);\r\n    var lines = txt.value.split(/\\n/);\r\n    clearMarkers();\r\n    for (var i in lines) {\r\n        var ps = lines[i].split(/,/);\r\n        if (ps.length >= 2) {\r\n            var latlng = new google.maps.LatLng(ps[0], ps[1]);\r\n            addMarker(latlng);\r\n        }\r\n    }\r\n    displayMarkers();\r\n    if (markers.length > 0) {\r\n        map.setCenter(markers[0].getPosition());\r\n    }\r\n}\r\n\r\nfunction initialize(canvasName) {\r\n    map = new google.maps.Map(document.getElementById(canvasName), {\r\n            mapTypeId: google.maps.MapTypeId.ROADMAP,\r\n        });\r\n    google.maps.event.addListener(map, 'click', function(event) {\r\n            addMarker(event.latLng);\r\n            displayMarkers();\r\n        });\r\n}\r\nfunction load() {\r\n    initialize('map_canvas');\r\n    var latlng = new google.maps.LatLng(34.725737, 135.235871);\r\n    map.setCenter(latlng);\r\n    map.setZoom(5);\r\n}//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL21hcC1lZGl0b3IuanM/N2YyYSJdLCJzb3VyY2VzQ29udGVudCI6WyJ2YXIgbWFwO1xyXG52YXIgbWFya2VycyA9IFtdO1xyXG52YXIgcG9seWxpbmU7XHJcbnZhciBpZCA9IFwicG9pbnRzXCI7XHJcblxyXG5mdW5jdGlvbiBzaG93UG9seWxpbmUoKSB7XHJcbiAgICBpZiAocG9seWxpbmUpIHtcclxuICAgICAgICBwb2x5bGluZS5zZXRNYXAobnVsbCk7XHJcbiAgICB9XHJcbiAgICB2YXIgcGF0aCA9IFtdO1xyXG4gICAgZm9yICh2YXIgaSA9IDA7IGkgPCBtYXJrZXJzLmxlbmd0aDsgaSsrKSB7XHJcbiAgICAgICAgdmFyIGxhdGxuZyA9IG1hcmtlcnNbaV0uZ2V0UG9zaXRpb24oKTtcclxuICAgICAgICBwYXRoLnB1c2gobGF0bG5nKTtcclxuICAgICAgICBtYXJrZXJzW2ldLnNldFRpdGxlKFwiI1wiICsgaSArIFwiOiBcIiArIGxhdGxuZy50b1VybFZhbHVlKCkpO1xyXG4gICAgfVxyXG4gICAgcG9seWxpbmUgPSBuZXcgZ29vZ2xlLm1hcHMuUG9seWxpbmUoe1xyXG4gICAgICAgICAgICBtYXA6IG1hcCxcclxuICAgICAgICAgICAgcGF0aDogcGF0aCxcclxuICAgICAgICAgICAgc3Ryb2tlQ29sb3I6IFwiIzAwMDBGRlwiLFxyXG4gICAgICAgICAgICBzdHJva2VPcGFjaXR5OiAwLjUsXHJcbiAgICAgICAgICAgIHN0cm9rZVdlaWdodDogOCxcclxuICAgICAgICB9KTtcclxufVxyXG5cclxuZnVuY3Rpb24gY2xlYXJNYXJrZXJzKCkge1xyXG4gICAgZm9yICh2YXIgaSA9IDA7IGkgPCBtYXJrZXJzLmxlbmd0aDsgaSsrKSB7XHJcbiAgICAgICAgbWFya2Vyc1tpXS5zZXRNYXAobnVsbCk7XHJcbiAgICB9XHJcbiAgICBtYXJrZXJzID0gW107XHJcbiAgICBzaG93UG9seWxpbmUoKTtcclxufVxyXG5cclxuZnVuY3Rpb24gZ2V0TWFya2VySW5kZXgobWFya2VyKSB7XHJcbiAgICBmb3IgKHZhciBpID0gMDsgaSA8IG1hcmtlcnMubGVuZ3RoOyBpKyspIHtcclxuICAgICAgICBpZiAobWFya2VyID09IG1hcmtlcnNbaV0pIHtcclxuICAgICAgICAgICAgcmV0dXJuIGk7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgcmV0dXJuIC0xO1xyXG59XHJcblxyXG5mdW5jdGlvbiBhZGRNYXJrZXIobGF0bG5nLCBpKSB7XHJcbiAgICB2YXIgbWFya2VyID0gbmV3IGdvb2dsZS5tYXBzLk1hcmtlcih7XHJcbiAgICAgICAgICAgIG1hcDogbWFwLFxyXG4gICAgICAgICAgICBwb3NpdGlvbjogbGF0bG5nLFxyXG4gICAgICAgICAgICBkcmFnZ2FibGU6IHRydWUsXHJcbiAgICAgICAgfSk7XHJcbiAgICAvKlxyXG4gICAgZ29vZ2xlLm1hcHMuZXZlbnQuYWRkTGlzdGVuZXIobWFya2VyLCAnY2xpY2snLCBmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgdmFyIGluZm9XaW5kb3cgPSBuZXcgZ29vZ2xlLm1hcHMuSW5mb1dpbmRvdyh7XHJcbiAgICAgICAgICAgICAgICAgICAgY29udGVudDogbWFya2VyLmdldFBvc2l0aW9uKCkudG9VcmxWYWx1ZSgpLFxyXG4gICAgICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgICAgIGluZm9XaW5kb3cub3BlbihtYXAsIG1hcmtlcik7XHJcbiAgICAgICAgfSk7XHJcbiAgICAqL1xyXG4gICAgZ29vZ2xlLm1hcHMuZXZlbnQuYWRkTGlzdGVuZXIobWFya2VyLCAnZHJhZ2VuZCcsIGZ1bmN0aW9uKGV2ZW50KSB7XHJcbiAgICAgICAgICAgIHNob3dQb2x5bGluZSgpO1xyXG4gICAgICAgICAgICBkaXNwbGF5TWFya2VycygpO1xyXG4gICAgICAgIH0pO1xyXG4gICAgZ29vZ2xlLm1hcHMuZXZlbnQuYWRkTGlzdGVuZXIobWFya2VyLCAncmlnaHRjbGljaycsIGZ1bmN0aW9uKGV2ZW50KSB7XHJcbiAgICAgICAgICAgIHJlbW92ZU1hcmtlcihtYXJrZXIpO1xyXG4gICAgICAgICAgICBzaG93UG9seWxpbmUoKTtcclxuICAgICAgICAgICAgZGlzcGxheU1hcmtlcnMoKTtcclxuICAgICAgICB9KTtcclxuICAgIGdvb2dsZS5tYXBzLmV2ZW50LmFkZExpc3RlbmVyKG1hcmtlciwgJ2RibGNsaWNrJywgZnVuY3Rpb24oZXZlbnQpIHtcclxuICAgICAgICAgICAgdmFyIGkgPSBnZXRNYXJrZXJJbmRleChtYXJrZXIpO1xyXG4gICAgICAgICAgICBpZiAoaSA+IDAgJiYgaSA9PSBtYXJrZXJzLmxlbmd0aCAtIDEpIHtcclxuICAgICAgICAgICAgICAgIGktLTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBpZiAoaSA8IG1hcmtlcnMubGVuZ3RoIC0gMSkge1xyXG4gICAgICAgICAgICAgICAgdmFyIGxhdDAgPSBtYXJrZXJzW2ldLmdldFBvc2l0aW9uKCkubGF0KCk7XHJcbiAgICAgICAgICAgICAgICB2YXIgbG5nMCA9IG1hcmtlcnNbaV0uZ2V0UG9zaXRpb24oKS5sbmcoKTtcclxuICAgICAgICAgICAgICAgIHZhciBsYXQxID0gbWFya2Vyc1tpKzFdLmdldFBvc2l0aW9uKCkubGF0KCk7XHJcbiAgICAgICAgICAgICAgICB2YXIgbG5nMSA9IG1hcmtlcnNbaSsxXS5nZXRQb3NpdGlvbigpLmxuZygpO1xyXG4gICAgICAgICAgICAgICAgdmFyIGxhdGxuZyA9IG5ldyBnb29nbGUubWFwcy5MYXRMbmcoKGxhdDArbGF0MSkvMiwgKGxuZzArbG5nMSkvMik7XHJcbiAgICAgICAgICAgICAgICBhZGRNYXJrZXIobGF0bG5nLCBpKzEpO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbiAgICBpZiAoaSA9PSBudWxsIHx8IGkgPj0gbWFya2Vycy5sZW5ndGgpIHtcclxuICAgICAgICBtYXJrZXJzLnB1c2gobWFya2VyKTtcclxuICAgIH0gZWxzZSB7XHJcbiAgICAgICAgbWFya2Vycy5zcGxpY2UoaSwgMCwgbWFya2VyKTtcclxuICAgIH1cclxuICAgIHNob3dQb2x5bGluZSgpO1xyXG59XHJcblxyXG5mdW5jdGlvbiByZW1vdmVNYXJrZXIobWFya2VyKSB7XHJcbiAgICB2YXIgaSA9IGdldE1hcmtlckluZGV4KG1hcmtlcik7XHJcbiAgICBtYXJrZXIuc2V0TWFwKG51bGwpO1xyXG4gICAgbWFya2Vycy5zcGxpY2UoaSwgMSk7XHJcbiAgICBzaG93UG9seWxpbmUoKTtcclxufVxyXG5cclxuZnVuY3Rpb24gZGlzcGxheU1hcmtlcnMoKSB7XHJcbiAgICB2YXIgdHh0ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoaWQpO1xyXG4gICAgdHh0LnZhbHVlID0gXCJcIjtcclxuICAgIGZvciAodmFyIGkgPSAwOyBpIDwgbWFya2Vycy5sZW5ndGg7IGkrKykge1xyXG4gICAgICAgIHZhciBsYXRsbmcgPSBtYXJrZXJzW2ldLmdldFBvc2l0aW9uKCk7XHJcbiAgICAgICAgdHh0LnZhbHVlICs9IGxhdGxuZy50b1VybFZhbHVlKCkgKyBcIixcXG5cIjtcclxuICAgIH1cclxufVxyXG5cclxuZnVuY3Rpb24gc2V0TWFya2VycygpIHtcclxuICAgIHZhciB0eHQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChpZCk7XHJcbiAgICB2YXIgbGluZXMgPSB0eHQudmFsdWUuc3BsaXQoL1xcbi8pO1xyXG4gICAgY2xlYXJNYXJrZXJzKCk7XHJcbiAgICBmb3IgKHZhciBpIGluIGxpbmVzKSB7XHJcbiAgICAgICAgdmFyIHBzID0gbGluZXNbaV0uc3BsaXQoLywvKTtcclxuICAgICAgICBpZiAocHMubGVuZ3RoID49IDIpIHtcclxuICAgICAgICAgICAgdmFyIGxhdGxuZyA9IG5ldyBnb29nbGUubWFwcy5MYXRMbmcocHNbMF0sIHBzWzFdKTtcclxuICAgICAgICAgICAgYWRkTWFya2VyKGxhdGxuZyk7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgZGlzcGxheU1hcmtlcnMoKTtcclxuICAgIGlmIChtYXJrZXJzLmxlbmd0aCA+IDApIHtcclxuICAgICAgICBtYXAuc2V0Q2VudGVyKG1hcmtlcnNbMF0uZ2V0UG9zaXRpb24oKSk7XHJcbiAgICB9XHJcbn1cclxuXHJcbmZ1bmN0aW9uIGluaXRpYWxpemUoY2FudmFzTmFtZSkge1xyXG4gICAgbWFwID0gbmV3IGdvb2dsZS5tYXBzLk1hcChkb2N1bWVudC5nZXRFbGVtZW50QnlJZChjYW52YXNOYW1lKSwge1xyXG4gICAgICAgICAgICBtYXBUeXBlSWQ6IGdvb2dsZS5tYXBzLk1hcFR5cGVJZC5ST0FETUFQLFxyXG4gICAgICAgIH0pO1xyXG4gICAgZ29vZ2xlLm1hcHMuZXZlbnQuYWRkTGlzdGVuZXIobWFwLCAnY2xpY2snLCBmdW5jdGlvbihldmVudCkge1xyXG4gICAgICAgICAgICBhZGRNYXJrZXIoZXZlbnQubGF0TG5nKTtcclxuICAgICAgICAgICAgZGlzcGxheU1hcmtlcnMoKTtcclxuICAgICAgICB9KTtcclxufVxyXG5mdW5jdGlvbiBsb2FkKCkge1xyXG4gICAgaW5pdGlhbGl6ZSgnbWFwX2NhbnZhcycpO1xyXG4gICAgdmFyIGxhdGxuZyA9IG5ldyBnb29nbGUubWFwcy5MYXRMbmcoMzQuNzI1NzM3LCAxMzUuMjM1ODcxKTtcclxuICAgIG1hcC5zZXRDZW50ZXIobGF0bG5nKTtcclxuICAgIG1hcC5zZXRab29tKDUpO1xyXG59XG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvbWFwLWVkaXRvci5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7Ozs7Ozs7O0FBU0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOyIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ }
/******/ ]);