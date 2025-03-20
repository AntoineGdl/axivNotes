## Setup Instructions for Windows

1. **Install PHP**:
    - Download and install PHP from [php.net](https://www.php.net/downloads).
    - Add the PHP path to the environment variable PATH.

2. **Install Composer**:
    - Download and install Composer from [getcomposer.org](https://getcomposer.org/download/).

3. **Install Node.js and npm**:
    - Download and install Node.js from [nodejs.org](https://nodejs.org/).
    - npm is included with Node.js.

4. **Clone the project**:
    - Open a command prompt and run:
      ```bash
      git clone <URL_OF_THE_PROJECT>
      cd <PROJECT_NAME>
      ```

5. **Install PHP dependencies**:
    - In the project directory, run:
      ```bash
      composer install
      ```

6. **Install JavaScript dependencies**:
    - In the project directory, run:
      ```bash
      npm install
      ```

7. **Install additional PHP dependencies**:
    - Run:
      ```bash
      composer require maatwebsite/excel
      ```

8. **Configure the environment**:
    - Copy the `.env.example` file to `.env`:
      ```bash
      copy .env.example .env
      ```
    - Modify the `.env` file with your database information and other necessary configurations.

9. **Generate the application key**:
    - Run:
      ```bash
      php artisan key:generate
      ```

10. **Migrate the database**:
    - Run:
      ```bash
      php artisan migrate
      ```

11. **Start the development server**:
    - Run:
      ```bash
      php artisan serve
      ```

12. **Compile the assets**:
    - Run:
      ```bash
      npm run dev
      ```
