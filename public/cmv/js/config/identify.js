define({
	map: true,
	mapClickMode: true,
	mapRightClickMenu: true,
	identifyLayerInfos: true,
	identifyTolerance: 5,

	// config object definition:
	//	{<layer id>:{
	//		<sub layer number>:{
	//			<pop-up definition, see link below>
	//			}
	//		},
	//	<layer id>:{
	//		<sub layer number>:{
	//			<pop-up definition, see link below>
	//			}
	//		}
	//	}

	// for details on pop-up definition see: https://developers.arcgis.com/javascript/jshelp/intro_popuptemplate.html

	identifies: idn /*{
		
		ilok:{
			0:{
				title: 'Ilok Kabupaten Bogor',
				fieldInfos: [{
					fieldName: 'NAMA_PEMOHON',
					label: 'Nama Pemohon',
					visible: true
				},{
					fieldName: 'NAMA_PERUSAHAAN',
					label: 'Nama Perusahaan',
					visible: true
				},{
					fieldName: 'REGISTER',
					label: 'Register',
					visible: true
				},{
					fieldName: 'KEGIATAN',
					label: 'Kegiatan',
					visible: true
				},{
					fieldName: 'PERUNTUKAN',
					label: 'Peruntukan',
					visible: true
				},{
					fieldName: 'LUAS_M2',
					label: 'Luas (M2)',
					visible: true
				},{
					fieldName: 'ALAMAT_DESA',
					label: 'Alamat Desa',
					visible: true
				},{
					fieldName: 'ALAMAT_KECAMATAN',
					label: 'Alamat Kecamatan',
					visible: true
				},{
					fieldName: 'NOMOR_SK',
					label: 'Nomor SK',
					visible: true
				},{
					fieldName: 'TANGGAL_SK_TERBIT',
					label: 'Tanggal SK Terbit',
					visible: true
				},{
					fieldName: 'TAHUN_1',
					label: 'Tahun',
					visible: true
				}],
			}
		},
		meetupHometowns: {
			0: {
				title: 'Hometowns',
				fieldInfos: [{
					fieldName: 'Location',
					visible: true
				}]
			}
		},
		louisvillePubSafety: {
			2: {
				title: 'Police Station',
				fieldInfos: [{
					fieldName: 'Name',
					visible: true
				}, {
					fieldName: 'Address',
					visible: true
				}, {
					fieldName: 'Type',
					visible: true
				}, {
					fieldName: 'Police Function',
					visible: true
				}, {
					fieldName: 'Last Update Date',
					visible: true
				}]
			},
			8: {
				title: 'Traffic Camera',
				description: '{Description} lasted updated: {Last Update Date}',
				mediaInfos: [{
					title: '',
					caption: '',
					type: 'image',
					value: {
						sourceURL: '{Location URL}',
						linkURL: '{Location URL}'
					}
				},
				{
					type: "piechart",
					value: {
				  		fields: ["AGE_UNDER5", "AGE_5_17", "AGE_18_21", "AGE_22_29"],
				  		theme: "Julie"
					}
			  	}]
			}
		},
		jenistanah:{
			0: {
				title: 'Jenis Tanah',
				fieldInfos: [{
					fieldName: 'Jenis_Tanah',
					label: 'Jenis Tanah',
					visible: true
				},{
					fieldName: 'Luas_Lahan_KM',
					visible: true
				}]	
			}
		},
		fasilitas:{
			0: {
				title: 'Fasilitas',
				fieldInfos: [{
					fieldName: 'POI_NAMA',
					label: 'Nama Poi',
					visible: true
				},{
					fieldName: 'NAMA_JALAN',
					label: 'Nama Jalan',
					visible: true
				},{
					fieldName: 'FASILITAS',
					label: 'Fasilitas',
					visible: true
				}]	
			}
		},
		geologi:{
			0: {
				title: 'Fasilitas',
				fieldInfos: [{
					fieldName: 'Formasi_Geologi',
					label: 'Formasi Geologi',
					visible: true
				},{
					fieldName: 'Luas_Lahan_KM',
					visible: true
				}]	
			}
		},
		kemiringanlereng:{
			0: {
				title: 'Kemiringan Lereng',
				fieldInfos: [{
					fieldName: 'Kelas_Lereng',
					label: 'Kelas Lereng',
					visible: true
				},{
					fieldName: 'Luas_Lahan_KM',
					label: 'Luas Lahan(KM)',
					visible: true
				}]	
			}
		},
		prjabopuncur:{
			0: {
				title: 'Pola Ruang JABODETABEK Puncur',
				fieldInfos: [{
					fieldName: 'Rencana_Pemanfaatan_Jabodetabekpuncur',
					label: 'Rencana Pemanfaatan Jabodetabek Puncur',
					visible: true
				},{
					fieldName: 'Luas_Lahan_KM',
					label: 'Luas Lahan(KM)',
					visible: true
				}]	
			}
		},
		prkabbogor:{
			0: {
				title: 'Pola Ruang JABODETABEK Puncur',
				fieldInfos: [{
					fieldName: 'Rencana_Pemanfaatan_Kabupaten',
					label: 'Rencana Pemanfaatan Kabupaten',
					visible: true
				},{
					fieldName: 'Luas_Lahan_KM',
					label: 'Luas Lahan(KM)',
					visible: true
				}]	
			}
		},

		komoditas_perikanan:{
			0: {
				title: 'Komoditas Perikanan',
				fieldInfos: [{
					fieldName: 'Toponimi_K',
					label: 'Toponimi',
					visible: true
				}],
				mediaInfos:[{
					type: "piechart",
					value: {
				  		fields: ["Mas", "Nila", "Mujair", "Gurame", "Tawes", "Patin", "Lele", "Tambakan", "Bawal", "Nilem", "Lainnya"],
				  		theme: "Julie"
					}
				}]	
			}	
		},

		dokumentasi:{
			0:{
				fieldInfos: [{
					fieldName: 'Toponimi_Video',
					label: 'Toponimi',
					visible: true
				}],
				description:'<video widht="180" height="200" controls>'+
  							'<source src="{Link_Video}" type="video/mp4">'+
							'Your browser does not support the video tag.'+
							'</video>',
			}
		},

		investasi:{
			0: {
				title: 'Komoditas Kesehatan',
				fieldInfos: [{
					fieldName: 'Toponimi_Kecamatan',
					label: 'Toponimi',
					visible: true
				}],
				
				mediaInfos:[{
					type: "piechart",
					value: {
				  		fields: ["Dokter_Umum", "Dokter_Gigi", "Perawat", "Bidan", "Bidan_Praktek", "Rumah_Sakit", "Dokter_Praktek", "Puskesmas"],
				  		theme: "Julie"
					}
				}]	
			}
		}
	}*/
});