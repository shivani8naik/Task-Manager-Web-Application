// routes/taskRoutes.js
const express = require('express');
const router = express.Router();
const passport = require('passport');
const TaskController = require('../controllers/taskController');

// Middleware to authenticate the user before accessing task routes
router.use(passport.authenticate('local'));

// Routes
router.get('/', TaskController.getTasks);
router.post('/', TaskController.createTask);
router.put('/:id', TaskController.updateTask);
router.delete('/:id', TaskController.deleteTask);

module.exports = router;
