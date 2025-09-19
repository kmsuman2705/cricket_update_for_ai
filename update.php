<?php
// Accept JSON input from fetch() POST
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (isset($data['score'])) {
    $score = $data['score'];

    // ✅ Use absolute path to score.json
    $filePath = "/var/www/html/score.json";

    // ✅ Convert to JSON
    $jsonData = json_encode(["score" => $score]);

    // ✅ Try saving
    if (file_put_contents($filePath, $jsonData) !== false) {
        echo "✅ Score updated: $score";
    } else {
        // ❌ Error writing file
        http_response_code(500);
        echo "❌ Failed to write score.json (permissions issue?)";
    }
} else {
    // ❌ Invalid or missing score field
    http_response_code(400);
    echo "❌ Invalid request: No score provided.";
}
?>
