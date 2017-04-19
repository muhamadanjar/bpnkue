function identifyLayer(layer = 'all') {
    map.on('click', function(evt) {
                    
                    coordinate = evt.coordinate;
                
                    var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature, layer) {
                        return feature;
                    });

                    if (feature) {
                        content = tablePopupVector(feature);
                        contentPopup.innerHTML = content;
                        popup.setPosition(coordinate);
                    }else{
                        if (selectedLayer == 'all') {
                            var url = singleAllLayers
                                .getSource()
                                .getGetFeatureInfoUrl(
                                    evt.coordinate,
                                    map.getView().getResolution(),
                                    map.getView().getProjection(),
                                    {
                                        'INFO_FORMAT': 'application/json',
                                        //'propertyName': '*',
                                        'LAYERS':intLayersString,
                                        'QUERY_LAYERS':intLayersString, 
                                        'FEATURE_COUNT': 50
                                    }
                                );
                        }else{
                            var layer = findBy(map.getLayerGroup(), 'id', selectedLayer);
                            var url = layer
                                .getSource()
                                .getGetFeatureInfoUrl(
                                    evt.coordinate,
                                    map.getView().getResolution(),
                                    map.getView().getProjection(),
                                    {
                                        'INFO_FORMAT': 'application/json',
                                        //'propertyName': '*',
                                        //'LAYERS':intLayersString,
                                        //'QUERY_LAYERS':intLayersString, 
                                        'FEATURE_COUNT': 50
                                    }
                                );
                        }

                        var url = singleAllLayers
                        .getSource()
                        .getGetFeatureInfoUrl(
                            evt.coordinate,
                            map.getView().getResolution(),
                            map.getView().getProjection(),
                            {
                                'INFO_FORMAT': 'application/json',
                                //'propertyName': '*',
                                'FEATURE_COUNT': 50
                            }
                        );

                        $.ajax({
                            url: url,
                            dataType : 'json',
                            error:function (argument) {
                                console.log(argument)
                            },
                            beforeSend: function() {
                                $('#loading').html("<img src='images/ajax-loader.gif' />");
                            },
                        }).then(function (data) {
                            //console.log(data);
                            var feature = data.features[0];
                                $('#loading').hide();
                                content = tablePopup(feature);
                                contentPopup.innerHTML = content;
                                popup.setPosition(evt.coordinate);
                                //popup.show(evt.coordinate, content);
                            
                        });   
                    }
                
                    
                

    });
}

function getSelectInfo() {
    var option = '';
    for (var i=0;i<intLayers.length;i++){
                   option += '<option value="'+ intLayers[i] + '">' + intLayers[i] + '</option>';
    }
    $('#identify').append(option);
    $('#identify').change(function(e) {
        selectedLayer = $(this).val();
        if (selectedLayer != "") {

        }else{
            selectedLayer = "all";
        }
                   
    });

}