<?php 
session_start();
require_once 'db.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== 'user') {
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
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">User Panel</a>
            <div class="d-flex">
                <span class="navbar-text text-white me-3">
                    Logged in as <?php echo htmlspecialchars($_SESSION["username"]); ?>
                </span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
            <p class="text-muted">You are logged in as a regular user.</p>
        </div>

    
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Search People</h5>
                        <form action="" method="get" class="d-flex">
                            <input type="text" name="search" class="form-control me-2" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search for users...">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

  
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Results</h5>
                        <?php if (count($results) > 0): ?>
                            <ul class="list-group">
                                <?php foreach ($results as $person): ?>
                                    <li class="list-group-item">
                                        <?php echo htmlspecialchars($person['name']); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <?php if ($search): ?>
                                <p class="text-muted">No result/s found.</p>
                            <?php else: ?>
                                <p class="text-muted">Use the search box above to find people.</p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
