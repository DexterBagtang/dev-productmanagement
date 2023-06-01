<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
    <style>
        /* Define your custom CSS styles here */
        body {
            /*font-family: Arial, sans-serif;*/
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --tw-text-opacity: 1;
            color: rgba(75, 85, 99, var(--tw-text-opacity));
            font-size: 12px
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 5px;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body >
<div style="background-color: #f5f5f5">
    <div style="margin: auto; padding: 5px; background-color: white;border-radius: 10px; width: 90%">
        <h2 style="font-weight: 100;">Projects Summary</h2>

        <table class="table table-bordered">
            <tbody>
            <tr style="text-align: center">
                <td style="width: 33%">
                    <div>All Projects</div>
                    <h1>{{$allProjectsCount}}</h1>
                </td>
                <td style="width: 33%">
                    <div>Ongoing Projects</div>
                    <h1>{{$ongoingProjectsCount}}</h1>
                </td>
                <td style="width: 33%">
                    <div>Completed Projects</div>
                    <h1>{{$completedProjectsCount}}</h1>
                </td>
            </tr>
            </tbody>

        </table>
        <br>
        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th>Project Title</th>
                <th>Project Age</th>
                <th>Date Created</th>
                <th>Proposal Target Date</th>
                <th>Project Status</th>

            </tr>
            </thead>
            <tbody>
            <!-- Loop through projects to display the details -->
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->project_title }}</td>
                    <td>{{ $project->project_age}}{{($project->project_age > 0) ? 'd':''}}</td>
                    <td>{{ \Carbon\Carbon::parse($project->created_at)->format('d-M-Y h:i a') }}</td>
                    <td>{{ \Carbon\Carbon::parse($project->date_needed)->format('d-M-Y') }}</td>
                    <td>{{$project->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <p>Please log in <a href="https://pm.philcom.com/viewprojectstatus">here</a> to access and view all the details of the projects.</p>
    </div>
</div>

</body>
</html>


