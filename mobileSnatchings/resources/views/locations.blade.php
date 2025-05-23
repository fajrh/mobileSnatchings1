<!DOCTYPE html>
<html>
   <head>
      <title>Products</title>
      <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
      <style>
         #map {
            width: 100%;
            height: 600px;
            margin-top: 30px;
         }
      </style>
   </head>
   <body>
      <h1>Products</h1>
      <table border="1">
         <thead>
            <tr>
               <th>ID</th>
               <th>Description</th>
               <th>Latitude</th>
               <th>Longitude</th>
               <th>Datetime</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($products as $product)
               <tr>
                  <td>{{ $product->id }}</td>
                  <td>{{ $product->description }}</td>
                  <td>{{ $product->lat }}</td>
                  <td>{{ $product->long }}</td>
                  <td>{{ $product->datetime }}</td>
               </tr>
            @endforeach
         </tbody>
      </table>

      <div id="map"></div>

      <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
      <script>
   const map = L.map('map').setView([24.8607, 67.0011], 12); // Centered on Karachi

   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
   }).addTo(map);

   const products = @json($products);

   // Create a feature group to store all markers
   const markersGroup = L.featureGroup();

   products.forEach(product => {
      if (product.lat && product.long) {
         const marker = L.marker([product.lat, product.long]);
         marker.bindPopup(`
            <strong>${product.description}</strong><br>
            ID: ${product.id}<br>
            Date: ${product.datetime}
         `);
         markersGroup.addLayer(marker);
      }
   });

   // Add all markers to the map
   markersGroup.addTo(map);

   // Adjust the map view to fit all markers
   if (markersGroup.getLayers().length > 0) {
      map.fitBounds(markersGroup.getBounds(), { padding: [50, 50] });
   }
</script>

   </body>
</html>
