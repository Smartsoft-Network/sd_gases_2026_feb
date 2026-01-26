# Oxygen Design Studio (Laravel Edition)

This is a Laravel application using Blade templates and Alpine.js for interactivity.

## Project Structure

- **Backend**: Laravel 11
- **Frontend**: Blade Templates + Alpine.js + Tailwind CSS
- **Assets**: Located in `resources/css`, `resources/js`, and `resources/views`

## Getting Started

1.  **Install PHP Dependencies**:
    ```bash
    composer install
    ```

2.  **Install Node Dependencies**:
    ```bash
    npm install
    ```

3.  **Setup Environment**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    touch database/database.sqlite
    php artisan migrate
    ```

4.  **Run Development Servers**:
    *   Backend: `php artisan serve`
    *   Frontend (Vite): `npm run dev`

5.  **Build for Production**:
    ```bash
    npm run build
    ```

## Key Features

- **Blade Templates**: Server-side rendering for better SEO and performance.
- **Alpine.js**: Lightweight JavaScript framework for client-side interactivity (animations, modals, etc.).
- **Tailwind CSS**: Utility-first CSS framework for styling.
- **Named Routes**: Used throughout the application for easy route management.

## Directory Layout

- `resources/views/layouts`: Main layout files (header, footer).
- `resources/views/partials`: Reusable components (hero, services, products).
- `resources/views/products`: Individual product detail pages.
- `resources/views/services`: Individual service detail pages.
- `resources/js/app.js`: Main JavaScript entry point (Alpine.js initialization).
