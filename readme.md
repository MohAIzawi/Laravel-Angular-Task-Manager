# Laravel-Angular Task Manager

A full-stack task management application built with Laravel backend and Angular frontend.

## Features

- 🔐 **User Authentication** - Registration and login with JWT tokens
- 📝 **Task Management** - Create, read, update, delete tasks
- 👥 **Task Assignment** - Assign tasks to users
- 📅 **Due Dates** - Set and track task deadlines
- 🎨 **Modern UI** - Material Design with responsive layout
- 🛡️ **Secure API** - Laravel Sanctum authentication
- 📱 **Mobile Friendly** - Responsive design for all devices

## Tech Stack

### Backend
- **Laravel 10** - PHP framework
- **Laravel Sanctum** - API authentication
- **SQLite** - Database (easily switchable to MySQL/PostgreSQL)
- **PHP 8.1+** - Programming language

### Frontend
- **Angular 18** - TypeScript framework
- **Angular Material** - UI component library
- **RxJS** - Reactive programming
- **SCSS** - Styling

## Quick Start

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js 18+ and npm
- Git

### Backend Setup

```bash
# Navigate to backend directory
cd Backend-Laravel

# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Start Laravel development server
php artisan serve
```

The Laravel API will be available at `http://localhost:8000`

### Frontend Setup

```bash
# Navigate to frontend directory
cd frontend-angular

# Install Node.js dependencies
npm install

# Start Angular development server
ng serve
```

The Angular application will be available at `http://localhost:4200`

## Usage

1. **Register** a new account or **login** with existing credentials
2. **Create tasks** with title, description, due date, and assignee
3. **View all tasks** in a clean, organized table
4. **Edit or delete** tasks as needed
5. **Logout** when finished

## API Endpoints

### Authentication
- `POST /api/auth/register` - User registration
- `POST /api/auth/login` - User login
- `POST /api/auth/logout` - User logout

### Tasks
- `GET /api/tasks` - Get all tasks
- `POST /api/tasks` - Create new task
- `GET /api/tasks/{id}` - Get specific task
- `PUT /api/tasks/{id}` - Update task
- `DELETE /api/tasks/{id}` - Delete task

## Project Structure

```
Laravel-Angular-API/
├── Backend-Laravel/          # Laravel backend
│   ├── app/
│   │   ├── Http/Controllers/ # API controllers
│   │   ├── Models/          # Eloquent models
│   │   └── Http/Requests/   # Form validation
│   ├── database/
│   │   └── migrations/      # Database migrations
│   └── routes/
│       └── api.php          # API routes
└── frontend-angular/         # Angular frontend
    ├── src/
    │   ├── app/
    │   │   ├── core/        # Core services and guards
    │   │   ├── features/    # Feature modules
    │   │   └── shared/      # Shared components
    │   └── environments/    # Environment configs
    └── angular.json         # Angular configuration
```

## Screenshots

### Login Page
Modern authentication interface with Material Design

### Task Dashboard
Clean, responsive task management interface

### Task Creation
Intuitive form for creating and editing tasks

## Development

### Running Both Servers

```bash
# Terminal 1: Laravel Backend
cd Backend-Laravel
php artisan serve

# Terminal 2: Angular Frontend
cd frontend-angular
ng serve
```

### Database

The application uses SQLite by default for easy setup. To switch to MySQL or PostgreSQL:

1. Update `.env` file in `Backend-Laravel/`
2. Change `DB_CONNECTION` and related database settings
3. Run migrations: `php artisan migrate`

### Environment Configuration

#### Laravel (.env)
```env
APP_NAME="Task Manager API"
APP_ENV=local
APP_KEY=base64:your-key-here
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite

SANCTUM_STATEFUL_DOMAINS=localhost:4200
```

#### Angular (environment.ts)
```typescript
export const environment = {
  production: false,
  apiUrl: 'http://localhost:8000/api',
  tokenKey: 'auth_token'
};
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open source and available under the [MIT License](LICENSE).

## Troubleshooting

### Common Issues

**CORS Errors:**
- Ensure `SANCTUM_STATEFUL_DOMAINS` includes `localhost:4200` in Laravel `.env`
- Check that Angular is running on port 4200

**Database Issues:**
- Ensure database file exists and has proper permissions
- Run `php artisan migrate:fresh` to reset database

**Authentication Issues:**
- Clear browser localStorage
- Check that tokens are being sent in request headers
- Verify API routes are accessible

## Support

If you have any questions or run into issues:

1. Check the troubleshooting section above
2. Open an issue on GitHub
3. Review the API endpoints documentation

## Future Enhancements

- [ ] Real-time notifications
- [ ] File attachments for tasks
- [ ] Task categories and labels
- [ ] Advanced filtering and search
- [ ] Team collaboration features
- [ ] Mobile app (React Native/Flutter)
- [ ] Email notifications
- [ ] Task templates
- [ ] Time tracking
- [ ] Reporting and analytics

---

**Made with ❤️ using Laravel and Angular**