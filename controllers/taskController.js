const Task = require('../models/taskModel');

const TaskController = {
    getTasks: async (req, res) => {
        try {
            // Retrieve tasks for the authenticated user
            const tasks = await Task.find({ userId: req.user._id });
            return res.status(200).json(tasks);
        } catch (error) {
            return res.status(500).json({ message: 'Failed to retrieve tasks.' });
        }
    },
    
    createTask: async (req, res) => {
        try {
            // Extract task data from the request
            const { title, description } = req.body;

            // Validate task input (e.g., check for required fields)
            if (!title) {
                return res.status(400).json({ message: 'Task title is required.' });
            }

            // Create a new task for the authenticated user
            const newTask = new Task({ title, description, userId: req.user._id });
            await newTask.save();
            return res.status(201).json({ message: 'Task created successfully.' });
        } catch (error) {
            return res.status(500).json({ message: 'Failed to create a task.' });
        }
    },

    updateTask: async (req, res) => {
        try {
            // Extract task data from the request
            const { title, description } = req.body;

            // Validate task input (e.g., check for required fields)
            if (!title) {
                return res.status(400).json({ message: 'Task title is required.' });
            }

            // Update a task by ID
            const taskId = req.params.id;
            const updatedTask = await Task.findByIdAndUpdate(taskId, { title, description }, { new: true });

            if (!updatedTask) {
                return res.status(404).json({ message: 'Task not found.' });
            }

            return res.status(200).json(updatedTask);
        } catch (error) {
            return res.status(500).json({ message: 'Failed to update the task.' });
        }
    },

    deleteTask: async (req, res) => {
        try {
            // Delete a task by ID
            const taskId = req.params.id;
            const deletedTask = await Task.findByIdAndRemove(taskId);

            if (!deletedTask) {
                return res.status(404).json({ message: 'Task not found.' });
            }

            return res.status(204).json();
        } catch (error) {
            return res.status(500).json({ message: 'Failed to delete the task.' });
        }
    },
};

module.exports = TaskController;
