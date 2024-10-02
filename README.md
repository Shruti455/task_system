# Task Management System
This is a simple task management system built using Laravel. It allows users to create tasks, assign them to specific users, update task statuses, and add comments with the option to upload files.

### Requirements
1. User Management:
* Basic user authentication and authorization functionality.
* Only authenticated users can create tasks and add comments.

2. Task Management:
* Database structure to store tasks with fields for title, description, assigned user, and status.
* CRUD operations for tasks, including file upload option in task creation.

3. Comments:
* Relationship between tasks and comments. Each task can have multiple comments.
* Database structure to store comments with fields for comment content and the user who posted it.
* CRUD operations for comments, including file upload option.

4. User Interface:
* Simple and intuitive interface for managing tasks and comments.
* HTML, CSS, and Bootstrap for a responsive and visually appealing interface.

### Setup Instructions
1. Clone the repository:
`git clone https://github.com/your-username/task-management-system.git`

2. Navigate into the project directory
`cd task-management-system`

3. Install dependencies
`composer update` and `npm install`

4. Create a copy of the 
`.env.example` file and rename it to `.env.` Update the database configuration with your credentials:

5. Run database migrations
`php artisan migrate`

6. Serve the application
`php artisan serve`

7. Start development server
`npm run dev`

8. Access the application in your web browser at
`http://localhost:8000`

### Additional Notes
* Ensure that your server meets the Laravel requirements.
    1. NGINX / Server / Localserver
    2. PHP 8.2
    3. MySQL
    4. PHPMyAdmin

* For any issues or questions, please refer to the Laravel documentation or open an issue in the GitHub repository.

### Features
1. Any user can create task.
2. Assign to specific user.
3. Only task owner can edit or delete task.
4. Only task owner can assign task to specific user.
5. Both task creator and assigned user can change status.
6. User can add an attachment in the task.
7. Both task creator and assigned user can comment on task.
8. Comment can be only delete or update by user who comment.
9. Attachment can be upload in the comment section
