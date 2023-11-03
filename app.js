const express = require('express');
const app = express();
const port = process.env.PORT || 3000;

// Use middleware
app.use(express.json());
// Add other middleware as needed (e.g., logging, CORS, authentication, error handling)

// Import and use routes
const userRoutes = require('./routes/userRoutes');
const taskRoutes = require('./routes/taskRoutes');

app.use('/user', userRoutes);
app.use('/tasks', taskRoutes);

app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});
