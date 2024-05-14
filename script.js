document.addEventListener("DOMContentLoaded", function() {
    var links = [
        { id: "cropLink", url: "crop.html" },
        { id: "soilMoistureLink", url: "soil.html" },
        { id: "temperatureLink", url: "temp.php" },
        { id: "humidityLink", url: "humidity.php" }
    ];

    links.forEach(function(link) {
        var element = document.getElementById(link.id);
        if (element) {
            element.addEventListener("click", function(event) {
                event.preventDefault();
                var overlay = document.getElementById('overlay');
                overlay.style.display = 'flex'; // Display the overlay

                // Redirect after 5 seconds
                setTimeout(function() {
                    window.location.href = link.url;
                }, 1000);

                // Hide the loader after 5 seconds
                setTimeout(function() {
                    overlay.style.display = 'none';
                }, 3000);
            });
        }
    });
});
