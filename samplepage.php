<?php 
$url = 'https://jsonplaceholder.typicode.com/posts';
$response = file_get_contents($url);
$data = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <style>
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        .head {
            font-weight: bold;
            color: #333;
        }
        .post {
            border: 1px solid #ccc;
            padding: 1rem;
            margin: 1rem;
            border-radius: 8px;
            max-width: 100%;
        }
    </style>
</head>
<body>
    <h1>Posts</h1>
    <?php foreach ($data as $post): ?>
        <div class="post">
            <h2 ><span class="head">Title: </span> <?= htmlspecialchars($post['title']) ?></h2>
            <p ><span class="head">Body: </span> <?= htmlspecialchars($post['body']) ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
