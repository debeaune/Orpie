# 🌿 Orpie — Species Observatory

A web application for browsing and searching natural species, built with Symfony and Docker.

<img width="1365" height="529" alt="image" src="https://github.com/user-attachments/assets/71a4469d-b4ff-49b0-bd3c-d3e8a6573e17" />


## Overview

Orpie allows users to browse a list of species, search by name in real time, and access a detailed page for each species (Latin name, French name, English name, habitat, conservation status, Wikipedia link).

Detailed data is fetched from the [iNaturalist API](https://www.inaturalist.org/).

## Tech Stack

- **PHP 8.3** / **Symfony 6**
- **MySQL 8.0**
- **Nginx**
- **Docker** / **Docker Compose**
- **Tailwind CSS**
- **Webpack Encore**

## Prerequisites

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installed and running

## Installation

1. Clone the repository:

```bash
git clone https://github.com/debeaune/Orpie.git
cd Orpie
```

2. Start the Docker containers:

```bash
docker-compose up -d
```

3. Open the application in your browser:

```
http://localhost:8080
```

## Features

- 📋 Species list with photo and taxonomic group
- 🔍 Real-time search by name
- 🔎 Detailed species page (Latin, French and English names, habitat, conservation status, Wikipedia)
- 🗄️ Species import via form

## Project Structure

```
Orpie/
├── assets/          # CSS and JS sources (Tailwind, Webpack)
├── nginx/           # Nginx configuration
├── src/
│   ├── Controller/  # Symfony controllers
│   ├── Entity/      # Doctrine entities
│   ├── Model/       # iNaturalist API calls
│   └── Repository/  # Database queries
├── templates/       # Twig templates
├── Dockerfile
└── docker-compose.yml
```

## Author

Marie Laure — [github.com/debeaune](https://github.com/debeaune)
