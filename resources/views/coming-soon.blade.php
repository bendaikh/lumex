<!DOCTYPE html>
<html lang="fr" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumex Lighting - Éclairage Professionnel & Solutions Lumineuses</title>
    <meta name="description" content="Depuis 2007, Lumex éclaire vos espaces avec passion, expertise et créativité. Solutions d'éclairage sur mesure pour professionnels et particuliers à Casablanca.">
    <meta name="keywords" content="éclairage, luminaires, Casablanca, architecture, design, LED, professionnel">
    <link rel="icon" href="{{ get_file('uploads/logo/favicon.png') }}" type="image/png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #1e3a8a;
            --accent-color: #fbbf24;
            --dark-color: #0f172a;
            --light-color: #f8fafc;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --white: #ffffff;
            --gradient-primary: linear-gradient(135deg, #ff6b35 0%, #f59e0b 100%);
            --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
            --shadow-light: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-heavy: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .header.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: var(--shadow-medium);
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--secondary-color);
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-primary);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Login Button Styling */
        .login-btn {
            background: var(--gradient-primary) !important;
            color: white !important;
            padding: 8px 16px !important;
            border-radius: 25px !important;
            border: none !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            box-shadow: var(--shadow-light) !important;
            margin-left: 1rem !important;
        }

        .login-btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: var(--shadow-medium) !important;
            background: linear-gradient(135deg, #e55a2b 0%, #d97706 100%) !important;
        }

        .login-btn::after {
            display: none !important;
        }

        .login-btn i {
            margin-right: 6px;
        }

        /* Mobile Login Button */
        .mobile-login-btn {
            background: var(--gradient-primary) !important;
            color: white !important;
            font-weight: 600 !important;
            border-radius: 8px !important;
            margin: 0.5rem 1rem !important;
            text-align: center !important;
            border: none !important;
        }

        .mobile-login-btn:hover {
            background: linear-gradient(135deg, #e55a2b 0%, #d97706 100%) !important;
            transform: none !important;
        }

        .mobile-login-btn i {
            margin-right: 8px;
        }

        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 4px;
        }

        .hamburger-line {
            width: 25px;
            height: 3px;
            background: var(--text-dark);
            transition: all 0.3s ease;
        }

        .mobile-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            box-shadow: var(--shadow-medium);
            z-index: 999;
        }

        .mobile-menu.active {
            display: block;
        }

        .mobile-nav-menu {
            list-style: none;
            padding: 1rem 0;
        }

        .mobile-nav-menu li {
            border-bottom: 1px solid #e5e7eb;
        }

        .mobile-nav-link {
            display: block;
            padding: 1rem 2rem;
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .mobile-nav-link:hover {
            background: var(--light-color);
            color: var(--primary-color);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: var(--gradient-dark);
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
            z-index: 1;
        }

        /* Animated Light Rays Background */
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(255, 107, 53, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(251, 191, 36, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 40% 60%, rgba(255, 107, 53, 0.15) 0%, transparent 40%),
                linear-gradient(45deg, rgba(30, 58, 138, 0.8) 0%, rgba(15, 23, 42, 0.9) 100%);
            animation: lightPulse 8s ease-in-out infinite;
        }

        /* Light Rays Animation */
        .light-rays {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><linearGradient id="ray1" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="%23ff6b35" stop-opacity="0.6"/><stop offset="100%" stop-color="%23ff6b35" stop-opacity="0"/></linearGradient><linearGradient id="ray2" x1="100%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="%23fbbf24" stop-opacity="0.4"/><stop offset="100%" stop-color="%23fbbf24" stop-opacity="0"/></linearGradient></defs><polygon points="0,0 200,0 100,1000 0,1000" fill="url(%23ray1)"/><polygon points="1000,0 800,0 900,1000 1000,1000" fill="url(%23ray2)"/><polygon points="300,0 500,0 400,1000 200,1000" fill="url(%23ray1)"/><polygon points="700,0 500,0 600,1000 800,1000" fill="url(%23ray2)"/></svg>');
            animation: lightRays 12s linear infinite;
            opacity: 0.7;
        }

        /* Floating Light Particles */
        .light-particles {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 2;
            will-change: transform;
        }

        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: radial-gradient(circle, rgba(255, 107, 53, 0.8) 0%, rgba(255, 107, 53, 0.4) 50%, transparent 100%);
            border-radius: 50%;
            animation: floatParticle 15s linear infinite;
            will-change: transform, opacity;
            backface-visibility: hidden;
        }

        .particle:nth-child(odd) {
            background: radial-gradient(circle, rgba(251, 191, 36, 0.8) 0%, rgba(251, 191, 36, 0.4) 50%, transparent 100%);
            animation-duration: 18s;
        }

        .particle:nth-child(3n) {
            width: 2px;
            height: 2px;
            animation-duration: 20s;
        }

        /* Animated Light Bulbs */
        .light-bulbs {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 1;
            will-change: transform;
        }

        .light-bulb {
            position: absolute;
            width: 40px;
            height: 40px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: lightBulbGlow 4s ease-in-out infinite;
            will-change: transform, opacity, box-shadow;
            backface-visibility: hidden;
        }

        .light-bulb::before {
            content: '💡';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            opacity: 0.3;
            animation: lightBulbFlicker 3s ease-in-out infinite;
            will-change: transform, opacity;
        }

        /* Keyframe Animations */
        @keyframes lightPulse {
            0%, 100% { 
                opacity: 0.8;
                transform: scale(1);
            }
            50% { 
                opacity: 1;
                transform: scale(1.05);
            }
        }

        @keyframes lightRays {
            0% { 
                transform: rotate(0deg) scale(1);
                opacity: 0.7;
            }
            50% { 
                transform: rotate(180deg) scale(1.1);
                opacity: 0.9;
            }
            100% { 
                transform: rotate(360deg) scale(1);
                opacity: 0.7;
            }
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(100vh) translateX(0px) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) translateX(100px) rotate(360deg);
                opacity: 0;
            }
        }

        @keyframes lightBulbGlow {
            0%, 100% { 
                opacity: 0.3;
                transform: scale(1);
                box-shadow: 0 0 20px rgba(255, 107, 53, 0.3);
            }
            50% { 
                opacity: 0.6;
                transform: scale(1.2);
                box-shadow: 0 0 40px rgba(255, 107, 53, 0.6);
            }
        }

        @keyframes lightBulbFlicker {
            0%, 100% { 
                opacity: 0.3;
                transform: translate(-50%, -50%) scale(1);
            }
            25% { 
                opacity: 0.6;
                transform: translate(-50%, -50%) scale(1.1);
            }
            50% { 
                opacity: 0.4;
                transform: translate(-50%, -50%) scale(0.9);
            }
            75% { 
                opacity: 0.7;
                transform: translate(-50%, -50%) scale(1.05);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            max-width: 600px;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #fbbf24 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .hero-cta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: var(--shadow-medium);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-heavy);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
        }

        /* About Section */
        .section {
            padding: 5rem 0;
        }

        /* Ensure proper spacing for About section */
        #about {
            margin-top: 0;
            padding-top: 6rem;
            position: relative;
            z-index: 2;
        }

        /* Ensure all sections have proper positioning */
        .section {
            position: relative;
            z-index: 2;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .section-subtitle {
            text-align: center;
            color: var(--text-light);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto 3rem;
        }

        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .about-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-light);
        }

        .about-text p {
            margin-bottom: 1.5rem;
        }

        .about-text .highlight {
            color: var(--primary-color);
            font-weight: 600;
        }

        .about-image {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-heavy);
        }

        .about-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .about-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-primary);
            opacity: 0.1;
            z-index: 1;
        }

        /* Services Section */
        .services {
            background: var(--light-color);
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .service-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: var(--shadow-light);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-heavy);
        }

        .service-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .service-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .service-description {
            color: var(--text-light);
            line-height: 1.6;
        }

        /* Partners Section */
        .partners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .partner-category {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-light);
            transition: all 0.3s ease;
        }

        .partner-category:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
        }

        .partner-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin: 0 auto 1rem;
        }

        .partner-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        /* Products Section */
        .products {
            background: var(--light-color);
        }

        .product-filters {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 20px;
            border: 2px solid var(--primary-color);
            background: transparent;
            color: var(--primary-color);
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-light);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-heavy);
        }

        .product-image {
            height: 200px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }

        .product-content {
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .product-description {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Realizations Section */
        .realizations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .realization-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-light);
            transition: all 0.3s ease;
        }

        .realization-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-heavy);
        }

        .realization-image {
            height: 250px;
            background: var(--gradient-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
        }

        .realization-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: white;
            padding: 2rem 1.5rem 1.5rem;
        }

        .realization-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .realization-description {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Contact Section */
        .contact {
            background: var(--light-color);
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem;
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-light);
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .contact-details h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--text-dark);
        }

        .contact-details p {
            color: var(--text-light);
        }

        .contact-form {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: var(--shadow-light);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-dark);
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Footer */
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--accent-color);
        }

        .footer-section p,
        .footer-section li {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .mobile-menu-toggle {
                display: flex;
            }
            
            .header {
                position: relative;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-cta {
                flex-direction: column;
                align-items: flex-start;
            }

            .about-content,
            .contact-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .section {
                padding: 3rem 0;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        /* Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Fallback: Show content if JavaScript is disabled */
        .no-js .fade-in {
            opacity: 1;
            transform: translateY(0);
        }

        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: var(--shadow-medium);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .back-to-top:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-heavy);
        }

        .back-to-top.visible {
            display: flex;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header" id="header">
        <div class="container">
            <nav class="nav">
                <a href="#" class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    Lumex Lighting
                </a>
                
                <ul class="nav-menu">
                    <li><a href="#accueil" class="nav-link">Accueil</a></li>
                    <li><a href="#about" class="nav-link">Qui sommes nous ?</a></li>
                    <li><a href="#partners" class="nav-link">Partenaires</a></li>
                    <li><a href="#realizations" class="nav-link">Réalisations</a></li>
                    <li><a href="#services" class="nav-link">Nos services</a></li>
                    <li><a href="#products" class="nav-link">Nos produits</a></li>
                    <li><a href="#contact" class="nav-link">Contact</a></li>
                    <li><a href="{{ url('/login') }}" class="nav-link login-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        Connexion
                    </a></li>
                </ul>
                
                <div class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                    <div class="hamburger-line"></div>
                    <div class="hamburger-line"></div>
                    <div class="hamburger-line"></div>
                </div>
            </nav>
            
            <!-- Mobile Menu -->
            <div class="mobile-menu" id="mobile-menu">
                <ul class="mobile-nav-menu">
                    <li><a href="#accueil" class="mobile-nav-link">Accueil</a></li>
                    <li><a href="#about" class="mobile-nav-link">Qui sommes nous ?</a></li>
                    <li><a href="#partners" class="mobile-nav-link">Partenaires</a></li>
                    <li><a href="#realizations" class="mobile-nav-link">Réalisations</a></li>
                    <li><a href="#services" class="mobile-nav-link">Nos services</a></li>
                    <li><a href="#products" class="mobile-nav-link">Nos produits</a></li>
                    <li><a href="#contact" class="mobile-nav-link">Contact</a></li>
                    <li><a href="{{ url('/login') }}" class="mobile-nav-link mobile-login-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        Connexion
                    </a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="accueil">
        <!-- Animated Light Rays -->
        <div class="light-rays"></div>
        
        <!-- Floating Light Particles -->
        <div class="light-particles" id="light-particles"></div>
        
        <!-- Animated Light Bulbs -->
        <div class="light-bulbs" id="light-bulbs"></div>
        
        <div class="container">
            <div class="hero-content fade-in">
                <div class="hero-badge">
                    <i class="fas fa-star"></i> Depuis 2007 - Expertise & Créativité
                </div>
                <h1 class="hero-title">LIGHTING EMOTIONS</h1>
                <p class="hero-subtitle">
                    Au sein de Lumex, nous croyons en la lumière comme étant la quatrième dimension de l'architecture. 
                    Une lumière qui donne forme aux bâtiments, aux initiatives, aux visions des architectes et des concepteurs.
                </p>
                <div class="hero-cta">
                    <a href="#contact" class="btn btn-primary">
                        <i class="fas fa-calendar-alt"></i>
                        Prendre un rendez-vous
                    </a>
                    <a href="#services" class="btn btn-secondary">
                        <i class="fas fa-info-circle"></i>
                        Découvrir nos services
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section" id="about">
        <div class="container">
            <h2 class="section-title fade-in">À propos</h2>
            <p class="section-subtitle fade-in">
                Découvrez notre passion pour l'éclairage et notre engagement envers l'excellence
            </p>
            
            <div class="about-content">
                <div class="about-text fade-in">
                    <p>
                        Depuis 2007, <span class="highlight">Lumex éclaire vos espaces</span> avec passion, expertise et créativité. 
                        Basés à Casablanca, nous sommes spécialisés dans la fourniture de matériel d'éclairage et la conception 
                        de solutions lumineuses sur mesure pour les professionnels de l'architecture, du design d'intérieur, 
                        du bâtiment, et aussi les particuliers.
                    </p>
                    <p>
                        Notre mission est simple : <span class="highlight">sublimer chaque espace par la lumière</span>, 
                        en alliant performance technique, esthétique, et innovation. Nous collaborons étroitement avec 
                        des architectes, promoteurs, bureaux d'études et designers pour proposer des projets cohérents, 
                        fonctionnels et inspirants.
                    </p>
                    <p>
                        Notre équipe, passionnée et expérimentée, vous accompagne de l'étude photométrique jusqu'au choix 
                        des luminaires, avec une sélection rigoureuse de produits alliant design, durabilité et qualité.
                    </p>
                    <p class="highlight" style="font-size: 1.2rem; font-weight: 600; margin-top: 2rem;">
                        Lumière sur vos projets. Lumière sur vos idées.
                    </p>
                </div>
                <div class="about-image fade-in">
                    <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Lumex Lighting - Éclairage professionnel">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section services" id="services">
        <div class="container">
            <h2 class="section-title fade-in">Nos services</h2>
            <p class="section-subtitle fade-in">
                Des solutions complètes pour tous vos besoins en éclairage
            </p>
            
            <div class="services-grid">
                <div class="service-card fade-in">
                    <div class="service-icon">
                        <i class="fas fa-drafting-compass"></i>
                    </div>
                    <h3 class="service-title">Conception et étude d'éclairage</h3>
                    <p class="service-description">
                        Études photométriques et simulations 3D (Dialux), analyse des besoins selon l'architecture 
                        et l'usage de l'espace, création de plans lumière sur mesure.
                    </p>
                </div>
                
                <div class="service-card fade-in">
                    <div class="service-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="service-title">Conseil & Accompagnement</h3>
                    <p class="service-description">
                        Audit lumineux pour optimiser l'efficacité énergétique, sélection des solutions techniques 
                        et esthétiques adaptées, conseil personnalisé aux architectes, décorateurs et particuliers.
                    </p>
                </div>
                
                <div class="service-card fade-in">
                    <div class="service-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="service-title">Suivi de Projet & Coordination</h3>
                    <p class="service-description">
                        Nous travaillons main dans la main avec les équipes techniques et architecturales, 
                        assurant la cohérence et la réussite de chaque projet, du concept jusqu'à la mise en service.
                    </p>
                </div>
                
                <div class="service-card fade-in">
                    <div class="service-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <h3 class="service-title">Fourniture du Matériel d'éclairage</h3>
                    <p class="service-description">
                        Sélection experte de marques et solutions testées et approuvées, disponibilité & réactivité 
                        avec un stock local, personnalisation selon vos besoins.
                    </p>
                </div>
                
                <div class="service-card fade-in">
                    <div class="service-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="service-title">Scénographie de Façades</h3>
                    <p class="service-description">
                        Études lumineuses sur-mesure adaptées à chaque bâtiment, scénarios dynamiques avec variations 
                        de couleurs, technologies intelligentes (DMX, DALI, LED RGB).
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="section" id="partners">
        <div class="container">
            <h2 class="section-title fade-in">Nos partenaires</h2>
            <p class="section-subtitle fade-in">
                Lumex est le digne représentant de fabricants de renommée internationale
            </p>
            
            <div class="partners-grid">
                <div class="partner-category fade-in">
                    <div class="partner-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h3 class="partner-title">Décoratif</h3>
                </div>
                
                <div class="partner-category fade-in">
                    <div class="partner-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="partner-title">Architectural</h3>
                </div>
                
                <div class="partner-category fade-in">
                    <div class="partner-icon">
                        <i class="fas fa-plug"></i>
                    </div>
                    <h3 class="partner-title">Appareillage</h3>
                </div>
                
                <div class="partner-category fade-in">
                    <div class="partner-icon">
                        <i class="fas fa-tree"></i>
                    </div>
                    <h3 class="partner-title">Extérieur</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="section" style="background: var(--gradient-dark); color: white;">
        <div class="container">
            <h2 class="section-title fade-in" style="color: white;">Nos réalisations en chiffres</h2>
            <p class="section-subtitle fade-in" style="color: rgba(255, 255, 255, 0.8);">
                Plus de 15 ans d'expertise au service de vos projets
            </p>
            
            <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-top: 3rem;">
                <div class="stat-item fade-in" style="text-align: center; padding: 2rem;">
                    <div class="stat-number" style="font-size: 3rem; font-weight: 800; color: var(--accent-color); margin-bottom: 0.5rem;">500+</div>
                    <div class="stat-label" style="font-size: 1.1rem; color: rgba(255, 255, 255, 0.9);">Projets réalisés</div>
                </div>
                
                <div class="stat-item fade-in" style="text-align: center; padding: 2rem;">
                    <div class="stat-number" style="font-size: 3rem; font-weight: 800; color: var(--accent-color); margin-bottom: 0.5rem;">15+</div>
                    <div class="stat-label" style="font-size: 1.1rem; color: rgba(255, 255, 255, 0.9);">Années d'expérience</div>
                </div>
                
                <div class="stat-item fade-in" style="text-align: center; padding: 2rem;">
                    <div class="stat-number" style="font-size: 3rem; font-weight: 800; color: var(--accent-color); margin-bottom: 0.5rem;">100%</div>
                    <div class="stat-label" style="font-size: 1.1rem; color: rgba(255, 255, 255, 0.9);">Satisfaction client</div>
                </div>
                
                <div class="stat-item fade-in" style="text-align: center; padding: 2rem;">
                    <div class="stat-number" style="font-size: 3rem; font-weight: 800; color: var(--accent-color); margin-bottom: 0.5rem;">24/7</div>
                    <div class="stat-label" style="font-size: 1.1rem; color: rgba(255, 255, 255, 0.9);">Support technique</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="section products" id="products">
        <div class="container">
            <h2 class="section-title fade-in">Nos produits</h2>
            <p class="section-subtitle fade-in">
                Trois gammes de produits pour répondre à tous vos besoins
            </p>
            
            <div class="product-filters">
                <button class="filter-btn active" onclick="filterProducts('all')">Tous</button>
                <button class="filter-btn" onclick="filterProducts('essentielle')">Gamme Essentielle</button>
                <button class="filter-btn" onclick="filterProducts('avancee')">Gamme Avancée</button>
                <button class="filter-btn" onclick="filterProducts('prestige')">Gamme Prestige</button>
            </div>
            
            <div class="products-grid">
                <div class="product-card fade-in" data-category="essentielle">
                    <div class="product-image">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">Gamme Essentielle - Décoratif</h3>
                        <p class="product-description">Solutions d'éclairage décoratif de base, parfaites pour les espaces résidentiels et petits commerces.</p>
                    </div>
                </div>
                
                <div class="product-card fade-in" data-category="essentielle">
                    <div class="product-image">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">Gamme Essentielle - Technique</h3>
                        <p class="product-description">Éclairage technique fiable et économique pour les applications industrielles et commerciales.</p>
                    </div>
                </div>
                
                <div class="product-card fade-in" data-category="avancee">
                    <div class="product-image">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">Gamme Avancée - Architectural</h3>
                        <p class="product-description">Solutions architecturales avancées avec contrôle intelligent et design moderne.</p>
                    </div>
                </div>
                
                <div class="product-card fade-in" data-category="avancee">
                    <div class="product-image">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">Gamme Avancée - Extérieur</h3>
                        <p class="product-description">Éclairage extérieur résistant aux intempéries avec technologies LED haute performance.</p>
                    </div>
                </div>
                
                <div class="product-card fade-in" data-category="prestige">
                    <div class="product-image">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">Gamme Prestige - Décoratif</h3>
                        <p class="product-description">Luminaires décoratifs de luxe, créations uniques pour espaces haut de gamme.</p>
                    </div>
                </div>
                
                <div class="product-card fade-in" data-category="prestige">
                    <div class="product-image">
                        <i class="fas fa-gem"></i>
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">Gamme Prestige - Architectural</h3>
                        <p class="product-description">Solutions architecturales premium avec technologies de pointe et finitions exceptionnelles.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Realizations Section -->
    <section class="section" id="realizations">
        <div class="container">
            <h2 class="section-title fade-in">Réalisations</h2>
            <p class="section-subtitle fade-in">
                Découvrez nos projets d'éclairage dans différents secteurs
            </p>
            
            <div class="realizations-grid">
                <div class="realization-card fade-in">
                    <div class="realization-image">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="realization-overlay">
                        <h3 class="realization-title">Retail</h3>
                        <p class="realization-description">Éclairage commercial pour espaces de vente</p>
                    </div>
                </div>
                
                <div class="realization-card fade-in">
                    <div class="realization-image">
                        <i class="fas fa-hotel"></i>
                    </div>
                    <div class="realization-overlay">
                        <h3 class="realization-title">Hôtels</h3>
                        <p class="realization-description">Ambiances lumineuses pour l'hôtellerie</p>
                    </div>
                </div>
                
                <div class="realization-card fade-in">
                    <div class="realization-image">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="realization-overlay">
                        <h3 class="realization-title">Résidentiel</h3>
                        <p class="realization-description">Éclairage sur mesure pour habitations</p>
                    </div>
                </div>
                
                <div class="realization-card fade-in">
                    <div class="realization-image">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="realization-overlay">
                        <h3 class="realization-title">Éducation</h3>
                        <p class="realization-description">Solutions pour établissements scolaires</p>
                    </div>
                </div>
                
                <div class="realization-card fade-in">
                    <div class="realization-image">
                        <i class="fas fa-bus"></i>
                    </div>
                    <div class="realization-overlay">
                        <h3 class="realization-title">Transport</h3>
                        <p class="realization-description">Éclairage pour infrastructures de transport</p>
                    </div>
                </div>
                
                <div class="realization-card fade-in">
                    <div class="realization-image">
                        <i class="fas fa-city"></i>
                    </div>
                    <div class="realization-overlay">
                        <h3 class="realization-title">Urbain</h3>
                        <p class="realization-description">Éclairage public et urbain</p>
                    </div>
                </div>
                
                <div class="realization-card fade-in">
                    <div class="realization-image">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="realization-overlay">
                        <h3 class="realization-title">Bureaux</h3>
                        <p class="realization-description">Environnements de travail optimisés</p>
                    </div>
                </div>
                
                <div class="realization-card fade-in">
                    <div class="realization-image">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="realization-overlay">
                        <h3 class="realization-title">Restauration</h3>
                        <p class="realization-description">Ambiances pour restaurants et cafés</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="section" style="background: var(--gradient-primary); color: white; text-align: center;">
        <div class="container">
            <div class="cta-content fade-in">
                <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; color: white;">Prêt à éclairer votre projet ?</h2>
                <p style="font-size: 1.2rem; margin-bottom: 2rem; opacity: 0.9; max-width: 600px; margin-left: auto; margin-right: auto;">
                    Contactez-nous dès aujourd'hui pour une consultation gratuite et découvrez comment nous pouvons transformer vos espaces avec la lumière.
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="#contact" class="btn" style="background: white; color: var(--primary-color); padding: 1rem 2rem; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                        <i class="fas fa-calendar-alt"></i>
                        Demander un devis gratuit
                    </a>
                    <a href="tel:+212661142161" class="btn" style="background: transparent; color: white; border: 2px solid white; padding: 1rem 2rem; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                        <i class="fas fa-phone"></i>
                        Appeler maintenant
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section contact" id="contact">
        <div class="container">
            <h2 class="section-title fade-in">Contact</h2>
            <p class="section-subtitle fade-in">
                Contactez-nous pour discuter de votre projet d'éclairage
            </p>
            
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-item fade-in">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Adresse</h3>
                            <p>132 Rue Brahim Nakhai<br>Casablanca, Maroc</p>
                        </div>
                    </div>
                    
                    <div class="contact-item fade-in">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Téléphone</h3>
                            <p>+212 661 142 161</p>
                        </div>
                    </div>
                    
                    <div class="contact-item fade-in">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Email</h3>
                            <p>contact@lumex.ma</p>
                        </div>
                    </div>
                    
                    <div class="contact-item fade-in">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Horaires d'ouverture</h3>
                            <p>Lun - Ven: 8h00 - 18h00<br>
                            Sam: 9h00 - 13h00</p>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form fade-in">
                    <h3>Demander un devis</h3>
                    <form id="contact-form">
                        <div class="form-group">
                            <label class="form-label" for="name">Nom complet *</label>
                            <input type="text" id="name" name="name" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="email">Email *</label>
                            <input type="email" id="email" name="email" class="form-input" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="phone">Téléphone</label>
                            <input type="tel" id="phone" name="phone" class="form-input">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="project">Type de projet</label>
                            <select id="project" name="project" class="form-input">
                                <option value="">Sélectionnez un type</option>
                                <option value="residential">Résidentiel</option>
                                <option value="commercial">Commercial</option>
                                <option value="industrial">Industriel</option>
                                <option value="architectural">Architectural</option>
                                <option value="exterior">Extérieur</option>
                                <option value="other">Autre</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="message">Message *</label>
                            <textarea id="message" name="message" class="form-input form-textarea" rows="5" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            Envoyer le message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Lumex Lighting</h3>
                    <p>Depuis 2007, nous éclairons vos espaces avec passion, expertise et créativité. Votre partenaire de confiance pour tous vos projets d'éclairage à Casablanca.</p>
                    <div style="margin-top: 1rem;">
                        <a href="#" style="margin-right: 1rem;"><i class="fab fa-facebook"></i></a>
                        <a href="#" style="margin-right: 1rem;"><i class="fab fa-instagram"></i></a>
                        <a href="#" style="margin-right: 1rem;"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3>Nos services</h3>
                    <ul>
                        <li><a href="#services">Conception d'éclairage</a></li>
                        <li><a href="#services">Conseil & Accompagnement</a></li>
                        <li><a href="#services">Fourniture de matériel</a></li>
                        <li><a href="#services">Scénographie de façades</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Nos produits</h3>
                    <ul>
                        <li><a href="#products">Gamme Essentielle</a></li>
                        <li><a href="#products">Gamme Avancée</a></li>
                        <li><a href="#products">Gamme Prestige</a></li>
                        <li><a href="#products">Éclairage extérieur</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Contact</h3>
                    <p><i class="fas fa-map-marker-alt"></i> 132 Rue Brahim Nakhai, Casablanca</p>
                    <p><i class="fas fa-phone"></i> +212 661 142 161</p>
                    <p><i class="fas fa-envelope"></i> contact@lumex.ma</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2024 Lumex Lighting. Tous droits réservés. | Conception et développement par Lumex Team</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Remove no-js class to enable animations
        document.documentElement.classList.remove('no-js');
        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const hamburger = document.querySelector('.mobile-menu-toggle');
            
            if (mobileMenu && hamburger) {
                mobileMenu.classList.toggle('active');
                hamburger.classList.toggle('active');
            }
        }

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    // Add offset for fixed header
                    const headerHeight = document.querySelector('.header').offsetHeight;
                    const targetPosition = target.offsetTop - headerHeight;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Contact form handling
        const contactForm = document.getElementById('contact-form');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form data
                const formData = new FormData(this);
                const name = formData.get('name');
                const email = formData.get('email');
                const phone = formData.get('phone');
                const message = formData.get('message');
                
                // Simple validation
                if (!name || !email || !message) {
                    alert('Veuillez remplir tous les champs obligatoires.');
                    return;
                }
                
                // Email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    alert('Veuillez entrer une adresse email valide.');
                    return;
                }
                
                // Show success message (in a real application, you would send this to a server)
                alert('Merci pour votre message ! Nous vous contacterons bientôt.');
                this.reset();
            });
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all elements with fade-in class for animation
        document.querySelectorAll('.fade-in').forEach(element => {
            observer.observe(element);
        });

        // Fallback: Show all content after 1 second if intersection observer fails
        setTimeout(() => {
            document.querySelectorAll('.fade-in:not(.visible)').forEach(element => {
                element.classList.add('visible');
            });
        }, 1000);

        // Parallax effect for hero section (disabled to prevent overlap)
        // window.addEventListener('scroll', () => {
        //     const scrolled = window.pageYOffset;
        //     const hero = document.querySelector('.hero');
        //     if (hero) {
        //         hero.style.transform = `translateY(${scrolled * 0.5}px)`;
        //     }
        // });

        // Product category filtering
        function filterProducts(category) {
            const products = document.querySelectorAll('.product-card');
            const buttons = document.querySelectorAll('.filter-btn');
            
            // Remove active class from all buttons
            buttons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            event.target.classList.add('active');
            
            // Show/hide products based on category
            products.forEach(product => {
                if (category === 'all' || product.dataset.category === category) {
                    product.style.display = 'block';
                    product.classList.add('visible');
                } else {
                    product.style.display = 'none';
                }
            });
        }

        // Service accordion functionality (if service items exist)
        const serviceItems = document.querySelectorAll('.service-item');
        if (serviceItems.length > 0) {
            serviceItems.forEach(item => {
                item.addEventListener('click', function() {
                    const content = this.querySelector('.service-content');
                    const isActive = this.classList.contains('active');
                    
                    // Close all other service items
                    serviceItems.forEach(otherItem => {
                        otherItem.classList.remove('active');
                        const otherContent = otherItem.querySelector('.service-content');
                        if (otherContent) {
                            otherContent.style.maxHeight = '0';
                        }
                    });
                    
                    // Toggle current item
                    if (!isActive && content) {
                        this.classList.add('active');
                        content.style.maxHeight = content.scrollHeight + 'px';
                    }
                });
            });
        }

        // Realization gallery lightbox
        function openLightbox(imageSrc, title) {
            const lightbox = document.createElement('div');
            lightbox.className = 'lightbox';
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    <span class="lightbox-close">&times;</span>
                    <img src="${imageSrc}" alt="${title}">
                    <div class="lightbox-caption">${title}</div>
                </div>
            `;
            
            document.body.appendChild(lightbox);
            document.body.style.overflow = 'hidden';
            
            // Close lightbox
            lightbox.addEventListener('click', function(e) {
                if (e.target === lightbox || e.target.classList.contains('lightbox-close')) {
                    document.body.removeChild(lightbox);
                    document.body.style.overflow = 'auto';
                }
            });
        }

        // Add click handlers to realization images (if they exist)
        const realizationImages = document.querySelectorAll('.realization-card img');
        if (realizationImages.length > 0) {
            realizationImages.forEach(img => {
                img.addEventListener('click', function() {
                    const title = this.alt || 'Réalisation Lumex';
                    const src = this.src;
                    openLightbox(src, title);
                });
            });
        }

        // Back to top button
        const backToTop = document.createElement('button');
        backToTop.innerHTML = '↑';
        backToTop.className = 'back-to-top';
        backToTop.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
        document.body.appendChild(backToTop);

        // Show/hide back to top button
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTop.style.display = 'block';
            } else {
                backToTop.style.display = 'none';
            }
        });

        // Typing animation for hero text
        function typeWriter(element, text, speed = 100) {
            let i = 0;
            element.innerHTML = '';
            
            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            type();
        }

        // Initialize typing animation when page loads
        window.addEventListener('load', () => {
            const heroTitle = document.querySelector('.hero-title');
            if (heroTitle) {
                const originalText = heroTitle.textContent;
                typeWriter(heroTitle, originalText, 80);
            }
        });

        // Counter animation for statistics
        function animateCounters() {
            const counters = document.querySelectorAll('.counter');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000; // 2 seconds
                const increment = target / (duration / 16); // 60fps
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    counter.textContent = Math.floor(current);
                }, 16);
            });
        }

        // Trigger counter animation when stats section is visible
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    statsObserver.unobserve(entry.target);
                }
            });
        });

        const statsSection = document.querySelector('.stats-grid');
        if (statsSection) {
            statsObserver.observe(statsSection);
        }

        // Enhanced floating particles effect for lighting theme
        function createLightParticles() {
            const particleContainer = document.getElementById('light-particles');
            if (!particleContainer) return;

            // Create 30 floating light particles
            for (let i = 0; i < 30; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 15) + 's';
                particleContainer.appendChild(particle);
            }
        }

        // Create animated light bulbs
        function createLightBulbs() {
            const bulbContainer = document.getElementById('light-bulbs');
            if (!bulbContainer) return;

            // Create 8 light bulbs positioned around the screen
            const positions = [
                { top: '10%', left: '10%' },
                { top: '20%', right: '15%' },
                { top: '60%', left: '5%' },
                { top: '70%', right: '10%' },
                { top: '30%', left: '85%' },
                { top: '80%', left: '90%' },
                { top: '15%', left: '50%' },
                { top: '85%', left: '60%' }
            ];

            positions.forEach((pos, index) => {
                const bulb = document.createElement('div');
                bulb.className = 'light-bulb';
                bulb.style.top = pos.top;
                bulb.style.left = pos.left;
                bulb.style.right = pos.right;
                bulb.style.animationDelay = (index * 0.5) + 's';
                bulbContainer.appendChild(bulb);
            });
        }

        // Initialize lighting animations
        createLightParticles();
        createLightBulbs();

        // Subtle parallax effect for hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero');
            const lightRays = document.querySelector('.light-rays');
            const lightParticles = document.querySelector('.light-particles');
            
            if (hero && scrolled < window.innerHeight) {
                const parallaxSpeed = 0.5;
                const particlesSpeed = 0.3;
                
                if (lightRays) {
                    lightRays.style.transform = `translateY(${scrolled * parallaxSpeed}px)`;
                }
                
                if (lightParticles) {
                    lightParticles.style.transform = `translateY(${scrolled * particlesSpeed}px)`;
                }
            }
        });

        // Performance optimization: Reduce animations on mobile
        function optimizeForMobile() {
            if (window.innerWidth < 768) {
                // Reduce number of particles on mobile
                const particles = document.querySelectorAll('.particle');
                particles.forEach((particle, index) => {
                    if (index > 15) {
                        particle.style.display = 'none';
                    }
                });
                
                // Reduce light bulbs on mobile
                const bulbs = document.querySelectorAll('.light-bulb');
                bulbs.forEach((bulb, index) => {
                    if (index > 4) {
                        bulb.style.display = 'none';
                    }
                });
            }
        }

        // Call optimization on load and resize
        window.addEventListener('load', optimizeForMobile);
        window.addEventListener('resize', optimizeForMobile);
    </script>

    <!-- Enhanced CSS for professional design -->
    <style>
        /* Professional color scheme inspired by Prolight */
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #1e3a8a;
            --accent-color: #fbbf24;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-light: #f8fafc;
            --bg-dark: #0f172a;
            --white: #ffffff;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Enhanced animations */
        .animate-fade-in {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }


        .btn-primary {
            background: var(--primary-color);
            color: var(--white);
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            background: #e55a2b;
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-secondary {
            background: transparent;
            color: var(--white);
            padding: 1rem 2rem;
            border: 2px solid var(--white);
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--white);
            color: var(--primary-color);
        }

        /* Enhanced navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: var(--shadow);
        }


        /* Enhanced cards */
        .card {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        /* Enhanced buttons */
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-outline:hover {
            background: var(--primary-color);
            color: var(--white);
        }

        /* Enhanced forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        /* Enhanced footer */
        .footer {
            background: var(--bg-dark);
            color: var(--white);
            padding: 3rem 0 1rem;
        }

        .footer h4 {
            color: var(--accent-color);
            margin-bottom: 1rem;
        }

        .footer a {
            color: var(--white);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--primary-color);
        }

        /* Lightbox styles */
        .lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10000;
        }

        .lightbox-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
        }

        .lightbox-content img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .lightbox-close {
            position: absolute;
            top: -40px;
            right: 0;
            color: white;
            font-size: 30px;
            cursor: pointer;
        }

        .lightbox-caption {
            color: white;
            text-align: center;
            margin-top: 10px;
            font-size: 18px;
        }

        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            display: none;
            z-index: 1000;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .back-to-top:hover {
            background: #e55a2b;
            transform: translateY(-2px);
        }

        /* Particles effect */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .hero-cta {
                flex-direction: column;
                align-items: center;
            }
            
            .back-to-top {
                bottom: 20px;
                right: 20px;
                width: 45px;
                height: 45px;
                font-size: 18px;
            }
        }

        /* Service accordion active state */
        .service-item.active .service-icon {
            transform: rotate(45deg);
        }

        .service-item.active .service-content {
            max-height: 500px;
        }

        /* Filter button active state */
        .filter-btn.active {
            background: var(--primary-color);
            color: white;
        }

        /* Mobile menu active state */
        .hamburger.active .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active .hamburger-line:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }
    </style>
</body>
</html>
                