### Personal Website Deployed with Kubernetes

A responsive personal website featuring a contact form powered by a PHP backend. This project is fully containerized with Docker and deployed to a Kubernetes cluster on DigitalOcean, showcasing modern DevOps practices such as container orchestration, secrets management, and scalable deployments.

---

## Features

- **Responsive Frontend**:
  - Built with HTML, CSS, and JavaScript (AJAX-based contact form).

- **PHP Backend**:
  - Processes form submissions and sends emails using PHPMailer.

- **Containerization**:
  - A `Dockerfile` to build a PHP-Apache container.
  - `docker-compose.yml` for local testing.
 
- **Kubernetes Deployment**:
  - Deployment and Service manifests for application orchestration.
  - Secrets management to securely store sensitive credentials.

- **Cloud Deployment**:
  - Live application hosted on a Kubernetes cluster with external access via a LoadBalancer.

---

## Getting Started

Follow these instructions to deploy and run the project locally or in a Kubernetes cluster.

### Prerequisites

- Install [Docker Desktop](https://www.docker.com/products/docker-desktop) (for local testing).
- Install [kubectl](https://kubernetes.io/docs/tasks/tools/) for Kubernetes management.
- Install [doctl](https://docs.digitalocean.com/reference/doctl/how-to/install/) if deploying to DigitalOcean Kubernetes.

---

### Local Setup with Docker

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/rileylitchfield/current-portfolio.git
   cd current-portfolio
   ```

2. **Create an `.env` File**:
   - Add your SMTP credentials to enable email functionality:
     ```env
     SMTP_HOST=live.smtp.mailtrap.io
     SMTP_PORT=587
     SMTP_USERNAME=your_mailtrap_username
     SMTP_PASSWORD=your_mailtrap_password
     FROM_EMAIL=from_email_address
     TO_EMAIL=to_email_address
     ```

3. **Build and Run the Application**:
   ```bash
   docker-compose up --build
   ```

4. **Access the Website:**:
   - Open your browser and navigate to:
     ```
     http://localhost:8080
     ```

---

### Deployment on Kubernetes

1. **Prepare Kubernetes Manifests**:
   Update `deployment.yaml` and `service.yaml` to point to your Docker image and match your configuration.

2. **Apply the Secrets**:
   - Use `secrets.yaml` to store sensitive credentials:
     ```bash
     kubectl apply -f secrets.yaml
     ```

3. **Deploy the Application:**:
   ```bash
   kubectl apply -f deployment.yaml
   kubectl apply -f service.yaml
   ```

4. **Access the Website:**:
   - Get the external IP of your service:
     ```
     kubectl get services
     ```
   - Open the IP in your browser:
     ```
     http://<EXTERNAL-IP>
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
├── .env                   # Environment variables (local use only)
├── .gitignore             # Ignored files/folders
├── composer.json          # PHP dependency manager configuration
├── composer.lock          # Dependency lockfile
├── docker-compose.yml     # Docker Compose configuration
├── Dockerfile             # Docker build instructions
├── deployment.yaml        # Kubernetes deployment manifest
├── service.yaml           # Kubernetes service manifest
├── secrets.yaml           # Kubernetes secrets (excluded from Git)
├── index.html             # Main frontend file
```

---

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript (AJAX for contact form).
- **Backend**: PHP with PHPMailer for email handling.
- **Containerization**: Docker and Docker Compose.
- **Orchestration**: Kubernetes for deployment, scaling, and management.
- **Cloud Hosting**: DigitalOcean Kubernetes.
- **Secrets Management**: Kubernetes Secrets for secure configuration.
- **Email Testing**: Mailtrap for SMTP testing.

---

## Future Enhancements

- **HTTPS Support**:
  - Add an NGINX Ingress Controller and configure TLS with Cert-Manager.
- **Monitoring**:
  - Integrate Prometheus and Grafana for detailed metrics and custom dashboards.
- **CI/CD Pipeline**:
  - Automate builds and deployments using GitHub Actions.

---

## Acknowledgments

- [PHPMailer](https://github.com/PHPMailer/PHPMailer) for email handling.
- [Docker](https://www.docker.com/) and [Kubernetes](https://kubernetes.io/) for modern deployment practices.
- [Mailtrap](https://mailtrap.io/) for email testing.
- [DigitalOcean](https://www.digitalocean.com/) for cloud hosting.
