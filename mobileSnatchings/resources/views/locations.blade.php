<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Reported Mobile Snatching Incidents / رپورٹ کردہ موبائل سنچائی واقعات</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
   <style>
      :root {
         --primary-color: #006747; /* Pakistani green */
         --secondary-color: #e6f7e6; /* Light green */
         --tertiary-color: #d0e0d0; /* Lighter green */
      }
      body {
         font-family: 'Noto Nastaliq Urdu', Arial, sans-serif;
         background: linear-gradient(to bottom, var(--secondary-color), var(--tertiary-color));
         margin: 0;
         padding: 20px;
         color: #333;
      }
      h1 {
         text-align: center;
         color: var(--primary-color);
         margin-bottom: 20px;
      }
      p {
         text-align: center;
         margin-bottom: 20px;
      }
      .urdu {
         font-family: 'Noto Nastaliq Urdu', serif;
      }
      #map {
         width: 100%;
         height: 600px;
         margin-bottom: 20px;
         border: 1px solid #ccc;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
         animation: fadeIn 1s ease-in;
      }
      @keyframes fadeIn {
         from { opacity: 0; }
         to { opacity: 1; }
      }
      .incident-table {
         width: 100%;
         border-collapse: collapse;
         background: white;
         border-radius: 10px;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }
      .incident-table th, .incident-table td {
         padding: 12px;
         text-align: left;
         border-bottom: 1px solid #ddd;
      }
      .incident-table th {
         background-color: var(--primary-color);
         color: white;
      }
      .incident-table th i {
         color: white;
         margin-right: 8px;
      }
      .incident-table tr:nth-child(even) {
         background-color: #f2f2f2;
      }
      .incident-table tr:hover {
         background-color: #ddd;
         cursor: pointer;
         transition: background-color 0.3s ease-in-out;
      }
      .leaflet-popup-content-wrapper {
         background-color: #fff;
         border-radius: 5px;
         box-shadow: 0 3px 14px rgba(0,0,0,0.4);
      }
      .leaflet-popup-content {
         margin: 10px;
         font-family: 'Noto Nastaliq Urdu', Arial, sans-serif;
      }
      .leaflet-popup-tip {
         background-color: #fff;
      }
      @media (max-width: 600px) {
         #map {
            height: 400px;
         }
         .incident-table th, .incident-table td {
            padding: 8px;
            font-size: 14px;
         }
      }
   </style>
</head>
<body>
   <h1>
      <span dir="ltr">Reported Mobile Snatching Incidents</span> / <span dir="rtl" class="urdu">رپورٹ کردہ موبائل سنچائی واقعات</span>
   </h1>
   <p>
      <span dir="ltr">View all reported incidents on the map below.</span> / <span dir="rtl" class="urdu">نیچے دی گئی نقشہ پر تمام رپورٹ کردہ واقعات دیکھیں۔</span>
   </p>
   <div id="map"></div>
   <table class="incident-table">
      <thead>
         <tr>
            <th><i class="fas fa-hashtag"></i> ID</th>
            <th><i class="fas fa-align-left"></i> Description</th>
            <th><i class="fas fa-map-marker-alt"></i> Latitude</th>
            <th><i class="fas fa-map-marker-alt"></i> Longitude</th>
            <th><i class="fas fa-calendar-alt"></i> Datetime</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($products as $product)
            <tr data-lat="{{ $product->lat }}" data-long="{{ $product->long }}">
               <td>{{ $product->id }}</td>
               <td>{{ $product->description }}</td>
               <td>{{ $product->lat }}</td>
               <td>{{ $product->long }}</td>
               <td>{{ $product->datetime }}</td>
            </tr>
         @endforeach
      </tbody>
   </table>

   <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
   <script>
      const map = L.map('map').setView([24.8607, 67.0011], 12); // Centered on Karachi

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
         attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
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

      // Make table rows clickable
      document.querySelectorAll('table.incident-table tr').forEach(row => {
         row.addEventListener('click', () => {
            const lat = row.getAttribute('data-lat');
            const long = row.getAttribute('data-long');
            if (lat && long) {
               map.setView([lat, long], 15); // Zoom level 15
            }
         });
      });
   </script>
</body>
</html>