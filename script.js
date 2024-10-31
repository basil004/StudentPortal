document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
  
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
  
    // Send an AJAX request to the check_credentials.php script
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'check_credentials.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      if (xhr.status === 200) {
        // Redirect to the dashboard page if the credentials are correct
        if (xhr.responseText === 'success') {
          window.location.href = 'dashboard.html';
        } else {
          alert('Invalid username or password');
        }
      } else {
        console.error('Error fetching student details:', xhr.statusText);
      }
    };
    xhr.send(`username=${username}&password=${password}`);
  });