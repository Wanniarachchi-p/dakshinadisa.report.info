

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$table_name = "moratumulla_data";

// List of all possible fields
$all_fields = [
    "සභාවන්", "පවුල්", "මෙතෝදිස්ත_දෙව්මැදුරු", "සභාවේ_වෙනත්_ගොඩනැගිලි", "අනෙකුත්_ගොඩනැගිලි",
    "මිෂනාරි_ආධුනිකයන්_ඇතුලු_දේවගැතිවරුන්", "විශ්‍රාමලත්", "පුරුෂ", "ස්ත්‍රී‍",
    "ශ්‍රීලාංකික_ආධුනිකයන්_ඇතුලු_දේවගැතිවරුන්", "අතිරේක_දේවගැතිවරුන්", "විශ්‍රාමලත්_දේවගැතිවරුන්", "සහෝදරියන්",
    "එවැන්ජලිස්ත_පුරුෂ", "එවැන්ජලිස්ත_ස්ත්‍රී", "ස්ථාපිත_සේවකයන්", "වැටුප්_නොලබන_ස්ථානීය_සේවකයන්",
    "සම්පූර්ණ_ගිහි_දේශකයන්", "සෝදිසිපිට_සිටින_ගිහි_දේශකයන්", "පංති_මූලකයින්", "ගබඩාකරුවන්",
    "සම්පූර්ණ_සාමාජකයින්", "සෝදිසිපිට_සිටින_සාමාජකයින්", "අවුරුදු_5_දක්වා", "අවුරුදු_5-15_දක්වා", "අවුරුදු_15_ට_වැඩි", "ජ්‍යෙෂ්ඨ_සාමාජකයින්", "කනිෂ්ඨ_වෙනත්_නියෝජිතයින්",
    "මුලු_ක්‍රිස්තියානි", "වැඩිහිටි", "ළදරු", "බෞතිස්මයට_සූදානම",
    "ක්ෂේත්‍ර_පුහුණුව_ලැබූ_ආධුනික_පුරුෂ", "ක්ෂේත්‍ර_පුහුණුව_ලැබූ_ආධුනික_ස්ත්‍රී"
];

// Handle POST request (form submission)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $columns = [];
    $values = [];
    
    // Process each field
    foreach ($all_fields as $field_id) {
        $number_field = $field_id . "_number";
        $description_field = $field_id . "_description";
        
        // Add number field
        $columns[] = "`" . $conn->real_escape_string($number_field) . "`";
        $number_value = isset($_POST[$number_field]) ? $_POST[$number_field] : '';
        $values[] = "'" . $conn->real_escape_string($number_value) . "'";
        
        // Add description field
        $columns[] = "`" . $conn->real_escape_string($description_field) . "`";
        $description_value = isset($_POST[$description_field]) ? $_POST[$description_field] : '';
        $values[] = "'" . $conn->real_escape_string($description_value) . "'";
    }
    
    // Construct and execute the SQL INSERT query
    $sql_columns = implode(", ", $columns);
    $sql_values = implode(", ", $values);
    $sql_insert = "INSERT INTO `{$table_name}` ({$sql_columns}) VALUES ({$sql_values})";
    
    if ($conn->query($sql_insert) === TRUE) {
        $success_message = "දත්ත සාර්ථකව සුරකින ලදී! (Data saved successfully!)";
    } else {
        $error_message = "දෝෂය: " . $conn->error;
    }
}

// Function to process data for display
function processData($field_id, $row_data) {
    $number_field = $field_id . "_number";
    $description_field = $field_id . "_description";
    
    $display_count = isset($row_data[$number_field]) ? $row_data[$number_field] : '';
    $display_description = isset($row_data[$description_field]) ? $row_data[$description_field] : '';
    
    return [
        'display_count' => $display_count,
        'display_description' => $display_description
    ];
}
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>මොරටුමුල්ල මෙතොදිස්ත සභාව - දත්ත පෙන්වීම</title>
    <style>
        :root {
            --primary-color: #8B0000;
            --secondary-color: #f4f6f9;
            --accent-color: #D4AF37;
            --text-color: #333333;
            --light-text: #6c757d;
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --header-gradient: linear-gradient(135deg, #700000, #8B0000);
            --border-color: #e0d6c0;
            --success-color: #28a745;
            --hover-color: #700000;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Arial', 'Iskoola Pota', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: #f9f5e9;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: var(--header-gradient);
            color: white;
            padding: 20px 0;
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar a, .dropdown-btn {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            font-size: 15px;
            border-left: 4px solid transparent;
            transition: all 0.3s;
        }
        
        .sidebar a:hover, .dropdown-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--accent-color);
        }

        .dropdown-btn {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            outline: none;
            cursor: pointer;
            position: relative;
        }
        
        .dropdown-btn::after {
            content: "▾";
            position: absolute;
            right: 20px;
            color: var(--accent-color);
            transition: transform 0.3s;
        }
        
        .dropdown-container {
            display: none;
            background-color: rgba(0, 0, 0, 0.15);
            padding-left: 20px;
        }
        
        .active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--accent-color);
        }
        
        .content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
            background-color: var(--secondary-color);
        }
        
        .header {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .header h1 {
            color: var(--primary-color);
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .data-section {
            background: white;
            margin: 20px 0;
            padding: 25px;
            border-radius: 8px;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(212, 175, 55, 0.3);
            scroll-margin-top: 20px; /* For smooth scroll alignment */
        }
        
        .data-section h2 {
            color: var(--primary-color);
            font-size: 20px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
        }
        
        .data-row {
            display: flex;
            margin: 10px 0;
            align-items: flex-start;
        }
        
        .data-label {
            font-weight: 600;
            color: #555;
            min-width: 150px;
            margin-right: 15px;
        }
        
        .data-value {
            flex: 1;
            color: var(--text-color);
        }
        
        .data-value.number {
            font-weight: bold;
            color: var(--primary-color);
            font-size: 18px;
        }
        
        .description {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            border-left: 4px solid var(--accent-color);
        }
        
        .no-data {
            color: var(--light-text);
            font-style: italic;
        }
        
        .status-message {
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            text-align: center;
        }
        
        .status-message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .status-message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .footer {
            padding: 20px;
            margin-top: 30px;
            text-align: center;
            background-color: #e9ecef;
            border-top: 1px solid var(--border-color);
            color: var(--light-text);
        }
        
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <nav class="sidebar">
        <a href="#සභාවන්">සභාවන්</a>
        <a href="#පවුල්">පවුල්</a>

        <button class="dropdown-btn">නමස්කාර ස්ථාන</button>
        <div class="dropdown-container">
            <a href="#මෙතෝදිස්ත_දෙව්මැදුරු">මෙතෝදිස්ත දෙව්මැදුරු</a>
            <a href="#සභාවේ_වෙනත්_ගොඩනැගිලි">සභාවේ වෙනත් ගොඩනැගිලි</a>
            <a href="#අනෙකුත්_ගොඩනැගිලි">අනෙකුත් ගොඩනැගිලි</a>
        </div>

        <button class="dropdown-btn">පූර්ණ කාලීන සේවකයන්</button>
        <div class="dropdown-container">
            <button class="dropdown-btn">මිෂනාරිවරු</button>
            <div class="dropdown-container">
                <a href="#මිෂනාරි_ආධුනිකයන්_ඇතුලු_දේවගැතිවරුන්">ආධුනිකයන් ඇතුලු දේවගැතිවරුන්</a>
                <a href="#විශ්‍රාමලත්">විශ්‍රාමලත්</a>
            </div>
            <button class="dropdown-btn">ගිහි</button>
            <div class="dropdown-container">
                <a href="#පුරුෂ">පුරුෂ</a>
                <a href="#ස්ත්‍රී‍">ස්ත්‍රී‍</a>
            </div>
        </div>

        <button class="dropdown-btn">ශ්‍රීලාංකික දේවගැතිවරුන්</button>
        <div class="dropdown-container">
            <a href="#ශ්‍රීලාංකික_ආධුනිකයන්_ඇතුලු_දේවගැතිවරුන්">ආධුනිකයන් ඇතුලු දේවගැතිවරුන්</a>
            <a href="#අතිරේක_දේවගැතිවරුන්">අතිරේක දේවගැතිවරුන්</a>
            <a href="#විශ්‍රාමලත්_දේවගැතිවරුන්">විශ්‍රාමලත් දේවගැතිවරුන්</a>
            <a href="#සහෝදරියන්">සහෝදරියන්</a>
        </div>

        <button class="dropdown-btn">ශ්‍රීලාංකික දේව සේවකවරු</button>
        <div class="dropdown-container">
            <a href="#එවැන්ජලිස්ත_පුරුෂ">එවැන්ජලිස්ත පුරුෂ</a>
            <a href="#එවැන්ජලිස්ත_ස්ත්‍රී">එවැන්ජලිස්ත ස්ත්‍රී</a>
            <a href="#ස්ථාපිත_සේවකයන්">ස්ථාපිත සේවකයන්</a>
            <a href="#වැටුප්_නොලබන_ස්ථානීය_සේවකයන්">වැටුප් නොලබන ස්ථානීය සේවකයන්</a>
        </div>

        <button class="dropdown-btn">ස්වෙච්ඡා සේවකයන්</button>
        <div class="dropdown-container">
            <a href="#සම්පූර්ණ_ගිහි_දේශකයන්">සම්පූර්ණ ගිහි දේශකයන්</a>
            <a href="#සෝදිසිපිට_සිටින_ගිහි_දේශකයන්">සෝදිසිපිට සිටින ගිහි දේශකයන්</a>
            <a href="#පංති_මූලකයින්">පංති මූලකයින්</a>
            <a href="#ගබඩාකරුවන්">ගබඩාකරුවන්</a>
        </div>

 <button class="dropdown-btn">සාමාජිකයින්</button>
        <div class="dropdown-container">
            <a href="#සම්පූර්ණ_සාමාජකයින්">සම්පූර්ණ සාමාජකයින්</a>
             <a href="#සෝදිසිපිට_සිටින_සාමාජකයින්">සෝදිසිපිට සිටින සාමාජකයින්</a>
            <a href="#අවුරුදු_5_දක්වා">අවුරුදු 5 දක්වා</a>
                <a href="#අවුරුදු_5-15_දක්වා">අවුරුදු 5-15 දක්වා</a>
                <a href="#අවුරුදු_15_ට_වැඩි">අවුරුදු 15 ට වැඩි</a>
                <a href="#ජ්‍යෙෂ්ඨ_සාමාජකයින්">ජ්‍යෙෂ්ඨ සාමාජකයින්</a>
                <a href="#කනිෂ්ඨ_වෙනත්_නියෝජිතයින්">කනිෂ්ඨ වෙනත් නියෝජිතයින්</a>
            </div>

        <a href="#මුලු_ක්‍රිස්තියානි">මුලු ක්‍රිස්තියානි</a>

        <button class="dropdown-btn">බෞතිස්ම</button>
        <div class="dropdown-container">
            <a href="#වැඩිහිටි">වැඩිහිටි</a>
            <a href="#ළදරු">ළදරු</a>
        </div>

        <a href="#බෞතිස්මයට_සූදානම">බෞතිස්මයට සූදානම</a>

        <button class="dropdown-btn">ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික</button>
        <div class="dropdown-container">
            <a href="#ක්ෂේත්‍ර_පුහුණුව_ලැබූ_ආධුනික_පුරුෂ">පුරුෂ</a>
            <a href="#ක්ෂේත්‍ර_පුහුණුව_ලැබූ_ආධුනික_ස්ත්‍රී">ස්ත්‍රී</a>
        </div>
    </nav>

    <main class="content">
        <div class="header">
            <h1>මොරටුමුල්ල මෙතොදිස්ත සභාව - දත්ත වාර්තාව</h1>
            <p>සභාවේ නවතම දත්ත සංරක්ෂණය සහ පෙන්වීම</p>
        </div>

        <?php
        // Show success/error messages
      //  if (isset($success_message)) {
        //    echo "<div class='status-message success'>" . htmlspecialchars($success_message) . "</div>";
        //}
        //if (isset($error_message)) {
        //    echo "<div class='status-message error'>දෝෂයක් ඇතිවිය: " . htmlspecialchars($error_message) . "</div>";
        //}

        // Fetch and display the latest record
        $sql_fetch_latest = "SELECT * FROM `{$table_name}` ORDER BY `id` DESC LIMIT 1";
        $result_fetch = $conn->query($sql_fetch_latest);

        if ($result_fetch && $result_fetch->num_rows > 0) {
            $row_data = $result_fetch->fetch_assoc();
            
            foreach ($all_fields as $field_id) {
                $processed = processData($field_id, $row_data);
                $display_title = str_replace('_', ' ', $field_id);
                // Assign a proper ID to each section for anchor linking
                echo "<div class='data-section' id='" . htmlspecialchars($field_id) . "'>";
                echo "<h2>" . htmlspecialchars($display_title) . "</h2>";
                echo "<div class='data-row'>";
                echo "<span class='data-label'>ගණන (Count):</span>";
                if (!empty($processed['display_count']) || (is_numeric($processed['display_count']) && $processed['display_count'] == 0)) {
                    echo "<span class='data-value number'>" . htmlspecialchars($processed['display_count']) . "</span>";
                } else {
                    echo "<span class='data-value no-data'>නොමැත</span>";
                }
                echo "</div>";
                
                echo "<div class='data-row'>";
                echo "<span class='data-label'>විස්තර (Description):</span>";
                if (!empty($processed['display_description'])) {
                    echo "<div class='description data-value'>" . $processed['display_description'] . "</div>";
                } else {
                    echo "<span class='data-value no-data'>විස්තර නොමැත (No description)</span>";
                }
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='status-message info'>පෙන්වීමට දත්ත නොමැත. (No data to display.)</div>";
        }

        $conn->close();
        ?>
        <footer class="footer">
            <p>&copy; <?php echo date("Y"); ?> ශ්‍රී ලංකා මෙතෝදිස්ත සභාව - දක්ෂිණ දිසාව. සියලුම හිමිකම් ඇවිරිණි.</p>
        </footer>
    </main>

    <script>
        // Smooth scrolling for sidebar links
        document.querySelectorAll('.sidebar a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
  
        // Dropdown functionality
        var dropdown = document.getElementsByClassName("dropdown-btn");
        for (var i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                // Close other open dropdowns at the same level
                var parent = this.parentElement;
                var siblings = parent.children;
                for (var j = 0; j < siblings.length; j++) {
                    if (siblings[j].classList.contains('dropdown-btn') && siblings[j] !== this) {
                        siblings[j].classList.remove('active');
                        siblings[j].nextElementSibling.style.display = "none";
                    }
                }
                // Toggle current dropdown
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
  </script>
</body>
</html>