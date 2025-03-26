<!DOCTYPE html>
<html>
<head>
    <title>Employee Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Employee Report</h2>
    <table>
        <tr>
            <th>Name</th>
            {{-- <th>Team</th> --}}
            <th>Salary</th>
            <th>Start Date</th>
        </tr>
        @foreach($employees as $employee)
        <tr>
            <td>{{ $employee->name }}</td>
            {{-- <td>{{ $employee->email }}</td> --}}
            <td>${{ number_format($employee->salary, 2) }}</td>
            <td>{{ $employee->start_date }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
