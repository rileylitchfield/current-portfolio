# Personal Website with Dockerized Backend

A responsive personal website featuring a contact form powered by a PHP backend. This project is fully containerized with Docker, making it easy to deploy and scale, while highlighting modern development and deployment practices.

---

## Features

- **Responsive Frontend**:
  - Built with HTML, CSS, and JavaScript (AJAX-based contact form).

- **PHP Backend**:
  - Processes form submissions and sends emails using PHPMailer.

- **Containerized Setup**:
  - A `Dockerfile` to build a PHP-Apache container.
  - `docker-compose.yml` to manage configurations and environment variables.

---

## Getting Started

Follow these instructions to get a local copy of the project up and running.

### Prerequisites

- Install [Docker Desktop](https://www.docker.com/products/docker-desktop) and ensure WSL2 integration is enabled (for Windows users).

---

### Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-username/your-repo-name.git
   cd your-repo-name
   ```

2. **Create an `.env` File**:
   - Add your SMTP credentials to enable email functionality:
     ```env
     SMTP_HOST=live.smtp.mailtrap.io
     SMTP_PORT=587
     SMTP_USERNAME=your_mailtrap_username
     SMTP_PASSWORD=your_mailtrap_password
     ```

3. **Build and Run the Application**:
   ```bash
   docker-compose up --build
   ```

4. **Access the Website**:
   - Open your browser and navigate to:
     ```
     http://localhost:8080
     ```

---

## Project Structure

```plaintext
website/
├── css/                   # Stylesheets
├── fonts/                 # Fonts used in the website
├── images/                # Image assets
├── js/                    # JavaScript files
├── php/                   # PHP backend files (e.g., process-form.php)
├── vendor/                # Composer dependencies (e.g., PHPMailer)
├── .env                   # Environment variables
├── .gitignore             # Ignored files/folders
├── composer.json          # PHP dependency manager configuration
├── composer.lock          # Dependency lockfile
├── docker-compose.yml     # Docker Compose configuration
├── Dockerfile             # Docker build instructions
├── index.html             # Main frontend file
```

---

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript (AJAX for contact form).
- **Backend**: PHP with PHPMailer for email handling.
- **Containerization**: Docker and Docker Compose.
- **Email Testing**: Mailtrap for SMTP testing.

---

## Future Enhancements

- Deploy to a Kubernetes cluster for scalability and reliability.
- Integrate CI/CD pipelines for automated builds and deployments.
- Add monitoring with tools like Prometheus and Grafana.

---

## Acknowledgments

- [PHPMailer](https://github.com/PHPMailer/PHPMailer) for email handling.
- [Docker](https://www.docker.com/) for containerization.
- [Mailtrap](https://mailtrap.io/) for email testing.
