@extends('layouts.app')
@section('title', 'Home page')
@section('content')
<style>
    /* Hero Section Styling */
    .hero-section {
        display: flex;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }

    .hero-text {
        width: 50%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: rgb(239, 236, 232);
        padding: 20px;
        color: #333;
        text-align: center;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }

    .hero-text h1 {
        font-size: 4rem;
        margin-bottom: 20px;
        font-weight: 700;
        color: #000;
        line-height: 1.2;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3); /* Slight shadow for readability */
    }

    .hero-text p {
        font-size: 1.5rem;
        color: #555;
        max-width: 500px;
        line-height: 1.6;
    }

    .hero-image {
        width: 50%; /* Takes the other half of the width */
        height: 100%;
        background: url('{{ asset('images/home1.png') }}') no-repeat center center;
        background-size: cover;
    }

    /* About Section Styling */
    .about-section {
        padding: 60px 0;
        background-color: #fff;
        text-align: center;
        margin-top: 100px;
        margin-bottom: 100px;
    }

    .about-section h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
    }

    .about-section p {
        max-width: 700px;
        margin: 0 auto;
        font-size: 1.2rem;
        line-height: 1.8;
        color: #666;
    }

    /* Services Section Styling */
    .services-section {
        padding: 60px 0;
        background-color: #f9f9f9;
        text-align: center;
    }

    .services-section h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
    }

    .services-section .service-card {
        display: inline-block;
        width: 300px;
        margin: 20px;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        vertical-align: top;
    }

    .services-section .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    .services-section .service-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-bottom: 1px solid #ddd;
    }

    .services-section .service-card h3 {
        margin: 15px 0;
        font-size: 1.5rem;
        color: #333;
    }

    .services-section .service-card p {
        font-size: 1rem;
        color: #666;
    }

    /* Featured Cars Section Styling */
    .featured-cars {
        padding: 40px 0;
        background-color: #f9f9f9;
        position: relative;
        text-align: center;
    }

    .featured-cars h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
    }

    .car-container {
        display: flex;
        overflow-x: hidden;
        scroll-behavior: smooth;
        width: 100%;
        position: relative;
    }

    .car-card {
        flex: 0 0 30%; /* Shows 3 cards at a time */
        margin: 0 10px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 12px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .car-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    .car-card img {
        width: 100%;
        height: 180px; /* Adjusted height for better styling */
        object-fit: cover;
        border-bottom: 1px solid #ddd; /* Divider between image and content */
    }

    .car-card-body {
        padding: 20px;
    }

    .car-card h3 {
        margin: 0;
        font-size: 1.75rem;
        color: #333;
    }

    .car-card p {
        color: #666;
        font-size: 1rem;
        margin-top: 10px;
    }

    .scroll-icon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        font-size: 2rem;
        cursor: pointer;
        border-radius: 50%;
        transition: background-color 0.3s;
        z-index: 100;
    }

    .scroll-icon:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    .scroll-left {
        left: 10px;
    }

    .scroll-right {
        right: 10px;
    }

    /* Footer Styling */
    footer {
        background-color: #2c3e50;
        color: #ecf0f1;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #34495e;
        flex-wrap: wrap;
        margin-top: 200px;
    }

    .footer-left, .footer-right {
        width: 48%;
        text-align: center;
    }

    .footer-left {
        text-align: left;
    }

    .footer-right {
        text-align: right;
    }

    .footer-link {
        color: #3498db;
        text-decoration: none;
        font-weight: 500;
        margin: 0 10px;
    }

    .footer-link:hover {
        text-decoration: underline;
    }

    .footer-right p {
        margin: 0;
    }

    .q {
        background-color: rgb(143, 227, 226);
        border-radius: 10px;
        padding: 1px;
    }
</style>

<!-- Hero Section -->
<div class="hero-section" >
    <div class="hero-text">
        <h1>Welcome to <span class="q">Quick</span>Rent</h1>
        <p>Your ultimate destination for hassle-free car rentals. Discover a wide range of vehicles, from compact cars to spacious SUVs, all designed to make your journey as smooth as possible.</p>
    </div>
    <div class="hero-image"></div>
</div>

<!-- About Section -->
<div class="about-section" id="about">
    <h2>About Us</h2>
    <p>At QuickRent, we pride ourselves on offering a streamlined car rental experience tailored to your needs. Our diverse fleet of vehicles ensures that you find the perfect car for any occasion, whether it's a weekend getaway or a business trip. Enjoy exceptional service, transparent pricing, and the convenience of booking online or in-person.</p>
</div>

<!-- Services Section -->
<div class="services-section" id="services">
    <h2>Our Services</h2>
    <div class="service-card">
        <img src="{{ asset('images/service.jpeg') }}" alt="Service 1">
        <h3>Flexible Rentals</h3>
        <p>Choose from a variety of rental options to suit your needs, from short-term to long-term rentals.</p>
    </div>
    <div class="service-card">
        <img src="{{ asset('images/twenySeven.png') }}" alt="Service 2">
        <h3>24/7 Support</h3>
        <p>Our dedicated support team is available around the clock to assist you with any inquiries or issues.</p>
    </div>
    <div class="service-card">
        <img src="{{ asset('images/Click.png') }}" alt="Service 3">
        <h3>Seamless Booking</h3>
        <p>Experience a smooth and easy booking process, both online and at our rental locations.</p>
    </div>
</div>

<!-- Featured Cars Section -->
<div class="container featured-cars" id="features">
    <h2>Featured Cars</h2>
    <button class="scroll-icon scroll-left" onclick="scrollLeft()">&larr;</button>
    <div class="car-container">
        <!-- Car Cards -->
        <div class="car-card">
            <img src="{{ asset('images/1724925345-acura.jpg') }}" alt="Acura">
            <div class="car-card-body">
                <h3>Acura MDX</h3>
                <p>Experience luxury and performance with the Acura MDX. Perfect for family trips and long drives.</p>
            </div>
        </div>

        <div class="car-card" id="services">
            <img src="{{ asset('images/CarModel1.png') }}" alt="Toyota Corolla">
            <div class="car-card-body">
                <h3>Toyota Corolla</h3>
                <p>Enjoy reliable and efficient driving with the Toyota Corolla. Ideal for city commutes and daily use.</p>
            </div>
        </div>

        <div class="car-card" >
            <img src="{{ asset('images/CarModel2.png') }}" alt="Honda Civic">
            <div class="car-card-body">
                <h3>Honda Civic</h3>
                <p>Get the best of both worlds with the Honda Civic – style, comfort, and fuel efficiency combined.</p>
            </div>
        </div>

        <div class="car-card">
            <img src="{{ asset('images/CarModel3.png') }}" alt="Ford Mustang">
            <div class="car-card-body">
                <h3>Ford Mustang</h3>
                <p>Unleash your inner driver with the Ford Mustang. A classic American muscle car with modern features.</p>
            </div>
        </div>

        <div class="car-card">
            <img src="{{ asset('images/CarModel4.png') }}" alt="Chevrolet Tahoe">
            <div class="car-card-body">
                <h3>Chevrolet Tahoe</h3>
                <p>Perfect for group travel, the Chevrolet Tahoe offers ample space and a smooth ride for any adventure.</p>
            </div>
        </div>

        <div class="car-card">
            <img src="{{ asset('images/CarModel5.jpeg') }}" alt="BMW X5">
            <div class="car-card-body">
                <h3>BMW X5</h3>
                <p>Elevate your driving experience with the BMW X5 – a premium SUV with advanced features and luxurious comfort.</p>
            </div>
        </div>
    </div>
    <button class="scroll-icon scroll-right" onclick="scrollRight()">&rarr;</button>
</div>
<!-- Footer Section -->
<footer>
    <div class="footer-right">
        <p style="margin-right: 100px">Follow us on:</p>
        <a href="#" class="footer-link">Facebook</a> |
        <a href="#" class="footer-link">Twitter</a> |
        <a href="#" class="footer-link">Instagram</a>
    </div>
</footer>

<script>
    function scrollLeft() {
        document.querySelector('.car-container').scrollBy({
            left: -300,
            behavior: 'smooth'
        });
    }

    function scrollRight() {
        document.querySelector('.car-container').scrollBy({
            left: 400,
            behavior: 'smooth'
        });
    }
</script>

@endsection
