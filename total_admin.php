<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'user_app');

// Establish database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Handle Update
if (isset($_POST['update_id'], $_POST['update_value'])) {
    $id = $_POST['update_id'];
    $value = $_POST['update_value'];
    $stmt = $conn->prepare("UPDATE total_data SET value = ? WHERE id = ?");
    $stmt->bind_param("ii", $value, $id);
    $stmt->execute();
    header("Location: total_admin.php"); exit;
}

// Handle Delete
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $stmt = $conn->prepare("DELETE FROM total_data WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: total_admin.php"); exit;
}

// Process form submission
$success_message = '';
$selected_year = $_POST['selected_year'] ?? date("Y") . "/" . (date("Y") + 1);

// Handle Create (Save New Data)
if (isset($_POST['data']) && isset($_POST['year'])) {
    $year = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING);
    
    if (empty($year)) {
        die("Error: Year field is required");
    }

    foreach ($_POST['data'] as $key => $value) {
        $parts = explode('|', $key);
        $category = $parts[0] ?? '';
        $sub_category = $parts[1] ?? '';
        $sub_sub_category = $parts[2] ?? '';
        
        $numeric_value = filter_var($value, FILTER_VALIDATE_INT);
        if ($numeric_value === false) {
            die("Error: Invalid numeric value provided");
        }

        $stmt = $conn->prepare("REPLACE INTO total_data 
                              (category, sub_category, sub_sub_category, year, value) 
                              VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $category, $sub_category, $sub_sub_category, $year, $numeric_value);
        
        if (!$stmt->execute()) {
            die("Error saving data: " . $stmt->error);
        }
    }

   

    // Process each data field
    foreach ($_POST['data'] as $key => $value) {
        $parts = explode('|', $key);
        $category = $parts[0] ?? '';
        $sub_category = $parts[1] ?? '';
        $sub_sub_category = $parts[2] ?? '';
        
        // Validate numeric value
        $numeric_value = filter_var($value, FILTER_VALIDATE_INT);
        if ($numeric_value === false) {
            die("Error: Invalid numeric value provided");
        }

        // Prepare and execute SQL statement
        $stmt = $conn->prepare("REPLACE INTO total_data 
                              (category, sub_category, sub_sub_category, year, value) 
                              VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $category, $sub_category, $sub_sub_category, $year, $numeric_value);
        
        if (!$stmt->execute()) {
            die("Error saving data: " . $stmt->error);
        }
    }
    
    // Success message
    $success_message = "Data successfully saved for $year";
}

// Data structure configuration
$data_structure = [
    "සභාවන්" => ["" => [""]],
    "පවුල් ඒකක" => ["" => [""]],
    "නමස්කාර ස්ථාන" => [
        "" => [
            "මෙතෝදිස්ත දෙව්මැදුරු", 
            "සභාවේ වෙනත් ගොඩනැගිලි", 
            "අනෙකුත් ගොඩනැගිලි"
        ]
    ],
    "පූර්ණ කාලීන සේවකයන්" => [
        "" => [
            "මිෂනාරි-ආධුනිකයන් ඇතුලු දේවගැතිවරුන්",
            "මිෂනාරි-විශ්‍රාමලත්",
            "මිෂනාරි-ගිහි:පුරුෂ",
            "මිෂනාරි-ගිහි:ස්ත්‍රී‍",
            "ශ්‍රීලාංකික දේවගැතිවරුන්-ආධුනිකයන් ඇතුලු දේවගැතිවරුන්",
            "ශ්‍රීලාංකික දේවගැතිවරුන්-අතිරේක දේවගැතිවරුන්",
            "ශ්‍රීලාංකික දේවගැතිවරුන්-විශ්‍රාමලත් දේවගැතිවරුන්",
            "සහෝදරියන්",
            "ශ්‍රීලාංකික දේව සේවකවරු-එවැන්ජලිස්තවරුන්‍",
            "ශ්‍රීලාංකික දේව සේවකවරු-එවැන්ජලිස්තවරියන්",
            "ශ්‍රීලාංකික දේව සේවකවරු-ස්ථාපිත සේවකයන්",
            "ශ්‍රීලාංකික දේව සේවකවරු-වැටුප් නොලබන ස්ථානීය සේවකයන්"
        ]
    ],
    "ස්වෙච්ඡා සේවකයන්" => [
        "" => [
            "සම්පූර්ණ ගිහි දේශකයන්",
            "සෝදිසිපිට සිටින ගිහි දේශකයන්",
            "පංති මූලකයින්",
            "ගබඩාකරුවන්"
        ]
    ],
    "සාමාජිකයින්" => [
        "" => [
            "සම්පූර්ණ සාමාජකයින්",
            "පිට සිටින සාමාජකයින්",
            "අවුරුදු 5 දක්වා",
            "අවුරුදු 5-15 දක්වා",
            "අවුරුදු 15 ට වැඩි",
            "ජ්‍යෙෂ්ඨ සාමාජකයින්",
            "කනිෂ්ඨ වෙනත් නියෝජිතයින්"
        ]
    ],
    "මුලු ක්‍රිස්තියානි" => ["" => [""]],
    "බෞතිස්ම" => ["" => ["වැඩිහිටි", "ළදරු"]],
    "බෞතිස්මයට සූදානම" => ["" => [""]],
    "ක්ෂේත්‍ර 
     පුහුණුව ලැබූ ආධුනික" => ["" => ["පුරුෂ", "ස්ත්‍රී"]]
];
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>දත්ත ඇතුලත් කිරීමේ පද්ධතිය | Administrative Data Entry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
    :root {
      --primary-color: #8B0000;
      --secondary-color: #f4f6f9;
      --accent-color: #D4AF37;
      --success-color: #28a745;
      --light-bg: #f9f5e9;
      --dark-text: #333333;
      --light-text: #6c757d;
      --border-radius: 8px;
      --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      --header-gradient: linear-gradient(135deg, #700000, #8B0000);
      --border-color: #e0d6c0;
    }
    
    body {
      font-family: 'Arial', 'Iskoola Pota', sans-serif;
      background-color: var(--light-bg);
      color: var(--dark-text);
      line-height: 1.6;
    }
    
    .header {
      background: var(--header-gradient);
      color: white;
      border-radius: 0 0 var(--border-radius) var(--border-radius);
      box-shadow: var(--card-shadow);
      margin-bottom: 2rem;
      padding: 1.5rem;
      text-align: center;
    }
    
    .form-container {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: var(--card-shadow);
      padding: 2rem;
      margin-bottom: 2rem;
      border: 1px solid rgba(212, 175, 55, 0.3);
      position: relative;
      overflow: hidden;
    }
    
    .form-container::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 4px;
      height: 100%;
      background-color: var(--accent-color);
    }
    
    .category-card {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: var(--card-shadow);
      margin-bottom: 1.5rem;
      overflow: hidden;
      transition: all 0.3s ease;
      border: 1px solid rgba(212, 175, 55, 0.3);
    }
    
    .category-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
      border-color: rgba(212, 175, 55, 0.5);
    }
    
    .category-header {
      background-color: var(--primary-color);
      color: white;
      padding: 1rem 1.5rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .category-header i {
      margin-right: 10px;
      font-size: 1.2rem;
      color: var(--accent-color);
    }
    
    .data-item {
      padding: 1rem 1.5rem;
      border-bottom: 1px solid var(--border-color);
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: background-color 0.2s;
    }
    
    .data-item:hover {
      background-color: rgba(212, 175, 55, 0.05);
    }
    
    .data-item:last-child {
      border-bottom: none;
    }
    
    .data-label {
      font-weight: 500;
      color: var(--dark-text);
      flex: 1;
      margin-right: 1rem;
    }
    
    .data-input {
      width: 100px;
      text-align: center;
      padding: 8px 12px;
      border: 1px solid var(--border-color);
      border-radius: 4px;
      transition: all 0.3s;
    }
    
    .data-input:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
    }
    
    .success-message {
      background-color: rgba(40, 167, 69, 0.1);
      color: var(--success-color);
      padding: 1rem;
      border-radius: var(--border-radius);
      margin-bottom: 1.5rem;
      border-left: 4px solid var(--success-color);
      display: flex;
      align-items: center;
    }
    
    .success-message i {
      margin-right: 10px;
      font-size: 1.2rem;
    }
    
    .submit-btn {
      background-color: var(--primary-color);
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      font-weight: 600;
      border-radius: var(--border-radius);
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(139, 0, 0, 0.2);
      cursor: pointer;
    }
    
    .submit-btn:hover {
      background-color: #700000;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(139, 0, 0, 0.3);
    }
    
    @media (max-width: 768px) {
      .data-item {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .data-label {
        margin-bottom: 0.5rem;
        margin-right: 0;
      }
      
      .data-input {
        width: 100%;
      }
      
      .form-container {
        padding: 1.5rem;
      }
    }
</style>
</head>
<body>
    <div class="header py-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-1"> දත්ත ඇතුලත් කිරීමේ පද්ධතිය</h1>
                    <p class="mb-0">Administrative Data Entry System</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php if (!empty($success_message)): ?>
            <div class="success-message">
                <i class="bi bi-check-circle-fill"></i>
                <span><?php echo htmlspecialchars($success_message); ?></span>
            </div>
        <?php endif; ?>
        
<?php
// ✅ INSERT THIS NEW BLOCK RIGHT HERE

// Fetch selected year data
$selected_year = $_POST['selected_year'] ?? date("Y") . "/" . (date("Y") + 1);
$entries = [];

if (!empty($selected_year)) {
    $stmt = $conn->prepare("SELECT id, category, sub_category, sub_sub_category, value FROM total_data WHERE year = ?");
    $stmt->bind_param("s", $selected_year);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $entries[] = $row;
    }
}

// Handle Update request
if (isset($_POST['update_id'])) {
    $id = $_POST['update_id'];
    $value = $_POST['update_value'];
    $stmt = $conn->prepare("UPDATE total_data SET value = ? WHERE id = ?");
    $stmt->bind_param("ii", $value, $id);
    $stmt->execute();
    header("Location: total_admin.php"); exit;
}

// Handle Delete request
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $stmt = $conn->prepare("DELETE FROM total_data WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: total_admin.php"); exit;
}
?>
<div class="form-container mb-4">
    <form method="POST" class="row g-3">
        <div class="col-md-6">
            <label for="selected_year" class="form-label fw-bold">දත්ත පෙන්වීමට වසර තෝරන්න</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                <input type="text" class="form-control" id="selected_year" name="selected_year" 
                       value="<?php echo htmlspecialchars($selected_year); ?>" 
                       placeholder="උදා: 2024/25">
            </div>
        </div>
        <div class="col-md-6 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i> පෙන්වන්න
            </button>
        </div>
    </form>
</div>

<!-- 🔽 Your existing form starts here -->
<div class="form-container">
    <form method="POST" action="">

        
        <div class="form-container">
            <form method="POST" action="">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="year" class="form-label fw-bold">වාර්ෂික වර්ෂය <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                <input type="text" class="form-control" id="year" name="year" 
                                       placeholder="උදා: 2024/25" required>
                            </div>
                            <small class="text-muted">උදාහරණයක් ලෙස: 2024/25</small>
                        </div>
                    </div>
                </div>
                
                <h3 class="mb-4"><i class="bi bi-list-check"></i> දත්ත ක්ෂේත්‍ර</h3>
                
                <?php foreach ($data_structure as $category => $sub_categories): ?>
                    <div class="category-card">
                        <div class="category-header">
                            <i class="bi bi-folder-fill"></i>
                            <span><?php echo htmlspecialchars($category); ?></span>
                        </div>
                        <div class="card-body p-0">
                            <?php foreach ($sub_categories as $sub_category => $sub_sub_categories): ?>
                                <?php foreach ($sub_sub_categories as $sub_sub_category): 
                                    $key = implode('|', [
                                        $category,
                                        $sub_category,
                                        $sub_sub_category
                                    ]);
                                    $label = !empty($sub_sub_category) ? $sub_sub_category : $category;
                                ?>
                                    <div class="data-item">
                                        <span class="data-label"><?php echo htmlspecialchars($label); ?></span>
                                        <input type="number" 
                                               class="form-control data-input" 
                                               name="data[<?php echo htmlspecialchars($key); ?>]" 
                                               value="0" 
                                               min="0"
                                               required>
                                    </div>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <div class="text-center mt-4">
                    <button type="submit" class="btn submit-btn text-white">
                        <i class="bi bi-save"></i> දත්ත සුරකින්න
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty($entries)): ?>
    <div class="form-container">
        <h4 class="mb-3"><i class="bi bi-table"></i> "<?php echo htmlspecialchars($selected_year); ?>" සඳහා ඇතුළත් කරන ලද දත්ත</h4>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ප්‍රභේදය</th>
                 <th>උප ප්‍රභේදය</th>
                    <th>ගණන</th>
                    <th>ක්‍රියා</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entries as $entry): ?>
                    <tr>
                        <form method="POST">
                            <td><?php echo htmlspecialchars($entry['category']); ?></td>
                            <td><?php echo htmlspecialchars($entry['sub_sub_category']); ?></td>
                            <td>
                                <input type="number" name="update_value" value="<?php echo $entry['value']; ?>" class="form-control" required>
                            </td>
                            <td>
                                <input type="hidden" name="update_id" value="<?php echo $entry['id']; ?>">
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="bi bi-pencil"></i> යාවත්කාල
                                </button>
                        </form>
                        <form method="POST" style="display:inline-block;" onsubmit="return confirm('මෙම දත්ත මකා දැමීමට විශ්වාසද?');">
                            <input type="hidden" name="delete_id" value="<?php echo $entry['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> මකන්න
                            </button>
                        </form>
                            </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
      
<?php endif; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Focus on year input when page loads
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('year').focus();
        });
  
        // Database simulation (in a real app, this would be server-side)
        let churchData = [];
        let currentRecordId = null;
        
        // Initialize the app
        document.addEventListener('DOMContentLoaded', function() {
            // Load saved data from localStorage
            loadSavedRecords();
            updateRecordSelector();
            
            // Set up event listeners
            setupDropdowns();
            setupFormSubmit();
            setupRecordControls();
        });
        
        // Load saved records from localStorage
        function loadSavedRecords() {
            const savedData = localStorage.getItem('churchData');
            if (savedData) {
                churchData = JSON.parse(savedData);
            }
        }
        
        // Update the record selector dropdown
        function updateRecordSelector() {
            const selector = document.getElementById('record-select');
            selector.innerHTML = '<option value="">නව වාර්තාවක් සාදන්න</option>';
            
            churchData.forEach(record => {
                const option = document.createElement('option');
                option.value = record.id;
                option.textContent = `වාර්තාව ${record.id} - ${new Date(record.timestamp).toLocaleString()}`;
                selector.appendChild(option);
            });
        }
        
        // Setup dropdown functionality
        function setupDropdowns() {
            var dropdown = document.getElementsByClassName("dropdown-btn");
            for (var i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }
            
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
        }
        
        // Setup form submit handler
        function setupFormSubmit() {
            document.getElementById('church-data-form').addEventListener('submit', function(e) {
                e.preventDefault();
                saveData(true);
            });
        }
        
        // Setup record controls
        function setupRecordControls() {
            document.getElementById('load-record').addEventListener('click', loadSelectedRecord);
            document.getElementById('delete-record').addEventListener('click', deleteSelectedRecord);
        }
        
        // Formatting function for rich text editor
        function format(command, editorId) {
            document.getElementById(editorId).focus();
            document.execCommand(command, false, null);
        }
        
        // Save data to localStorage
        function saveData(createNew) {
            // Before saving, copy contenteditable content to hidden inputs
            const editorDivs = document.querySelectorAll('.editor');
            editorDivs.forEach(editorDiv => {
                const hiddenInputId = editorDiv.id + '_hidden';
                const hiddenInput = document.getElementById(hiddenInputId);
                if (hiddenInput) {
                    hiddenInput.value = editorDiv.innerHTML;
                }
            });
            
            // Collect all form data
            const formData = new FormData(document.getElementById('church-data-form'));
            const data = {};
            
            for (let [key, value] of formData.entries()) {
                data[key] = value;
            }
            
            // Add timestamp
            data.timestamp = new Date().toISOString();
            
            if (currentRecordId) {
                // Update existing record
                const index = churchData.findIndex(record => record.id === currentRecordId);
                if (index !== -1) {
                    churchData[index] = { id: currentRecordId, ...data };
                }
            } else {
                // Create new record
                const newId = Date.now().toString();
                churchData.push({ id: newId, ...data });
                currentRecordId = newId;
            }
            
            // Save to localStorage
            localStorage.setItem('churchData', JSON.stringify(churchData));
            
            // Update the record selector
            updateRecordSelector();
            
            // Show success message
            alert('දත්ත සාර්ථකව සුරකින ලදී!');
            
            if (createNew) {
                // Reset form for new entry
                document.getElementById('church-data-form').reset();
                currentRecordId = null;
                
                // Clear all editors
                editorDivs.forEach(editorDiv => {
                    editorDiv.innerHTML = '';
                });
            }
        }
        
        // Load selected record
        function loadSelectedRecord() {
            const recordId = document.getElementById('record-select').value;
            if (!recordId) return;
            
            const record = churchData.find(r => r.id === recordId);
            if (!record) return;
            
            currentRecordId = recordId;
            
            // Load data into form
            for (const key in record) {
                if (key === 'id' || key === 'timestamp') continue;
                
                if (key.endsWith('_hidden')) {
                    // This is a rich text field
                    const editorId = key.replace('_hidden', '');
                    const editor = document.getElementById(editorId);
                    if (editor) {
                        editor.innerHTML = record[key];
                    }
                    const hiddenInput = document.getElementById(key);
                    if (hiddenInput) {
                        hiddenInput.value = record[key];
                    }
                } else {
                    // Regular input field
                    const input = document.querySelector(`[name="${key}"]`);
                    if (input) {
                        input.value = record[key];
                    }
                }
            }
        }
        
        // Delete selected record
        function deleteSelectedRecord() {
            const recordId = document.getElementById('record-select').value;
            if (!recordId || !confirm('ඔබට මෙම වාර්තාව මැකීමට අවශ්‍යද?')) return;
            
            churchData = churchData.filter(record => record.id !== recordId);
            localStorage.setItem('churchData', JSON.stringify(churchData));
            
            if (currentRecordId === recordId) {
                // Clear the form if we're deleting the currently loaded record
                document.getElementById('church-data-form').reset();
                currentRecordId = null;
                
                // Clear all editors
                document.querySelectorAll('.editor').forEach(editorDiv => {
                    editorDiv.innerHTML = '';
                });
            }
            
            updateRecordSelector();
            alert('වාර්තාව සාර්ථකව මකා ඇත!');
        }
        
        // Edit section
        function editSection(sectionId) {
            const modal = document.getElementById('edit-modal');
            const modalBody = document.getElementById('modal-body');
            
            // Get current section data
            const numberInput = document.getElementById(`${sectionId}_number`);
            const editor = document.getElementById(`${sectionId}_description`);
            
            // Populate modal with section data
            modalBody.innerHTML = `
                <label>ගණන:</label>
                <input type="number" id="modal-${sectionId}_number" value="${numberInput.value}" class="modal-input">
                
                <label>විස්තර:</label>
                <div class="toolbar">
                    <button type="button" onclick="formatModal('bold', 'modal-${sectionId}_description')"><b>B</b></button>
                    <button type="button" onclick="formatModal('italic', 'modal-${sectionId}_description')"><i>I</i></button>
                    <button type="button" onclick="formatModal('underline', 'modal-${sectionId}_description')"><u>U</u></button>
                </div>
                <div class="editor" contenteditable="true" id="modal-${sectionId}_description">${editor.innerHTML}</div>
            `;
            
            // Store which section we're editing
            modal.dataset.editingSection = sectionId;
            
            // Show modal
            modal.style.display = 'flex';
        }
        
        // Close modal
        function closeModal() {
            document.getElementById('edit-modal').style.display = 'none';
        }
        
        // Format text in modal editor
        function formatModal(command, editorId) {
            document.getElementById(editorId).focus();
            document.execCommand(command, false, null);
        }
        
        // Save section changes from modal
        function saveSectionChanges() {
            const modal = document.getElementById('edit-modal');
            const sectionId = modal.dataset.editingSection;
            
            // Get values from modal
            const numberValue = document.getElementById(`modal-${sectionId}_number`).value;
            const descriptionHtml = document.getElementById(`modal-${sectionId}_description`).innerHTML;
            
            // Update the main form
            document.getElementById(`${sectionId}_number`).value = numberValue;
            document.getElementById(`${sectionId}_description`).innerHTML = descriptionHtml;
            document.getElementById(`${sectionId}_description_hidden`).value = descriptionHtml;
            
            closeModal();
        }
        
        // Delete section data
        function deleteSection(sectionId) {
            if (confirm('ඔබට මෙම කොටසේ දත්ත මකා දැමීමට අවශ්‍යද?')) {
                document.getElementById(`${sectionId}_number`).value = '';
                document.getElementById(`${sectionId}_description`).innerHTML = '';
                document.getElementById(`${sectionId}_description_hidden`).value = '';
            }
        }
  </script>
</body>
</html>