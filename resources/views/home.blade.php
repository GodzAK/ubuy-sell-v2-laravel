@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="hero" style="background-image:url('{{ asset('assets/images/bg.jpeg') }}');">
    <div class="overlay"></div>
    <div class="hero-content">
        <h1>Welcome to UBuy & Sell</h1>
        <p>Your trusted marketplace for University of Batangas essentials</p>
        <a href="{{ auth()->check() ? route('marketplace.index') : route('login') }}" class="cta-button">Shop Now</a>
    </div>
</section>

<section id="featured" class="categories">
    <h2>Featured Categories</h2>
    <div class="category-grid">
        <div class="category-card">
            <img src="{{ asset('assets/images/uniform.png') }}" alt="Uniforms">
            <div class="category-content">
                <h3>Uniforms</h3>
                <p>Official UB uniforms</p>
                <a href="{{ auth()->check() ? route('marketplace.index', ['category' => 'Clothes']) : route('login') }}" class="category-link">Shop Uniforms</a>
            </div>
        </div>
        <div class="category-card">
            <img src="{{ asset('assets/images/logo1.png') }}" alt="Books">
            <div class="category-content">
                <h3>Books</h3>
                <p>Textbooks & References</p>
                <a href="{{ auth()->check() ? route('marketplace.index', ['category' => 'Books']) : route('login') }}" class="category-link">Browse Books</a>
            </div>
        </div>
        <div class="category-card">
            <img src="{{ asset('assets/images/search.png') }}" alt="Supplies">
            <div class="category-content">
                <h3>Supplies</h3>
                <p>Academic Essentials</p>
                <a href="{{ auth()->check() ? route('marketplace.index', ['category' => 'School Supplies']) : route('login') }}" class="category-link">View Supplies</a>
            </div>
        </div>
    </div>
</section>

<section class="about">
    <div class="about-content">
        <h2>Why Choose UBuy & Sell?</h2>
        <div class="features-grid">
            <div class="feature">
                <i class="fas fa-shield-alt"></i>
                <h3>Trusted Platform</h3>
                <p>Verified student marketplace</p>
            </div>
            <div class="feature">
                <i class="fas fa-hand-holding-usd"></i>
                <h3>Best Deals</h3>
                <p>Affordable student prices</p>
            </div>
            <div class="feature">
                <i class="fas fa-sync"></i>
                <h3>Sustainable</h3>
                <p>Support recycling culture</p>
            </div>
        </div>
    </div>
</section>

<section class="vision-mission">
    <div class="vm-container">
        <div class="vm-card">
            <h3>Our Vision</h3>
            <p>To be the most trusted and efficient online marketplace for students, fostering a sense of community and supporting sustainable practices in the University of Batangas.</p>
        </div>
        <div class="vm-card">
            <h3>Our Mission</h3>
            <p>To provide a safe, easy-to-use platform for buying and selling student essentials, empowering students to save money, reduce waste, and promote a culture of collaboration.</p>
        </div>
    </div>
</section>
@endsection
