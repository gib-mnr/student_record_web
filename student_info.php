<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Student Info Form</title>
  <style>
    /* Google-style padding and margin for form */
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
/*      height: 100vh;*/
    }

    form {
      background-color: white;
      padding: 20px;
      border-radius: 16px; /* Rounded corners */
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 600px;
/*      border: 2px solid red; */

    }

    h2 {
      text-align: center;
    }

    label {
      font-weight: bold;
      margin-top: 10px;
      display: block;
    }

input, textarea {
    width: 100%;
    padding: 12px; /* Adjust this as needed */
    margin: 8px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 16px; /* Rounded corners */
    font-size: 1rem; /* This scales with zoom */
}

    button {
      background-color: #4285f4; /* Google's blue color */
      color: white;
      padding: 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
    }

    button:hover {
      background-color: #357ae8;
    }

  </style>
</head>
<body>

  <!-- Form to save student information -->
  <!-- action="index.php" -->
<form id="studentForm"  action="index.php" method="POST">
    <h2>Student Info Form</h2>
    
    <!-- Input for Student Name -->
    <label for="name">Name</label>
    <input type="text" id="name" name="name" placeholder="Enter your name" required>

    <!-- Input for Email -->
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required>

    <!-- Input for Phone Number -->
    <label for="phone">Phone Number</label>
    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>

    <!-- Input for Social Media Links -->
    <label for="social">Social Media Links</label>
    <input type="url" id="facebook" name="facebook" placeholder="Facebook URL">
    <input type="url" id="twitter" name="twitter" placeholder="Twitter URL">
    <input type="url" id="linkedin" name="linkedin" placeholder="LinkedIn URL">

    <!-- Input for Date of Birth -->
    <label for="dob">Date of Birth</label>
    <input type="date" id="dob" name="dob" required>

    <!-- Input for Address -->
    <label for="address">Address</label>
    <textarea id="address" name="address" placeholder="Enter your address" required></textarea>

    <!-- Submit Button -->
    <button type="submit">Submit</button>

    <!-- Button to view students -->
    <a href="view_students.php" class="view-button">View Students</a>


  </form>

  <!-- JavaScript to handle form submission -->
  <script>
    // document.getElementById('studentForm').addEventListener('submit', submitFormFunction);


  function submitFormFunction(event){
      // event.preventDefault();
      
      // Collecting form data
      const formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        facebook: document.getElementById('facebook').value,
        twitter: document.getElementById('twitter').value,
        linkedin: document.getElementById('linkedin').value,
        dob: document.getElementById('dob').value,
        address: document.getElementById('address').value,
      };

      // Logging form data to console
      console.log('Student Data:', formData);

      // Clear form after submission
      document.getElementById('studentForm').reset();
      alert('Form submitted successfully!');
    }
  
  </script>

</body>
</html>