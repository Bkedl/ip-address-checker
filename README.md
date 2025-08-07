## Overview

This project is a cloud-native, microservice-based application for validating, classifying and retrieving information about IP addresses. The system is composed of multiple Dockerised services developed in PHP, Node.js and Python, each fulfilling a dedicated role in the overall architecture.

The services are deployed using Kubernetes via Rancher and the project incorporates CI/CD pipelines to streamline development, testing and deployment. A minimal frontend interface was developed to align with the project's backend-first specification.

## Tools & Technologies Used

- Python (Flask)
- Node.js (Express)
- PHP
- unittest (Python)
- Jest (JavaScript)
- PHPUnit (PHP)
- Docker, Docker Compose
- Kubernetes (Rancher)
- GitLab CI

## What Was Built

- Validation Service (Python): Checks the format of submitted IP addresses and returns validation results.
- Classification Service (Node.js): Maps IP addresses to basic categories (e.g. internal, public, invalid).
- Country Info Service (PHP): Looks up geolocation and country information for a given IP address.
- Reverse Proxy & API Gateway: Handles routing between frontend and backend services.
- Minimal Web Interface: Lightweight HTML/CSS interface for submitting IP addresses to the backend services.

## Testing

Each microservice includes its own suite of unit tests:
- unittest for Python services
- Jest for JavaScript services
- PHPUnit for PHP services

NB: These tests are integrated into the CI/CD pipeline and run automatically on each commit.

## Deployment Architecture

- Services are containerised via Docker.
- Deployed to Kubernetes clusters using Rancher, with container orchestration and scaling.
- CI/CD pipeline via GitLab automates testing and deployments.
- Services communicate through REST APIs and are exposed via a reverse proxy.

NB: All services are intentionally modular to allow independent scaling and updates.
