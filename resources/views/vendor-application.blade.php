<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Golden Bean | Vendor Application</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|dancing-script:700|playfair-display:400,500" rel="stylesheet" />
        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            :root {
                --coffee-uganda-dark: #4B371C;
                --coffee-uganda-medium: #8B5A2B;
                --coffee-uganda-light: #D2B48C;
                --coffee-uganda-cream: #FFF8E1;
                --coffee-uganda-gold: #D4AF37;
                --coffee-uganda-green: #5A7247;
            }
            body {
                background-color: var(--coffee-uganda-cream);
                color: var(--coffee-uganda-dark);
                font-family: 'Playfair Display', serif;
                min-height: 100vh;
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                background-image: url('https://images.unsplash.com/photo-1602524818607-f2b046a5d5a0?q=80&w=1000');
                background-size: cover;
                background-position: center;
                background-blend-mode: overlay;
                background-color: rgba(249, 245, 240, 0.9);
            }
            .coffee-wrapper {
                width: 100%;
                max-width: 1200px;
                padding: 2rem;
                display: flex;
                justify-content: center;
            }
            .coffee-container {
                width: 100%;
                max-width: 600px;
                background: rgba(255, 255, 255, 0.97);
                border-radius: 20px;
                box-shadow: 0 10px 30px rgba(75, 55, 28, 0.2);
                padding: 3rem 2rem 2rem 2rem;
                position: relative;
                overflow: hidden;
                text-align: center;
                border: 1px solid rgba(139, 90, 43, 0.3);
                backdrop-filter: blur(5px);
            }
            .coffee-container::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 10px;
                background: linear-gradient(90deg, var(--coffee-uganda-green) 0%, var(--coffee-uganda-medium) 50%, var(--coffee-uganda-gold) 100%);
            }
            .coffee-header {
                font-family: 'Dancing Script', cursive;
                color: var(--coffee-uganda-medium);
                font-size: 3rem;
                margin: 1rem 0 0.5rem 0;
                text-align: center;
                font-weight: 700;
                position: relative;
                display: inline-block;
                text-shadow: 1px 1px 3px rgba(139, 90, 43, 0.2);
            }
            .coffee-header::after {
                content: "";
                position: absolute;
                bottom: -10px;
                left: 25%;
                width: 50%;
                height: 3px;
                background: linear-gradient(90deg, transparent, var(--coffee-uganda-gold), transparent);
            }
            .coffee-subheader {
                color: var(--coffee-uganda-green);
                font-size: 1.2rem;
                text-align: center;
                margin: 1rem 0 2rem;
                font-weight: 500;
                line-height: 1.6;
            }
            .vendor-form {
                text-align: left;
                margin: 0 auto;
                max-width: 400px;
            }
            .vendor-form label {
                color: var(--coffee-uganda-dark);
                font-weight: 500;
                margin-bottom: 0.3rem;
                display: block;
            }
            .vendor-form input[type="text"],
            .vendor-form input[type="file"] {
                width: 100%;
                margin-bottom: 1.2rem;
                padding: 0.7rem 1rem;
                border-radius: 8px;
                border: 1px solid var(--coffee-uganda-light);
                background: #fff8e1;
                font-size: 1rem;
                color: var(--coffee-uganda-dark);
                box-sizing: border-box;
            }
            .vendor-form input[type="file"] {
                padding: 0.5rem 0.5rem;
                background: #fff;
            }
            .vendor-form button {
                background: linear-gradient(90deg, var(--coffee-uganda-gold), var(--coffee-uganda-medium));
                color: #fff;
                font-weight: bold;
                padding: 0.8rem 2rem;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                font-size: 1.1rem;
                margin-top: 0.5rem;
                box-shadow: 0 2px 8px rgba(212, 175, 55, 0.1);
                transition: background 0.3s, transform 0.2s;
            }
            .vendor-form button:hover {
                background: linear-gradient(90deg, var(--coffee-uganda-medium), var(--coffee-uganda-gold));
                transform: translateY(-2px);
            }
            .coffee-footer {
                margin-top: 2.5rem;
                color: var(--coffee-uganda-medium);
                font-size: 0.9rem;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
            }
            .uganda-flag {
                display: inline-flex;
                margin: 0 0.5rem;
            }
            .flag-color {
                width: 15px;
                height: 15px;
                margin: 0 2px;
            }
            .black { background-color: #000000; }
            .yellow { background-color: #FCDC04; }
            .red { background-color: #D90000; }
            @media (max-width: 768px) {
                .coffee-container {
                    padding: 2rem 0.5rem;
                }
                .coffee-header {
                    font-size: 2rem;
                }
                .coffee-subheader {
                    font-size: 1rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="coffee-wrapper">
            <div class="coffee-container">
                <h1 class="coffee-header">Golden Bean</h1>
                <p class="coffee-subheader">Vendor Application &mdash; Welcome to Uganda's Coffee Network</p>
                <form class="vendor-form" method="POST" action="/vendor-application" enctype="multipart/form-data">
                    @csrf
                    <label for="financial_score">Financial Score</label>
                    <input type="text" id="financial_score" name="financial_score" required>
                    <label for="reputation">Reputation</label>
                    <input type="text" id="reputation" name="reputation" required>
                    <label for="regulatory_proof">Proof of Regulatory Adherence (PDF)</label>
                    <input type="file" id="regulatory_proof" name="regulatory_proof" accept="application/pdf" required>
                    <button type="submit"><i class="fas fa-paper-plane"></i> Submit Application</button>
                </form>
                <div class="coffee-footer">
                    <p>
                        Proudly Ugandan 
                        <span class="uganda-flag">
                            <span class="flag-color black"></span>
                            <span class="flag-color yellow"></span>
                            <span class="flag-color red"></span>
                        </span>
                        | Tracking Excellence from Seed to Export
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
