# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Development Commands

### Local Development
- `composer dev` - Start the full development environment (Laravel server, queue worker, and Vite asset bundler)
- `php artisan serve` - Start Laravel development server only
- `npm run dev` - Start Vite development server for frontend assets
- `php artisan queue:work` - Start queue worker for background jobs

### Build and Assets
- `npm run build` - Build production assets with Vite
- `vite build` - Direct Vite build command

### Testing
- `php artisan test` - Run PHPUnit/Pest test suite
- `composer test` - Run tests with config cleared first
- Tests use Pest framework with PHPUnit TestCase base

### Code Quality
- `vendor/bin/pint` - Laravel Pint code formatter (PSR-12 standard)

## Architecture Overview

This is a **Laravel 12 + Livewire + Volt** application for a Geely automotive website with the following key characteristics:

### Technology Stack
- **Backend**: Laravel 12 with PHP 8.2+
- **Frontend**: Livewire 3 + Volt for reactive components
- **Styling**: Tailwind CSS 4.x with custom Geely fonts
- **Build**: Vite 6 for asset compilation
- **Database**: SQLite (development)
- **Testing**: Pest framework

### Key Architectural Patterns

#### Livewire Component Structure
- **Full Components**: Located in `app/Livewire/` (e.g., `HeroSection`, `ModelSection`)
- **Volt Components**: Simple blade-based components in `resources/views/livewire/`
- Components handle both frontend presentation and backend logic in single files

#### Frontend Architecture
- **Layout System**: Nested blade layouts in `resources/views/components/layouts/`
  - `frontend/front.blade.php` - Main frontend layout
  - `app.blade.php` - Admin/dashboard layout
- **Component Library**: Uses Livewire Flux UI components
- **Asset Pipeline**: Vite compiles `resources/css/app.css` and `resources/js/app.js`

#### Data Configuration Pattern
- Complex UI components use PHP array configurations (see `HeroSection::$heroConfig`)
- Slide configurations, styling options, and content are stored as component properties
- This allows dynamic content management without database dependencies

#### Route Structure
- Frontend routes in `routes/web.php`
- Authentication routes in `routes/auth.php`
- Volt routes for settings pages using `Volt::route()`

### Important Implementation Details

#### Custom Styling
- Custom Geely fonts in `resources/fonts/`
- Tailwind configured with custom CSS classes
- Mobile-first responsive design patterns

#### Media Handling
- Vehicle images and videos in `public/frontend/images/vehicles/`
- Support for both image and video hero slides
- Custom 3D carousel implementation

#### Authentication
- Laravel Breeze-style authentication
- Livewire-based auth forms
- Email verification system included

## Development Notes

### File Organization
- Frontend Livewire components: `app/Livewire/Front/`
- Frontend views: `resources/views/livewire/front/`
- Shared components: `resources/views/components/`
- Public assets: `public/frontend/`

### Database
- Uses SQLite for development (`database/database.sqlite`)
- Migrations follow Laravel standards
- Factory and seeder setup included

### Testing Strategy
- Feature tests for authentication flows
- Uses RefreshDatabase trait for clean test runs
- Pest configuration in `tests/Pest.php`