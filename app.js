const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');

const app = express();
app.use(bodyParser.urlencoded({ extended: false }));

// Database connection
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'basil2004',
  database: 'student_portal'
});

connection.connect((err) => {
  if (err) throw err;
  console.log('Database connected!');
});

// Routes
app.get('/', (req, res) => {
  res.send(`
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Student Portal Login</title>
      <link rel="stylesheet" href="styles.css">
    </head>
    <body>
      <div class="container">
        <h2>Login</h2>
        <form id="loginForm" method="post" action="/login">
          <input type="text" id="username" name="username" placeholder="Username" required>
          <input type="password" id="password" name="password" placeholder="Password" required>
          <button type="submit">Login</button>
        </form>
      </div>
    </body>
    </html>
    `);
});

app.post('/login', (req, res) => {
  const { username, password } = req.body;

  connection.query('SELECT * FROM students WHERE username =? AND password =?', [username, password], (err, results) => {
    if (err) throw err;

    if (results.length > 0) {
      res.send('Welcome!');
    } else {
      res.send('Invalid username or password.');
    }
  });
});

app.listen(3000, () => {
  console.log('Server started on port 3000!');
});