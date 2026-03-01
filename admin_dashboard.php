<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check admin authentication
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit;
}

// Import PDO connection
require_once("includes/connect.php");

// Initialize variables
$message = '';
$message_type = '';

// CRUD Operation Handlers
// 1. Add new project
if (isset($_POST['add_project'])) {
    $project_name = trim($_POST['project_name']);
    $project_flag = trim($_POST['project_flag']);

    if (!empty($project_name) && !empty($project_flag)) {
        try {
            $sql = "INSERT INTO project (project, flag, is_deleted) VALUES (:project, :flag, 0)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':project' => $project_name,
                ':flag' => $project_flag
            ]);
            $message = "Project added successfully!";
            $message_type = "success";
        } catch (PDOException $e) {
            $message = "Error adding project: " . $e->getMessage();
            $message_type = "error";
        }
    } else {
        $message = "Project name and category are required!";
        $message_type = "error";
    }
}

// 2. Update existing project
if (isset($_POST['update_project'])) {
    $project_id = intval($_POST['project_id']);
    $project_name = trim($_POST['project_name']);
    $project_flag = trim($_POST['project_flag']);

    if ($project_id > 0 && !empty($project_name) && !empty($project_flag)) {
        try {
            $sql = "UPDATE project SET project = :project, flag = :flag WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':project' => $project_name,
                ':flag' => $project_flag,
                ':id' => $project_id
            ]);
            $message = "Project updated successfully!";
            $message_type = "success";
        } catch (PDOException $e) {
            $message = "Error updating project: " . $e->getMessage();
            $message_type = "error";
        }
    } else {
        $message = "Invalid project data!";
        $message_type = "error";
    }
}

// 3. Soft delete project (mark as deleted)
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $project_id = intval($_GET['delete']);
    try {
        $sql = "UPDATE project SET is_deleted = 1 WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $project_id]);
        $message = "Project deleted (soft) successfully!";
        $message_type = "success";
    } catch (PDOException $e) {
        $message = "Error deleting project: " . $e->getMessage();
        $message_type = "error";
    }
}

// 4. Restore soft deleted project
if (isset($_GET['restore']) && is_numeric($_GET['restore'])) {
    $project_id = intval($_GET['restore']);
    try {
        $sql = "UPDATE project SET is_deleted = 0 WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $project_id]);
        $message = "Project restored successfully!";
        $message_type = "success";
    } catch (PDOException $e) {
        $message = "Error restoring project: " . $e->getMessage();
        $message_type = "error";
    }
}

// 5. Get projects (filter by deleted status)
$show_deleted = isset($_GET['show_deleted']) ? 1 : 0;
try {
    $sql = "SELECT * FROM project WHERE is_deleted = :is_deleted ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':is_deleted' => $show_deleted]);
    $projects = $stmt->fetchAll();
} catch (PDOException $e) {
    $message = "Error fetching projects: " . $e->getMessage();
    $message_type = "error";
    $projects = [];
}

// Get project for edit
$edit_project = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    try {
        $sql = "SELECT * FROM project WHERE id = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $edit_id]);
        $edit_project = $stmt->fetch();
    } catch (PDOException $e) {
        $message = "Error loading project for edit: " . $e->getMessage();
        $message_type = "error";
    }
}

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin_login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Yi Cheng</title>
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <style>
        .admin-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }
        .card {
            background: #fff;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        .msg-success {
            color: #228B22;
            background: #A8E6CF;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        .msg-error {
            color: #D8000C;
            background: #FFCCCB;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        th {
            background: #f8f9fa;
            font-weight: 600;
        }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
            display: inline-block;
            font-size: 0.875rem;
            cursor: pointer;
            border: none;
        }
        .btn-primary {
            background: #FF6F61;
            color: white;
        }
        .btn-primary:hover {
            background: #FF8A7A;
        }
        .btn-secondary {
            background: #6E7B8B;
            color: white;
        }
        .btn-secondary:hover {
            background: #86939e;
        }
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background: #bb2d3b;
        }
        .btn-restore {
            background: #28a745;
            color: white;
        }
        .btn-restore:hover {
            background: #218838;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #6E7B8B;
        }
        input, select, textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #6E7B8B;
            border-radius: 0.25rem;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #FF6F61;
            outline: none;
        }
    </style>
</head>
<body style="background-color: #F8F8F8; color: #6E7B8B;">
    <div class="admin-container">
        <!-- Admin Header -->
        <div class="admin-header">
            <h1 class="text-3xl" style="font-family: 'Poppins', sans-serif; color: #0D0D0D;">
                Admin Dashboard - Manage Projects
            </h1>
            <div>
                <span style="margin-right: 1rem;">Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                <a href="?logout=1" class="btn btn-secondary">Logout</a>
            </div>
        </div>

        <!-- Message Display -->
        <?php if ($message): ?>
            <div class="msg-<?php echo $message_type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- Add/Edit Project Form -->
        <div class="card">
            <h2 class="text-xl mb-4" style="font-family: 'Poppins', sans-serif; color: #0D0D0D;">
                <?php echo $edit_project ? 'Edit Project' : 'Add New Project'; ?>
            </h2>
            <form method="POST" action="admin_dashboard.php" class="space-y-4">
                <?php if ($edit_project): ?>
                    <input type="hidden" name="project_id" value="<?php echo $edit_project['id']; ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="project_name">Project Name *</label>
                    <input type="text" id="project_name" name="project_name" required
                        value="<?php echo $edit_project ? htmlspecialchars($edit_project['project']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="project_flag">Project Category *</label>
                    <select id="project_flag" name="project_flag" required>
                        <option value="UI & UX" <?php echo ($edit_project && $edit_project['flag'] == 'UI & UX') ? 'selected' : ''; ?>>UI & UX</option>
                        <option value="Motion Graphics" <?php echo ($edit_project && $edit_project['flag'] == 'Motion Graphics') ? 'selected' : ''; ?>>Motion Graphics</option>
                        <option value="Rebrand" <?php echo ($edit_project && $edit_project['flag'] == 'Rebrand') ? 'selected' : ''; ?>>Rebrand</option>
                        <option value="Backend" <?php echo ($edit_project && $edit_project['flag'] == 'Backend') ? 'selected' : ''; ?>>Backend</option>
                        <option value="Other" <?php echo ($edit_project && $edit_project['flag'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                
                <button type="submit" name="<?php echo $edit_project ? 'update_project' : 'add_project'; ?>" class="btn btn-primary">
                    <?php echo $edit_project ? 'Update Project' : 'Add Project'; ?>
                </button>
                <?php if ($edit_project): ?>
                    <a href="admin_dashboard.php" class="btn btn-secondary">Cancel Edit</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Projects List -->
        <div class="card">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl" style="font-family: 'Poppins', sans-serif; color: #0D0D0D;">
                    Projects List
                </h2>
                <div>
                    <a href="admin_dashboard.php" class="btn btn-secondary <?php echo !$show_deleted ? 'active' : ''; ?>">
                        Active Projects
                    </a>
                    <a href="admin_dashboard.php?show_deleted=1" class="btn btn-secondary ml-2 <?php echo $show_deleted ? 'active' : ''; ?>">
                        Deleted Projects
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Project Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($projects)): ?>
                            <tr>
                                <td colspan="5" class="text-center">No projects found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($projects as $project): ?>
                                <tr>
                                    <td><?php echo $project['id']; ?></td>
                                    <td><?php echo htmlspecialchars($project['project']); ?></td>
                                    <td><?php echo htmlspecialchars($project['flag']); ?></td>
                                    <td><?php echo $project['is_deleted'] ? '<span style="color: #dc3545;">Deleted</span>' : '<span style="color: #28a745;">Active</span>'; ?></td>
                                    <td>
                                        <?php if (!$project['is_deleted']): ?>
                                            <a href="?edit=<?php echo $project['id']; ?>" class="btn btn-secondary">Edit</a>
                                            <a href="?delete=<?php echo $project['id']; ?>" class="btn btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this project?')">Delete</a>
                                        <?php else: ?>
                                            <a href="?restore=<?php echo $project['id']; ?>" class="btn btn-restore">Restore</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>