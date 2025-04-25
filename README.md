# Service Ticket Handling System

This project is a PHP-based application designed for managing service tickets. It uses SQL Server as the database backend to store and manage ticket data efficiently.

## Features
- Create, update, and manage service tickets.
- SQL Server integration for robust data handling.
- User-friendly interface for ticket management.

## Requirements
- PHP 7.4 or higher
- SQL Server
- Composer (for dependency management)
- Web server (e.g., Apache or Nginx)

## Installation

1. **Clone the Repository**
    ```bash
    git clone <repository-url>
    cd <repository-folder>
    ```

2. **Install Dependencies**
    Run the following command to install PHP dependencies:
    ```bash
    composer install
    ```

3. **Set Up Environment Variables**
    Create a `.env` file in the project root and configure the following:
    ```env
    DB_CONNECTION=sqlsrv
    DB_HOST=<your-database-host>
    DB_PORT=<your-database-port>
    DB_DATABASE=<your-database-name>
    DB_USERNAME=<your-database-username>
    DB_PASSWORD=<your-database-password>
    ```

4. **Run Database Migrations**
    Execute the migrations to set up the database schema:
    ```bash
    php artisan migrate
    ```

5. **Start the Development Server**
    Launch the application locally:
    ```bash
    php artisan serve
    ```

6. **Access the Application**
    Open your browser and navigate to:
    ```
    http://localhost:8000
    ```

## Usage
- Log in to the system to start managing service tickets.
- Use the dashboard to create, view, and update tickets.

## Contributing
Feel free to submit issues or pull requests to improve the project.

## License
This project is licensed under the [MIT License](LICENSE).