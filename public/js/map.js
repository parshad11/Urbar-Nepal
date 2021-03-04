mapboxgl.accessToken = 'pk.eyJ1IjoicHJhbW9kbGFtc2FsIiwiYSI6ImNqenp2d25xZjIyZnozbG1saXJvdzY4encifQ.JnhenWIopEkt6RAp5ukfCA';

const task_latitude=$('input#task_latitude').val();
const task_longitude=$('input#task_longitude').val();
const task_map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center:[task_longitude, task_latitude],
    zoom:13
});
var marker = new mapboxgl.Marker()
.setLngLat([task_longitude, task_latitude])
.addTo(task_map);
task_map.addControl(new mapboxgl.NavigationControl());

