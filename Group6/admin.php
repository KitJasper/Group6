<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require('includes/db.php');
include('includes/auth.php');

class AdminDashboard {
    private $conn;
    private $userAuthenticator;

    public function __construct($db_connection, $authenticator) {
        $this->conn = $db_connection;
        $this->userAuthenticator = $authenticator;
    }

    public function isAdminLoggedIn() {
        return isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin';
    }

    public function logout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
            session_destroy();
            header("Location: login.php");
            exit();
        }
    }

    public function getReservations() {
        try {
            $query = "SELECT r.date, u.username as user, r.computer_count, r.purpose, r.status, r.id
                      FROM reservations r
                      INNER JOIN users u ON r.user_id = u.id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
            return [];
        }
    }

    public function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}

$userAuthenticator = new UserAuthenticator($conn);
$adminDashboard = new AdminDashboard($conn, $userAuthenticator);

if (!$adminDashboard->isAdminLoggedIn()) {
    header("Location: login.php");
    exit();
}

$adminDashboard->logout();
$reservations = $adminDashboard->getReservations();

function admindashboard($reservations, $csrfToken) {
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="icon" href="images/ctu.png" type="image/x-icon">
    <link rel="stylesheet" href="admin.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/cf223ee5eb.js" crossorigin="anonymous"></script>
</head>

<body class="font-sans">

    <div class="header p-5 text-white">
        <h1 class="container">Admin Dashboard</h1>
    </div>

    <div class="container flex justify-between mx-auto mt-8">
        <h2 class="text-2xl sm:text-3xl">Reservations</h2>
        <form method="post" action="" class="text-right">
            <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
            <button type="submit" name="logout"
                class="bg-red-500 hover:bg-red-700 text-white font-bold  sm:py-4 sm:px-4 rounded"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</button>
        </form>
    </div>

    <div class="wrapper bg-white rounded-lg shadow-xl p-4 sm:p-8 overflow-x-auto container mx-auto mt-4 text-center">
        <div class="w-full overflow-x-auto">
            <table class="w-full table-auto border border-gray-300 text-sm sm:text-lg">
                <thead>
                    <tr>
                        <th class="px-4 py-2 bg-blue-500 text-white border hidden md:table-cell">Date</th>
                        <th class="px-4 py-2 bg-blue-500 text-white border">User</th>
                        <th class="px-4 py-2 bg-blue-500 text-white border hidden md:table-cell">Computer Count</th>
                        <th class="px-4 py-2 bg-blue-500 text-white border hidden md:table-cell">Purpose</th>
                        <th class="px-4 py-2 bg-blue-500 text-white border">Status</th>
                        <th class="px-4 py-2 bg-blue-500 text-white border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $row) { ?>
                    <tr>
                        <td class="px-4 py-2 border hidden md:table-cell">
                            <?= htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8') ?>
                        </td>
                        <td class="px-4 py-2 border">
                            <?= htmlspecialchars($row['user'], ENT_QUOTES, 'UTF-8') ?>
                        </td>
                        <td class="px-4 py-2 border hidden md:table-cell">
                            <?= htmlspecialchars($row['computer_count'], ENT_QUOTES, 'UTF-8') ?>
                        </td>
                        <td class="px-4 py-2 border hidden md:table-cell">
                            <?= htmlspecialchars($row['purpose'], ENT_QUOTES, 'UTF-8') ?>
                        </td>
                        <td
                            class="px-4 py-2 border <?= $row['status'] === 'approved' ? 'text-green-500' : ($row['status'] === 'pending' ? 'text-blue-500' : 'text-red-500') ?>">
                            <?= htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') ?>
                        </td>
                        <td class="px-4 py-2 border">
                            <div
                                class="<?= $row['status'] === 'Approved' ? 'bg-green-500' : ($row['status'] === 'Pending' ? 'bg-blue-500' : 'bg-red-500') ?> text-white py-4 px-4 sm:py-4 sm:px-4 rounded">
                                <a href="delete_reservation.php?id=<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') ?>"
                                    class="text-white <?= $row['status'] === 'Approved' ? 'bg-red-500' : '' ?>"> 
                                    <i class="fa-regular fa-trash-can"></i> Delete</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>



<?php
}

$csrfToken = $adminDashboard->generateCSRFToken();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout']) && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $adminDashboard->logout();
}

admindashboard($reservations, $csrfToken);
?>
