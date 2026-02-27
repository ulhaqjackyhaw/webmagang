# Copilot Instructions - Sistem Manajemen Magang

## Project Overview
This is a **Laravel 12** internship management system with role-based access control (RBAC) for two roles: **Admin** and **HC (Human Capital)**. The system features a public landing page for intern registration, with file uploads, approval workflows, and WhatsApp notification integration.

## Core Architecture

### Role-Based Access Pattern
- **Custom middleware**: `RoleMiddleware` (`app/Http/Middleware/RoleMiddleware.php`) checks user roles via variadic parameters
- **Route protection**: Apply `middleware(['role:admin,hc'])` in `routes/web.php`
- **Two access levels**:
  - **Public**: Anyone can access landing page and register for internship
  - **Admin/HC**: Login required to manage applications

### Data Flow
1. **Public users** submit intern applications via landing page (`PublicInternController`) with file uploads → `created_by` = NULL, status: `pending`
2. **HC/Admin** login to review applications → approves/rejects via `InternController@updateStatus`
3. On approval/rejection → auto-redirect to WhatsApp with pre-filled message using `wa.me` API
4. **HC/Admin** moves approved interns to `AcceptedIntern` with internship period and unit assignment

### Key Models & Relationships
- `User`: Has `role` field (admin/hc only) - no package-based RBAC
- `Intern`: May have creator (`User` - nullable), has status (pending/approved/rejected)
- `AcceptedIntern`: Belongs to `Intern` and creator, tracks internship period/unit

## Critical Development Workflows

### Setup Commands
```powershell
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed  # Seeds default users (see UserSeeder)
php artisan storage:link
npm install
```

### Running the Application
```powershell
# Quick start (single terminal)
php artisan serve

# Full dev environment with watch mode (uses composer script)
composer dev  # Runs: server, queue, logs (pail), vite concurrently
```

### Default Login Credentials (UserSeeder)
- Admin: `admin@magang.com` / `4DM1NHC2025`
- HC: `hc@magang.com` / `PasswordnyaHC2025`

**Note**: TU role has been removed - registration is now public via landing page.

## Project-Specific Conventions

### File Upload Pattern
- **Storage**: Files saved to `storage/app/public/{proposals,cvs,surats}` using `store()` method
- **Validation**: Max 2MB, types: `pdf,doc,docx`
- **Deletion**: Always use `Storage::disk('public')->delete($path)` when replacing files
- **Access**: Files served via `storage` symlink (created by `php artisan storage:link`)

### WhatsApp Integration
When updating intern status to approved/rejected:
1. Format phone: Remove non-digits, convert `0xxx` → `62xxx`
2. Build URL: `https://wa.me/{phone}?text={urlencode($message)}`
3. Redirect directly (not return view) to open WhatsApp

**Template messages** are hardcoded in `InternController@updateStatus` - customize there.

### Excel Export Implementation
- Uses `maatwebsite/excel` package
- Export classes in `app/Exports/` implement multiple concerns:
  - `WithHeadings`, `WithMapping`, `WithStyles`, `ShouldAutoSize`, `WithTitle`
- Apply custom styling via `PhpOffice\PhpSpreadsheet` (see `InternsExport` for header formatting)
- Export routes return: `Excel::download(new InternsExport($data), 'filename.xlsx')`

### Frontend Stack
- **Blade templates** with Tailwind CSS v4 (via `@tailwindcss/vite`)
- Assets compiled with **Vite**: Edit `resources/css/app.css` or `resources/js/app.js`
- Build: `npm run build` (production) or `npm run dev` (watch mode)
- Include in layouts: `@vite(['resources/css/app.css', 'resources/js/app.js'])`

## Common Patterns
Public Registration
```php
// Public users can register without authentication
// created_by is NULL for public registrations
$data['created_by'] = null;
Intern::create($data);
```

### Controller Authorization (HC/Admin Only)
```php
// Only HC and Admin can manage interns
// No ownership checks needed - all managed by HC/Admin
Route::middleware(['role:hc,admin'])->group(function () {
    Route::resource('interns', InternController::class);
});
```

### Query Pattern for Interns
```php
// HC/Admin see all interns with creator info (nullable)
$query = Intern::with('creator');   $query->with('creator');  // HC/Admin see all with creator info
}
```

### Filter Pattern (Year/Month)
Controllers use `whereYear()` and `whereMonth()` for filtering. Available years/months dynamically fetched from existing data using `selectRaw('YEAR(created_at) as year')`.

## Important Files to Reference

- **Route definitions**: `routes/web.php` - shows all role-based route groups
- **Middleware registration**: `bootstrap/app.php` - alias middleware as `'role'`
- **Validation messages**: Indonesian language used in controller validations (e.g., `'rejection_reason.required_if'`)
- **Excel styling example**: `app/Exports/InternsExport.php` - comprehensive PhpSpreadsheet styling

## Testing & Debugging
- Run tests: `composer test` (runs `php artisan test`)
- Queue debugging: Use `php artisan pail` for real-time log tailing
- File upload issues: Check `storage/app/public` permissions and verify symlink exists

## What NOT to Do
- Don't add RBAC packages (Spatie Permission, etc.) - uses simple role field
- Don't create API routes - this is a traditional MVC app with Blade views
- Don't use JavaScript frameworks (React/Vue) - uses vanilla JS + Vite
- Don't modify seeder passwords without updating documentation
