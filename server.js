const express = require('express');
const mongoose = require('mongoose');
const bodyParser = require('body-parser');
const app = express();
const port = process.env.PORT || 3000;

// Connect to your MongoDB database
mongoose.connect('mongodb://localhost/mydatabase', { useNewUrlParser: true, useUnifiedTopology: true });

app.use(bodyParser.json());
// ... Other server setup and middleware

// Define the schema for user data (userModel.js) and task data (taskModel.js)
const User = require('./models/userModel');
const Task = require('./models/taskModel');

// Define your routes (userRoutes.js and taskRoutes.js)
const userRoutes = require('./routes/userRoutes');
const taskRoutes = require('./routes/taskRoutes');

// Use the routes
app.use('/user', userRoutes);
app.use('/tasks', taskRoutes);

app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});
