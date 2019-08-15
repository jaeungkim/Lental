// initialize map
var map = L.map('miniMap').setView([51.505, -0.09], 13);

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// show marker on location if found
function onLocationFound(e) {
    var radius = e.accuracy;

    L.marker(e.latlng).addTo(map).bindPopup("You are within " + radius + " metres from this point.").openPopup();

    L.circle(e.latlng, radius).addTo(map);
}

map.on('locationfound', onLocationFound);

// show error if location not found
function onLocationError(e) {
    alert(e.message);
}

map.on('locationerror', onLocationError);

// show current location on map
map.locate({
    setView: true,
    maxZoom: 16
});
map.invalidateSize();

// address search feature
// import GeoSearchControl, OpenStreetMapProvider from 'leaflet-geosearch';
// const provider = new OpenStreetMapProvider();
// const address = $('#address');
//
// address.keyup(addressChange());
//
// function addressChange(){
//     provider
//   .search({ query: address.val() })
//   .then(function(result) {
//     console.log(result);
//   });
// }
