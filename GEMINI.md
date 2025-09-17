## Pokédex Project Overview

This document provides a comprehensive overview of the Pokédex web application. It is intended to guide the Gemini AI in understanding the project's purpose, technology stack, and specific implementation details to ensure all generated code and documentation are consistent and accurate.

---

## Project Goal

The primary goal of this project is to create a web application that functions as a Pokédex. It will allow users to browse a list of Pokémon, view detailed information for each one, and navigate between different Pokémon. The application is built with a focus on a clean, modern design and a seamless user experience.

---

## Technology Stack

The project is built using:

<!-- * **T**ailwind CSS: Used for all styling. The design should be clean, modern, and utility-first. No custom CSS should be written in separate files unless absolutely necessary.
* **A**lpine.js: Used for any front-end interactivity that is not handled by Livewire. This includes simple state management, showing/hiding elements, and event listeners. -->
* **L**aravel: The backend framework that handles routing, data fetching, and rendering.
<!-- * **L**ivewire: Used for creating dynamic, reactive components. It will handle the primary logic for fetching and displaying Pokémon data without a full page refresh. -->

---

## Key Features

### 1. Main Pokémon List Page

* **Endpoint:** The main page will be accessible at the root URL `/`.
* **Data Source:** Fetches a list of Pokémon from an external API (e.g., PokeAPI).
* **UI/UX:** Displays a paginated or infinite-scrolling list of Pokémon.
* **User Interaction:** Each Pokémon in the list should be a clickable link that navigates to its detail page.

### 2. Pokémon Detail Page

* **Endpoint:** A dedicated page for each Pokémon, with a clean URL structure like `pokedex/{pokemon_name}`. The `{pokemon_name}` segment should be the slugified name of the Pokémon (e.g., `pokedex/pikachu`).
* **Data Source:** Fetches detailed information for a specific Pokémon from an external API.
* **UI/UX:** Displays a comprehensive view of the Pokémon, including its image, type, abilities, and stats.
* **Error Handling:** The page should display an error message if the specified Pokémon is not found.
* **User Experience:**
    * Show a loading spinner while data is being fetched.
    * Display a clear error message if the API call fails.
    * Implement a responsive design that works well on all screen sizes.

### 3. Navigation

* A navigation panel should be present on the detail page.
* **Previous/Next Navigation:** Buttons to navigate to the previous and next Pokémon in the list.
* **Home Button:** A button or link to return to the main list page.


### 4. Design
* Home Page (`home.png`):
    * Layout: A clean, responsive grid of Pokémon cards.
    * Card Design: Each card has a light gray background, rounded corners, centered Pokémon image, and the
      Pokémon's name centered below it. The overall aesthetic is minimalist and light.
* Detail Page (`pokemon_preview.png`):
    * Layout: A single, prominent card displaying Pokémon details.
    * Card Design: The card features a light green border and a light green background for the header section
      containing the Pokémon image. The Pokémon's name is bold and larger, followed by left-aligned stats and
      a "Hidden Ability" section.
    * Navigation: Simple "Previous", "Home", "Next" text links at the top.
* General: The design emphasizes readability, clear information presentation, and a clean, modern feel with
  minimal shadows or complex gradients.
---

## Technical Constraints and Guidelines

* **API Calls:** All external API calls should be handled by a dedicated service or class within Laravel
<!-- * **Front-end Interaction:** Use Alpine.js for simple front-end interactions, such as toggling a modal or showing/hiding a loading spinner directly in the HTML. -->
* **Code Style:** Adhere to the PSR-12 standard for PHP. Write clean, well-commented code.
* **File Structure:** Follow the standard Laravel directory structure.
* **User Interface:** Prioritize a user-friendly and intuitive interface.
* **Testing:** Write unit tests for both the front-end and back-end components.
