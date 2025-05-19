<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

include '../includes/db.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    try {
        $stmt = $conn->query("SELECT * FROM feedbackform ORDER BY submission_date DESC");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'data' => $data]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} elseif ($method == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $fullName = $input['full_name'] ?? '';
    $email = $input['email'] ?? '';
    $entertainment = $input['entertainment_type'] ?? '';
    $experience = $input['experience_rating'] ?? '';
    $foodQuality = $input['food_rating'] ?? '';
    $mostEnjoy = is_array($input['most_enjoy'] ?? null) ? implode(', ', $input['most_enjoy']) : '';
    $bestFoodSection = is_array($input['best_food_section'] ?? null) ? implode(', ', $input['best_food_section']) : '';
    $comments = $input['comments'] ?? '';

    try {
        if (!empty($email)) {
            $stmtCheck = $conn->prepare("SELECT COUNT(*) FROM feedbackform WHERE email = :email");
            $stmtCheck->bindParam(':email', $email);
            $stmtCheck->execute();
            if ($stmtCheck->fetchColumn() > 0) {
                echo json_encode(['success' => false, 'error' => 'Email already submitted.']);
                exit;
            }
        }

        $stmt = $conn->prepare("INSERT INTO feedbackform (
            full_name, email, entertainment_type, experience_rating,
            food_rating, most_enjoy, best_food_section, comments, submission_date
        ) VALUES (
            :fullName, :email, :entertainment, :experience,
            :foodQuality, :mostEnjoy, :bestFoodSection, :comments, NOW()
        )");

        $stmt->execute([
            ':fullName' => $fullName,
            ':email' => $email,
            ':entertainment' => $entertainment,
            ':experience' => $experience,
            ':foodQuality' => $foodQuality,
            ':mostEnjoy' => $mostEnjoy,
            ':bestFoodSection' => $bestFoodSection,
            ':comments' => $comments
        ]);

        echo json_encode(['success' => true, 'message' => 'Feedback submitted successfully.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>