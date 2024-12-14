<?php require_once 'core/dbconfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
    h2{
    text-align: center;
    margin-top: 20px;
        }
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        text-align: left;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    th {
        background-color: #f4f4f4;
        color: #333;
        font-weight: bold;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
    td a {
        color: #007BFF;
        text-decoration: none;
    }
    td a:hover {
        text-decoration: underline;
    }
</style>
<?php if (isset($_SESSION['message'])) { ?>
    <h1 style="color: green; text-align: center; background-color: ghostwhite; border-style: solid;">    
        <?php echo $_SESSION['message']; ?>
    </h1>
<?php } unset($_SESSION['message']); ?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET">
    <input type="text" name="searchInput" placeholder="Search here">
    <input type="submit" name="searchBtn">

    <h2>ICHEL STORE</h2>
</form>
<a href="index.php">Clear search query</a>
<a href="insert.php">Insert query here</a>

<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Position</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Home Address</th>
        <th>Nationality</th>
        <th>Date Added</th>
        <th>Edit / Delete</th>
    </tr>

<?php 
if (!isset($_GET['searchBtn'])) {
    $getallappli = getallappli($pdo);
    foreach ($getallappli as $row) { ?>
        <tr>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
            <td><?php echo $row['position']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['home_address']; ?></td>
            <td><?php echo $row['nationality']; ?></td>
            <td><?php echo $row['date_added']; ?></td>
            <td>
                <a href="edit.php?job_id=<?php echo $row['job_id']; ?>">Edit</a>
                <a href="delete.php?job_id=<?php echo $row['job_id']; ?>">Delete</a>
            </td>
        </tr>
    <?php }
} else {
    $searchforappli = searchforappli($pdo, $_GET['searchInput']);
    foreach ($searchforappli as $row) { ?>
        <tr>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
            <td><?php echo $row['position']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['home_address']; ?></td>
            <td><?php echo $row['nationality']; ?></td>
            <td><?php echo $row['date_added']; ?></td>
            <td>
                <a href="edit.php?job_id=<?php echo $row['job_id']; ?>">Edit</a>
                <a href="delete.php?job_id=<?php echo $row['job_id']; ?>">Delete</a>
            </td>
        </tr>
    <?php }
} ?>
</table>
</body>
</html>
