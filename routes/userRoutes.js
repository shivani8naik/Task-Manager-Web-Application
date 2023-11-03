// routes/userRoutes.js
const express = require('express');
const router = express.Router();
const UserController = require('../controllers/userController');
const passport = require('passport');

// Register a new user
router.post('/register', async (req, res, next) => {
    try {
        await UserController.register(req.body);
        res.status(201).json({ message: 'Registration successful' });
    } catch (error) {
        next(error); // Pass the error to the error handling middleware
    }
});

// Login
// In your userRoutes.js or equivalent
router.post('/login', (req, res) => {
      const { email, password } = req.body;
      
      // Validate the user's credentials and perform login logic here
      if (email === 'valid@email.com' && password === 'validpassword') {
          // Successful login
          res.send('Login successful');
      } else {
          // Failed login
          res.status(401).send('Login failed');
      }
  });

module.exports = router;
