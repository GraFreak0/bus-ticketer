document.addEventListener("DOMContentLoaded", function() {
    // Calculate target time for 5:00 PM today
    var targetTimeToday = new Date();
    targetTimeToday.setHours(17, 0, 0); // Set target time to 5:00 PM

    // Calculate target time for 12:00 AM (start of the next day)
    var targetTimeNextDay = new Date();
    targetTimeNextDay.setDate(targetTimeNextDay.getDate() + 1); // Next day
    targetTimeNextDay.setHours(0, 0, 0); // Set time to 12:00 AM

    function updateTimer() {
        var currentTime = new Date();
        var difference;

        // Determine which target time to use based on current time
        if (currentTime < targetTimeToday) {
            difference = targetTimeToday - currentTime;
        } else {
            difference = targetTimeNextDay - currentTime;
        }

        if (difference <= 0) {
            // Target time reached, make platform accessible
            document.getElementById("countdown").style.display = "none";
            document.getElementById("platform-access").style.display = "block";
            toggleFormAccessibility(true); // Enable form when platform becomes accessible
            clearInterval(timerInterval); // Stop updating timer
        } else {
            // Calculate remaining time
            var hours = Math.floor(difference / (1000 * 60 * 60));
            var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((difference % (1000 * 60)) / 1000);

            // Display countdown timer
            document.getElementById("countdown").innerHTML = "Platform will be accessible in: " + hours + "h " + minutes + "m " + seconds + "s";
        }
    }

    // Initial call to update timer immediately
    updateTimer();

    // Update timer every second
    var timerInterval = setInterval(updateTimer, 1000);

    // Function to enable or disable form based on platform accessibility
    function toggleFormAccessibility(accessible) {
        var form = document.getElementById('generateForm');
        var nameInput = document.getElementById('name');
        var submitButton = form.querySelector('button[type="submit"]');

        if (accessible) {
            nameInput.removeAttribute('disabled');
            submitButton.removeAttribute('disabled');
        } else {
            nameInput.setAttribute('disabled', 'disabled');
            submitButton.setAttribute('disabled', 'disabled');
        }
    }
});