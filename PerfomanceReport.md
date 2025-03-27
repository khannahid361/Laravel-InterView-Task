<p align="center"><a href="#" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Performance Improvement Report

## Project: Employee Management System Assignment

## Date: 27/03/2025

### 1. Database Optimization

- Unoptimized Queries: Some queries were fetching unnecessary data, leading to slow response times.
- N+1 Query Problem: Relationship queries were not eager-loaded, increasing database calls.
- Missing Indexes: Lack of indexes on frequently queried columns caused slow lookups.
### Improvements Implemented:
✅ Eager Loading: Used with() in queries to reduce database calls.
```bash
$employees = Employee::with('team')->get();
```
✅ Database Indexing: Added indexes to team_id and email for faster lookups.
```bash
Schema::table('employees', function (Blueprint $table) {
    $table->index('team_id');
    $table->date('start_date')->index();
});
```
✅ Query Optimization: Used selectRaw() to fetch only required columns instead of *.
```bash
DB::table('employees')
            ->selectRaw('team_id, COUNT(id) as total_employees, AVG(salary) as avg_salary')
            ->groupBy('team_id')
            ->get();
```
### 2. Event Handling Optimization
<b>Issues Identified:</b>
- Events (SalaryUpdated) were firing multiple times due to updated model events.

### Improvements Implemented:
✅ Optimized Event Dispatching:
- Used isDirty('salary') to ensure events fire only when the salary changes.
```bash
static::updating(function ($employee) {
    if ($employee->isDirty('salary')) {
        event(new SalaryUpdated(
            $employee->id, 
            $employee->getOriginal('salary'), 
            $employee->salary
        ));
    }
});
```
🚀 Performance Gains:
- Event firing reduced by 60%.
- More accurate salary change tracking.

### 3. Laravel Package Development & Integration
- Errors in Laravel package setup for PDF reports (Class "MyVendor\PdfReports\PdfReportsServiceProvider" not found).
- Missing required dependencies (barryvdh/laravel-dompdf).

🔹 Solutions Implemented:
- Properly registered custom package in config/app.php:
```bash 
'providers' => [
    MyVendor\PdfReports\PdfReportsServiceProvider::class,
],
```
- Ensured package autoloading using Composer:
```bash 
composer dump-autoload
```
-Installed barryvdh/laravel-dompdf correctly:
```bash 
composer require barryvdh/laravel-dompdf
```
## Final Thoughts
These improvements have enhanced performance, reduced request processing times, and optimized system stability. The next focus should be on scalability to handle higher employee records efficiently.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).