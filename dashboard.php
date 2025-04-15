<?php 
session_start();


require_once 'db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$search = '';
$results = [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']); 

    $sql = "SELECT * FROM people WHERE name LIKE '%$search%'";
    $query = $conn->query($sql);

    if ($query && $query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            $results[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column justify-content-center align-items-center vh-100 bg-light">

    <div class="container text-center mb-4">
        <div class="card shadow-sm p-4">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
            <p class="text-muted">You are logged in.</p>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <div class="container">
        <h2>Search</h2>
        <form action="" method="get" class="d-flex mb-3">
            <input type="text" name="search" class="form-control me-2" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search for users...">
            <button type="submit" class="submit btn btn-primary">Search</button>
        </form>

        <h3>Results</h3>
        <?php if (count($results) > 0): ?>
            <ul class="list-group">
                <?php foreach ($results as $person): ?>
                    <li class="list-group-item">
                        <?php echo htmlspecialchars($person['name']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <?php if($search):?>
            <p>No result/s found.</p>
        <?php endif; ?>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
