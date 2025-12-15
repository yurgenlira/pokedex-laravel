# Pokédex Laravel

A modern, clean, and responsive web application that serves as your personal Pokédex. Built with the latest web technologies to provide a seamless user experience.

![Project Status](https://img.shields.io/badge/status-active-success.svg)
![License](https://img.shields.io/badge/license-MIT-blue.svg)

## 📖 About

This project is a detailed implementation of a Pokédex using **Laravel 12** and **Tailwind CSS 4**. It interacts with the [PokéAPI](https://pokeapi.co/) to fetch and display real-time data about Pokémon, including their stats, types, abilities, and sprites.

The goal is to demonstrate a clean architecture, modern UI interaction and robust backend practices within the Laravel ecosystem.

## ✨ Features

- **Global Pokémon List**: Browse a comprehensive list of Pokémon.
- **Detailed Views**: Click on any Pokémon to view detailed statistics, including:
  - High-quality Official Artwork
  - Base Stats (HP, Attack, Defense, Speed, etc.)
  - Types and Abilities (including hidden abilities)
- **Seamless Navigation**: Easily navigate between previous and next Pokémon entries.
- **Interactive Rating System**: Authenticated users can rate Pokémon on a 5-star scale.
- **Live Leaderboard**: View the top 10 highest-rated Pokémon community-wide.
- **Dynamic Theming**: Pokémon detail views adapt their color scheme based on the Pokémon's type for an immersive experience.
- **Modern UI**: A premium design utilizing modern CSS techniques, vibrant colors, dark mode support, and smooth interactions.

## 🛠 Tech Stack

- **Backend**: [Laravel 12](https://laravel.com)
- **Frontend**: [Blade Templates](https://laravel.com/docs/blade), [Tailwind CSS 4](https://tailwindcss.com)
- **Data Source**: [PokéAPI](https://pokeapi.co)
- **Build Tool**: [Vite](https://vitejs.dev)

## 🚀 Getting Started

Follow these steps to set up the project locally.

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd pokedex-laravel
   ```

2. **Install Backend Dependencies**
   ```bash
   composer install
   ```

3. **Install Frontend Dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   Copy the example environment file and configure it:
   ```bash
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   ```

5. **Start the Application**
   You need to run both the Laravel server and the Vite development server.

   ```bash
   # Terminal 1
   php artisan serve

   # Terminal 2
   npm run dev
   ```

   Visit `http://localhost:8000` in your browser.

## 🏭 Production Setup

Deploying the application to production requires a few more steps to ensure it is secure, fast, and stable.

### 1. Server Requirements

- PHP 8.2 or higher with the following extensions: `curl`, `dom`, `fileinfo`, `iconv`, `mbstring`, `pdo`, `tokenizer`, `xml`, `xmlwriter`, `zip`.
- A database server (e.g., MySQL, PostgreSQL).
- A web server (e.g., Nginx, Apache).
- Composer, Node.js, and NPM.

### 2. Deployment Steps

1.  **Clone the repository** on your server.
2.  **Install Composer Dependencies**:
    ```bash
    composer install --no-dev --optimize-autoloader
    ```
3.  **Install Frontend Dependencies**:
    ```bash
    npm install
    ```
4.  **Build Frontend Assets**:
    ```bash
    npm run build
    ```
5.  **Configure Environment**:
    Create a `.env` file from `.env.example`.
    ```bash
    cp .env.example .env
    ```
    Edit the `.env` file and set the following:
    - `APP_ENV=production`
    - `APP_DEBUG=false`
    - `APP_KEY` (generate one if empty)
    - `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
    - Any other application-specific settings.

6.  **Generate Application Key**:
    If you haven't set `APP_KEY` in the `.env` file, run:
    ```bash
    php artisan key:generate --force
    ```
7.  **Run Database Migrations**:
    ```bash
    php artisan migrate --force
    ```
    The `--force` flag is required to run migrations in production.

8.  **Optimize for Production**:
    Cache your configuration and routes for a significant performance boost.
    ```bash
    php artisan optimize
    php artisan view:cache
    ```

9.  **Set Directory Permissions**:
    The web server needs to be able to write to the `storage` and `bootstrap/cache` directories.
    ```bash
    chmod -R 775 storage bootstrap/cache
    chown -R www-data:www-data storage bootstrap/cache
    ```
    *(Adjust `www-data` to your web server's user)*

10. **Configure Web Server**:
    Point your web server's document root to the `public` directory. Ensure URL rewriting is enabled to direct all requests to `public/index.php`.

## 🔧 Useful Commands

### Clearing Caches
If you encounter issues with config or views not updating, use these commands to clear the application cache:

```bash
# Clear all caches (Config, Route, Cache, View)
php artisan optimize:clear

# Clear specific caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

## 🧪 Testing

Run the test suite to ensure everything is working correctly:

```bash
php artisan test
```

### End-to-End Testing (Dusk)

To run browser-based E2E tests:

```bash
php artisan dusk
```

### Local CI/CD with Act (`act`)

This project supports running GitHub Actions workflows locally using [act](https://github.com/nektos/act). This is useful for testing CI/CD changes without pushing to the repository.

**Prerequisites:**

*   [Docker](https://www.docker.com/get-started)
*   [act](https://github.com/nektos/act#installation)

**Running Workflows:**

To run the entire CI/CD pipeline:

```bash
act
```

To run a specific job:

```bash
act -j <job-name>
```

For example, to run the `unit-tests` job:

```bash
act -j unit-tests
```

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
