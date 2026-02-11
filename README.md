# Ticket System - Laravel 11 CRUD

Simple ticket management system built with Laravel 11.

## Setup

1. Install dependencies:

```bash
composer install
```

2. Generate application key:

```bash
php artisan key:generate
```

3. Run migrations:

```bash
php artisan migrate
```

4. Start development server:

```bash
php artisan serve
```

Akses aplikasi di: http://localhost:8000

## Testing

### Create Ticket

1. Navigate to http://localhost:8000
2. Click "Create New Ticket"
3. Fill in title, description, status, and priority
4. Submit form
5. Verify ticket appears in list

### View Ticket

1. From tickets list, click "View" on any ticket
2. Verify all details are displayed correctly

### Update Ticket

1. From tickets list, click "Edit" on any ticket
2. Modify any field
3. Submit form
4. Verify changes are saved

### Delete Ticket

1. From tickets list, click "Delete" on any ticket
2. Confirm deletion
3. Verify ticket is removed from list

## Features

- Create tickets with title, description, status, and priority
- View all tickets in paginated list
- View individual ticket details
- Edit existing tickets
- Delete tickets
- Form validation
- Success notifications
- Clean and responsive UI with Tailwind CSS
