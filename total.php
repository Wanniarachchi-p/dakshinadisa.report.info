<?php
// Database Connection (Secure)
$conn = new mysqli("localhost", "root", "", "user_app");
if ($conn->connect_error) {
    die("දත්ත සම්බන්ධතාවය අසාර්ථක විය: " . $conn->connect_error);
}

$selected_year = $_GET['year'] ?? '2024/25';

// Original Sinhala Data Structure (Unchanged)
$structure = [
    "සභාවන්" => ["" => [""]],
    "පවුල් ඒකක" => ["" => [""]],
    "නමස්කාර ස්ථාන" => [
        "" => ["මෙතෝදිස්ත දෙව්මැදුරු", "සභාවේ වෙනත් ගොඩනැගිලි", "අනෙකුත් ගොඩනැගිලි"]
    ],
    "පූර්ණ කාලීන සේවකයන්" => [
        "" => ["මිෂනාරි-ආධුනිකයන් ඇතුලු දේවගැතිවරුන්", "මිෂනාරි-විශ්‍රාමලත්", "මිෂනාරි-ගිහි:පුරුෂ", "මිෂනාරි-ගිහි:ස්ත්‍රී‍","ශ්‍රීලාංකික දේවගැතිවරුන්-ආධුනිකයන් ඇතුලු දේවගැතිවරුන්", "ශ්‍රීලාංකික දේවගැතිවරුන්-අතිරේක දේවගැතිවරුන්", "ශ්‍රීලාංකික දේවගැතිවරුන්-විශ්‍රාමලත් දේවගැතිවරුන්", "සහෝදරියන්",
        "ශ්‍රීලාංකික දේව සේවකවරු-එවැන්ජලිස්තවරුන්‍", "ශ්‍රීලාංකික දේව සේවකවරු-එවැන්ජලිස්තවරියන්", "ශ්‍රීලාංකික දේව සේවකවරු-ස්ථාපිත සේවකයන්", "ශ්‍රීලාංකික දේව සේවකවරු-වැටුප් නොලබන ස්ථානීය සේවකයන්"]
    ],
    "ස්වෙච්ඡා සේවකයන්" => [
        "" => ["සම්පූර්ණ ගිහි දේශකයන්", "සෝදිසිපිට සිටින ගිහි දේශකයන්", "පංති මූලකයින්", "ගබඩාකරුවන්"]
    ],
    "සාමාජිකයින්" => [
        "" => ["සම්පූර්ණ සාමාජකයින්", "පිට සිටින සාමාජකයින්", "අවුරුදු 5 දක්වා", "අවුරුදු 5-15 දක්වා", "අවුරුදු 15 ට වැඩි", "ජ්‍යෙෂ්ඨ සාමාජකයින්", "කනිෂ්ඨ වෙනත් නියෝජිතයින්"]
    ],
    "මුලු ක්‍රිස්තියානි" => ["" => [""]],
    "බෞතිස්ම" => ["" => ["වැඩිහිටි", "ළදරු"]],
    "බෞතිස්මයට සූදානම" => ["" => [""]],
    "ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික" => ["" => ["පුරුෂ", "ස්ත්‍රී"]]
];

// Data Retrieval
$stmt = $conn->prepare("SELECT category, COALESCE(sub_category, '') AS sub_category, COALESCE(sub_sub_category, '') AS sub_sub_category, value FROM total_data WHERE year = ?");
$stmt->bind_param("s", $selected_year);
$stmt->execute();
$result = $stmt->get_result();

$filled_data = [];
while ($row = $result->fetch_assoc()) {
    $filled_data[$row['category']][$row['sub_category']][$row['sub_sub_category']] = $row['value'];
}
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>දත්ත වාර්තාව - <?php echo htmlspecialchars($selected_year); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --maroon: #8B0000;
            --gold: #D4AF37;
            --light-bg: #FFF8E7;
        }
        
        body {
            font-family: 'Iskoola Pota', 'Arial', sans-serif;
            background-color: var(--light-bg);
            color: #333;
        }
        
        .header {
            background: var(--maroon);
            color: white;
            border-bottom: 3px solid var(--gold);
        }
        
        .data-card {
            border-left: 4px solid var(--gold);
            background: white;
            transition: all 0.3s;
        }
        
        .data-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(139, 0, 0, 0.1);
        }
        
        .card-header {
            background: var(--maroon);
            color: white;
            border-bottom: 1px solid var(--gold);
        }
        
        .data-value {
            color: var(--maroon);
            font-weight: 600;
        }
        
        .btn-gold {
            background-color: var(--gold);
            color: #333;
            border: none;
        }
        
        .btn-gold:hover {
            background-color: #C9A227;
            color: #333;
        }
        
        .form-control:focus {
            border-color: var(--maroon);
            box-shadow: 0 0 0 0.25rem rgba(139, 0, 0, 0.25);
        }
        
        @media print {
            .no-print { display: none; }
            .data-card { border: 1px solid #ddd !important; }
        }
    </style>
</head>
<body>
    <header class="header py-4 mb-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-1"></i> දත්ත වාර්තාව</h1>
                    <p class="mb-0"><?php echo htmlspecialchars($selected_year); ?> වර්ෂය</p>
                </div>
                <div>
                    <a href="welcome.html" class="btn btn-outline-light me-2 no-print">
                        <i class="bi bi-arrow-left"></i> ආපසු
                    </a>
                    <button onclick="window.print()" class="btn btn-gold no-print">
                        <i class="bi bi-printer"></i> පිටපත්
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main class="container">
        <div class="row mb-4 no-print">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="get" class="row g-3 align-items-center">
                            <div class="col-md-8">
                                <label for="year" class="form-label">වර්ෂය තෝරන්න</label>
                                <input type="text" class="form-control" id="year" name="year" 
                                       value="<?php echo htmlspecialchars($selected_year); ?>" 
                                       placeholder="උදා: 2024/25" required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-gold w-100">
                                    <i class="bi bi-search"></i> සොයන්න
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php foreach ($structure as $cat => $subs): ?>
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="data-card card h-100">
                        <div class="card-header">
                            <i class="bi bi-folder-fill me-2"></i><?php echo $cat; ?>
                        </div>
                        <div class="card-body p-0">
                            <?php foreach ($subs as $sub => $subsubs): ?>
                                <?php foreach ($subsubs as $subsub): ?>
                                    <?php
                                        $value = $filled_data[$cat][$sub][$subsub] ?? null;
                                        $label = $subsub ?: ($sub ?: $cat);
                                    ?>
                                    <div class="d-flex justify-content-between p-3 border-bottom">
                                        <span><?php echo $label; ?></span>
                                        <span class="data-value">
                                            <?php echo $value ?? '<span class="text-muted">දත්ත නැත</span>'; ?>
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="mt-5 py-4 text-center text-muted no-print">
         <p>&copy; <?php echo date("Y"); ?>  ශ්‍රී ලංකා මෙතෝදිස්ත සභාව - දක්ෂිණ දිසාව. සියලුම හිමිකම් ඇවිරිණි.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>