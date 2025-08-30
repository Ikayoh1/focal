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
  <title>Focal — Your Daily Work Companion</title>
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

    .hero {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 48px 24px;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
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

    .hero-box {
      background: var(--bg-card);
      padding: 48px;
      max-width: 700px;
      width: 100%;
      border-radius: 16px;
      box-shadow: var(--shadow-soft);
      text-align: center;
      position: relative;
      z-index: 1;
      transform: translateY(0);
      transition: transform 0.5s ease, box-shadow 0.3s ease;
    }

    .hero-box:hover {
      transform: translateY(-8px);
      box-shadow: var(--shadow-hover);
    }

    .hero h1 {
      font-size: 36px;
      font-weight: 700;
      margin-bottom: 20px;
      background: var(--gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero p {
      font-size: 18px;
      color: var(--text-muted);
      margin-bottom: 32px;
      line-height: 1.8;
    }

    .btn-group {
      display: flex;
      gap: 16px;
      justify-content: center;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 14px 28px;
      font-weight: 600;
      font-size: 16px;
      text-decoration: none;
      border-radius: 8px;
      transition: all 0.3s ease;
      box-shadow: var(--shadow-soft);
    }

    .btn-primary {
      background: var(--gradient);
      color: white;
    }

    .btn-primary:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-hover);
    }

    .btn-secondary {
      background: var(--warm-cream);
      color: var(--text-primary);
      border: 1px solid var(--border-color);
    }

    .btn-secondary:hover {
      background: var(--warm-orange);
      border-color: var(--accent-primary);
      transform: translateY(-4px);
      box-shadow: var(--shadow-hover);
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
      .hero-box {
        padding: 32px;
      }

      .hero h1 {
        font-size: 28px;
      }

      .hero p {
        font-size: 16px;
      }

      .btn-group {
        flex-direction: column;
        align-items: center;
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
      .hero-box {
        padding: 24px;
      }

      .hero h1 {
        font-size: 24px;
      }

      .hero p {
        font-size: 14px;
      }

      .btn {
        padding: 12px 24px;
        font-size: 14px;
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
        <a href="#features">Features</a>
        <a href="#about">About</a>
        <a href="login.php">Sign In</a>
      </nav>
    </div>
  </header>

  <div class="hero">
    <div class="hero-box">
      <h1>Your Calm Space to Get Things Done</h1>
      <p>Focal brings your projects, files, and tasks into one clean, intuitive workspace. Streamline your workflow with no clutter, just flow.</p>
      <div class="btn-group">
        <a href="login.php" class="btn btn-primary">Sign In or Get Started</a>
        <a href="register.php" class="btn btn-secondary">Create an Account</a>
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
      // Animate hero box on load
      const heroBox = document.querySelector('.hero-box');
      heroBox.style.opacity = '0';
      heroBox.style.transform = 'translateY(20px)';
      setTimeout(() => {
        heroBox.style.transition = 'all 0.5s ease';
        heroBox.style.opacity = '1';
        heroBox.style.transform = 'translateY(0)';
      }, 100);

      // Parallax effect for hero background
      const hero = document.querySelector('.hero');
      window.addEventListener('scroll', () => {
        const scrollPosition = window.scrollY;
        hero.querySelector('::before').style.transform = `translateY(${scrollPosition * 0.2}px)`;
      });

      // Button hover animation
      const buttons = document.querySelectorAll('.btn');
      buttons.forEach(btn => {
        btn.addEventListener('mouseenter', () => {
          btn.style.transform = 'translateY(-4px)';
          btn.style.boxShadow = 'var(--shadow-hover)';
        });
        btn.addEventListener('mouseleave', () => {
          btn.style.transform = 'translateY(0)';
          btn.style.boxShadow = 'var(--shadow-soft)';
        });
      });
    });
  </script>
</body>
</html>