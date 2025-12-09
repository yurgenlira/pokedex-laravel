# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.1.0] - 2025-12-09

### Added
- Initial Laravel 12 project setup.
- Basic routing for Pokémon list and detail pages.
- `PokemonController` and `PokemonService` to fetch data from PokéAPI.
- Basic Blade views for listing and showing Pokémon.
- Integration with Tailwind CSS.
- README documentation including setup steps, cache clearing commands, and testing instructions.
- E2E testing setup with Laravel Dusk.

## [0.2.0] - 2025-12-09

### Added
- **User Authentication**: Integrated Laravel Breeze for secure user login and registration.
- **Rating System**: Interactive 5-star rating system for authenticated users.
- **Leaderboard**: A new page displaying the top 10 highest-rated Pokémon.
- **Dynamic Theming**: Pokémon detail cards now dynamically adapt their colors based on the Pokémon's type (e.g., Fire = Orange, Water = Blue).
- **Dark Mode Support**: Enhanced dark mode compatibility for improved accessibility and aesthetics.
