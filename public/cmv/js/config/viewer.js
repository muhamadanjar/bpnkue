define([
   'esri/units',
   'esri/geometry/Extent',
   'esri/config',
   'esri/tasks/GeometryService',
   'esri/layers/ImageParameters'
], function (units, Extent, esriConfig, GeometryService, ImageParameters) {

    // url to your proxy page, must be on same machine hosting you app. See proxy folder for readme.
    esriConfig.defaults.io.proxyUrl = 'proxy/proxy.ashx';
    esriConfig.defaults.io.alwaysUseProxy = false;
    // url to your geometry server.
    esriConfig.defaults.geometryService = new GeometryService('http://tasks.arcgisonline.com/ArcGIS/rest/services/Geometry/GeometryServer');

    //image parameters for dynamic services, set to png32 for higher quality exports.
    var imageParameters = new ImageParameters();
    imageParameters.format = 'png32';
    var CibinongEx = new Extent({
        xmin:106.820683941,
        ymin:-6.491017366,
        xmax:106.882385599,
        ymax:-6.436604068,
        spatialReference:{wkid:4326}
    });

    var kabupatenbogor = new Extent({
        xmin:11854886.2463439,
        ymin:-752236.7337139085,
        xmax:11919628.409301355,
        ymax:-715546.9601370738,
        spatialReference:{wkid:102100}
    });

    var KaltimEx = new Extent({
        xmin:12293782.886295728,
        ymin:-122751.5762906585,
        xmax:13757704.852013037,
        ymax:467953.7782970266,
        spatialReference:{wkid:102100}
    });

       

    return {
        // used for debugging your app
        isDebug: true,

        //default mapClick mode, mapClickMode lets widgets know what mode the map is in to avoid multipult map click actions from taking place (ie identify while drawing).
        defaultMapClickMode: 'identify',
        // map options, passed to map constructor. see: https://developers.arcgis.com/javascript/jsapi/map-amd.html#map1
        mapOptions: {
            basemap: 'streets',
            center: [106.0764884,-6.3252738],
            zoom: 12,
            sliderStyle: 'small',
            //extent: KaltimEx,
        },
        
        // panes: {
        // 	left: {
        // 		splitter: true
        // 	},
        // 	right: {
        // 		id: 'sidebarRight',
        // 		placeAt: 'outer',
        // 		region: 'right',
        // 		splitter: true,
        // 		collapsible: true
        // 	},
        // 	bottom: {
        // 		id: 'sidebarBottom',
        // 		placeAt: 'outer',
        // 		splitter: true,
        // 		collapsible: true,
        // 		region: 'bottom'
        // 	},
        // 	top: {
        // 		id: 'sidebarTop',
        // 		placeAt: 'outer',
        // 		collapsible: true,
        // 		splitter: true,
        // 		region: 'top'
        // 	}
        // },
        // collapseButtonsPane: 'center', //center or outer

        // operationalLayers: Array of Layers to load on top of the basemap: valid 'type' options: 'dynamic', 'tiled', 'feature'.
        // The 'options' object is passed as the layers options for constructor. Title will be used in the legend only. id's must be unique and have no spaces.
        // 3 'mode' options: MODE_SNAPSHOT = 0, MODE_ONDEMAND = 1, MODE_SELECTION = 2
        operationalLayers: op /*[
        
        {
            type: 'dynamic',
            url: 'http://silver-pc:6080/arcgis/rest/services/SIMPOSI/PETA_POTENSI_INVESTASI/MapServer',
            title: 'Potensi Investasi Kabupaten Bogor',
            options: {
                id: 'investasi',
                opacity: 1.0,
                visible: false,
                imageParameters: imageParameters
            },
           
            layerControlLayerInfos: {
                swipe: true,
                metadataUrl: true,
                expanded: false
            }
        },
        {
            type: 'dynamic',
            url: 'http://silver-pc:6080/arcgis/rest/services/SIMPOSI/PETA_DOKUMENTASI/MapServer',
            title: 'Dokumentasi Kabupaten Bogor',
            options: {
                id: 'dokumentasi',
                opacity: 1.0,
                visible: false,
                imageParameters: imageParameters
            },
           
            layerControlLayerInfos: {
                swipe: true,
                metadataUrl: true,
                expanded: false
            }
        },
        {
            type: 'dynamic',
            url: 'http://silver-pc:6080/arcgis/rest/services/SIMPOSI/PETA_SEBARAN_FASILITAS/MapServer',
            title: 'Sebaran Fasilitas',
            options: {
                id: 'sebaran_fasilitas',
                opacity: 1.0,
                visible: true,
                imageParameters: imageParameters
            },
           
            layerControlLayerInfos: {
                swipe: true,
                metadataUrl: true,
                expanded: false
            }
        },
        {
            type: 'dynamic',
            url: 'http://silver-pc:6080/arcgis/rest/services/SIMPOSI/PETA_RENCANA_TATA_RUANG_KAB_BOGOR/MapServer',
            title: 'Rencana Tata Ruang Kabupaten Bogor',
            options: {
                id: 'rencana_tataruang_kab_bogor',
                opacity: 1.0,
                visible: false,
                imageParameters: imageParameters
            },
           
            layerControlLayerInfos: {
                swipe: true,
                metadataUrl: true,
                expanded: false
            }
        },
        {
            type: 'dynamic',
            url: 'http://silver-pc:6080/arcgis/rest/services/SIMPOSI/PETA_PERIJINAN_KAB_BOGOR/MapServer',
            title: 'Perijinan Kabupaten Bogor',
            options: {
                id: 'perijinan',
                opacity: 1.0,
                visible: true,
                imageParameters: imageParameters
            },
           
            layerControlLayerInfos: {
                swipe: true,
                metadataUrl: true,
                expanded: false
            }
        },
        {
            type: 'dynamic',
            url: 'http://silver-pc:6080/arcgis/rest/services/SIMPOSI/PETA_KONDISI_FISIK_KAB_BOGOR/MapServer',
            title: 'Kondisi Fisik Kabupaten Bogor',
            options: {
                id: 'kondisi_fisik',
                opacity: 1.0,
                visible: false,
                imageParameters: imageParameters
            },
           
            layerControlLayerInfos: {
                swipe: true,
                metadataUrl: true,
                expanded: false
            }
        },
        {
            type: 'dynamic',
            url: 'http://silver-pc:6080/arcgis/rest/services/SIMPOSI/PETA_ANALISIS_KEMAMPUAN_LAHAN/MapServer',
            title: 'Analisis Kemampuan Kabupaten Bogor',
            options: {
                id: 'analisis_kemampuan',
                opacity: 1.0,
                visible: false,
                imageParameters: imageParameters
            },
           
            layerControlLayerInfos: {
                swipe: true,
                metadataUrl: true,
                expanded: false
            }
        },
        {
            type: 'dynamic',
            url: 'http://silver-pc:6080/arcgis/rest/services/SIMPOSI/PETA_ADMINISTRASI_KABUPATEN_BOGOR/MapServer',
            title: 'Administrasi Kabupaten Bogor',
            options: {
                id: 'administrasi',
                opacity: 1.0,
                visible: true,
                imageParameters: imageParameters
            },
           
            layerControlLayerInfos: {
                swipe: true,
                metadataUrl: true,
                expanded: true
            }
        }]*/,
        // set include:true to load. For titlePane type set position the the desired order in the sidebar
        widgets: {
            growler: {
                include: true,
                id: 'growler',
                type: 'domNode',
                path: 'gis/dijit/Growler',
                srcNodeRef: 'growlerDijit',
                options: {}
            },
            geocoder: {
                include: true,
                id: 'geocoder',
                type: 'domNode',
                path: 'gis/dijit/Geocoder',
                srcNodeRef: 'geocodeDijit',
                options: {
                    map: true,
                    mapRightClickMenu: true,
                    geocoderOptions: {
                        autoComplete: true,
                        arcgisGeocoder: {
                            placeholder: 'Enter an address or place'
                        }
                    }
                }
            },
            identify: {
                include: true,
                id: 'identify',
                type: 'titlePane',
                path: 'gis/dijit/Identify',
                title: 'Info',
                open: false,
             
                position: 3,
                options: 'config/identify'
            },
            basemaps: {
                include: true,
                id: 'basemaps',
                type: 'domNode',
                path: 'gis/dijit/Basemaps',
                srcNodeRef: 'basemapsDijit',
                options: 'config/basemaps'
            },
            mapInfo: {
                include: true,
                id: 'mapInfo',

                type: 'domNode',
                path: 'gis/dijit/MapInfo',
                srcNodeRef: 'mapInfoDijit',
                options: {
                    map: true,
                    mode: 'dms',
                    firstCoord: 'y',
                    unitScale: 3,
                    showScale: true,
                    xLabel: '',
                    yLabel: '',
                    minWidth: 286
                }
            },
            scalebar: {
                include: true,
                id: 'scalebar',
                type: 'map',
                path: 'esri/dijit/Scalebar',
                options: {
                    map: true,
                    attachTo: 'bottom-left',
                    scalebarStyle: 'line',
                    scalebarUnit: 'dual'
                }
            },
            locateButton: {
                include: true,
                id: 'locateButton',
                type: 'domNode',
                path: 'gis/dijit/LocateButton',
                srcNodeRef: 'locateButton',
                options: {
                    map: true,
                    publishGPSPosition: true,
                    highlightLocation: true,
                    useTracking: true,
                    geolocationOptions: {
                        maximumAge: 0,
                        timeout: 15000,
                        enableHighAccuracy: true
                    }
                }
            },
            overviewMap: {
                include: true,
                id: 'overviewMap',
                type: 'map',
                path: 'esri/dijit/OverviewMap',
                options: {
                    map: true,
                    attachTo: 'bottom-right',
                    color: '#0000CC',
                    height: 100,
                    width: 125,
                    opacity: 0.30,
                    visible: false
                }
            },
            homeButton: {
                include: false,
                id: 'homeButton',
                type: 'domNode',
                path: 'esri/dijit/HomeButton',
                srcNodeRef: 'homeButton',
                options: {
                    map: true,
                    extent: new Extent({
                        xmin: -180,
                        ymin: -85,
                        xmax: 180,
                        ymax: 85,
                        spatialReference: {
                            wkid: 4326
                        }
                    })
                }
            },
            legend: {
                include: true,
                id: 'legend',
                type: 'titlePane',
                path: 'esri/dijit/Legend',
                title: 'Legenda',
                
                open: false,
                position: 0,
                options: {
                    map: true,
                    legendLayerInfos: true
                }
            },
            layerControl: {
                include: true,
                id: 'layerControl',
                type: 'titlePane',
                path: 'gis/dijit/LayerControl',
                title: 'Daftar Layer',
                
                open: false,
                position: 0,
                options: {
                    map: true,
                    layerControlLayerInfos: true,
                    separated: true,
                    vectorReorder: true,
                    overlayReorder: true
                }
            },
            bookmarks: {
                include: false,
                id: 'bookmarks',
                type: 'titlePane',
                path: 'gis/dijit/Bookmarks',
                title: 'Bookmarks',
                
                open: false,
                position: 2,
                options: 'config/bookmarks'
            },
            find: {
                include: true,
                id: 'find',
                type: 'titlePane',
                canFloat: true,
                path: 'gis/dijit/Find',
                title: 'Query',
                
                open: false,
                position: 3,
                options: 'config/find'
            },
            findcoordinate: {
                include: false,
                id: 'findcoordinate',
                type: 'titlePane',
                canFloat: true,
                path: 'gis/dijit/FindCoordinate',
                title: 'Cari Kordinat',
                
                open: false,
                position: 3,
                options: 'config/findcoordinate'
            },
            draw: {
                include: false,
                id: 'draw',
                type: 'titlePane',
                
                canFloat: true,
                path: 'gis/dijit/Draw',
                title: 'Draw',
                open: false,
                position: 4,
                options: {
                    map: true,
                    mapClickMode: true
                }
            },
            measure: {
                include: true,
                id: 'measurement',
                type: 'titlePane',
                canFloat: true,
                
                path: 'gis/dijit/Measurement',
                title: 'Alat Ukur',
                open: false,
                position: 5,
                options: {
                    map: true,
                    mapClickMode: true,
                    defaultAreaUnit: units.SQUARE_MILES,
                    defaultLengthUnit: units.MILES
                }
            },
            print: {
                include: true,
                id: 'print',
                type: 'titlePane',
                canFloat: true,
                
                path: 'gis/dijit/Print',
                title: 'Cetak Peta',
                open: false,
                position: 6,
                options: {
                    map: true,
                    printTaskURL: 'https://utility.arcgisonline.com/arcgis/rest/services/Utilities/PrintingTools/GPServer/Export%20Web%20Map%20Task',
                    //printTaskURL: 'http://silver-pc:6080/arcgis/rest/services/SIMPOSI/ExportWebMap/GPServer/Export%20Web%20Map',
                    copyrightText: 'Copyright 2016',
                    authorText: 'SIMPOSI KAB BOGOR',
                    defaultTitle: 'Viewer Map',
                    defaultFormat: 'PDF',
                    defaultLayout: 'MAP_ONLY'
                }
            },
            directions: {
                include: false,
                id: 'directions',
                type: 'titlePane',
                
                path: 'gis/dijit/Directions',
                title: 'Directions',
                open: false,
                position: 7,
                options: {
                    map: true,
                    mapRightClickMenu: true,
                    options: {
                        routeTaskUrl: 'http://sampleserver3.arcgisonline.com/ArcGIS/rest/services/Network/USA/NAServer/Route',
                        routeParams: {
                            directionsLanguage: 'en-US',
                            directionsLengthUnits: units.MILES
                        },
                        active: false //for 3.12, starts active by default, which we dont want as it interfears with mapClickMode
                    }
                }
            },
            editor: {
                include: false,
                id: 'editor',
                type: 'titlePane',
                path: 'gis/dijit/Editor',
                title: 'Editor',
                
                open: false,
                position: 8,
                options: {
                    map: true,
                    mapClickMode: true,
                    editorLayerInfos: true,
                    settings: {
                        toolbarVisible: true,
                        showAttributesOnClick: true,
                        enableUndoRedo: true,
                        createOptions: {
                            polygonDrawTools: ['freehandpolygon', 'autocomplete']
                        },
                        toolbarOptions: {
                            reshapeVisible: true,
                            cutVisible: true,
                            mergeVisible: true
                        }
                    }
                }
            },
            streetview: {
                include: true,
                id: 'streetview',
                type: 'titlePane',
                canFloat: true,
                
                position: 9,
                path: 'gis/dijit/StreetView',
                title: 'Google Street View',
                options: {
                    map: true,
                    mapClickMode: true,
                    mapRightClickMenu: true
                }
            },
            help: {
                include: true,
                id: 'help',
                type: 'floating',
                path: 'gis/dijit/Help',
                title: 'Bantuan',
                options: {}
            }

        }
    };
});