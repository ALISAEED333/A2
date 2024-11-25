<?php

// Set the URL for the API
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch the data from the API
$response = file_get_contents($URL);

// Decode the JSON response
$data = json_decode($response, true);

// Extract the results (if available)
$records = $data['results'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment Data</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
</head>
<body>
<main class="container">
    <!-- Main heading for the student enrollment data -->
    <h1>University of Bahrain: Student Enrollment Data</h1>

    <!-- Wrap table in a container to make it scrollable on small screens -->
    <div class="table-container">
        <table>
            <thead>
                <!-- Table headers for student data -->
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Program</th>
                    <th>Nationality</th>
                    <th>College</th>
                    <th>Number of Students</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($records)): ?>
                    <!-- Display message when there are no records -->
                    <tr class="no-data">
                        <td colspan="6">No data available for the specified filters.</td>
                    </tr>
                <?php else: ?>
                    <!-- Loop through each record and display data in rows -->
                    <?php foreach ($records as $record): ?>
                        <?php $fields = $record ?? []; // Ensure $record is an array or default to empty ?>
                        <tr>
                            <!-- Use htmlspecialchars to prevent XSS attacks by escaping HTML characters -->
                            <td><?= htmlspecialchars($fields['year'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($fields['semester'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($fields['the_programs'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($fields['nationality'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($fields['colleges'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($fields['number_of_students'] ?? 'N/A') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>
