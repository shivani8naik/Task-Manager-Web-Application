const User = require('../models/userModel');

const UserController = {
    register: async (req, res) => {
        try {
            // Extract user registration data from the request
            const { name, email, password } = req.body;

            // Validate user input (e.g., check for required fields and validate email format)
            if (!name || !email || !password) {
                return res.status(400).json({ message: 'Please provide all required information' });
            }
            
            // Check if the user with the same email already exists
            const existingUser = await User.findOne({ email });
            if (existingUser) {
                return res.status(409).json({ message: 'User with this email already exists' });
            }

            // Create a new user
            const newUser = new User({ name, email, password });
            await newUser.save();

            // Optionally, generate and send a token for authentication

            return res.status(201).json({ message: 'User registered successfully' });
        } catch (error) {
            return res.status(500).json({ message: 'Registration failed. Please try again.' });
        }
    },

    login: (req, res) => {
        // Implement user login logic, including authentication using Passport.js or similar middleware
        // Send a response with an authentication token upon successful login
    },
};

module.exports = UserController;
