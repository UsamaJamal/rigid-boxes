<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('uploads/favicon-rigid-boxes.webp') }}" type="image/webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ($product['meta_title'] ?? $product['title'] ?? 'Custom Packaging') }} - The Rigid Boxes</title>
    @if(!empty($product['meta_description']))
        <meta name="description" content="{{ $product['meta_description'] }}">
    @endif
    @if(!empty($product['meta_keywords']))
        <meta name="keywords" content="{{ $product['meta_keywords'] }}">
    @endif
    <meta name="robots" content="{{ $product['robots'] ?? 'index,follow' }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;900&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <style>
        /* Remove number input spinners globally */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        input[type=number] {
            -moz-appearance: textfield;
        }

        :root {
            --primary-color: #8D4445;
            --secondary-color: #F8EEEC;
            --background-color: #FAF8F8;
            --footer-color: #5F2D2F;
            --header-gradient: linear-gradient(278.74deg, #AB5A5B 0.2%, #8D4445 44.25%, #5B2829 88.3%);
            
            --color-text-primary: #2D2D2D;
            --color-text-secondary: #666666;
            --color-text-tertiary: #999999;
            --color-border: #E5E5E5;
            --color-card-bg: #FFFFFF;
            
            --container-width: 1280px;
            --margin-sides: 55px;
        }

        body, body * {
            text-shadow: none !important;
            -webkit-text-stroke: 0 !important;
            filter: none !important;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #FAF8F8;
            color: var(--color-text-primary);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Open Sans', sans-serif;
            color: var(--color-text-primary);
            font-weight: 700;
        }

        .container {
            width: 100%;
            max-width: var(--container-width);
            margin: 0 auto;
            padding: 0 var(--margin-sides);
            box-sizing: border-box;
        }

        /* Hero Section */
        .hero-section {
            padding: 20px 0 40px;
            background-color: #FAF8F8;
            margin-top: 20px; /* space for header */
        }
        
        .hero-container {
            display: flex;
            gap: 60px;
            align-items: flex-start;
        }
        
        .hero-images {
            flex: 0 0 456px;
            max-width: 456px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .hero-details {
            flex: 0 1 50%;
            max-width: 600px;
        }
        
        .main-image {
            width: 100%;
            height: auto;
            margin: 0; /* Left align */
            background-color: var(--secondary-color);
            border-radius: 12px;
            border: 1px solid var(--primary-color);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .main-image img {
            max-width: 100%;
            height: auto;
            object-fit: contain;
        }
        
        .thumbnails {
            display: flex;
            gap: 15px;
            justify-content: center; /* Center align */
        }
        
        .thumb {
            width: 90px;
            height: 90px;
            background-color: var(--secondary-color);
            border-radius: 8px;
            cursor: pointer;
            border: 1px solid var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .thumb::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 35px;
            height: 16px;
            background-color: #F2F4F5;
            border-bottom-left-radius: 4px;
        }
        
        .thumb:hover, .thumb.active {
            border-color: var(--primary-color);
        }
        
        .trust-badges-container {
            background: #F2F2F2;
            padding: 12px 20px;
            border-radius: 8px;
            display: flex;
            gap: 30px;
            margin-top: 20px;
            align-items: center;
            justify-content: center;
            min-height: 60px;
        }
        
        .trust-badge {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 13px;
            color: #333;
        }

        /* Product Form */
        .hero-form {
            flex: 1.2;
            padding: 0;
        }

        .hero-form h1 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #000;
        }
        
        .hero-form > p {
            color: var(--color-text-secondary);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .section-label {
            display: block;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 6px;
            font-size: 14px;
        }

        .form-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-bottom: 12px;
        }

        .form-grid-pref {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-bottom: 12px;
        }
        
        /* Mobile view handled in main media query below */
        
        .form-grid-4 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 80px;
            gap: 8px;
            margin-bottom: 12px;
        }

        .form-grid-2-upload {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 12px;
        }
        
        .file-upload-wrap {
            display: flex;
        }
        
        .file-upload-wrap input[type="text"] {
            border-radius: 6px 0 0 6px;
            border-right: none;
            background: #fff;
            flex: 1;
        }
        
        .file-upload-wrap .upload-btn {
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            padding: 0 20px;
            border-radius: 0 6px 6px 0;
            cursor: pointer;
            font-weight: 600;
        }

        .input-wrap input, .input-wrap select, .form-control, textarea.form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--color-border);
            border-radius: 6px;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            transition: border-color 0.3s;
            background: #fff;
        }

        /* Custom Select Arrow Styling */
        .input-wrap select, select.form-control {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='black' stroke='black' stroke-width='1' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 14px;
            padding-right: 40px;
        }

        /* Hide number input spin buttons */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
        
        .input-wrap input:focus, .input-wrap select:focus, .form-control:focus, textarea.form-control:focus {
            border-color: var(--primary-color);
            outline: none;
        }
        
        /* Custom JS Select Styling */
        .custom-select-wrapper {
            position: relative;
            width: 100%;
        }
        
        .custom-select-trigger {
            width: 100%;
            padding: 12px 40px 12px 15px;
            border: 1px solid var(--color-border);
            border-radius: 6px;
            font-family: inherit;
            font-size: 13px;
            background: #fff;
            cursor: pointer;
            position: relative;
            user-select: none;
            text-align: left;
            color: var(--color-text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .custom-select-trigger::after {
            content: '';
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 14px;
            height: 14px;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            pointer-events: none;
        }

        .custom-select-trigger.open {
            border-color: var(--primary-color);
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .custom-options {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            border: 1px solid var(--primary-color);
            border-top: none;
            border-radius: 0 0 6px 6px;
            z-index: 99;
            display: none;
            max-height: 200px;
            overflow-y: auto;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .custom-options.open {
            display: block;
        }

        .custom-option {
            padding: 10px 15px;
            font-size: 13px;
            cursor: pointer;
            transition: background-color 0.2s, color 0.2s;
        }

        .custom-option:hover, .custom-option.selected {
            background-color: var(--primary-color);
            color: #fff;
        }

        .btn-primary {
            display: block;
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
            background-color: var(--primary-color);
            color: #fff;
            text-align: center;
            padding: 16px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }
        
        .btn-primary:hover {
            background-color: var(--footer-color);
        }

        /* Features Badges Section */
        .features-badges-section {
            background-color: #EFEFEF;
            padding: 20px 0 10px 0;
            margin-top: -12px;
            max-width: calc(var(--container-width) - (var(--margin-sides) * 2));
            width: calc(100% - (var(--margin-sides) * 2));
            margin-left: auto;
            margin-right: auto;
            border-radius: 12px;
            position: relative;
            z-index: 10;
        }

        .features-badges-section .container {
            padding: 0 40px;
        }

        .badges-horizontal {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .feature-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 8px;
        }

        .feature-icon {
            width: 139px;
            height: 104px;
            object-fit: contain;
        }

        .feature-text {
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #000;
        }

        .badges-horizontal {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .trust-badges-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .trust-badges-image {
            width: 220px;
            height: 36px;
            display: inline-block;
            object-fit: contain;
        }

        .features-badges-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .features-badges-image {
            width: 220px;
            height: 36px;
            display: inline-block;
            object-fit: contain;
        }

        .shipping-badge-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .shipping-badge-image {
            width: 220px;
            height: 36px;
            display: inline-block;
            object-fit: contain;
        }

        .fourth-badge-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .fourth-badge-image {
            width: 220px;
            height: 36px;
            display: inline-block;
            object-fit: contain;
        }

        .badge-label {
            display: inline-block;
            color: #4a4a4a;
            font: 500 14px/1.35 'DM Sans', sans-serif;
            text-align: left;
            white-space: nowrap;
        }

        .badge-icon-svg {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            color: #666;
        }

        /* Tabs Section */
        .tabs-section {
            background: transparent;
            padding: 20px 0;
            border-bottom: none;
            border-top: none;
            margin-bottom: 0px;
        }
        
        .tabs-list {
            display: flex;
            gap: 0;
            list-style: none;
            justify-content: center;
            background: #FFFFFF;
            border: 2px solid #8d4445;
            border-radius: 50px;
            padding: 8px;
            max-width: fit-content;
            margin: 0 auto;
        }
        
        .tab-item {
            padding: 12px 32px;
            border-radius: 50px;
            font-family: 'Open Sans', sans-serif;
            font-weight: 600;
            font-size: 18px;
            line-height: 24px;
            letter-spacing: 0.01em;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }
        
        .tab-item.active {
            background: #8d4445;
            color: #fff;
        }
        
        .tab-item:not(.active) {
            color: #000000;
            background: transparent;
        }
        
        .tab-item:not(.active):hover {
            color: var(--primary-color);
        }

        /* Content Section */
        .content-section {
            padding-bottom: 60px;
        }
        
        .content-section h2 {
            font-family: 'Open Sans', sans-serif;
            font-size: 24px;
            font-weight: 700;
            line-height: 40px;
            letter-spacing: 0.02em;
            text-align: justify;
            margin-bottom: 10px;
        }
        
        .content-section p {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 16px;
            color: var(--color-text-secondary);
            margin-bottom: 15px;
            line-height: 40px;
            text-align: justify;
        }
        
        .content-section ul,
        .content-section ol {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 16px;
            margin: 0 0 15px;
            padding-left: 2rem;
            color: var(--color-text-secondary);
            line-height: 40px;
            text-align: justify;
        }

        .content-section ul {
            list-style-type: disc;
        }

        .content-section ol {
            list-style-type: decimal;
        }

        .content-section li {
            padding-left: 4px;
        }

        .content-section li::marker {
            color: var(--color-text);
            font-weight: 600;
        }

        /* Specs Section */
        .specs-section {
            max-width: calc(var(--container-width) - (var(--margin-sides) * 2));
            width: calc(100% - (var(--margin-sides) * 2));
            margin: 32px auto;
            border-radius: 12px;
            overflow: hidden;
            border: 0.5px solid #8d4445;
        }

        .specs-table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
        }
        
        .specs-table tr:nth-child(odd) {
            background-color: #F8EEEC;
        }
        
        .specs-table tr:nth-child(even) {
            background-color: #FFFFFF;
        }
        
        .specs-table td {
            padding: 15px 30px;
            color: var(--color-text-secondary);
        }
        
        .specs-table td:first-child {
            font-weight: 700;

            color: #000;

        }

        /* FAQs Section */
        .faqs-section {
            max-width: calc(var(--container-width) - (var(--margin-sides) * 2));
            width: calc(100% - (var(--margin-sides) * 2));
            margin: 32px auto;
        }
        
        .faq-item {
            background: #FFFDFD;
            border: 1px solid #D6D6D6;
            border-radius: 4px;
            margin-bottom: 12px;
        }
        
        .faq-question {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            font-size: 18px;
            font-weight: 500;
            /* background: #8d4445; */
            /* color: #fff; */
        }
        
        .faq-answer {
            padding: 20px 20px 20px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: --color-text-primary;
            display: none;
            line-height: 1.6;
        }
        
        .faq-icon {
            font-size: 20px;
            font-weight: 400;
        }

        /* Order Process Section */
        .order-process-section {
            max-width: calc(var(--container-width) - (var(--margin-sides) * 2));
            width: calc(100% - (var(--margin-sides) * 2));
            margin: 32px auto 60px;
        }
        
        .process-cards {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .process-card {
            flex: 1;
            min-width: 250px;
            max-width: 325px;
            height: auto;
            min-height: 220px;
            background-color: #F8EEEC;
            border-radius: 8px;
            padding: 25px 18px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-sizing: border-box;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .process-card:hover {
            background-color: #8C3A3A;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(140, 58, 58, 0.3);
        }
        
        .process-card:hover .process-icon {
            color: #FFFFFF;
        }
        
        .process-card:hover h4 {
            color: #FFFFFF;
        }
        
        .process-card:hover p {
            color: rgba(255, 255, 255, 0.9);
        }
        
        .process-icon {
            font-size: 35px;
            color: #8C3A3A;
            margin-bottom: 15px;
            transition: color 0.3s ease;
        }
        
        .process-card h4 {
            font-family: 'Open Sans', sans-serif;
            font-size: 14px;
            font-weight: 700;
            line-height: 20px;
            color: #000000;
            text-align: center;
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }
        
        .process-card p {
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            font-size: 13px;
            line-height: 18px;
            color: #000000;
            text-align: center;
            transition: color 0.3s ease;
        }

        /* Custom Finishes Section */
        .finishes-section {
            max-width: calc(var(--container-width) - (var(--margin-sides) * 2));
            width: calc(100% - (var(--margin-sides) * 2));
            margin: -30px auto 30px auto;
        }
        
        .mobile-heading-break { display: none; }

        .finishes-header {
            margin-top: 60px;
            text-align: center;
            font-family: 'DM Sans', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: #000;
            margin-bottom: 30px;
        }
        
        .finishes-grid {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }
        
        .finishes-image-container {
            flex: 1.34;
            height: 420px;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
        }
        
        .finishes-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            opacity: 1 !important;
            filter: none !important;
        }
        
        .carousel-dots {
            position: absolute;
            bottom: 20px;
            left: 30px;
            display: flex;
            gap: 8px;
        }
        
        .carousel-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid #fff; /* Increased border to match the larger size visually */
            background: transparent;
            cursor: pointer;
        }
        
        .carousel-dot.active {
            background: #fff;
        }
        
        .finishes-details-box {
            flex: 1;
            height: 420px;
            background-color: #F8EEEC;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 50px 20px 30px;
            box-sizing: border-box;
        }
        
        .finishes-top-text {
            font-family: 'Open Sans', sans-serif;
            font-size: 19.23px;
            font-weight: 600;
            line-height: 28.84px;
            letter-spacing: 0px;
            text-align: center;
            color: #000000;
        }
        
        .finishes-middle-list {
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .finish-item-light {
            font-family: 'DM Sans', sans-serif;
            font-size: 18px;
            color: rgba(0,0,0,0.3);
            font-weight: 500;
        }
        
        .finish-item-dark {
            font-family: 'DM Sans', sans-serif;
            font-size: 32px;
            color: #000;
            font-weight: 700;
        }
        
        .finishes-bottom-nav {
            display: flex;
            gap: 15px;
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            font-weight: 600;
            line-height: 18.46px;
            letter-spacing: 0px;
            text-align: center;
            color: #000000;
        }
        
        .finishes-bottom-nav span {
            cursor: pointer;
            transition: color 0.3s ease;
        }
        
        .finishes-bottom-nav span:not([style*="font-weight: 700"]) {
            color: #000000;
        }

        /* Quote Request Section */
        .quote-section {
            max-width: calc(var(--container-width) - (var(--margin-sides) * 2));
            width: calc(100% - (var(--margin-sides) * 2));
            margin: 0 auto 60px;
            padding: 40px 0;
            background-color: var(--primary-color);
            position: relative;
            overflow: hidden;
            border-radius: 16px;
        }

        .quote-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background-image: radial-gradient(rgba(255,255,255,0.2) 2px, transparent 2px);
            background-size: 15px 15px;
            opacity: 0.5;
        }

        .quote-grid {
            display: flex;
            gap: 60px;
            width: 100%;
            padding: 0 40px;
            margin: 0 auto;
            align-items: center;
        }

        .quote-form {
            flex: 1.5;
            background: #fff;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
        }
        
        .quote-form-header {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .quote-icon-box {
            width: 50px;
            height: 50px;
            background-color: #F8EEEC;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 24px;
            flex-shrink: 0;
        }
        
        .quote-form h2 {
            font-family: 'Open Sans', sans-serif;
            font-size: 24px;
            margin-bottom: 5px;
            color: #000;
        }
        
        .quote-form p {
            color: var(--color-text-secondary);
            font-size: 13px;
            margin-bottom: 0;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-row .form-group {
            flex: 1;
            min-width: 0;
        }
        
        .quote-form label {
            font-size: 12px;
            font-weight: 700;
            color: #000;
            display: block;
            margin-bottom: 8px;
        }
        
        .quote-form .form-control {
            background-color: #FAFAFA;
            border: 0.5px solid #8d4445;
            font-size: 13px;
        }
        /* Apply the same border interaction to the product (hero) form. */
        .hero-form .form-control {
            border: 0.5px solid #8d4445;
        }

        .hero-form .form-control:focus {
            border: 1px solid #8d4445 !important;
        }

        .hero-form .custom-select-trigger {
            border: 0.5px solid #8d4445;
        }

        .hero-form .custom-select-trigger.open {
            border: 1px solid #8d4445 !important;
        }

        .quote-form .form-control:focus {
            border: 1px solid #8d4445 !important;
        }

        /* The Box Style select is rendered as this custom trigger by JavaScript. */
        .quote-form .custom-select-trigger {
            background-color: #FAFAFA;
            border: 0.5px solid #8d4445;
            font-size: 13px;
        }

        .quote-form .custom-select-trigger.open {
            border: 1px solid #8d4445 !important;
        }
        .hero-form .form-control.is-active,
        .quote-form .form-control.is-active,
        .hero-form .custom-select-trigger.is-active,
        .quote-form .custom-select-trigger.is-active,
        .hero-form .form-control:focus,
        .quote-form .form-control:focus,
        .hero-form .custom-select-trigger.open,
        .quote-form .custom-select-trigger.open {
            border: 1px solid #8d4445 !important;
            box-shadow: 0 0 0 3px rgba(141, 68, 69, 0.1);
            outline: none;
        }
        
        .btn-submit-quote {
            background-color: var(--primary-color);
            color: #fff;
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            width: 250px;
            margin: 10px auto 0;
            display: inline-block;
        }
        
        .quote-info {
            flex: 1;
            color: #fff;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 2;
        }
        
        .quote-info h3 {
            font-family: 'Open Sans', sans-serif;
            font-size: 32px;
            color: #fff;
            margin-bottom: 15px;
            line-height: 1.3;
        }
        
        .quote-title-line {
            width: 60px;
            height: 3px;
            background-color: #fff;
            margin-bottom: 40px;
        }
        
        .quote-info img {
            width: 100%;
            max-width: 350px;
            display: block;
            margin: 0 auto 40px;
        }
        
        .features-list {
            display: flex;
            justify-content: center;
            gap: 30px;
        }
        
        .feature-item {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        
        .feature-icon {
            width: auto;
            height: auto;
            background-color: transparent;
            color: var(--primary-color);
            border-radius: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .feature-icon img {
            width: 139px;
            height: 110px;
            object-fit: contain;
            display: block;
        }
        
        .feature-item span {
            font-size: 12px;
            font-weight: 600;
            max-width: 100px;
            line-height: 1.4;
        }

        /* Related Products Section */
        .related-products {
            margin-top: -54px;
            padding: 10px 0 20px;
            background-color: #fff;
        }
        
        .related-products .container {
            max-width: var(--container-width);
            margin: 0 auto;
            padding: 0 var(--margin-sides);
        }
        
        .related-products h2 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 40px;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            max-width: 100%;
        }
        
        .product-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s;
            width: 100%;
            max-width: 100%;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
        }
        
        .product-image {
            width: 100%;
            height: auto;
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            border-radius: 12px;
            overflow: hidden;
        }
        
        .product-card h4 {
            font-size: 18px;
            font-weight: 700;
            color: #000;
            margin-bottom: 10px;
            font-family: 'Open Sans', sans-serif;
        }

        /* Responsive Margins */
        @media (min-width: 1600px) {
            :root { --margin-sides: 55px; }
            .hero-container {
                gap: 50px;
            }
            .hero-images {
                max-width: 600px;
            }
        }
        @media (max-width: 1440px) {
            :root { --margin-sides: 55px; }
        }
        @media (max-width: 1200px) and (min-width: 1025px) {
            :root { --margin-sides: 55px; }
            .hero-container {
                gap: 30px;
            }
            .hero-images {
                max-width: 450px;
            }
        }
        @media (max-width: 1024px) {
            :root { --margin-sides: 55px; }
            .hero-container {
                gap: 25px;
            }
            .hero-images {
                max-width: 400px;
            }
        }
        @media (max-width: 768px) {
            :root { --margin-sides: 20px; }
            .hero-container {
                gap: 20px;
            }
        }
        @media (max-width: 480px) {
            :root { --margin-sides: 16px; }
        }

        @media (max-width: 991px) {
            .hero-container, .finishes-grid, .quote-grid {
                flex-direction: column;
            }
            .hero-images,
            .hero-form,
            .hero-details {
                width: 100%;
                max-width: 100%;
                flex: none;
            }
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 767px) {
            .content-section, .specs-section, .faqs-section {
                width: calc(100% - (var(--margin-sides) * 2)); margin-left: auto; margin-right: auto;
                margin-bottom: 10px !important;
            }
            .content-section h2 {
                text-align: left;
            }
            .content-section .considerations-heading {
                font-size: 21px;
                line-height: 32px;
                letter-spacing: 0;
            }
            .finishes-section {
                margin-top: 0;
            }
            .mobile-heading-break { display: none; }

        .finishes-header {
                margin: 24px 0 18px;
                font-size: 20px;
                line-height: 24px;
                max-width: 260px;
                margin-left: auto;
                margin-right: auto;
            }
            .finishes-grid {
                display: flex;
                flex-direction: column;
                gap: 16px;
            }
            .finishes-image-container {
                order: 1;
                flex: none;
                width: 100%;
                aspect-ratio: 1.34;
                height: auto;
                border-radius: 16px;
                position: relative;
                overflow: hidden;
            }
            .finishes-details-box {
                order: 2;
                flex: none;
                width: 100%;
                height: auto;
                padding: 24px 18px;
                background: #FAF4F2;
                border-radius: 16px;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 16px;
                box-sizing: border-box;
            }
            .finishes-top-text {
                display: block !important;
                font-family: 'DM Sans', sans-serif;
                font-size: 18px;
                font-weight: 700;
                color: #000000;
            }
            .finishes-middle-list {
                display: flex !important;
                flex-direction: row !important;
                justify-content: center;
                align-items: center;
                gap: 16px;
                width: 100%;
                overflow-x: auto;
                padding: 4px 0;
                scrollbar-width: none;
            }
            .finish-item-light {
                font-size: 14px;
                color: #999999;
                font-weight: 500;
                white-space: nowrap;
            }
            .finish-item-dark {
                font-size: 16px;
                color: #000000;
                font-weight: 700;
                border-bottom: 2px solid #8C3A3A;
                padding-bottom: 4px;
                white-space: nowrap;
            }
            .finishes-bottom-nav {
                display: flex !important;
                flex-direction: column !important;
                gap: 8px;
                width: 100%;
                margin: 0;
                padding: 0;
                border: none;
            }
            .finishes-bottom-nav span {
                display: block;
                width: 100%;
                text-align: center;
                padding: 12px 14px;
                border: 1px solid #E5D5D5;
                border-radius: 6px;
                background-color: #FAF4F2;
                font-weight: 600;
                font-size: 12px;
                color: #333333;
                text-transform: uppercase;
                box-sizing: border-box;
                flex: none;
            }
            .finishes-bottom-nav span.active-nav,
            .finishes-bottom-nav span[style*="font-weight: 700"] {
                background-color: #8C3A3A !important;
                color: #FFFFFF !important;
                border-color: #8C3A3A !important;
                font-weight: 700 !important;
            }
            .carousel-dots {
                bottom: 10px;
                left: 25px;
                gap: 3px;
            }
            .carousel-dot {
                width: 7px;
                height: 7px;
                border-width: 1px;
            }
            .main-image {
                height: auto;
                aspect-ratio: 1;
            }
            .thumbnails {
                flex-wrap: wrap;
                gap: 10px;
            }
            .thumb {
                width: 65px;
                height: 65px;
            }
            .form-row, .form-grid-3, .form-grid-2-upload {
                display: grid;
                grid-template-columns: 1fr;
                gap: 15px;
            }
            .hero-form > p {
                font-size: 13px;
                line-height: 1.55;
            }

            #readMoreBtnLipstick {
                font-size: 12px !important;
                margin-left: 3px !important;
                white-space: nowrap;
            }
            .form-grid-4, .form-grid-pref {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 15px;
            }
            .form-control option:checked {
                background: var(--primary-color) linear-gradient(0deg, var(--primary-color) 0%, var(--primary-color) 100%);
                color: #fff;
            }
            .form-row-2col {
                grid-template-columns: 1fr 1fr;
            }
            .badges-horizontal {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 28px 16px;
                align-items: center;
            }
            .badges-horizontal > div {
                min-width: 0;
            }
            .badges-horizontal > div {
                display: flex;
                align-items: center;
                gap: 6px;
                text-align: left;
            }
            .badges-horizontal .badge-icon {
                display: block;
                width: 30px;
                height: 30px;
                flex: 0 0 30px;
                object-fit: cover;
                object-position: left center;
            }
            .badges-horizontal .badge-label {
                display: block;
                font-family: 'DM Sans', sans-serif;
                font-size: 12px;
                font-weight: 500;
                line-height: 14px;
                color: #4D4D4D;
                white-space: nowrap;
            }
            
            .feature-item {
                display: flex;
                flex-direction: row !important;
                align-items: center;
                text-align: left;
                gap: 12px;
                width: 100%;
                max-width: 300px;
            }
            
            .feature-icon {
                width: 40px !important;
                height: 40px !important;
                flex-shrink: 0;
            }
            
            .feature-text {
                font-size: 16px;
                flex: 1;
            }
            
            .features-badges-section .container {
                padding: 0 10px;
            }
            .tabs-section {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: none;
                scrollbar-width: none;
                padding: 20px 0 20px 20px;
            }
            .tabs-section {
                scroll-snap-type: x mandatory;
            }
            .tabs-list .tab-item {
                scroll-snap-align: center;
            }
            /* Final mobile tab styling */
            .tabs-section .container {
                border: 1px solid #8A8A8A;
                border-radius: 28px;
                background: #FFFFFF;
            }
            .tabs-list .tab-item.active {
                background: #8D4445;
                color: #FFFFFF;
            }
            /* Keep the tab border fixed while only its options scroll. */
            .tabs-section {
                overflow: hidden;
                padding: 20px 0;
            }
            .tabs-section .container {
                width: calc(100% - (var(--margin-sides) * 2));
                margin: 0 auto;
                padding: 0;
                overflow-x: auto;
                border: 2px solid #8d4445;
                border-radius: 50px;
                scrollbar-width: none;
            }
            .tabs-section .container::-webkit-scrollbar {
                display: none;
            }
            .tabs-list {
                border: 0;
                border-radius: 0;
                background: transparent;
            }
            .tabs-section::-webkit-scrollbar {
                display: none;
            }
            .tabs-section .container {
                padding: 0;
            }
            .tabs-list {
                display: inline-flex;
                flex-wrap: nowrap;
                justify-content: flex-start;
                padding: 4px;
                width: max-content;
                margin: 0;
                gap: 8px;
            }
            .tabs-list::-webkit-scrollbar {
                display: none;
            }
            .tab-item {
                flex: 0 0 auto;
                padding: 10px 22px;
                font-size: 15px;
                white-space: nowrap;
            }

            .finishes-middle-list {
                flex-direction: row;
                overflow-x: hidden;
                justify-content: center;
                align-items: center;
                gap: 20px;
                width: 100%;
                margin: 20px 0;
            }
            .finish-item-light {
                display: block;
                color: #A0A0A0;
                font-size: 13px;
                white-space: nowrap;
            }
            .finish-item-dark {
                color: #000;
                font-weight: 700;
                font-size: 15px;
                border-bottom: 3px solid #8c4446;
                padding-bottom: 5px;
                white-space: nowrap;
            }
            .finishes-image-container, .finishes-details-box {
                height: auto;
            }
            .finishes-bottom-nav {
                flex-direction: column;
                gap: 10px;
                border-top: none;
                padding-top: 0;
                margin-top: 10px;
            }
            .finishes-bottom-nav span {
                display: block;
                width: 100%;
                text-align: center;
                padding: 12px;
                border: 1px solid #e0d0d0;
                border-radius: 6px;
                background-color: transparent;
                font-weight: 600;
                font-size: 12px;
                color: #333;
                text-transform: uppercase;
                box-sizing: border-box;
            }
            .finishes-bottom-nav span.active-nav {
                background-color: #f8eeee;
                color: #8D4445;
                border-color: #8c4446;
            }
            /* Keep the full tab frame inside the shared page container. */
            .tabs-section .container {
                width: calc(100% - (var(--margin-sides) * 2)) !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
            .mobile-heading-break { display: block; }

            /* Mobile finishes layout override */
            .finishes-details-box {
                order: 2;
                width: 100%;
                padding: 24px 18px;
                background: #FAF4F2;
                border-radius: 16px;
            }
            .finishes-top-text {
                display: block !important;
            }
            .finishes-middle-list {
                display: flex !important;
                flex-direction: row !important;
            }
            .finishes-bottom-nav {
                display: flex !important;
                flex-direction: column !important;
                gap: 8px;
            }
            .finishes-bottom-nav span {
                flex: none;
                width: 100%;
                display: block;
            }
            .finishes-image-container {
                order: 1;
                width: 100%;
                border-radius: 16px;
            }
            .carousel-dots {
                bottom: 12px;
                left: 20px;
                gap: 5px;
            }
            .carousel-dot {
                width: 7px;
                height: 7px;
                border-width: 1px;
            }
            .quote-form-header p {
                display: none;
            }

            .quote-icon-box {
                display: none;
            }

            .mobile-quote-btn {
                display: none !important;
            }
            .products-grid {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: none;
                scrollbar-width: none;
                gap: 15px;
                padding-bottom: 5px;
            }
            .products-grid::-webkit-scrollbar {
                display: none;
            }
            .product-card {
                flex: 0 0 calc(50% - 7.5px);
                width: auto;
                max-width: none;
            }
            .product-image {
                width: 100%;
                height: auto;
                aspect-ratio: 1;
                margin-bottom: 10px;
            }
            .product-image img {
                width: 100%;
                height: 100%;
                object-fit: contain !important;
            }
            .quote-info {
                display: none;
            }
            .quote-grid {
                padding: 0 15px;
                gap: 30px;
            }
            .quote-form {
                padding: 25px 20px;
            }
        }




        /* Keep the quote form balanced at 125% browser zoom. */
        @media (min-width: 768px) and (max-width: 1366px) {
            .quote-form-header {
                gap: 10px;
            }
            .quote-form h2 {
                font-size: 20px;
                white-space: nowrap;
            }
            .quote-form .form-row {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 15px;
            }
            .quote-form .form-row.form-row-2col {
                grid-template-columns: minmax(0, 1.5fr) minmax(0, 1fr);
            }
            .quote-form .form-row .form-group {
                min-width: 0;
            }
            .quote-form label {
                white-space: nowrap;
            }
            .quote-form .form-control {
                min-width: 0;
                padding-left: 10px;
                padding-right: 10px;
            }
        }

    </style>
</head>
<body>
    @include('components.header')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-container">
            @php
                $pMainImg = !empty($product['image']) ? (\Illuminate\Support\Str::startsWith($product['image'], ['storage/', 'uploads/', 'images/']) ? $product['image'] : 'storage/' . $product['image']) : 'uploads/Gift-Boxes.webp';
                $pTitle = $product['title'] ?? 'Custom Packaging Box';
                $pGallery = [];
                if (!empty($product['images'])) {
                    $pGallery = is_string($product['images']) ? (json_decode($product['images'], true) ?: []) : (array) $product['images'];
                }
                $pGallery = array_values(array_unique(array_merge([$pMainImg], $pGallery)));
            @endphp
            <div class="hero-images">
                <div class="main-image">
                    <img id="product-main-image" src="{{ asset($pMainImg) }}" alt="{{ $pTitle }}" style="width: 100%; height: auto; display: block;" onerror="this.src='https://placehold.co/600x500/eeeeee/555555?text={{ urlencode($pTitle) }}'">
                </div>
                <div class="thumbnails">
                    @foreach($pGallery as $galleryIndex => $galleryImage)
                        @php $galleryImage = \Illuminate\Support\Str::startsWith($galleryImage, ['storage/', 'uploads/', 'images/']) ? $galleryImage : 'storage/' . $galleryImage; @endphp
                        <div class="thumb {{ $galleryIndex === 0 ? 'active' : '' }}" onclick="switchProductImage(this, '{{ asset($galleryImage) }}')">
                            <img src="{{ asset($galleryImage) }}" alt="{{ $pTitle }} thumbnail {{ $galleryIndex + 1 }}" style="width: 100%; height: 100%; object-fit: contain; border-radius: 6px;">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="hero-form">
                <h1>{{ $pTitle }}</h1>
                <p>{{ strip_tags($product['description'] ?? 'Custom printed boxes crafted to protect your products while showcasing your brand with premium-quality printing and luxury finishes.') }}</p>
                
                <form action="{{ url('/submit-quote') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-section">
                        <span class="section-label">Contact Information</span>
                        <div class="form-grid-3">
                            <input type="text" name="name" class="form-control" placeholder="Enter your name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" required>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                            <input type="tel" name="phone" class="form-control" placeholder="Enter your number" oninput="this.value = this.value.replace(/[^0-9+\-\(\)\s]/g, '')" required>
                        </div>
                    </div>

                    <div class="form-section">
                        <span class="section-label">Box Specifications</span>
                        <div class="form-grid-4">
                            <input type="number" name="width" class="form-control" placeholder="Width" required>
                            <input type="number" name="length" class="form-control" placeholder="Length" required>
                            <input type="number" name="depth" class="form-control" placeholder="Depth" required>
                            <select name="units" class="form-control" required>
                                <option>mm</option>
                                <option>cm</option>
                                <option>inch</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-section">
                        <span class="section-label">Packaging Preferences</span>
                        <div class="form-grid-pref">
                            @php
                                $boxStyleParent = \Illuminate\Support\Facades\DB::table('admin_categories')->where('slug', 'box-by-style')->first();
                                $boxStyles = $boxStyleParent ? \Illuminate\Support\Facades\DB::table('admin_categories')->where('parent_id', $boxStyleParent->id)->get() : [];
                            @endphp
                            <select name="box_style" class="form-control" id="pref-box-style">
                                <option value="" disabled selected>Box Style</option>
                                @foreach($boxStyles as $style)
                                    <option value="{{ $style->title }}">{{ $style->title }}</option>
                                @endforeach
                            </select>
                            <select name="material" class="form-control" id="pref-paper-stock">
                                <option value="" disabled selected>Select Paper Stock</option>
                                <option>12pt Cardboard Stock</option>
                                <option>14pt Cardboard Stock</option>
                                <option>16pt Cardboard Stock</option>
                                <option>18pt Cardboard Stock</option>
                                <option>20pt Cardboard Stock</option>
                                <option>22pt Cardboard Stock</option>
                                <option>24pt Cardboard Stock</option>
                                <option>Kraft Stock</option>
                                <option>Recycled BuxBoard</option>
                                <option>Corrugated Stock</option>
                                <option>No Printing Required</option>
                            </select>
                            <select name="color" class="form-control">
                                <option value="" disabled selected>Select Color</option>
                                <option>1 color</option>
                                <option>2 color</option>
                                <option>3 color</option>
                                <option>4 color</option>
                                <option>4/1 color</option>
                                <option>4/2 color</option>
                                <option>4/3 color</option>
                                <option>4/4 color</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <span class="section-label">Production Details</span>
                        <div class="form-grid-2-upload">
                            <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
                            <div class="file-upload-wrap" style="position: relative;">
                                <input type="file" name="quote_file" id="quote_file_input" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;" onchange="document.getElementById('quote_file_text').value = this.files.length > 0 ? this.files[0].name : ''">
                                <input type="text" id="quote_file_text" class="form-control" placeholder="No File Choosen" readonly style="pointer-events: none;">
                                <button type="button" class="upload-btn" style="pointer-events: none;">Upload</button>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <span class="section-label">Additional Details</span>
                        <textarea name="message" class="form-control" rows="3" placeholder="Enter your message"></textarea>
                    </div>

                    <button type="submit" class="btn-primary">Get a Quote</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Features Badges Section -->
    <section class="features-badges-section">
        <div class="container">
            <div class="badges-horizontal">
                <div class="trust-badges-wrapper">
                    <svg class="badge-icon-svg" viewBox="0 0 48 48" aria-label="No Die and Plate Charges" role="img"><circle cx="24" cy="24" r="18" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M14 32 34 14M16 16l16 16M21 13l14 14M13 25l10 10" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M20 36h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    <span class="badge-label">No Die &amp; Plate<br>Charges</span>
                </div>
                <div class="features-badges-wrapper">
                    <svg class="badge-icon-svg" viewBox="0 0 48 48" aria-label="Free Graphic Designing" role="img"><rect x="8" y="9" width="32" height="23" rx="2" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M14 38h20M24 32v6M14 15h20M17 20h7M17 25h12" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="34" cy="23" r="3" fill="none" stroke="currentColor" stroke-width="1.5"/></svg>
                    <span class="badge-label">Free Graphic<br>Designing</span>
                </div>
                <div class="shipping-badge-wrapper">
                    <svg class="badge-icon-svg" viewBox="0 0 48 48" aria-label="Quick Turnaround Time" role="img"><circle cx="24" cy="24" r="17" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M24 14v11l7 4M10 24h-3M41 24h-3M24 7v-3M24 44v-3" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                    <span class="badge-label">Quick Turnaround<br>Time</span>
                </div>
                <div class="fourth-badge-wrapper">
                    <svg class="badge-icon-svg" viewBox="0 0 48 48" aria-label="Free Shipping" role="img"><path d="M6 14h24v21H6zM30 22h7l6 7v6H30zM13 35a4 4 0 1 0 8 0M34 35a4 4 0 1 0 8 0M37 22v7h6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M12 20h10M12 25h7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                    <span class="badge-label">Free Shipping</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabs Section -->
    <div class="tabs-section">
        <div class="container">
            <ul class="tabs-list">
                <li class="tab-item active" onclick="switchTab('description')" id="tab-btn-description">Description</li>
                <li class="tab-item" onclick="switchTab('specs')" id="tab-btn-specs">Product Specifications</li>
                <li class="tab-item" onclick="switchTab('faqs')" id="tab-btn-faqs">FAQs</li>
                <li class="tab-item" onclick="switchTab('order')" id="tab-btn-order">Order Process</li>
            </ul>
        </div>
    </div>

    <!-- Content Section -->
    <section class="content-section container" id="content-description">
        <div>
            {!! !empty($product['long_description']) ? $product['long_description'] : '<p>' . ($product['description'] ?? '') . '</p>' !!}
        </div>
    </section>

    <!-- Specs Section -->
    <section class="specs-section" id="content-specs" style="display: none;">
        <table class="specs-table">
            <tr>
                <td>Box Style</td>
                <td>{{ $product['box_style'] ?? 'Custom Box Style' }}</td>
            </tr>
            <tr>
                <td>Dimensions</td>
                <td>{{ $product['dimensions'] ?? 'Custom Sizes Available' }}</td>
            </tr>
            <tr>
                <td>MOQ</td>
                <td>{{ $product['moq'] ?? '100 Units' }}</td>
            </tr>
            <tr>
                <td>Material Stock</td>
                <td>{{ $product['material'] ?? 'Premium Rigid Board / Cardstock' }}</td>
            </tr>
            <tr>
                <td>Printing</td>
                <td>{{ $product['printing'] ?? 'CMYK / PMS Color Printing' }}</td>
            </tr>
            <tr>
                <td>Finishing</td>
                <td>{{ $product['finishing'] ?? 'Soft-Touch Matte, Foil Stamping & Spot UV' }}</td>
            </tr>
            <tr>
                <td>Included Options</td>
                <td>Die Cutting, Window Patching, Custom Inserts</td>
            </tr>
            <tr>
                <td>Turnaround</td>
                <td>{{ $product['turnaround'] ?? '8 - 10 Business Days' }}</td>
            </tr>
        </table>
    </section>

    <!-- FAQs Section -->
    <section class="faqs-section" id="content-faqs" style="display: none;">
        @foreach($faqs ?? [] as $faq)
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>{{ $faq['question'] ?? '' }}</span>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer"><p>{{ $faq['answer'] ?? '' }}</p></div>
            </div>
        @endforeach
    </section>

    <!-- Order Process Section -->
    <section class="order-process-section" id="content-order" style="display: none;">
        <div class="process-cards">
            <div class="process-card">
                <div class="process-icon"><i class="fas fa-gift"></i></div>
                <h4>Customize Your Packaging</h4>
                <p>Choose from our extensive packaging solutions and personalize them with a variety of options to bring your ideal packaging to life.</p>
            </div>
            <div class="process-card">
                <div class="process-icon"><i class="fas fa-clipboard-list"></i></div>
                <h4>Request a Quote</h4>
                <p>After customizing your packaging, simply request a quote, and our packaging specialists will review your submission.</p>
            </div>
            <div class="process-card">
                <div class="process-icon"><i class="fas fa-headset"></i></div>
                <h4>Expert Consultation</h4>
                <p>Get expert consultation on your quote to reduce costs, improve efficiency, and minimize environmental impact.</p>
            </div>
            <div class="process-card">
                <div class="process-icon"><i class="fas fa-truck-fast"></i></div>
                <h4>Production & Delivery</h4>
                <p>After finalizing the details, we'll handle the entire production and shipping process. Just sit back and wait for your packaging to arrive!</p>
            </div>
        </div>
    </section>

    <!-- Finishes Section -->
    <section class="finishes-section">
        <h2 class="finishes-header">Custom Finishes <br class="mobile-heading-break">For Premium Feel</h2>
        <div class="finishes-grid">
            <div class="finishes-image-container">
                <img src="{{ asset('uploads/finish-material-grey-board.webp') }}" alt="grey board material">
                <div class="carousel-dots">
                    <div class="carousel-dot active"></div>
                    <div class="carousel-dot"></div>
                    <div class="carousel-dot"></div>
                    <div class="carousel-dot"></div>
                    <div class="carousel-dot"></div>
                </div>
            </div>
            <div class="finishes-details-box">
                <div class="finishes-top-text">Materials We Offer</div>
                <div class="finishes-middle-list">
                    <div class="finish-item-light">Duplex Chipboard</div>
                    <div class="finish-item-dark">Grey Board</div>
                    <div class="finish-item-light">Holographic</div>
                </div>
                <div class="finishes-bottom-nav">
                    <span class="active-nav">Materials</span>
                    <span>Printing Methods</span>
                    <span>Inks</span>
                    <span>Finishing</span>
                    <span>Add-ons</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Quote Section -->
    <section class="quote-section">
        <div class="quote-grid">
            <div class="quote-form">
                <div class="quote-form-header">
                    <div class="quote-icon-box"><img src="{{ asset('images/request-sample-kit.svg') }}" alt="sample kit" style="width: 50px; height: 50px;"></div>
                    <div>
                        <h2>Request A Sample Kit</h2>
                        <p>Fill out the form below and we'll send you a sample kit tailored to your needs.</p>
                    </div>
                </div>
                
                <form action="{{ url('/submit-quote') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(session('success'))
                        <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group">
                            <label>Name *</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address *</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label>Phone *</label>
                            <input type="tel" name="phone" class="form-control" placeholder="Phone number" oninput="this.value = this.value.replace(/[^0-9+\-\(\)\s]/g, '')" required>
                            
                            <!-- Hidden inputs for required fields from backend validation -->
                            <input type="hidden" name="width" value="N/A">
                            <input type="hidden" name="length" value="N/A">
                            <input type="hidden" name="depth" value="N/A">
                            <input type="hidden" name="units" value="N/A">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="company_name" class="form-control" placeholder="Company">
                        </div>
                        <div class="form-group">
                            <label>Website</label>
                            <input type="text" name="website" class="form-control" placeholder="Website">
                        </div>
                        <div class="form-group">
                            <label>Physical Address</label>
                            <input type="text" name="physical_address" class="form-control" placeholder="Address">
                        </div>
                    </div>
                    
                    <div class="form-row form-row-2col">
                        <div class="form-group" style="flex: 1.5;">
                            <label>Box Style *</label>
                            <select name="box_style" class="form-control" id="quote-box-style">
                                <option value="">Select style</option>
                                <option value="{{ $product['title'] ?? 'Custom Box' }}" selected>{{ $product['title'] ?? 'Custom Box' }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Quantity *</label>
                            <input type="number" name="quantity" class="form-control" placeholder="Enter quantity" required>
                        </div>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label>Message</label>
                        <textarea name="message" class="form-control" rows="4" placeholder="Enter your message"></textarea>
                    </div>
                    
                    <div style="text-align: center;">
                        <button type="submit" class="btn-submit-quote">Get Free Quote</button>
                    </div>
                </form>
            </div>
            
            <div class="quote-info">
                <h3>Premium Packaging<br>Starts Here</h3>
                <div class="quote-title-line"></div>
                
                <!-- Using the specific image requested by user -->
                <img src="{{ asset('images/Jul 3, 2026, 03_38_53 PM 1.png') }}" alt="premium box">
                
                <div class="features-list">
                    <div class="feature-item">
                        <div class="feature-icon"><img src="{{ asset('images/premium-quality-icon.png') }}" alt="premium quality"></div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><img src="{{ asset('images/custom-design.svg') }}" alt="custom designs"></div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><img src="{{ asset('images/fast-and-reliable.png') }}" alt="fast & reliable delivery"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <section class="related-products">
        <div class="container">
            <h2>Related Products</h2>
            <div class="products-grid">
                @php
                    $rProds = !empty($relatedProducts) ? $relatedProducts : [];
                @endphp
                @foreach($rProds as $rp)
                    @php
                        $rpImg = !empty($rp['image']) ? (\Illuminate\Support\Str::startsWith($rp['image'], ['storage/', 'uploads/', 'images/']) ? $rp['image'] : 'storage/' . $rp['image']) : 'uploads/Gift-Boxes.webp';
                        $rpSlug = $rp['slug'] ?? \Illuminate\Support\Str::slug($rp['title']);
                    @endphp
                    <div class="product-card">
                        <a href="{{ url('/product/' . $rpSlug) }}" style="text-decoration:none; color:inherit;">
                            <div class="product-image">
                                <img src="{{ asset($rpImg) }}" alt="{{ $rp['title'] }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://placehold.co/284x284/eeeeee/555555?text={{ urlencode($rp['title']) }}'">
                            </div>
                            <h4>{{ $rp['title'] }}</h4>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        function switchTab(tabId) {
            // Remove active class from all tabs
            document.querySelectorAll('.tab-item').forEach(el => el.classList.remove('active'));
            
            // Add active class to clicked tab
            if (document.getElementById('tab-btn-' + tabId)) {
                document.getElementById('tab-btn-' + tabId).classList.add('active');
                if (window.matchMedia('(max-width: 767px)').matches) {
                    const tabsScroller = document.querySelector('.tabs-section .container');
                    const selectedTab = document.getElementById('tab-btn-' + tabId);
                    if (tabsScroller && selectedTab) {
                        tabsScroller.scrollTo({
                            left: selectedTab.offsetLeft - (((window.innerWidth - tabsScroller.getBoundingClientRect().left) - selectedTab.offsetWidth) / 2),
                            behavior: 'smooth'
                        });
                    }
                }
            }
            
            // Hide all content sections
            if (document.getElementById('content-description')) document.getElementById('content-description').style.display = 'none';
            if (document.getElementById('content-specs')) document.getElementById('content-specs').style.display = 'none';
            if (document.getElementById('content-faqs')) document.getElementById('content-faqs').style.display = 'none';
            if (document.getElementById('content-order')) document.getElementById('content-order').style.display = 'none';
            
            // Show the target content
            if (document.getElementById('content-' + tabId)) {
                document.getElementById('content-' + tabId).style.display = 'block';
            }
        }
function toggleFaq(element) {
    const answer = element.nextElementSibling;
    const icon = element.querySelector('.faq-icon');

    // Close all other FAQs
    document.querySelectorAll('.faq-answer').forEach(item => {
        if (item !== answer) {
            item.style.display = 'none';

            const header = item.previousElementSibling;
            const headerIcon = header.querySelector('.faq-icon');

            header.style.backgroundColor = '';
            header.style.color = '';
            headerIcon.textContent = '+';
            headerIcon.style.color = '';
        }
    });

    // Toggle current FAQ
    if (answer.style.display === 'none' || answer.style.display === '') {
        answer.style.display = 'block';

        element.style.backgroundColor = '#8d4445';
        element.style.color = 'white';

        icon.textContent = 'âˆ’';
        icon.style.color = 'white';
    } else {
        answer.style.display = 'none';

        element.style.backgroundColor = '';
        element.style.color = '';

        icon.textContent = '+';
        icon.style.color = '';
    }
}

        // READ MORE / READ LESS toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const readMoreBtn = document.getElementById('readMoreBtn');
            const moreDescription = document.getElementById('moreDescription');
            if (readMoreBtn && moreDescription) {
                readMoreBtn.addEventListener('click', function() {
                    const isOpen = this.getAttribute('aria-expanded') === 'true';
                    moreDescription.style.display = isOpen ? 'none' : 'block';
                    this.setAttribute('aria-expanded', String(!isOpen));
                    this.textContent = isOpen ? 'READ MORE' : 'READ LESS';
                });
            }
            
            // Lipstick Boxes READ MORE toggle
            const readMoreBtnLipstick = document.getElementById('readMoreBtnLipstick');
            const dotsLipstick = document.getElementById('dotsLipstick');
            const moreLipstick = document.getElementById('moreLipstick');
            
            if (readMoreBtnLipstick && dotsLipstick && moreLipstick) {
                readMoreBtnLipstick.addEventListener('click', function() {
                    if (dotsLipstick.style.display === 'none') {
                        dotsLipstick.style.display = 'inline';
                        moreLipstick.style.display = 'none';
                        this.setAttribute('aria-expanded', 'false');
                        this.textContent = 'READ MORE';
                    } else {
                        dotsLipstick.style.display = 'none';
                        moreLipstick.style.display = 'inline';
                        this.setAttribute('aria-expanded', 'true');
                        this.textContent = 'READ LESS';
                    }
                });
            }
        });
    </script>

    <!-- Finishes Tab and Carousel Script -->
    <script>
        // Finishes data for each tab with multiple products and their images
        const finishesData = {
            'Materials': {
                title: 'Materials We Offer',
                items: [
                    { name: 'Black Kraft', active: false, image: '{{ asset("uploads/finish-material-black-kraft.webp") }}' },
                    { name: 'Duplex Chipboard', active: false, image: '{{ asset("uploads/finish-material-duplex-chipboard.webp") }}' },
                    { name: 'Grey Board', active: true, image: '{{ asset("uploads/finish-material-grey-board.webp") }}' },
                    { name: 'Holographic', active: false, image: '{{ asset("uploads/finish-material-holographic.webp") }}' },
                    { name: 'Metallic Paper', active: false, image: '{{ asset("uploads/finish-material-metallic-paper.webp") }}' },
                    { name: 'Natural Brown Kraft', active: false, image: '{{ asset("uploads/finish-material-natural-brown.webp") }}' },
                    { name: 'SBS C2S', active: false, image: '{{ asset("uploads/finish-material-sbs-c2s.webp") }}' },
                    { name: 'Textured Paper', active: false, image: '{{ asset("uploads/finish-material-textured.webp") }}' }
                ]
            },
            'Printing Methods': {
                title: 'Printing Methods',
                items: [
                    { name: 'Digital Printing', active: false, image: '{{ asset("uploads/finish-print-digital.webp") }}' },
                    { name: 'Flexographic Printing', active: false, image: '{{ asset("uploads/finish-print-flexographic.webp") }}' },
                    { name: 'Gravure Printing', active: true, image: '{{ asset("uploads/finish-print-gravure.webp") }}' },
                    { name: 'Offset Printing', active: false, image: '{{ asset("uploads/finish-print-offset.webp") }}' },
                    { name: 'Rotogravure Printing', active: false, image: '{{ asset("uploads/finish-print-rotogravure.webp") }}' },
                    { name: 'Scodix Digital', active: false, image: '{{ asset("uploads/finish-print-scodix-digital.webp") }}' },
                    { name: 'Screen Printing', active: false, image: '{{ asset("uploads/finish-print-screen.webp") }}' },
                    { name: 'UV Printing', active: false, image: '{{ asset("uploads/finish-print-uv.webp") }}' }
                ]
            },
            'Inks': {
                title: 'Inks Available',
                items: [
                    { name: 'CMYK', active: false, image: '{{ asset("uploads/finish-print-digital.webp") }}' },
                    { name: 'Pantone (PMS)', active: true, image: '{{ asset("uploads/finish-print-offset.webp") }}' },
                    { name: 'Metallic Inks', active: false, image: '{{ asset("uploads/finish-material-metallic-paper.webp") }}' },
                    { name: 'Soy-Based Ink', active: false, image: '{{ asset("uploads/finish-print-flexographic.webp") }}' },
                    { name: 'UV Inks', active: false, image: '{{ asset("uploads/finish-print-uv.webp") }}' }
                ]
            },
            'Finishing': {
                title: 'Finishing Options',
                items: [
                    { name: 'Gloss Lamination', active: false, image: '{{ asset("uploads/gloss-lamination.webp") }}' },
                    { name: 'Matte Lamination', active: true, image: '{{ asset("uploads/matte-lamination.webp") }}' },
                    { name: 'Soft-Touch Lamination', active: false, image: '{{ asset("uploads/soft-touch-lamination.webp") }}' },
                    { name: 'UV Coating', active: false, image: '{{ asset("uploads/uv-coating.webp") }}' },
                    { name: 'Aqueous Coating', active: false, image: '{{ asset("uploads/aqueous-coating.webp") }}' },
                    { name: 'Protective Varnish', active: false, image: '{{ asset("uploads/protective-varnish.webp") }}' }
                ]
            },
            'Add-ons': {
                title: 'Add-ons Available',
                items: [
                    { name: 'Embossing', active: false, image: '{{ asset("uploads/embossing.webp") }}' },
                    { name: 'Debossing', active: true, image: '{{ asset("uploads/debossing.webp") }}' },
                    { name: 'Blind Emboss', active: false, image: '{{ asset("uploads/blind-emboss.webp") }}' },
                    { name: 'Magnetic Closure', active: false, image: '{{ asset("uploads/magnetic-closure.webp") }}' },
                    { name: 'Luxury Magnetic Box', active: false, image: '{{ asset("uploads/luxury-magnetic-box.webp") }}' },
                    { name: 'Presentation Closure', active: false, image: '{{ asset("uploads/presentation-closure.webp") }}' },
                    { name: 'Luxury Insert', active: false, image: '{{ asset("uploads/luxury-insert.webp") }}' },
                    { name: 'Paper Insert', active: false, image: '{{ asset("uploads/paper-insert.webp") }}' },
                    { name: 'Protective Insert', active: false, image: '{{ asset("uploads/protective-insert.webp") }}' }
                ]
            }
        };

        // Tab switching functionality with scroll and image sync
        document.addEventListener('DOMContentLoaded', function() {
            const navItems = document.querySelectorAll('.finishes-bottom-nav span');
            const navContainer = document.querySelector('.finishes-bottom-nav');
            const titleElement = document.querySelector('.finishes-top-text');
            const itemsContainer = document.querySelector('.finishes-middle-list');
            const carouselImage = document.querySelector('.finishes-image-container img');
            const carouselDotsContainer = document.querySelector('.carousel-dots');
            let carouselDots = document.querySelectorAll('.carousel-dot');
            const tabNames = ['Materials', 'Printing Methods', 'Inks', 'Finishing', 'Add-ons'];
            let currentTabIndex = 0;
            let currentItemIndex = 2; // Start with middle item active

            function renderCarouselDots(count) {
                if (!carouselDotsContainer) return;
                carouselDotsContainer.innerHTML = '';
                for (let index = 0; index < count; index++) {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.className = 'carousel-dot' + (index === currentItemIndex ? ' active' : '');
                    dot.setAttribute('aria-label', 'Show image ' + (index + 1));
                    dot.addEventListener('click', () => {
                        currentItemIndex = index;
                        updateTabContent(currentTabIndex);
                        clearInterval(autoplayTimer);
                        autoplayTimer = setInterval(advanceCarousel, 4000);
                    });
                    carouselDotsContainer.appendChild(dot);
                }
                carouselDots = carouselDotsContainer.querySelectorAll('.carousel-dot');
            }

            // Function to update image based on active product
            function updateProductImage(imageUrl, dotIndex = null) {
                if (carouselImage && imageUrl) {
                    carouselImage.src = imageUrl;
                    carouselImage.style.opacity = '1';
                }

                // Update dots if index provided
                if (dotIndex !== null) {
                    carouselDots.forEach((dot, i) => {
                        dot.classList.toggle('active', i === dotIndex);
                    });
                }
            }

            // Function to update tab content
            function updateTabContent(tabIndex, scrollDirection = 0) {
                // Remove active class from all tabs
                navItems.forEach(nav => {
                    nav.classList.remove('active-nav');
                    nav.style.fontWeight = '';
                    nav.style.color = '';
                });

                // Add active class to current tab
                navItems[tabIndex].classList.add('active-nav');
                navItems[tabIndex].style.fontWeight = '700';
                navItems[tabIndex].style.color = '#8D4445';
                if (navContainer) {
                    navContainer.scrollTo({
                        left: navItems[tabIndex].offsetLeft - ((navContainer.clientWidth - navItems[tabIndex].offsetWidth) / 2),
                        behavior: 'smooth'
                    });
                }

                // Get the tab name
                const tabName = tabNames[tabIndex];

                // Update content based on tab
                if (finishesData[tabName]) {
                    const data = finishesData[tabName];
                    
                    // Update title
                    titleElement.textContent = data.title;

                    // If scrolling within same tab, rotate the active item
                    if (scrollDirection !== 0 && currentTabIndex === tabIndex) {
                        // Rotate items
                        if (scrollDirection > 0) {
                            currentItemIndex = (currentItemIndex + 1) % data.items.length;
                        } else {
                            currentItemIndex = (currentItemIndex - 1 + data.items.length) % data.items.length;
                        }
                    } else if (currentTabIndex !== tabIndex) {
                        // When changing tabs, reset to index 0
                        currentItemIndex = 0;
                    }
                    
                    // Update active states in data
                    data.items.forEach((item, idx) => {
                        item.active = (idx === currentItemIndex);
                    });

                    renderCarouselDots(data.items.length);

                    // Update the product image for active item
                    const activeItem = data.items[currentItemIndex];
                    if (activeItem && activeItem.image) {
                        updateProductImage(activeItem.image, currentItemIndex);
                    }

                    // Update labels immediately so they remain crisp and readable.
                    itemsContainer.innerHTML = '';
                        
                        // Show only 3 items at a time (before, current, after)
                        const visibleItems = [];
                        const visibleIndexes = [];
                        for (let i = -1; i <= 1; i++) {
                            const index = (currentItemIndex + i + data.items.length) % data.items.length;
                            visibleItems.push({...data.items[index]}); // Create a copy
                            visibleIndexes.push(index);
                        }
                        
                    visibleItems.forEach((item, relativeIndex) => {
                        const itemDiv = document.createElement('div');
                            // Only the middle item (index 1) should be dark
                            itemDiv.className = (relativeIndex === 1) ? 'finish-item-dark' : 'finish-item-light';
                            itemDiv.textContent = item.name;
                            
                            // Add click handler to ALL items to center them when clicked
                            itemDiv.style.cursor = 'pointer';
                            itemDiv.addEventListener('click', () => {
                                // Get the actual index from our visibleIndexes array
                                const actualIndex = visibleIndexes[relativeIndex];
                                currentItemIndex = actualIndex;
                                updateTabContent(currentTabIndex);
                                
                                // Reset autoplay timer
                                clearInterval(autoplayTimer);
                                autoplayTimer = setInterval(advanceCarousel, 4000);
                            });
                            
                        itemsContainer.appendChild(itemDiv);
                    });

                    itemsContainer.style.opacity = '1';
                }
                
                currentTabIndex = tabIndex;
            }

            // Click event for tabs
            navItems.forEach((item, index) => {
                item.addEventListener('click', function() {
                    updateTabContent(index);
                });
            });

            // Autoplay Carousel Logic
            let autoplayTimer;
            
            function advanceCarousel() {
                const tabName = tabNames[currentTabIndex];
                const data = finishesData[tabName];
                
                if (currentItemIndex + 1 >= data.items.length) {
                    // Switch to next tab automatically
                    let nextTabIndex = (currentTabIndex + 1) % tabNames.length;
                    updateTabContent(nextTabIndex);
                } else {
                    // Go to next item in current tab
                    updateTabContent(currentTabIndex, 1);
                }
            }

            // Start auto play
            autoplayTimer = setInterval(advanceCarousel, 4000);
            
            // Pause on hover
            const heroFormElement = document.querySelector('.hero-form');
            if (itemsContainer) {
                itemsContainer.addEventListener('mouseenter', () => clearInterval(autoplayTimer));
                itemsContainer.addEventListener('mouseleave', () => autoplayTimer = setInterval(advanceCarousel, 4000));
            }

            // Render the correct number of dots and load the initial final image.
            updateTabContent(currentTabIndex);

            // Add smooth transition for items and image
            if (itemsContainer) {
                itemsContainer.style.transition = 'opacity 0.5s ease';
            }
            if (carouselImage) {
                carouselImage.style.transition = 'opacity 0.5s ease';
            }

            // Keep the clicked control visibly active in both page forms.
            const formControlSelector = '.hero-form .form-control, .quote-form .form-control, .hero-form .custom-select-trigger, .quote-form .custom-select-trigger';
            document.addEventListener('click', function(event) {
                const activeControl = event.target.closest(formControlSelector);
                if (!activeControl) return;

                document.querySelectorAll(formControlSelector).forEach(control => {
                    control.classList.remove('is-active');
                });
                activeControl.classList.add('is-active');
            }, true);
            // Custom JS Select Implementation
            document.querySelectorAll('select.form-control').forEach(select => {
                if (select.parentElement.classList.contains('custom-select-wrapper')) return;
                
                const wrapper = document.createElement('div');
                wrapper.className = 'custom-select-wrapper';
                
                select.parentNode.insertBefore(wrapper, select);
                wrapper.appendChild(select);
                select.style.display = 'none';
                
                const trigger = document.createElement('div');
                trigger.className = 'custom-select-trigger';
                trigger.textContent = select.options[select.selectedIndex]?.text || '';
                wrapper.appendChild(trigger);
                
                const optionsContainer = document.createElement('div');
                optionsContainer.className = 'custom-options';
                
                Array.from(select.options).forEach((option, index) => {
                    const customOption = document.createElement('div');
                    customOption.className = 'custom-option';
                    if (index === select.selectedIndex) customOption.classList.add('selected');
                    customOption.textContent = option.text;
                    customOption.setAttribute('data-value', option.value || option.text);
                    
                    customOption.addEventListener('click', function(e) {
                        e.stopPropagation();
                        select.selectedIndex = index;
                        select.dispatchEvent(new Event('change'));
                        
                        trigger.textContent = this.textContent;
                        trigger.classList.remove('open');
                        
                        optionsContainer.querySelectorAll('.custom-option').forEach(opt => opt.classList.remove('selected'));
                        this.classList.add('selected');
                        
                        optionsContainer.classList.remove('open');
                    });
                    optionsContainer.appendChild(customOption);
                });
                
                wrapper.appendChild(optionsContainer);
                
                trigger.addEventListener('click', function(e) {
                    e.stopPropagation();
                    document.querySelectorAll('.custom-select-trigger').forEach(t => {
                        if (t !== trigger) {
                            t.classList.remove('open');
                            t.nextElementSibling.classList.remove('open');
                        }
                    });
                    this.classList.toggle('open');
                    optionsContainer.classList.toggle('open');
                });
            });
            
            document.addEventListener('click', function() {
                document.querySelectorAll('.custom-select-trigger').forEach(trigger => {
                    trigger.classList.remove('open');
                    trigger.nextElementSibling.classList.remove('open');
                });
            });

            // Initialize with first tab
            updateTabContent(0);
        });
    </script>


</script>
    
    <script>
        function switchProductImage(thumb, imageUrl) {
            const mainImage = document.getElementById('product-main-image');
            if (mainImage) mainImage.src = imageUrl;
            document.querySelectorAll('.thumbnails .thumb').forEach(function (item) {
                item.classList.toggle('active', item === thumb);
            });
        }

        document.addEventListener('click', function (event) {
            const formControlSelector = '.hero-form .form-control, .quote-form .form-control, .hero-form .custom-select-trigger, .quote-form .custom-select-trigger';
            const clickedControl = event.target.closest(formControlSelector);
            if (!clickedControl) return;

            document.querySelectorAll(formControlSelector).forEach(function (control) {
                control.style.setProperty('border', '0.5px solid #8d4445', 'important');
            });
            clickedControl.style.setProperty('border', '1px solid #8d4445', 'important');
        }, true);
    </script>
    @include('components.footer')
</body>
</html>

