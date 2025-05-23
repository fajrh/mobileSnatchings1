<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Report Mobile Snatching / موبائل سنچائی رپورٹ کریں</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu&display=swap" rel="stylesheet">
   <style>
      :root {
         --primary-color: #006747; /* Pakistani green */
         --secondary-color: #e6f7e6; /* Light green */
         --tertiary-color: #d0e0d0; /* Lighter green */
      }
      body {
         font-family: Arial, sans-serif;
         background: linear-gradient(to bottom, var(--secondary-color), var(--tertiary-color));
         margin: 0;
         padding: 20px;
         display: flex;
         flex-direction: column;
         align-items: center;
         min-height: 100vh;
         color: #333;
      }
      h2 {
         text-align: center;
         margin-bottom: 20px;
         color: var(--primary-color);
      }
      form {
         background: white;
         padding: 20px;
         border-radius: 10px;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
         width: 100%;
         max-width: 400px;
         animation: fadeIn 0.5s ease-in;
      }
      @keyframes fadeIn {
         from { opacity: 0; }
         to { opacity: 1; }
      }
      .form-group {
         display: flex;
         align-items: center;
         margin-bottom: 10px;
      }
      .address-group, .description-group {
         display: flex;
         flex-direction: column;
         margin-bottom: 10px;
      }
      .coords-group {
         display: flex;
         flex-wrap: wrap;
         margin-bottom: 10px;
         gap: 10px;
      }
      .coords-group label {
         display: flex;
         align-items: center;
         color: var(--primary-color);
         font-weight: bold;
         margin-right: 10px;
      }
      .coords-group input {
         flex: 1;
         max-width: 50px; /* Half of previous 100px */
         padding: 6px; /* Reduced padding for smaller size */
      }
      .bilingual-label {
         display: flex;
         align-items: center;
         margin-right: 10px;
         color: var(--primary-color);
         font-weight: bold;
      }
      .bilingual-label .en {
         margin-right: 10px;
         direction: ltr;
      }
      .bilingual-label .ur {
         direction: rtl;
         font-family: 'Noto Nastaliq Urdu', serif;
      }
      .input-with-button {
         display: flex;
         align-items: center;
         margin-top: 5px;
      }
      .input-with-button input {
         flex: 1;
         margin-right: 10px;
      }
      .form-group input[type="text"], .form-group input[type="number"], .address-group input[type="text"], .description-group input[type="text"] {
         width: 100%;
         padding: 8px;
         border: none;
         border-bottom: 2px solid #ccc;
         border-radius: 0;
         box-shadow: none;
         transition: border-color 0.3s ease-in-out;
      }
      .form-group .datetime-picker {
         width: 100%;
         max-width: 200px; /* Slightly smaller width for datetime */
         padding: 7px; /* Slightly reduced padding */
      }
      .form-group input[type="text"]:focus, .form-group input[type="number"]:focus, .form-group .datetime-picker:focus,
      .address-group input[type="text"]:focus, .description-group input[type="text"]:focus,
      .coords-group input[type="number"]:focus {
         border-color: var(--primary-color);
         outline: none;
      }
      .form-group input[type="submit"] {
         background: var(--primary-color);
         color: white;
         border: none;
         padding: 10px 15px;
         border-radius: 5px;
         cursor: pointer;
         transition: background 0.3s ease-in-out;
         width: 100%;
         font-size: 16px;
      }
      .form-group input[type="submit"]:hover {
         background: #004d37;
      }
      .icon {
         margin-right: 10px;
         color: var(--primary-color);
         font-size: 1.2em;
      }
      button {
         background: var(--primary-color);
         color: white;
         border: none;
         padding: 8px 12px;
         border-radius: 5px;
         cursor: pointer;
         transition: background 0.3s ease-in-out;
         white-space: nowrap;
      }
      button:hover {
         background: #004d37;
      }
      @media (max-width: 400px) {
         form {
            padding: 10px;
         }
         .form-group, .address-group, .description-group, .coords-group {
            flex-wrap: wrap;
         }
         .bilingual-label, .coords-group label {
            margin-bottom: 5px;
         }
         .form-group input[type="text"], .form-group input[type="number"], .address-group input[type="text"], .description-group input[type="text"],
         .coords-group input[type="number"] {
            padding: 6px;
         }
         .form-group .datetime-picker {
            padding: 6px;
            max-width: 100%;
         }
         button {
            padding: 6px 10px;
            font-size: 14px;
         }
         .coords-group {
            flex-direction: column;
         }
         .coords-group input {
            max-width: 100%;
         }
      }
   </style>
   <script>
      function searchAddress() {
         const address = document.getElementById("addressInput").value;
         if (!address) {
            alert("Please enter an address. / براہ کرم پتہ درج کریں۔");
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
               alert("No results found. / کوئی نتائج نہیں ملے۔");
            } else {
               const result = data[0];
               document.getElementById("latInput").value = parseFloat(result.lat).toFixed(6);
               document.getElementById("longInput").value = parseFloat(result.lon).toFixed(6);
            }
         })
         .catch(error => {
            console.error("Error fetching data:", error);
            alert("Failed to fetch geocoding data. / جغرافیائی ڈیٹا حاصل کرنے میں ناکامی۔");
         });
      }
   </script>
</head>
<body>
   <h2><span dir="ltr">Report mobile snatchings to help make Karachi safer</span> / <span dir="rtl" class="urdu">موبائل سنچائی رپورٹ کرکے کراچی کو محفوظ بنائیں</span></h2>
   <!-- Note: After submission, the server should display a thank-you message, e.g., "Thank you for your report! / آپ کی رپورٹ کے لیے شکریہ!" -->
   <form action="/addthepin" method="GET">
      <div class="address-group">
         <label for="addressInput" class="bilingual-label">
            <i class="fas fa-search icon"></i>
            <span class="en">Search Address</span>
            <span class="ur">پتہ تلاش کریں</span>
         </label>
         <div class="input-with-button">
            <input type="text" id="addressInput" placeholder="Enter address" />
            <button type="button" onclick="searchAddress()">Search / تلاش کریں</button>
         </div>
      </div>
      <div class="description-group">
         <label for="description" class="bilingual-label">
            <i class="fas fa-align-left icon"></i>
            <span class="en">Description</span>
            <span class="ur">تفصیل</span>
         </label>
         <input type="text" id="description" name="description" required minlength="3" maxlength="255" placeholder="Enter description" />
      </div>
      <div class="coords-group">
         <label for="latInput">
            <i class="fas fa-map-marker-alt icon"></i>
            <span class="en">Latitude</span>
         </label>
         <input type="number" id="latInput" name="lat" required step="0.000001" min="-90" max="90" />
         <label for="longInput">
            <i class="fas fa-map-marker-alt icon"></i>
            <span class="en">Longitude</span>
         </label>
         <input type="number" id="longInput" name="long" required step="0.000001" min="-180" max="180" />
      </div>
      <div class="form-group">
         <label for="datetime" class="bilingual-label">
            <i class="fas fa-calendar-alt icon"></i>
            <span class="en">Datetime</span>
            <span class="ur">تاریخ و وقت</span>
         </label>
         <input type="text" id="datetime" class="datetime-picker" name="datetime" required />
      </div>
      <div class="form-group">
         <input type="submit" value="Report / رپورٹ کریں" />
      </div>
   </form>
   <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
   <script>
      flatpickr(".datetime-picker", {
         enableTime: true,
         dateFormat: "Y-m-d H:i",
      });
   </script>
</body>
</html>