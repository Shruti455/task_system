# Task Management System
This is a simple task management system built using Laravel. It allows the admin to create tasks, assign them to specific users, and update task status.

### Requirements
1. User Management:
* Basic user authentication and authorization functionality.
* Only authenticated users can create tasks and add comments.

2. Task Management:
* Database structure to store tasks with fields for title, description, assigned user, and status.
* CRUD operations for tasks, including file upload option in task creation.

3. Export:
* Export users.
* Export Tasks

4. User Interface:
* Simple and intuitive interface for managing tasks and comments.
* HTML, CSS, and Bootstrap for a responsive and visually appealing interface.

5. Validation:
* Laravel Form validation is on the user and task creation form.
* jQuery email validation and form validation.

### Setup Instructions
1. Clone the repository:
`git clone https://github.com/Shruti455/task_system.git`

2. Navigate into the project directory
`cd task_system`

3. Install dependencies
`composer update` and `npm install`

4. Create a copy of the 
`.env.example` file and rename it to `.env.` Update the database configuration with your credentials:

5. Run database migrations
`php artisan migrate`

6. Run seeder to create admin credentials
`php artisan db:seed`

7. Serve the application
`php artisan serve`

8. Start development server
`npm run dev`

9. Access the application in your web browser at
`http://localhost:8000`

### Additional Notes
* Ensure that your server meets the Laravel requirements.
    1. NGINX / Server / Localserver
    2. PHP 8.2
    3. MySQL
    4. PHPMyAdmin

* For any issues or questions, please refer to the Laravel documentation or open an issue in the GitHub repository.

### Features
1. Admin can create task.
2. Assign to specific user.
3. Only Admin can edit or delete tasks.
4. Only Admin can assign task to specific user.
5. Both admin and assigned user can change status.
6. Admin can add an attachment in the task.
7. Admin can export user and tasks details in excel.
