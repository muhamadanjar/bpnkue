define({
   map: true,
   zoomExtentFactor: 2,
   queries: [
	   {
		   description: 'Jalan Bedasarkan Status',
		   url: 'http://silver-pc:6080/arcgis/rest/services/PANDEGLANG/Peta_Jaringan_Jalan/MapServer',
		   layerIds: [1],
		   searchFields: ['NAMA_RUAS'],
		   minChars: 2,

		   selectionMode: 'single'
	   },
	   {
		   description: 'POI Pandeglang',
		   url: 'http://silver-pc:6080/arcgis/rest/services/PANDEGLANG/POI_Pandeglang/MapServer',
		   layerIds: [0],
		   searchFields: ['NAME'],
		   minChars: 2,

		   selectionMode: 'single'
	   },
	   
   ],
   selectionSymbols: {
	   polygon: {
		   type   : 'esriSFS',
		   style  : 'esriSFSSolid',
		   color  : [255, 0, 0, 62],
		   outline: {
			   type : 'esriSLS',
			   style: 'esriSLSSolid',
			   color: [255, 0, 0, 255],
			   width: 3
		   }
	   },
	   point: {
		   type   : 'esriSMS',
		   style  : 'esriSMSCircle',
		   size   : 25,
		   color  : [255, 0, 0, 62],
		   angle  : 0,
		   xoffset: 0,
		   yoffset: 0,
		   outline: {
			   type : 'esriSLS',
			   style: 'esriSLSSolid',
			   color: [255, 0, 0, 255],
			   width: 2
		   }
	   }
   },
   selectionMode   : 'extended'
});