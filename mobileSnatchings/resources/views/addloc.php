<!DOCTYPE html>
<html>
   <head>
      <title>Add Location</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
      <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
         }
         form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
         }
         table {
            width: 100%;
         }
         td {
            padding: 10px 0;
         }
         input[type="text"], input[type="number"], input[type="datetime-local"], .datetime-picker {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
         }
         input[type="text"]:focus, input[type="number"]:focus, .datetime-picker:focus {
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.8);
            border-color: #007bff;
         }
         input[type="submit"] {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
         }
         input[type="submit"]:hover {
            background: #0056b3;
         }
         .icon {
            margin-right: 10px;
            color: #007bff;
         }
      </style>

      
  <script>
    function searchAddress() {
      const address = document.getElementById("addressInput").value;
      if (!address) {
        alert("Please enter an address.");
        return;
      }

      const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`;

      fetch(url, {
        headers: {
          'Accept': 'application/json',
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.length === 0) {
          alert("No results found.");
        } else {
          const result = data[0];
          // Truncate latitude and longitude to 1 decimal place
          document.getElementById("latInput").value = parseFloat(result.lat).toFixed(6);
          document.getElementById("longInput").value = parseFloat(result.lon).toFixed(6);
        }
      })
      .catch(error => {
        console.error("Error fetching data:", error);
        alert("Failed to fetch geocoding data.");
      });
    }
  </script>

   </head>
   <body>
      test
      <form action="/addthepin" method="GET">
         <table>
            <tr>
               <td><i class="fas fa-search icon"></i>Search Address</td>
               <td>
                  <input type="text" id="addressInput" placeholder="Enter address" />
                  <button type="button" onclick="searchAddress()">Search</button>
               </td>
            </tr>
            <tr>
               <td><i class="fas fa-align-left icon"></i>Description</td>
               <td><input type="text" name="description" required minlength="3" maxlength="255" /></td>
            </tr>
            <tr>
               <td><i class="fas fa-map-marker-alt icon"></i>Latitude</td>
               <td><input type="number" id="latInput" name="lat" required step="0.000001" min="-90" max="90" /></td>
            </tr>
            <tr>
               <td><i class="fas fa-map-marker-alt icon"></i>Longitude</td>
               <td><input type="number" id="longInput" name="long" required step="0.000001" min="-180" max="180" /></td>
            </tr>
            <tr>
               <td><i class="fas fa-calendar-alt icon"></i>Datetime</td>
               <td><input type="text" class="datetime-picker" name="datetime" required /></td>
            </tr>
            <tr>
               <td colspan="2">
                  <input type="submit" value="Add Location" />
               </td>
            </tr>
         </table>
      </form>
      <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
      <script>
         // Initialize Flatpickr for the datetime picker
         flatpickr(".datetime-picker", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
         });
      </script>
   </body>
</html>