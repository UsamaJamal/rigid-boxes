<style>
    .trust-us-section {
        background-color: var(--secondary-color);
        padding: 80px 0;
    }
    
    .trust-us-container {
        max-width: 1440px;
        width: 100%;
        margin: 0 auto;
        padding: 0 5%;
    }

    .trust-us-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .trust-us-header h2 {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 32px;
        color: var(--section-text-color);
        margin-bottom: 15px;
        margin-top: 0;
    }

    .trust-us-header p {
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 16px;
        color: var(--section-text-color);
        margin: 0;
        line-height: 1.5;
    }

    .trust-us-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .trust-card {
        background: #FFFFFF;
        border: 0.5px solid #8D4445;
        border-radius: 12px;
        padding: 40px 20px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .trust-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(141, 68, 69, 0.1);
    }

    .trust-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background-color: var(--secondary-color);
        margin-bottom: 24px;
    }

    .trust-icon img {
        max-width: 35px;
        max-height: 35px;
        object-fit: contain;
    }

    .trust-card h3 {
        font-family: 'Open Sans', sans-serif;
        font-weight: 700;
        font-size: 16px;
        line-height: 19.2px;
        color: var(--section-text-color);
        margin-bottom: 12px;
        margin-top: 0;
    }

    .trust-card p {
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 14px;
        line-height: 21.7px;
        letter-spacing: 0.23px;
        color: var(--section-text-color);
        margin: 0;
    }

    @media (max-width: 991px) {
        .trust-us-grid {
            grid-template-columns: repeat(1, 1fr);
        }
    }

    @media (max-width: 767px) {
        .trust-us-grid {
            grid-template-columns: 1fr;
        }
        
        .trust-us-header p br {
            display: none;
        }
    }
</style>
<section class="trust-us-section">
    <div class="trust-us-container">
        <div class="trust-us-header">
            <h2>Why Brands Trust Us</h2>
            <p>Every advantage is designed to make your packaging procurement seamless,<br>cost-effective, and world-class.</p>
        </div>
        <div class="trust-us-grid">
            <!-- Card 1 -->
            <div class="trust-card">
                <span class="trust-icon">
                    <img src="{{ asset('uploads/no-die-plate-charges.svg') }}" alt="No Die & Plate Charges">
                </span>
                <h3>No Die & Plate Charges</h3>
                <p>No added tooling fees, just straightforward pricing</p>
            </div>
            
            <!-- Card 2 -->
            <div class="trust-card">
                <span class="trust-icon">
                    <img src="{{ asset('uploads/customer-satisfaction.svg') }}" alt="Customer Satisfaction">
                </span>
                <h3>Customer Satisfaction</h3>
                <p>Built on trust, quality, and long term partnerships.</p>
            </div>
            
            <!-- Card 3 -->
            <div class="trust-card">
                <span class="trust-icon">
                    <img src="{{ asset('uploads/low-minimum-order-quantity.svg') }}" alt="Low Minimum Order Quantity">
                </span>
                <h3>Low Minimum Order Quantity</h3>
                <p>Flexible quantities to suit every business stage.</p>
            </div>
            
            <!-- Card 4 -->
            <div class="trust-card">
                <span class="trust-icon">
                    <img src="{{ asset('uploads/free-shipping.svg') }}" alt="Free Shipping">
                </span>
                <h3>Free Shipping</h3>
                <p>No shipping costs, no last-minute surprises.</p>
            </div>
            
            <!-- Card 5 -->
            <div class="trust-card">
                <span class="trust-icon">
                    <img src="{{ asset('uploads/free-graphic-design.svg') }}" alt="Free Graphic Design">
                </span>
                <h3>Free Graphic Design</h3>
                <p>Professional designs at no extra cost.</p>
            </div>
            
            <!-- Card 6 -->
            <div class="trust-card">
                <span class="trust-icon">
                    <img src="{{ asset('uploads/fast-turn-around.svg') }}" alt="Fast Turnaround Time">
                </span>
                <h3>Fast Turnaround Time</h3>
                <p>Quick production with consistent quality.</p>
            </div>
        </div>
    </div>
</section>

