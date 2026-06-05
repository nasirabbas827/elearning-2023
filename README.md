# elearning_2023  

A lightweight e‑learning platform built with PHP. The repository contains the core application code, a sample MySQL database, and the bundled **FPDF** library for PDF generation (certificates, reports, etc.).

---  

## Table of Contents  

- [Overview](#overview)  
- [Features](#features)  
- [Tech Stack](#tech-stack)  
- [Installation](#installation)  
- [Usage](#usage)  
- [License](#license)  

---  

## Overview  

`elearning_2023` is a simple, modular e‑learning system designed for educational institutions or independent trainers. It provides basic course management, user authentication, and PDF report generation out‑of‑the‑box. The project is intentionally kept minimal to serve as a solid foundation for further customization.

---  

## Features  

- **Course & Lesson Management** – Create, edit, and delete courses and associated lessons.  
- **User Authentication** – Secure login/registration with password hashing.  
- **PDF Generation** – Built‑in FPDF integration for certificates, progress reports, and quizzes.  
- **Responsive UI** – Basic front‑end built with HTML5/CSS3 (no heavy JavaScript frameworks).  
- **Database Schema** – Ready‑to‑import MySQL dump (`Database/elearning.sql`).  

---  

## Tech Stack  

| Layer | Technology |
|-------|------------|
| Backend | PHP 8.x |
| Database | MySQL / MariaDB |
| PDF Generation | **FPDF** (included in `FPDF/` directory) |
| Dependency Management | Composer |
| Documentation | Markdown (`README.md`), Word (`E Learning Project PHP.docx`) |

---  

## Installation  

1. **Clone the repository**  

   ```bash
   git clone https://github.com/your-username/elearning_2023.git
   cd elearning_2023
   ```

2. **Install PHP dependencies**  

   ```bash
   composer install
   ```

   > The `FPDF` library is already bundled, but Composer will resolve any additional packages defined in `composer.json`.

3. **Create the database**  

   ```bash
   # Adjust credentials as needed
   mysql -u root -p < Database/elearning.sql
   ```

4. **Configure environment variables**  

   Copy the example file and edit the values:

   ```bash
   cp .env.example .env
   # Edit .env with your DB credentials, base URL, etc.
   ```

5. **Set up the web server**  

   - **Built‑in PHP server (development only)**  

     ```bash
     php -S localhost:8000 -t public
     ```

   - **Apache / Nginx** – Point the document root to the `public/` directory and ensure PHP‑FPM is enabled.

---  

## Usage  

### Access the application  

Open your browser and navigate to the URL configured in `.env` (e.g., `http://localhost:8000`).  

### Typical workflow  

1. **Register / Log in** – Create a user account or use the default admin credentials (`admin@example.com / password`).  
2. **Create a Course** – From the dashboard, add a new course and populate it with lessons.  
3. **Generate PDFs** – Use the “Export” button on the course page to produce a PDF certificate or progress report. The FPDF library handles rendering; you can customize templates in `FPDF/`.  

### Running tests (if any)  

```bash
./vendor/bin/phpunit
```

---  

## License  

This project is licensed