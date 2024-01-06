Project Setup Guide

Prerequisites:
PHP version: 8.1
Laravel version: 10.10

Steps to Set Up:
1. Clone the Project
git clone <repository_url>
cd <project_directory>

2. Install Dependencies
composer install
composer update

3. Create a Database
Create a database for the project.

4. Configure .env File
Create a .env file in the root of the project.
Fill in the following values in the .env file:
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

5. Generate GitHub Access Token
Go to GitHub Settings.
Click "<>Developer Settings" in left bottom corner,
From "Personal access tokens" in the left Click "Fine-grained tokens".
Click "Generate a personal access token"
Set permissions for "All repositories".
Grant "Read and write" access to "Administration" under "Repository permissions".
Save the generated token to use later in your project.

6. Use the GitHub Token in Your Project
Inside the project, find the "GitHub token" input field.
Enter the previously generated GitHub access token to authenticate your repository actions.

7. Run the Project
Run the Laravel development server:
php artisan serve

8. Access the Application
Open your web browser and visit http://localhost:8000 to access your Laravel application.