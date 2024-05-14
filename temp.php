<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Water Requirements Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"],
        button {
            width: 100%;
            margin-bottom: 20px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        #result {
            margin-top: 30px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .back-button {
    position: absolute;
    top: 20px;
    left: 20px;
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
}

.back-button:hover {
    text-decoration: none;
}
    </style>
</head>
<body>
<a href="index.html" class="back-button">&larr; Back</a>
    <header>
        <h1>Crop Water Requirements Calculator</h1>
    </header>
    <main>
        <form id="cropForm">
            <label for="cropName">Crop Name:</label>
            <input type="text" id="cropName" required><br><br>
            
            <label for="location">Location:</label>
            <input type="text" id="location" required><br><br>
            
            <label for="duration">Duration (in days):</label>
            <input type="number" id="duration" required><br><br>
            
            <label for="temperature">Temperature (in °C):</label>
            <input type="number" id="temperature" required><br><br>
            
            <button type="submit">Calculate Water Requirements</button>
        </form>
        <div id="result"></div>
    </main>
    <footer>
        <p>&copy; 2024 Crop Water Requirements Calculator. All rights reserved.</p>
    </footer>

    <script>
        document.getElementById('cropForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Get user inputs
            var cropName = document.getElementById('cropName').value;
            var location = document.getElementById('location').value;
            var duration = parseInt(document.getElementById('duration').value);
            var temperature = parseFloat(document.getElementById('temperature').value);

            // Call function to calculate water requirements
            calculateWaterRequirements(cropName, location, duration, temperature);
        });

        function calculateWaterRequirements(cropName, location, duration, temperature) {
            // Construct API request URLs
            var weatherAPIUrl = `https://api.openweathermap.org/data/2.5/weather?q=${location}&appid=YOUR_API_KEY`;
            var cropAPIUrl = `https://api.example.com/crop-data?name=${cropName}`;

            // Make API requests to fetch weather and crop data
            Promise.all([
                fetch(weatherAPIUrl).then(response => response.json()),
                fetch(cropAPIUrl).then(response => response.json())
            ]).then(data => {
                var weatherData = data[0];
                var cropData = data[1];

                // Extract relevant data from weather response
                var temperatureKelvin = weatherData.main.temp;
                var humidity = weatherData.main.humidity;

                // Extract relevant data from crop response
                var waterRequirementPerDay = cropData.waterRequirementPerDay;

                // Calculate total water requirement for the given duration
                var totalWaterRequirement = waterRequirementPerDay * duration;

                // Display the result
                var resultElement = document.getElementById('result');
                resultElement.innerHTML = `
                    <h2>Water Requirements for ${cropName}</h2>
                    <p>Total water requirement for ${duration} days:</p>
                    <p>${totalWaterRequirement.toFixed(2)} liters</p>
                `;
            }).catch(error => {
                console.error('Error fetching data:', error);
                // Display error message to the user
                var resultElement = document.getElementById('result');
                resultElement.innerHTML = '<p>Error fetching data. Please try again later.</p>';
            });
        }
    </script>
</body>
</html>
