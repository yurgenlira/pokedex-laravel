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
- **Modern UI**: A premium design utilizing modern CSS techniques, vibrant colors, and smooth interactions.

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

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
