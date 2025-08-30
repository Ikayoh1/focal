<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard/home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Focal</title>
  <style>
    :root {
      --bg-primary: #fefcf8;
      --bg-card: #ffffff;
      --bg-hover: #f8f6f2;
      --border-color: #e8e4df;
      --text-primary: #2d2d2d;
      --text-secondary: #6b6b6b;
      --text-muted: #9a9a9a;
      --accent-primary: #ff6314;
      --accent-secondary: #5296dd;
      --accent-hover: #ff5722;
      --gradient: linear-gradient(135deg, #ff6314 0%, #5296dd 100%);
      --warm-orange: #ffaa7a;
      --warm-cream: #fff8f0;
      --shadow-soft: 0 4px 12px rgba(255, 99, 20, 0.1);
      --shadow-hover: 0 8px 24px rgba(255, 99, 20, 0.2);
      --error-color: #e3342f;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', sans-serif;
      background: radial-gradient(circle at center, var(--warm-cream) 0%, var(--bg-primary) 100%);
      color: var(--text-primary);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      overflow-x: hidden;
    }

    header {
      background: rgba(255, 255, 255, 0.95);
      border-bottom: 1px solid var(--border-color);
      padding: 16px 24px;
      position: sticky;
      top: 0;
      z-index: 1000;
      backdrop-filter: blur(20px);
      box-shadow: var(--shadow-soft);
    }

    .header-content {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      font-size: 28px;
      font-weight: 700;
      background: var(--gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .nav-links {
      display: flex;
      gap: 24px;
    }

    .nav-links a {
      color: var(--text-secondary);
      text-decoration: none;
      font-size: 15px;
      font-weight: 500;
      transition: color 0.2s ease;
    }

    .nav-links a:hover {
      color: var(--accent-secondary);
    }

    .register-section {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 48px 24px;
      position: relative;
      overflow: hidden;
    }

    .register-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: var(--gradient);
      opacity: 0.05;
      transform: translateY(20px);
      transition: transform 0.5s ease;
    }

    .register-box {
      background: var(--bg-card);
      padding: 40px;
      max-width: 500px;
      width: 100%;
      border-radius: 16px;
      box-shadow: var(--shadow-soft);
      text-align: center;
      position: relative;
      z-index: 1;
      transform: translateY(0);
      transition: transform 0.5s ease, box-shadow 0.3s ease;
    }

    .register-box:hover {
      transform: translateY(-8px);
      box-shadow: var(--shadow-hover);
    }

    .register-box h1 {
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 24px;
      background: var(--gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .register-form {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .register-form input {
      padding: 12px 16px;
      font-size: 16px;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      background: var(--bg-primary);
      color: var(--text-primary);
      transition: border-color 0.2s ease;
    }

    .register-form input:focus {
      outline: none;
      border-color: var(--accent-primary);
      box-shadow: 0 0 0 3px rgba(255, 99, 20, 0.1);
    }

    .register-form input::placeholder {
      color: var(--text-muted);
    }

    .register-form button {
      padding: 14px;
      font-size: 16px;
      font-weight: 600;
      background: var(--gradient);
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: var(--shadow-soft);
    }

    .register-form button:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-hover);
    }

    .error-message {
      color: var(--error-color);
      font-size: 14px;
      margin-bottom: 16px;
      text-align: left;
    }

    .login-link {
      margin-top: 16px;
      font-size: 14px;
      color: var(--text-secondary);
    }

    .login-link a {
      color: var(--accent-secondary);
      text-decoration: none;
      font-weight: 500;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    footer {
      background: rgba(255, 255, 255, 0.95);
      border-top: 1px solid var(--border-color);
      padding: 20px;
      text-align: center;
      font-size: 14px;
      color: var(--text-muted);
      position: sticky;
      bottom: 0;
      backdrop-filter: blur(20px);
    }

    footer a {
      color: var(--accent-secondary);
      text-decoration: none;
      font-weight: 500;
    }

    footer a:hover {
      text-decoration: underline;
    }

    .footer-links {
      margin-top: 8px;
      display: flex;
      justify-content: center;
      gap: 24px;
    }

    @media (max-width: 768px) {
      .register-box {
        padding: 32px;
      }

      .register-box h1 {
        font-size: 24px;
      }

      .header-content {
        flex-direction: column;
        gap: 16px;
        text-align: center;
      }

      .nav-links {
        flex-direction: column;
        gap: 12px;
      }
    }

    @media (max-width: 480px) {
      .register-box {
        padding: 24px;
      }

      .register-box h1 {
        font-size: 20px;
      }

      .register-form input,
      .register-form button {
        font-size: 14px;
        padding: 10px;
      }
    }

    /* Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: var(--warm-cream);
    }

    ::-webkit-scrollbar-thumb {
      background: var(--warm-orange);
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: var(--accent-primary);
    }
  </style>
</head>
<body>
  <header>
    <div class="header-content">
      <div class="logo">Focal</div>
      <nav class="nav-links">
        <a href="index.php">Home</a>
        <a href="#features">Features</a>
        <a href="#about">About</a>
      </nav>
    </div>
  </header>

  <div class="register-section">
    <div class="register-box">
      <h1>Create Your Focal Account</h1>
      <?php if (isset($_GET['error'])): ?>
        <div class="error-message">
          <?= htmlspecialchars($_GET['error']) ?>
        </div>
      <?php endif; ?>
      <form action="api/register_handler.php" method="POST" class="register-form">
        <input type="text" name="name" placeholder="Full Name" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Register</button>
      </form>
      <div class="login-link">
        Already have an account? <a href="login.php">Login here</a>
      </div>
    </div>
  </div>

  <footer>
    <p>Made with ❤️ by <a href="https://iredylabs.com" target="_blank">iRedyLabs</a></p>
    <div class="footer-links">
      <a href="#privacy">Privacy Policy</a>
      <a href="#terms">Terms of Service</a>
      <a href="#contact">Contact Us</a>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Animate register box on load
      const registerBox = document.querySelector('.register-box');
      registerBox.style.opacity = '0';
      registerBox.style.transform = 'translateY(20px)';
      setTimeout(() => {
        registerBox.style.transition = 'all 0.5s ease';
        registerBox.style.opacity = '1';
        registerBox.style.transform = 'translateY(0)';
      }, 100);

      // Parallax effect for register section background
      const registerSection = document.querySelector('.register-section');
      window.addEventListener('scroll', () => {
        const scrollPosition = window.scrollY;
        registerSection.querySelector('::before').style.transform = `translateY(${scrollPosition * 0.2}px)`;
      });

      // Button hover animation
      const button = document.querySelector('.register-form button');
      button.addEventListener('mouseenter', () => {
        button.style.transform = 'translateY(-4px)';
        button.style.boxShadow = 'var(--shadow-hover)';
      });
      button.addEventListener('mouseleave', () => {
        button.style.transform = 'translateY(0)';
        button.style.boxShadow = 'var(--shadow-soft)';
      });

      // Input focus animation
      const inputs = document.querySelectorAll('.register-form input');
      inputs.forEach(input => {
        input.addEventListener('focus', () => {
          input.style.borderColor = 'var(--accent-primary)';
          input.style.boxShadow = '0 0 0 3px rgba(255, 99, 20, 0.1)';
        });
        input.addEventListener('blur', () => {
          input.style.borderColor = 'var(--border-color)';
          input.style.boxShadow = 'none';
        });
      });
    });
  </script>
</body>
</html>