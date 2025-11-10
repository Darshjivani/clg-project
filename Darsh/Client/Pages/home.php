<?php
session_start();
$is_logged_in = isset($_SESSION['User_Logged-In']) && $_SESSION['User_Logged-In'] === true;
$username = $is_logged_in ? $_SESSION['admin_username'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Logistic Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Modern Color Theme */
            --white-color: #ffffff;
            --dark-color: #1a1a2e;
            --primary-color: #0f4c75;
            --secondary-color: #3282b8;
            --accent-color: #bbe1fa;
            --spanish-gray: #6c757d;
            --pale-grey: #f8f9fa;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--dark-color);
        }

        /* Header Styles */
        header {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            background: rgba(15, 76, 117, 0.95);
            backdrop-filter: blur(20px);
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            max-width: 1300px;
            margin: 0 auto;
        }

        .nav-logo {
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo-text {
            color: var(--white-color);
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: var(--white-color);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            background: var(--secondary-color);
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .logout-btn {
            background: var(--danger-color);
            color: var(--white-color);
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .logout-btn:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .user-welcome {
            color: var(--white-color);
            font-weight: 500;
            margin-right: 1rem;
        }

        #menu-open-button, #menu-close-button {
            display: none;
            background: none;
            border: none;
            color: var(--white-color);
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-color) 0%, #004d56 100%);
            display: flex;
            align-items: center;
            padding-top: 80px;
        }

        .section-content {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .hero-section .section-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-details {
            animation: slideInLeft 1s ease-out;
        }

        .hero-details .title {
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--white-color);
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero-details .subtitle {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .hero-details .discription {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .buttons {
            display: flex;
            gap: 1rem;
        }

        .button {
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .order-now {
            background: var(--secondary-color);
            color: var(--primary-color);
        }

        .order-now:hover {
            background: var(--white-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .contact-us {
            background: transparent;
            color: var(--white-color);
            border: 2px solid var(--white-color);
        }

        .contact-us:hover {
            background: var(--white-color);
            color: var(--primary-color);
            transform: translateY(-3px);
        }

        .hero-image-wrapper {
            animation: slideInRight 1s ease-out;
        }

        .hero-image {
            width: 100%;
            max-width: 400px;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .hero-image:hover {
            transform: scale(1.05);
        }

        /* Section Titles */
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin: 4rem 0;
            color: var(--dark-color);
            position: relative;
        }

        .section-title::after {
            content: '';
            width: 80px;
            height: 4px;
            background: var(--secondary-color);
            display: block;
            margin: 1rem auto;
            border-radius: 2px;
        }

        /* Service Section */
        .service-section {
            padding: 4rem 0;
            background: var(--white-color);
        }

        .service-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            list-style: none;
        }

        .service-item {
            text-align: center;
            padding: 2rem;
            border-radius: 20px;
            background: var(--white-color);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease-out;
        }

        .service-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .service-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .service-item:hover .service-image {
            transform: scale(1.05);
        }

        .service-link {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 1.3rem;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .service-link:hover {
            color: var(--secondary-color);
        }

        .service-item .text {
            color: var(--spanish-gray);
            margin-top: 1rem;
            line-height: 1.6;
        }

        /* Team Section */
        .Our-teams-section {
            padding: 4rem 0;
            background: var(--pale-grey);
            overflow: hidden;
        }

        .Our-teams-section .section-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .slider-container {
            position: relative;
            padding: 2rem 0 3rem;
            overflow: visible;
        }

        .swiper {
            width: 100%;
            height: 100%;
            overflow: visible;
        }

        .swiper-wrapper {
            display: flex;
            align-items: stretch;
            padding-bottom: 1rem;
        }

        .swiper-slide {
            height: auto;
            display: flex;
        }

        .Our-team {
            text-align: center;
            padding: 2rem;
            background: var(--white-color);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            height: 100%;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .Our-team:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .Our-team:active {
            transform: translateY(-3px);
        }

        .user-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1rem;
            display: block;
            border: 4px solid var(--secondary-color);
            transition: transform 0.3s ease;
        }

        .user-image:hover {
            transform: scale(1.1);
        }

        .Our-team .name {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin: 0;
        }

        /* Swiper Navigation Buttons */
        .swiper-button-next,
        .swiper-button-prev {
            color: var(--primary-color);
            background: var(--white-color);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px;
            font-weight: bold;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: var(--primary-color);
            color: var(--white-color);
            transform: scale(1.1);
        }

        /* Swiper Pagination */
        .swiper-pagination {
            bottom: 0 !important;
        }

        .swiper-pagination-bullet {
            background: var(--spanish-gray);
            opacity: 0.5;
            width: 12px;
            height: 12px;
        }

        .swiper-pagination-bullet-active {
            background: var(--primary-color);
            opacity: 1;
        }

        /* Gallery Section */
        .gallery-section {
            padding: 4rem 0;
            background: var(--white-color);
        }

        .gallery-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            list-style: none;
        }

        .gallery-item {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
        }

        .gallery-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover .gallery-image {
            transform: scale(1.1);
        }

        /* Contact Section */
        .contact-section {
            padding: 4rem 0;
            background: var(--pale-grey);
        }

        .contact-section .section-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: start;
        }

        .contact-info-list {
            list-style: none;
        }

        .contact-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: var(--white-color);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .contact-info:hover {
            transform: translateX(10px);
        }

        .contact-info i {
            color: var(--primary-color);
            font-size: 1.2rem;
            width: 20px;
        }

        .contact-info p {
            margin: 0;
            color: var(--dark-color);
        }

        iframe {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Footer */
        .footer-section {
            background: var(--primary-color);
            color: var(--white-color);
            padding: 2rem 0;
        }

        .footer-section .section-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .social-link-list {
            display: flex;
            gap: 1rem;
        }

        .social-link {
            color: var(--white-color);
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            color: var(--secondary-color);
            transform: translateY(-3px);
        }

        .policy-link {
            color: var(--white-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .policy-link:hover {
            color: var(--secondary-color);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: var(--white-color);
            padding: 2.5rem;
            border-radius: 16px;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--pale-grey);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: var(--primary-color);
            color: var(--white-color);
            transform: rotate(90deg);
        }

        .modal-title {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .modal-image {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1.5rem;
            display: block;
            border: 4px solid var(--primary-color);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--pale-grey);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .modal-button {
            background: var(--primary-color);
            color: var(--white-color);
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .modal-button:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        /* Team card clickable */
        .Our-team {
            cursor: pointer;
        }

        /* Animations */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            #menu-open-button, #menu-close-button {
                display: block;
            }

            .nav-menu {
                position: fixed;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100vh;
                background: var(--primary-color);
                flex-direction: column;
                justify-content: center;
                transition: left 0.3s ease;
            }

            .nav-menu.active {
                left: 0;
            }

            #menu-close-button {
                position: absolute;
                top: 2rem;
                right: 2rem;
            }

            .hero-section .section-content {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 2rem;
            }

            .hero-details .title {
                font-size: 2.5rem;
            }

            .buttons {
                justify-content: center;
                flex-wrap: wrap;
            }

            .service-list {
                grid-template-columns: 1fr;
            }

            .gallery-list {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }

            .contact-section .section-content {
                grid-template-columns: 1fr;
            }

            .footer-section .section-content {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .section-content {
                padding: 0 1rem;
            }

            .hero-details .title {
                font-size: 2rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <a href="#" class="nav-logo">
                <h2 class="logo-text">Global</h2>
                <p class="logo-text">Logistic <span style="color: #b19149;">Portal</span></p>
            </a>
            <ul class="nav-menu">
                <button id="menu-close-button" class="fas fa-times"></button>
                <li class="nav-item"><a href="/Darsh/Client/Home" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="Service" class="nav-link">Services</a></li>
                <li class="nav-item"><a href="#Our-teams" class="nav-link">Our Team</a></li>
                <li class="nav-item"><a href="#gallery" class="nav-link">Gallery</a></li>
                <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
                <?php if ($is_logged_in): ?>

                    <li class="nav-item"><a href="/Darsh/Client/Logout" class="nav-link logout-btn">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a href="/Darsh/Client/Authentication" class="nav-link">Login</a></li>
                <?php endif; ?>
            </ul>
            <button id="menu-open-button" class="fas fa-bars"></button>
        </nav>
    </header>

    <main>
        <section class="hero-section" id="home">
            <div class="section-content">
                <div class="hero-details">
                    <h2 class="title">Import-Export</h2>
                    <h3 class="subtitle">Make your great experience!</h3>
                    <p class="discription">To develop a user-friendly, feature-rich website that streamlines the import and export logistics process for businesses and individuals, offering tools for quoting, booking, tracking, and document management.</p>
                    <div class="buttons">
                        <?php if ($is_logged_in): ?>
                            <a href="/Darsh/Client/Dashboard" class="button order-now">Dashboard</a>
                            <a href="/Darsh/Client/Logout" class="button contact-us">Logout</a>
                        <?php else: ?>
                            <a href="/Darsh/Client/Authentication" class="button order-now">Login</a>
                            <a href="#contact" class="button contact-us">Contact us</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="hero-image-wrapper">
                    <img src="Public/Images/logo1.png" alt="Hero" class="hero-image">
                </div>
            </div>
        </section>

        <section class="service-section" id="service">
            <h2 class="section-title">Our Services</h2>
            <div class="section-content">
                <ul class="service-list">
                    <li class="service-item">
                        <img src="Public/Images/cargo-services.jpg" alt="cargo service" class="service-image">
                        <h3 class="name"><a href="/Darsh/Client/Service?type=Sea Freight" class="service-link">Sea Freight</a></h3>
                        <p class="text">Cost-effective full container load (FCL) and less than container load (LCL) solutions for shipments of all sizes</p>
                    </li>
                    <li class="service-item">
                        <img src="Public/Images/flight-services.jpg" alt="flight services" class="service-image">
                        <h3 class="name"><a href="/Darsh/Client/Service?type=Air Freight" class="service-link">Air Freight</a></h3>
                        <p class="text">Fast and reliable air cargo services for time-sensitive shipments, connecting major global hubs.</p>
                    </li>
                    <li class="service-item">
                        <img src="Public/Images/road-services.jpg" alt="road services" class="service-image">
                        <h3 class="name"><a href="/Darsh/Client/Service?type=Road Transport" class="service-link">Road/Land Freight</a></h3>
                        <p class="text">Efficient domestic and cross-border transportation for seamless connectivity.</p>
                    </li>
                </ul>
            </div>
        </section>

        <section class="Our-teams-section" id="Our-teams">
            <h2 class="section-title">Our Team</h2>
            <div class="section-content">
                <div class="slider-container swiper">
                    <div class="swiper-wrapper">
                        <div class="Our-team swiper-slide">
                            <img src="Public/Images/Darsh.jpg" alt="User" class="user-image">
                            <h3 class="name">Darsh Jivani</h3>
                        </div>
                        <div class="Our-team swiper-slide">
                            <img src="Public/Images/Aryan.jpg" alt="User" class="user-image">
                            <h3 class="name">Aryan Dangodara</h3>
                        </div>
                        <div class="Our-team swiper-slide">
                            <img src="Public/Images/Gyan.jpg" alt="User" class="user-image">
                            <h3 class="name">Gyan Bathani</h3>
                        </div>
                        <div class="Our-team swiper-slide">
                            <img src="Public/Images/user-4.jpg" alt="User" class="user-image">
                            <h3 class="name">Emily Harris</h3>
                        </div>
                        <div class="Our-team swiper-slide">
                            <img src="Public/Images/user-5.jpg" alt="User" class="user-image">
                            <h3 class="name">Anthony Thompson</h3>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </section>

        <section class="gallery-section" id="gallery">
            <h2 class="section-title">Gallery</h2>
            <div class="section-content">
                <ul class="gallery-list">
                    <li class="gallery-item">
                        <img src="Public/Images/gallery-1.jpg" alt="Gallery" class="gallery-image">
                    </li>
                    <li class="gallery-item">
                        <img src="Public/Images/gallery-2.jpg" alt="Gallery" class="gallery-image">
                    </li>
                    <li class="gallery-item">
                        <img src="Public/Images/gallery-3.jpg" alt="Gallery" class="gallery-image">
                    </li>
                    <li class="gallery-item">
                        <img src="Public/Images/gallery-4.jpg" alt="Gallery" class="gallery-image">
                    </li>
                    <li class="gallery-item">
                        <img src="Public/Images/gallery-5.jpg" alt="Gallery" class="gallery-image">
                    </li>
                    <li class="gallery-item">
                        <img src="Public/Images/gallery-6.jpg" alt="Gallery" class="gallery-image">
                    </li>
                </ul>
            </div>
        </section>

        <section class="contact-section" id="contact">
            <h2 class="section-title">Contact Us</h2>
            <div class="section-content">
                <ul class="contact-info-list">
                    <li class="contact-info">
                        <i class="fa-solid fa-location-crosshairs"></i>
                        <p>123 Capsite Avenue, Wilderness, CA 98765</p>
                    </li>
                    <li class="contact-info">
                        <i class="fa-regular fa-envelope"></i>
                        <p>info@global_logistic_portal.com</p>
                    </li>
                    <li class="contact-info">
                        <i class="fa-solid fa-phone"></i>
                        <p>+91 9567890934</p>
                    </li>
                    <li class="contact-info">
                        <i class="fa-regular fa-clock"></i>
                        <p>Monday - Friday: 9:00 AM - 5:00 PM</p>
                    </li>
                    <li class="contact-info">
                        <i class="fa-regular fa-clock"></i>
                        <p>Saturday: 10:00 AM - 3:00 PM</p>
                    </li>
                    <li class="contact-info">
                        <i class="fa-regular fa-clock"></i>
                        <p>Sunday: Closed</p>
                    </li>
                    <li class="contact-info">
                        <i class="fa-solid fa-globe"></i>
                        <p>www.global_logistic_portal.com</p>
                    </li>
                </ul>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3718.911319332152!2d72.87034267403743!3d21.23536488046623!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04fa33d615b5d%3A0x13e224a83374a500!2sAR%20Mall%20%26%20Multiplex!5e0!3m2!1sen!2sin!4v1759813399073!5m2!1sen!2sin" style="border:0; width: 100%; height: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

        <footer class="footer-section">
            <div class="section-content">
                <p class="copyright-text">© 2025 Global Logistic Portal</p>
                <div class="social-link-list">
                    <a href="#" class="social-link"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="social-link"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
                <p class="policy-text">
                    <a href="#" class="policy-link">Privacy policy</a>
                    <span class="separator">●</span>
                    <a href="#" class="policy-link">Refund policy</a>
                </p>
            </div>
        </footer>
    </main>

    <!-- Team Member Modal -->
    <div id="teamModal" class="modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('teamModal')">&times;</button>
            <img id="modalImage" src="" alt="Team Member" class="modal-image">
            <h2 id="modalName" class="modal-title"></h2>
            <p id="modalRole" style="color: var(--spanish-gray); margin-bottom: 1rem;"></p>
            <p id="modalBio"></p>
        </div>
    </div>

    <!-- Contact Form Modal -->
   
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Mobile menu toggle
        const menuOpen = document.getElementById('menu-open-button');
        const menuClose = document.getElementById('menu-close-button');
        const navMenu = document.querySelector('.nav-menu');

        menuOpen.addEventListener('click', () => {
            navMenu.classList.add('active');
        });

        menuClose.addEventListener('click', () => {
            navMenu.classList.remove('active');
        });

        // Initialize Swiper for Team Slider
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.slider-container', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                grabCursor: true,
                centeredSlides: false,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                },
            });

            console.log('Team Slider initialized successfully!', swiper);
        });

        // Team member data
        const teamData = {
            'Darsh Jivani': {
                image: 'Public/Images/Darsh.jpg',
                role: 'Logistics Manager',
                bio: 'Expert in supply chain management with over 10 years of experience in international logistics and freight forwarding.'
            },
            'Aryan Dangodara': {
                image: 'Public/Images/Aryan.jpg',
                role: 'Operations Director',
                bio: 'Specializes in optimizing logistics operations and implementing efficient transportation solutions.'
            },
            'Gyan Bathani': {
                image: 'Public/Images/Gyan.jpg',
                role: 'Customer Relations Manager',
                bio: 'Dedicated to providing exceptional customer service and building long-term client relationships.'
            },
            'Emily Harris': {
                image: 'Public/Images/user-4.jpg',
                role: 'Customs Specialist',
                bio: 'Expert in customs regulations and international trade compliance with extensive knowledge of import/export procedures.'
            },
            'Anthony Thompson': {
                image: 'Public/Images/user-5.jpg',
                role: 'Warehouse Manager',
                bio: 'Manages warehouse operations and inventory control with a focus on efficiency and accuracy.'
            }
        };

        // Modal functions
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Team member click handler
        document.querySelectorAll('.Our-team').forEach(card => {
            card.addEventListener('click', function() {
                const name = this.querySelector('.name').textContent;
                const data = teamData[name];

                if (data) {
                    document.getElementById('modalImage').src = data.image;
                    document.getElementById('modalName').textContent = name;
                    document.getElementById('modalRole').textContent = data.role;
                    document.getElementById('modalBio').textContent = data.bio;
                    openModal('teamModal');
                }
            });
        });

        // Close modal when clicking outside
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal(this.id);
                }
            });
        });

        // Contact form submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for your message! We will get back to you soon.');
            closeModal('contactModal');
            this.reset();
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    navMenu.classList.remove('active');
                }
            });
        });

        // Header background on scroll
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(0, 109, 119, 0.98)';
            } else {
                header.style.background = 'rgba(0, 109, 119, 0.95)';
            }
        });
    </script>
</body>
</html>
