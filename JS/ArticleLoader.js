function setSession(screen) {
    // Send an AJAX request to set the session variable
    fetch('setSession.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: 'screen=' + screen
    })
    .then(response => response.text())
    .then(data => {
        // Update the content of the page based on the new screen
        document.getElementById('mainContent').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}