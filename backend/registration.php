<?php
// Retrieve email from the query string (if it's set)
$email = isset($_GET['email']) ? $_GET['email'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form with Image</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      display: flex;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      max-width: 800px;
      width: 100%;
    }

    .image-container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f4f4f4;
      padding: 20px;
      border-right: 1px solid #ddd;
    }

    .image-container img {
      max-width: 100%;
      border-radius: 8px;
    }

    .form-container {
      flex: 2;
      padding: 20px;
    }

    h1 {
      font-size: 18px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
    }

    form label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
    }

    .radio-group {
      display: flex;
      gap: 20px;
      margin-bottom: 15px;
    }

    .submit-btn {
      width: 100%;
      background: #000;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
    }

    .submit-btn:hover {
      background: #333;
    }

    .dob {
      display: flex;
      gap: 10px;
    }

    .dob-note {
      font-size: 12px;
      color: #888;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Left side image -->
    <div class="image-container">
      <img src="shopping.jpg" alt="Welcome Image">
    </div>

    <!-- Right side form -->
    <div class="form-container">
      <h1>We love new faces :)</h1>
      <form action="register.php" method="POST">
        <!-- Email Field -->
        <label for="email">Email:*</label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            value="<?php echo htmlspecialchars($email); ?>" 
            placeholder="Enter your email" 
            required 
            aria-required="true">
    
        <!-- First Name Field -->
        <label for="first-name">First Name:*</label>
        <input 
            type="text" 
            id="first-name" 
            name="first_name" 
            placeholder="Enter your first name" 
            required 
            aria-required="true">
    
        <!-- Last Name Field -->
        <label for="last-name">Last Name:*</label>
        <input 
            type="text" 
            id="last-name" 
            name="last_name" 
            placeholder="Enter your last name" 
            required 
            aria-required="true">
            
    
        <!-- Date of Birth Field -->
        <label for="dob">Date of Birth:*</label>
        <input 
            type="date" 
            id="dob" 
            name="date_of_birth" 
            required 
            aria-required="true">
       
    
        Address:*
     </label>
     <input id="address" name="address" placeholder="Enter your address" required="" type="text"/>
     <!-- Postal Code Field -->
     <label for="postal-code">
      Postal Code:*
     </label>
     <input id="postal-code" name="postal_code" placeholder="Enter your postal code" required="" type="text"/>
        <!-- Interest Field -->
        <label>Mostly Interested In:*</label>
        <div class="radio-group">
            <label>
                <input 
                    type="radio" 
                    name="interest" 
                    value="womenswear" 
                    required>
                Womenswear
            </label>
            <label>
                <input 
                    type="radio" 
                    name="interest" 
                    value="menswear" 
                    required>
                Menswear
            </label>
        </div>
    
        <!-- Submit Button -->
        <button type="submit" class="submit-btn">Join NC Fashion</button>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const daySelect = document.getElementById('day');
      const monthSelect = document.getElementById('month');
      const yearSelect = document.getElementById('year');

      // Populate days
      for (let i = 1; i <= 31; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        daySelect.appendChild(option);
      }

      // Populate months
      const months = [
        "January", "February", "March", "April", "May", 
        "June", "July", "August", "September", "October", 
        "November", "December"
      ];
      months.forEach((month, index) => {
        const option = document.createElement('option');
        option.value = index + 1;
        option.textContent = month;
        monthSelect.appendChild(option);
      });

      // Populate years
      const currentYear = new Date().getFullYear();
      for (let i = currentYear - 100; i <= currentYear - 16; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        yearSelect.appendChild(option);
      }
    });
  </script>
</body>
</html>
