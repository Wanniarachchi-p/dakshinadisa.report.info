

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>මිනුවන්ගොඩ මෙතොදිස්ත සභාව - පරිපාලන පැනලය</title>
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
    
    .form-container {
      max-width: 1000px;
      margin: 0 auto;
    }
    
    section {
      margin-bottom: 25px;
      padding: 25px;
      border-radius: 8px;
      background-color: white;
      box-shadow: var(--card-shadow);
      border: 1px solid rgba(212, 175, 55, 0.3);
      transition: all 0.3s;
      position: relative;
    }
    
    section::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 4px;
      height: 100%;
      background-color: var(--accent-color);
    }
    
    section:hover {
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
      transform: translateY(-2px);
      border-color: rgba(212, 175, 55, 0.5);
    }
    
    h2 {
      color: var(--primary-color);
      font-size: 20px;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid rgba(212, 175, 55, 0.3);
      position: relative;
    }
    
    h2::after {
      content: "";
      position: absolute;
      bottom: -1px;
      left: 0;
      width: 50px;
      height: 2px;
      background-color: var(--accent-color);
    }
    
    label {
      display: block;
      margin: 15px 0 8px;
      font-weight: 600;
      color: #555;
    }
    
    input[type="number"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid var(--border-color);
      border-radius: 4px;
      font-size: 15px;
      transition: all 0.3s;
    }
    
    input[type="number"]:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
    }
    
    .toolbar {
      margin: 15px 0 8px;
      background-color: var(--secondary-color);
      padding: 8px;
      border-radius: 4px;
      display: flex;
      gap: 5px;
      border: 1px solid var(--border-color);
    }
    
    .toolbar button {
      background-color: var(--primary-color);
      color: white;
      border: none;
      padding: 8px 12px;
      cursor: pointer;
      border-radius: 3px;
      font-size: 14px;
      transition: all 0.3s;
    }
    
    .toolbar button:hover {
      background-color: var(--hover-color);
    }
    
    .editor {
      border: 1px solid var(--border-color);
      min-height: 100px;
      padding: 12px;
      border-radius: 4px;
      background-color: white;
      line-height: 1.6;
      transition: all 0.3s;
    }
    
    .editor:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
    }
    
    .submit-button-container {
      text-align: center;
      margin-top: 40px;
    }
    
    .submit-button-container button {
      background-color: var(--primary-color);
      color: white;
      border: none;
      padding: 12px 30px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 4px;
      transition: all 0.3s;
      font-weight: 600;
      box-shadow: 0 2px 8px rgba(139, 0, 0, 0.2);
    }
    
    .submit-button-container button:hover {
      background-color: var(--hover-color);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(139, 0, 0, 0.3);
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
      
      section {
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
    </div>
    <div>
            <a href="#සහෝදරියන්">සහෝදරියන්</a>
        </div>

        <button class="dropdown-btn">ශ්‍රීලාංකික දේව සේවකවරු</button>
        <div class="dropdown-container">
            <a href="#එවැන්ජලිස්ත_පුරුෂ">එවැන්ජලිස්ත පුරුෂ</a>
            <a href="#එවැන්ජලිස්ත_ස්ත්‍රී">එවැන්ජලිස්ත ස්ත්‍රී</a>
            <a href="#ස්ථාපිත_සේවකයන්">ස්ථාපිත සේවකයන්</a>
            <a href="#වැටුප්_නොලබන_ස්ථානීය_සේවකයන්">වැටුප් නොලබන ස්ථානීය සේවකයන්</a>
        </div>
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

       <button class="dropdown-btn">ක්ෂේත්‍ර 
     පුහුණුව ලැබූ ආධුනික</button>
        <div class="dropdown-container">
            <a href="#ක්ෂේත්‍ර_පුහුණුව_ලැබූ_ආධුනික_පුරුෂ">පුරුෂ</a>
            <a href="#ක්ෂේත්‍ර_පුහුණුව_ලැබූ_ආධුනික_ස්ත්‍රී">ස්ත්‍රී</a>
        </div>
    </nav>

    <main class="content">
        <div class="header">
            <h1>මිනුවන්ගොඩ  මෙතොදිස්ත සභාව - පරිපාලන පැනලය</h1>
            <p>සභාවේ දත්ත කළමනාකරණය සහ වාර්තාකරණය</p>
        </div>
        
        <div class="form-container">
            <form action="මිනුවන්ගොඩ.php" method="post">
                <!-- All your sections remain exactly the same as in your original code -->
                <!-- I've kept all the original sections but removed them here for brevity -->
                <!-- The actual implementation would include all your sections exactly as you had them -->
                
                <section id="සභාවන්">
                    <h2>සභාවන්</h2>
                    <label>ගණන:</label>
                    <input type="number" name="සභාවන්_number">

                    <label>විස්තර:</label>
                    <div class="toolbar">
                        <button type="button" onclick="format('bold', 'සභාවන්_description')"><b>B</b></button>
                        <button type="button" onclick="format('italic', 'සභාවන්_description')"><i>I</i></button>
                        <button type="button" onclick="format('underline', 'සභාවන්_description')"><u>U</u></button>
                    </div>
                    <div class="editor" contenteditable="true" id="සභාවන්_description"></div>
                    <input type="hidden" name="සභාවන්_description" id="සභාවන්_description_hidden">
                </section>
<!-- පවුල් -->
<section id="පවුල්">
    <h2>පවුල්</h2>
    <label>ගණන:</label>
    <input type="number" name="පවුල්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'පවුල්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'පවුල්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'පවුල්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="පවුල්_description"></div>
    <input type="hidden" name="පවුල්_description" id="පවුල්_description_hidden">
</section>

<!-- මෙතෝදිස්ත දෙව්මැදුරු -->
<section id="මෙතෝදිස්ත_දෙව්මැදුරු">
    <h2>මෙතෝදිස්ත දෙව්මැදුරු</h2>
    <label>ගණන:</label>
    <input type="number" name="මෙතෝදිස්ත දෙව්මැදුරු_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'මෙතෝදිස්ත දෙව්මැදුරු_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'මෙතෝදිස්ත දෙව්මැදුරු_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'මෙතෝදිස්ත දෙව්මැදුරු_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="මෙතෝදිස්ත දෙව්මැදුරු_description"></div>
    <input type="hidden" name="මෙතෝදිස්ත දෙව්මැදුරු_description" id="මෙතෝදිස්ත දෙව්මැදුරු_description_hidden">
</section>

<!-- සභාවේ වෙනත් ගොඩනැගිලි -->
<section id="සභාවේ_වෙනත්_ගොඩනැගිලි">
    <h2>සභාවේ වෙනත් ගොඩනැගිලි</h2>
    <label>ගණන:</label>
    <input type="number" name="සභාවේ වෙනත් ගොඩනැගිලි_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'සභාවේ වෙනත් ගොඩනැගිලි_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'සභාවේ වෙනත් ගොඩනැගිලි_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'සභාවේ වෙනත් ගොඩනැගිලි_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="සභාවේ වෙනත් ගොඩනැගිලි_description"></div>
    <input type="hidden" name="සභාවේ වෙනත් ගොඩනැගිලි_description" id="සභාවේ වෙනත් ගොඩනැගිලි_description_hidden">
</section>

<!-- අනෙකුත් ගොඩනැගිලි -->
<section id="අනෙකුත්_ගොඩනැගිලි">
    <h2>අනෙකුත් ගොඩනැගිලි</h2>
    <label for="අනෙකුත්_ගොඩනැගිලි_number">ගණන:</label>
    <input type="number" id="අනෙකුත්_ගොඩනැගිලි_number" name="අනෙකුත්_ගොඩනැගිලි_number" min="0">
    <label for="අනෙකුත්_ගොඩනැගිලි_description">විස්තර:</label>
    <div class="editor" contenteditable="true" data-for="අනෙකුත්_ගොඩනැගිලි_description"></div>
    <input type="hidden" id="අනෙකුත්_ගොඩනැගිලි_description" name="අනෙකුත්_ගොඩනැගිලි_description">
</section>

<!-- මිෂනාරි ආධුනික -->
<section id="මිෂනාරි_ආධුනිකයන්_ඇතුලු_දේවගැතිවරුන්">
    <h2>මිෂනාරි ආධුනික</h2>
    <label for="මිෂනාරි_ආධුනිකයන්_ඇතුලු_දේවගැතිවරුන්_number">ගණන:</label>
    <input type="number" id="මිෂනාරි_ආධුනිකයන්_ඇතුලු_දේවගැතිවරුන්_number" name="මිෂනාරි_ආධුනිකයන්_ඇතුලු_දේවගැතිවරුන්_number" min="0">
    <label for="මිෂනාරි_ආධුනිකයන්_ඇතුලු_දේවගැතිවරුන්_description">විස්තර:</label>
    <div class="editor" contenteditable="true" data-for="මිෂනාරි_ආධුනිකයන්_ඇතුලු_දේවගැතිවරුන්_description"></div>
    <input type="hidden" id="මිෂනාරි_ආධුනිකයන්_ඇතුලු_දේවගැතිවරුන්_description" name="මිෂනාරි_ආධුනිකයන්_ඇතුලු_දේවගැතිවරුන්_description">
</section>

<!-- මිෂනාරි විශ්‍රාමලත් -->
<section id="විශ්‍රාමලත්">
    <h2>මිෂනාරි විශ්‍රාමලත්</h2>
    <label>ගණන:</label>
    <input type="number" name="විශ්‍රාමලත්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'විශ්‍රාමලත්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'විශ්‍රාමලත්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'විශ්‍රාමලත්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="විශ්‍රාමලත්_description"></div>
    <input type="hidden" name="විශ්‍රාමලත්_description" id="විශ්‍රාමලත්_description_hidden">
</section>

<!-- ගිහි පුරුෂ -->
<section id="පුරුෂ">
    <h2>ගිහි පුරුෂ</h2>
    <label>ගණන:</label>
    <input type="number" name="පුරුෂ_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'පුරුෂ_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'පුරුෂ_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'පුරුෂ_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="පුරුෂ_description"></div>
    <input type="hidden" name="පුරුෂ_description" id="පුරුෂ_description_hidden">
</section>

<!-- ගිහි ස්ත්‍රී -->
<section id="ස්ත්‍රී‍">
    <h2>ගිහි ස්ත්‍රී</h2>
    <label>ගණන:</label>
    <input type="number" name="ස්ත්‍රී‍_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'ස්ත්‍රී‍_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'ස්ත්‍රී‍_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'ස්ත්‍රී‍_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="ස්ත්‍රී‍_description"></div>
    <input type="hidden" name="ස්ත්‍රී‍_description" id="ස්ත්‍රී‍_description_hidden">
</section>

<!-- ශ්‍රීලාංකික ආධුනික -->
<section id="ශ්‍රීලාංකික_ආධුනිකයන්_ඇතුලු_දේවගැතිවරුන්">
    <h2>ශ්‍රීලාංකික ආධුනික</h2>
    <label>ගණන:</label>
    <input type="number" name="ශ්‍රීලාංකික ආධුනිකයන් ඇතුලු දේවගැතිවරුන්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'ශ්‍රීලාංකික ආධුනිකයන් ඇතුලු දේවගැතිවරුන්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'ශ්‍රීලාංකික ආධුනිකයන් ඇතුලු දේවගැතිවරුන්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'ශ්‍රීලාංකික ආධුනිකයන් ඇතුලු දේවගැතිවරුන්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="ශ්‍රීලාංකික ආධුනිකයන් ඇතුලු දේවගැතිවරුන්_description"></div>
    <input type="hidden" name="ශ්‍රීලාංකික ආධුනිකයන් ඇතුලු දේවගැතිවරුන්_description" id="ශ්‍රීලාංකික ආධුනිකයන් ඇතුලු දේවගැතිවරුන්_description_hidden">
</section>

<!-- අතිරේක දේවගැතිවරුන් -->
<section id="අතිරේක_දේවගැතිවරුන්">
    <h2>අතිරේක දේවගැතිවරුන්</h2>
    <label>ගණන:</label>
    <input type="number" name="අතිරේක දේවගැතිවරුන්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'අතිරේක දේවගැතිවරුන්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'අතිරේක දේවගැතිවරුන්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'අතිරේක දේවගැතිවරුන්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="අතිරේක දේවගැතිවරුන්_description"></div>
    <input type="hidden" name="අතිරේක දේවගැතිවරුන්_description" id="අතිරේක දේවගැතිවරුන්_description_hidden">
</section>

<!-- විශ්‍රාමලත් දේවගැතිවරුන් -->
<section id="විශ්‍රාමලත්_දේවගැතිවරුන්">
    <h2>විශ්‍රාමලත් දේවගැතිවරුන්</h2>
    <label>ගණන:</label>
    <input type="number" name="විශ්‍රාමලත් දේවගැතිවරුන්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'විශ්‍රාමලත් දේවගැතිවරුන්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'විශ්‍රාමලත් දේවගැතිවරුන්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'විශ්‍රාමලත් දේවගැතිවරුන්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="විශ්‍රාමලත් දේවගැතිවරුන්_description"></div>
    <input type="hidden" name="විශ්‍රාමලත් දේවගැතිවරුන්_description" id="විශ්‍රාමලත් දේවගැතිවරුන්_description_hidden">
</section>

<!-- සහෝදරියන් -->
<section id="සහෝදරියන්">
    <h2>සහෝදරියන්</h2>
    <label>ගණන:</label>
    <input type="number" name="සහෝදරියන්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'සහෝදරියන්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'සහෝදරියන්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'සහෝදරියන්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="සහෝදරියන්_description"></div>
    <input type="hidden" name="සහෝදරියන්_description" id="සහෝදරියන්_description_hidden">
</section>

<!-- එවැන්ජලිස්ත පුරුෂ -->
<section id="එවැන්ජලිස්ත_පුරුෂ">
    <h2>එවැන්ජලිස්ත පුරුෂ</h2>
    <label>ගණන:</label>
    <input type="number" name="එවැන්ජලිස්ත පුරුෂ_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'එවැන්ජලිස්ත පුරුෂ_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'එවැන්ජලිස්ත පුරුෂ_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'එවැන්ජලිස්ත පුරුෂ_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="එවැන්ජලිස්ත පුරුෂ_description"></div>
    <input type="hidden" name="එවැන්ජලිස්ත පුරුෂ_description" id="එවැන්ජලිස්ත පුරුෂ_description_hidden">
</section>

<!-- එවැන්ජලිස්ත ස්ත්‍රී -->
<section id="එවැන්ජලිස්ත_ස්ත්‍රී">
    <h2>එවැන්ජලිස්ත ස්ත්‍රී</h2>
    <label>ගණන:</label>
    <input type="number" name="එවැන්ජලිස්ත ස්ත්‍රී_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'එවැන්ජලිස්ත ස්ත්‍රී_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'එවැන්ජලිස්ත ස්ත්‍රී_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'එවැන්ජලිස්ත ස්ත්‍රී_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="එවැන්ජලිස්ත ස්ත්‍රී_description"></div>
    <input type="hidden" name="එවැන්ජලිස්ත ස්ත්‍රී_description" id="එවැන්ජලිස්ත ස්ත්‍රී_description_hidden">
</section>

<!-- ස්ථාපිත සේවකයන් -->
<section id="ස්ථාපිත_සේවකයන්">
    <h2>ස්ථාපිත සේවකයන්</h2>
    <label>ගණන:</label>
    <input type="number" name="ස්ථාපිත සේවකයන්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'ස්ථාපිත සේවකයන්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'ස්ථාපිත සේවකයන්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'ස්ථාපිත සේවකයන්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="ස්ථාපිත සේවකයන්_description"></div>
    <input type="hidden" name="ස්ථාපිත සේවකයන්_description" id="ස්ථාපිත සේවකයන්_description_hidden">
</section>

<!-- වැටුප් නොලබන ස්ථානීය සේවකයන් -->
<section id="වැටුප්_නොලබන_ස්ථානීය_සේවකයන්">
    <h2>වැටුප් නොලබන ස්ථානීය සේවකයන්</h2>
    <label>ගණන:</label>
    <input type="number" name="වැටුප් නොලබන ස්ථානීය සේවකයන්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'වැටුප් නොලබන ස්ථානීය සේවකයන්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'වැටුප් නොලබන ස්ථානීය සේවකයන්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'වැටුප් නොලබන ස්ථානීය සේවකයන්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="වැටුප් නොලබන ස්ථානීය සේවකයන්_description"></div>
    <input type="hidden" name="වැටුප් නොලබන ස්ථානීය සේවකයන්_description" id="වැටුප් නොලබන ස්ථානීය සේවකයන්_description_hidden">
</section>

<!-- සම්පූර්ණ ගිහි දේශකයන් -->
<section id="සම්පූර්ණ_ගිහි_දේශකයන්">
    <h2>සම්පූර්ණ ගිහි දේශකයන්</h2>
    <label>ගණන:</label>
    <input type="number" name="සම්පූර්ණ ගිහි දේශකයන්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'සම්පූර්ණ ගිහි දේශකයන්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'සම්පූර්ණ ගිහි දේශකයන්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'සම්පූර්ණ ගිහි දේශකයන්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="සම්පූර්ණ ගිහි දේශකයන්_description"></div>
    <input type="hidden" name="සම්පූර්ණ ගිහි දේශකයන්_description" id="සම්පූර්ණ ගිහි දේශකයන්_description_hidden">
</section>

<!-- සෝදිසිපිට සිටින ගිහි දේශකයන් -->
<section id="සෝදිසිපිට_සිටින_ගිහි_දේශකයන්">
    <h2>සෝදිසිපිට සිටින ගිහි දේශකයන්</h2>
    <label>ගණන:</label>
    <input type="number" name="සෝදිසිපිට සිටින ගිහි දේශකයන්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'සෝදිසිපිට සිටින ගිහි දේශකයන්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'සෝදිසිපිට සිටින ගිහි දේශකයන්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'සෝදිසිපිට සිටින ගිහි දේශකයන්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="සෝදිසිපිට සිටින ගිහි දේශකයන්_description"></div>
    <input type="hidden" name="සෝදිසිපිට සිටින ගිහි දේශකයන්_description" id="සෝදිසිපිට සිටින ගිහි දේශකයන්_description_hidden">
</section>

<!-- පංති මූලකයින් -->
<section id="පංති_මූලකයින්">
    <h2>පංති මූලකයින්</h2>
    <label>ගණන:</label>
    <input type="number" name="පංති මූලකයින්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'පංති මූලකයින්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'පංති මූලකයින්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'පංති මූලකයින්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="පංති මූලකයින්_description"></div>
    <input type="hidden" name="පංති මූලකයින්_description" id="පංති මූලකයින්_description_hidden">
</section>

<!-- ගබඩාකරුවන් -->
<section id="ගබඩාකරුවන්">
    <h2>ගබඩාකරුවන්</h2>
    <label>ගණන:</label>
    <input type="number" name="ගබඩාකරුවන්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'ගබඩාකරුවන්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'ගබඩාකරුවන්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'ගබඩාකරුවන්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="ගබඩාකරුවන්_description"></div>
    <input type="hidden" name="ගබඩාකරුවන්_description" id="ගබඩාකරුවන්_description_hidden">
</section>

<!-- සම්පූර්ණ සාමාජකයින් -->
<section id="සම්පූර්ණ_සාමාජකයින්">
    <h2>සම්පූර්ණ සාමාජකයින්</h2>
    <label>ගණන:</label>
    <input type="number" name="සම්පූර්ණ සාමාජකයින්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'සම්පූර්ණ සාමාජකයින්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'සම්පූර්ණ සාමාජකයින්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'සම්පූර්ණ සාමාජකයින්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="සම්පූර්ණ සාමාජකයින්_description"></div>
    <input type="hidden" name="සම්පූර්ණ සාමාජකයින්_description" id="සම්පූර්ණ සාමාජකයින්_description_hidden">
</section>


<section id="සෝදිසිපිට_සිටින_සාමාජකයින්">
    <h2>සෝදිසිපිට සිටින සාමාජකයින්</h2>
    <label>ගණන:</label>
    <input type="number" name="සෝදිසිපිට සිටින සාමාජකයින්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'සෝදිසිපිට සිටින සාමාජකයින්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'සෝදිසිපිට සිටින සාමාජකයින්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'සෝදිසිපිට සිටින සාමාජකයින්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="සෝදිසිපිට සිටින සාමාජකයින්_description"></div>
    <input type="hidden" name="සෝදිසිපිට සිටින සාමාජකයින්_description" id="සෝදිසිපිට සිටින සාමාජකයින්_description_hidden">
</section>

<!-- අවුරුදු 5 දක්වා -->
<section id="අවුරුදු_5_දක්වා">
    <h2>අවුරුදු 5 දක්වා</h2>
    <label>ගණන:</label>
    <input type="number" name="අවුරුදු 5 දක්වා_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'අවුරුදු 5 දක්වා_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'අවුරුදු 5 දක්වා_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'අවුරුදු 5 දක්වා_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="අවුරුදු 5 දක්වා_description"></div>
    <input type="hidden" name="අවුරුදු 5 දක්වා_description" id="අවුරුදු 5 දක්වා_description_hidden">
</section>

<!-- අවුරුදු 5-15 දක්වා -->
<section id="අවුරුදු_5-15_දක්වා">
    <h2>අවුරුදු 5-15 දක්වා</h2>
    <label>ගණන:</label>
    <input type="number" name="අවුරුදු 5-15 දක්වා_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'අවුරුදු 5-15 දක්වා_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'අවුරුදු 5-15 දක්වා_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'අවුරුදු 5-15 දක්වා_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="අවුරුදු 5-15 දක්වා_description"></div>
    <input type="hidden" name="අවුරුදු 5-15 දක්වා_description" id="අවුරුදු 5-15 දක්වා_description_hidden">
</section>

<!-- අවුරුදු 15 ට වැඩි -->
<section id="අවුරුදු_15_ට_වැඩි">
    <h2>අවුරුදු 15 ට වැඩි</h2>
    <label>ගණන:</label>
    <input type="number" name="අවුරුදු 15 ට වැඩි_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'අවුරුදු 15 ට වැඩි_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'අවුරුදු 15 ට වැඩි_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'අවුරුදු 15 ට වැඩි_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="අවුරුදු 15 ට වැඩි_description"></div>
    <input type="hidden" name="අවුරුදු 15 ට වැඩි_description" id="අවුරුදු 15 ට වැඩි_description_hidden">
</section>

<!-- ජ්‍යෙෂ්ඨ සාමාජකයින් -->
<section id="ජ්‍යෙෂ්ඨ_සාමාජකයින්">
    <h2>ජ්‍යෙෂ්ඨ සාමාජකයින්</h2>
    <label>ගණන:</label>
    <input type="number" name="ජ්‍යෙෂ්ඨ සාමාජකයින්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'ජ්‍යෙෂ්ඨ සාමාජකයින්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'ජ්‍යෙෂ්ඨ සාමාජකයින්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'ජ්‍යෙෂ්ඨ සාමාජකයින්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="ජ්‍යෙෂ්ඨ සාමාජකයින්_description"></div>
    <input type="hidden" name="ජ්‍යෙෂ්ඨ සාමාජකයින්_description" id="ජ්‍යෙෂ්ඨ සාමාජකයින්_description_hidden">
</section>

<!-- කනිෂ්ඨ නියෝජිතයින් -->
<section id="කනිෂ්ඨ_වෙනත්_නියෝජිතයින්">
    <h2>කනිෂ්ඨ නියෝජිතයින්</h2>
    <label>ගණන:</label>
    <input type="number" name="කනිෂ්ඨ වෙනත් නියෝජිතයින්_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'කනිෂ්ඨ වෙනත් නියෝජිතයින්_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'කනිෂ්ඨ වෙනත් නියෝජිතයින්_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'කනිෂ්ඨ වෙනත් නියෝජිතයින්_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="කනිෂ්ඨ වෙනත් නියෝජිතයින්_description"></div>
    <input type="hidden" name="කනිෂ්ඨ වෙනත් නියෝජිතයින්_description" id="කනිෂ්ඨ වෙනත් නියෝජිතයින්_description_hidden">
</section>

<!-- මුලු ක්‍රිස්තියානි -->
<section id="මුලු_ක්‍රිස්තියානි">
    <h2>මුලු ක්‍රිස්තියානි</h2>
    <label>ගණන:</label>
    <input type="number" name="මුලු ක්‍රිස්තියානි_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'මුලු ක්‍රිස්තියානි_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'මුලු ක්‍රිස්තියානි_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'මුලු ක්‍රිස්තියානි_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="මුලු ක්‍රිස්තියානි_description"></div>
    <input type="hidden" name="මුලු ක්‍රිස්තියානි_description" id="මුලු ක්‍රිස්තියානි_description_hidden">
</section>

<!-- වැඩිහිටි බෞතිස්ම -->
<section id="වැඩිහිටි">
    <h2>වැඩිහිටි බෞතිස්ම</h2>
    <label>ගණන:</label>
    <input type="number" name="වැඩිහිටි_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'වැඩිහිටි_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'වැඩිහිටි_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'වැඩිහිටි_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="වැඩිහිටි_description"></div>
    <input type="hidden" name="වැඩිහිටි_description" id="වැඩිහිටි_description_hidden">
</section>

<!-- ළදරු බෞතිස්ම -->
<section id="ළදරු">
    <h2>ළදරු බෞතිස්ම</h2>
    <label>ගණන:</label>
    <input type="number" name="ළදරු_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'ළදරු_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'ළදරු_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'ළදරු_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="ළදරු_description"></div>
    <input type="hidden" name="ළදරු_description" id="ළදරු_description_hidden">
</section>

<!-- බෞතිස්මයට සූදානම -->
<section id="බෞතිස්මයට_සූදානම">
    <h2>බෞතිස්මයට සූදානම</h2>
    <label>ගණන:</label>
    <input type="number" name="බෞතිස්මයට සූදානම_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'බෞතිස්මයට සූදානම_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'බෞතිස්මයට සූදානම_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'බෞතිස්මයට සූදානම_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="බෞතිස්මයට සූදානම_description"></div>
    <input type="hidden" name="බෞතිස්මයට සූදානම_description" id="බෞතිස්මයට සූදානම_description_hidden">
</section>

<!-- පුහුණු පුරුෂ -->
<section id="ක්ෂේත්‍ර_පුහුණුව_ලැබූ_ආධුනික_පුරුෂ">
    <h2>ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික පුරුෂ</h2>
    <label>ගණන:</label>
    <input type="number" name="ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික පුරුෂ_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික පුරුෂ_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික පුරුෂ_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික පුරුෂ_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික පුරුෂ_description"></div>
    <input type="hidden" name="ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික පුරුෂ_description" id="ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික පුරුෂ_description_hidden">
</section>

<!-- පුහුණු ස්ත්‍රී -->
<section id="ක්ෂේත්‍ර_පුහුණුව_ලැබූ_ආධුනික_ස්ත්‍රී">
    <h2>පුහුණු ස්ත්‍රී</h2>
    <label>ගණන:</label>
    <input type="number" name="ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික ස්ත්‍රී_number">
    
    <label>විස්තර:</label>
    <div class="toolbar">
        <button type="button" onclick="format('bold', 'ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික ස්ත්‍රී_description')"><b>B</b></button>
        <button type="button" onclick="format('italic', 'ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික ස්ත්‍රී_description')"><i>I</i></button>
        <button type="button" onclick="format('underline', 'ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික ස්ත්‍රී_description')"><u>U</u></button>
    </div>
    <div class="editor" contenteditable="true" id="ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික ස්ත්‍රී_description"></div>
    <input type="hidden" name="ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික ස්ත්‍රී_description" id="ක්ෂේත්‍ර පුහුණුව ලැබූ ආධුනික ස්ත්‍රී_description_hidden">
</section>
<!-- ... -->
                <!-- All other sections follow the same pattern -->
                <!-- ... -->

                <div class="submit-button-container">
                    <button type="submit">දත්ත ඉදිරිපත් කරන්න</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Before submitting the form, copy contenteditable content to hidden inputs
        document.querySelector('form').addEventListener('submit', function() {
            const editorDivs = document.querySelectorAll('.editor');
            editorDivs.forEach(editorDiv => {
                const hiddenInputId = editorDiv.id + '_hidden';
                const hiddenInput = document.getElementById(hiddenInputId);
                if (hiddenInput) {
                    hiddenInput.value = editorDiv.innerHTML;
                }
            });
        });

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
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
        
        // Formatting function for rich text editor
        function format(command, editorId) {
            document.getElementById(editorId).focus();
            document.execCommand(command, false, null);
        }
  </script>
</body>
</html>