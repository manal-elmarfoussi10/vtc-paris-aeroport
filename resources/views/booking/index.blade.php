@extends('layouts.app')

@section('title', 'Réserver un VTC - Transfert Paris Aéroports')
@section('description', 'Réservez votre chauffeur privé pour les aéroports CDG, Orly et Beauvais. Tarifs fixes, service premium 24h/24.')

@section('head')
<style>
/* Modern Booking Page Styles - Enhanced */
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

@keyframes gradientShift {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

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

@keyframes bounceIn {
    0% {
        opacity: 0;
        transform: scale(0.3);
    }
    50% {
        opacity: 1;
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes shimmer {
    0% {
        background-position: -200% 0;
    }
    100% {
        background-position: 200% 0;
    }
}

/* Progress Bar - Enhanced */
.progress-container {
    position: relative;
    width: 100%;
    height: 6px;
    background: #e5e7eb;
    border-radius: 3px;
    overflow: hidden;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
}

.progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #1e40af, #3b82f6, #60a5fa, #93c5fd);
    background-size: 300% 100%;
    animation: gradientShift 3s ease infinite, shimmer 2s linear infinite;
    transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 3px;
}

/* Step Indicators - Enhanced */
.step-indicator {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: white;
    border: 3px solid #e5e7eb;
    color: #6b7280;
    font-weight: bold;
    font-size: 18px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 1;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.step-indicator.active {
    background: linear-gradient(135deg, #1e40af, #3b82f6);
    border-color: #1e40af;
    color: white;
    box-shadow: 0 0 30px rgba(59, 130, 246, 0.4), 0 4px 16px rgba(59, 130, 246, 0.2);
    animation: bounceIn 0.6s ease-out;
}

.step-indicator.completed {
    background: linear-gradient(135deg, #10b981, #34d399);
    border-color: #10b981;
    color: white;
    box-shadow: 0 0 20px rgba(16, 185, 129, 0.3);
}

.step-indicator::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(59, 130, 246, 0.3);
    transform: translate(-50%, -50%);
    transition: all 0.3s ease;
}

.step-indicator.active::before {
    width: 60px;
    height: 60px;
}

/* Card Styles - Enhanced */
.booking-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid #f3f4f6;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    position: relative;
}

.booking-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.05), transparent);
    transition: left 0.5s ease;
}

.booking-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15), 0 0 30px rgba(59, 130, 246, 0.1);
}

.booking-card:hover::before {
    left: 100%;
}

/* Form Elements - Enhanced */
.form-input-modern {
    border: 2px solid #e5e7eb;
    border-radius: 14px;
    padding: 14px 18px;
    font-size: 16px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: white;
    position: relative;
    overflow: hidden;
}

.form-input-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
    transition: left 0.4s ease;
}

.form-input-modern:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15), 0 4px 16px rgba(59, 130, 246, 0.1);
    outline: none;
    transform: translateY(-2px);
}

.form-input-modern:focus::before {
    left: 100%;
}

/* Map Container - Enhanced */
.map-container {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15), 0 2px 8px rgba(0, 0, 0, 0.1);
    border: 2px solid #f3f4f6;
    transition: all 0.3s ease;
}

.map-container:hover {
    box-shadow: 0 12px 48px rgba(0, 0, 0, 0.2), 0 0 20px rgba(59, 130, 246, 0.1);
    border-color: #3b82f6;
}

/* Price Display - Enhanced */
.price-display {
    background: linear-gradient(135deg, #1e40af, #3b82f6, #60a5fa);
    color: white;
    border-radius: 16px;
    padding: 24px;
    text-align: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(30, 64, 175, 0.3);
}

.price-display::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    animation: gradientShift 4s infinite;
}

.price-display::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    animation: pulse 3s ease-in-out infinite;
}

/* Service Cards - Enhanced */
.service-card {
    background: white;
    border: 2px solid #f3f4f6;
    border-radius: 16px;
    padding: 20px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.service-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(147, 197, 253, 0.05));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.service-card:hover {
    border-color: #3b82f6;
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 12px 40px rgba(59, 130, 246, 0.2), 0 0 20px rgba(59, 130, 246, 0.1);
}

.service-card:hover::before {
    opacity: 1;
}

.service-card.selected {
    border-color: #3b82f6;
    background: linear-gradient(135deg, #eff6ff, #dbeafe);
    box-shadow: 0 8px 32px rgba(59, 130, 246, 0.25);
}

.service-card.selected::before {
    opacity: 1;
}

/* Floating Action Button - Enhanced */
.fab {
    position: fixed;
    bottom: 32px;
    right: 32px;
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1e40af, #3b82f6);
    color: white;
    border: none;
    box-shadow: 0 8px 32px rgba(59, 130, 246, 0.4), 0 4px 16px rgba(59, 130, 246, 0.2);
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.fab::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: all 0.4s ease;
}

.fab:hover {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 12px 48px rgba(59, 130, 246, 0.5), 0 6px 24px rgba(59, 130, 246, 0.3);
}

.fab:hover::before {
    width: 80px;
    height: 80px;
}

.fab:active {
    transform: scale(0.95) rotate(5deg);
}

/* Animations - Enhanced */
.animate-fade-in-up {
    animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.animate-slide-in-left {
    animation: slideInLeft 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.animate-slide-in-right {
    animation: slideInRight 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.animate-bounce-in {
    animation: bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

/* Step Transitions - Enhanced */
.step-transition {
    transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    transform-origin: center;
}

.step-enter {
    opacity: 0;
    transform: translateX(100px) scale(0.9) rotateY(15deg);
    filter: blur(2px);
}

.step-enter-active {
    opacity: 1;
    transform: translateX(0) scale(1) rotateY(0deg);
    filter: blur(0px);
}

.step-exit {
    opacity: 1;
    transform: translateX(0) scale(1) rotateY(0deg);
    filter: blur(0px);
}

.step-exit-active {
    opacity: 0;
    transform: translateX(-100px) scale(0.9) rotateY(-15deg);
    filter: blur(2px);
}

/* Advanced Hover Effects */
.booking-card:hover {
    transform: translateY(-12px) scale(1.03) rotateX(2deg);
    box-shadow:
        0 25px 80px rgba(0, 0, 0, 0.15),
        0 0 30px rgba(59, 130, 246, 0.1),
        0 0 60px rgba(59, 130, 246, 0.05);
    border-color: rgba(59, 130, 246, 0.3);
}

.booking-card:hover::before {
    left: 100%;
    background: linear-gradient(135deg,
        rgba(59, 130, 246, 0.1),
        rgba(147, 197, 253, 0.1),
        rgba(59, 130, 246, 0.05)
    );
}

/* Service Card Advanced Hover */
.service-card:hover {
    transform: translateY(-8px) scale(1.02) rotateX(5deg);
    box-shadow:
        0 20px 60px rgba(59, 130, 246, 0.15),
        0 0 30px rgba(59, 130, 246, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
    border-color: rgba(59, 130, 246, 0.5);
}

.service-card:hover::before {
    opacity: 1;
    background: linear-gradient(135deg,
        rgba(59, 130, 246, 0.08),
        rgba(147, 197, 253, 0.08),
        rgba(96, 165, 250, 0.05)
    );
}

/* Floating Action Button - Enhanced */
.fab {
    position: fixed;
    bottom: 32px;
    right: 32px;
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1e40af, #3b82f6, #60a5fa);
    background-size: 200% 200%;
    color: white;
    border: none;
    box-shadow:
        0 8px 32px rgba(59, 130, 246, 0.4),
        0 4px 16px rgba(59, 130, 246, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: float 3s ease-in-out infinite;
}

.fab::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.4);
    transform: translate(-50%, -50%);
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.fab:hover {
    transform: scale(1.15) rotate(180deg);
    box-shadow:
        0 16px 48px rgba(59, 130, 246, 0.6),
        0 8px 24px rgba(59, 130, 246, 0.4),
        0 0 40px rgba(59, 130, 246, 0.3);
    background-position: right center;
}

.fab:hover::before {
    width: 100px;
    height: 100px;
}

.fab:active {
    transform: scale(0.95) rotate(180deg);
}

/* Floating Animation */
@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
}

/* Pulse Animation for Active Elements */
@keyframes pulse-glow {
    0%, 100% {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
    }
    50% {
        box-shadow: 0 0 40px rgba(59, 130, 246, 0.6), 0 0 60px rgba(59, 130, 246, 0.4);
    }
}

.step-indicator.active {
    animation: pulse-glow 2s ease-in-out infinite;
}

/* Advanced Button Animations */
button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

button:active {
    transform: translateY(0px);
    transition: all 0.1s ease;
}

/* Ripple Effect */
@keyframes ripple {
    0% {
        transform: scale(0);
        opacity: 1;
    }
    100% {
        transform: scale(4);
        opacity: 0;
    }
}

.ripple {
    position: relative;
    overflow: hidden;
}

.ripple::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 5px;
    height: 5px;
    background: rgba(255, 255, 255, 0.5);
    opacity: 0;
    border-radius: 100%;
    transform: scale(1, 1) translate(-50%);
    transform-origin: 50% 50%;
}

.ripple:focus:not(:active)::after {
    animation: ripple 1s ease-out;
}

/* Staggered Animation for Cards */
.animate-stagger-1 { animation-delay: 0.1s; }
.animate-stagger-2 { animation-delay: 0.2s; }
.animate-stagger-3 { animation-delay: 0.3s; }
.animate-stagger-4 { animation-delay: 0.4s; }

/* 3D Transform Effects */
.perspective-1000 {
    perspective: 1000px;
}

.transform-3d {
    transform-style: preserve-3d;
}

/* Advanced Gradient Animations */
.price-display {
    background: linear-gradient(135deg, #1e40af, #3b82f6, #60a5fa, #93c5fd, #1e40af);
    background-size: 400% 400%;
    animation: gradient-shift 8s ease infinite;
}

@keyframes gradient-shift {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

/* Interactive Map Enhancements */
.map-container:hover {
    transform: scale(1.02);
    box-shadow:
        0 20px 60px rgba(0, 0, 0, 0.2),
        0 0 30px rgba(59, 130, 246, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

/* Form Element Advanced Effects */
.form-input-modern:focus {
    transform: translateY(-3px) scale(1.01);
    box-shadow:
        0 0 0 4px rgba(59, 130, 246, 0.15),
        0 8px 25px rgba(59, 130, 246, 0.1),
        0 0 40px rgba(59, 130, 246, 0.05);
}

.form-input-modern:focus::before {
    left: 100%;
    background: linear-gradient(90deg,
        transparent,
        rgba(59, 130, 246, 0.2),
        rgba(147, 197, 253, 0.2),
        transparent
    );
}

/* Loading States with Animation */
.loading {
    position: relative;
    overflow: hidden;
}

.loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg,
        transparent,
        rgba(59, 130, 246, 0.1),
        rgba(147, 197, 253, 0.1),
        transparent
    );
    animation: shimmer 1.5s infinite;
}

/* Success Animation */
@keyframes success-bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

.success-checkmark {
    animation: success-bounce 1s ease-out, bounceIn 0.6s ease-out;
}

/* Dynamic Gradient Backgrounds */
.bg-dynamic-gradient {
    background: linear-gradient(-45deg, #1e40af, #3b82f6, #60a5fa, #93c5fd, #1e40af);
    background-size: 400% 400%;
    animation: gradient-shift 15s ease infinite;
}

/* Enhanced Interactive Map Styling */
.map-container {
    position: relative;
    overflow: hidden;
    border: 3px solid transparent;
    background: linear-gradient(135deg, #f8fafc, #e2e8f0) padding-box,
                linear-gradient(135deg, #3b82f6, #60a5fa) border-box;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.map-container::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(135deg, #3b82f6, #60a5fa, #93c5fd, #3b82f6);
    background-size: 400% 400%;
    animation: gradient-shift 8s ease infinite;
    z-index: -1;
    border-radius: 18px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.map-container:hover::before {
    opacity: 1;
}

/* Modernized Form Elements */
.form-input-modern {
    background: linear-gradient(135deg, #ffffff, #f8fafc);
    border: 2px solid transparent;
    background-clip: padding-box;
    position: relative;
}

.form-input-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #3b82f6, #60a5fa, #93c5fd);
    z-index: -1;
    border-radius: 16px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.form-input-modern:focus::before {
    opacity: 0.1;
}

/* Enhanced Card Shadows and Animations */
.booking-card, .service-card {
    box-shadow:
        0 4px 20px rgba(0, 0, 0, 0.08),
        0 2px 8px rgba(0, 0, 0, 0.04),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.booking-card:hover, .service-card:hover {
    box-shadow:
        0 20px 60px rgba(59, 130, 246, 0.15),
        0 8px 32px rgba(59, 130, 246, 0.1),
        0 0 40px rgba(59, 130, 246, 0.05),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
}

/* Advanced Button Styling */
button {
    background: linear-gradient(135deg, #3b82f6, #60a5fa);
    border: none;
    position: relative;
    overflow: hidden;
    box-shadow:
        0 4px 20px rgba(59, 130, 246, 0.3),
        0 2px 8px rgba(59, 130, 246, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
}

button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.5s ease;
}

button:hover::before {
    left: 100%;
}

/* Enhanced Progress Bar */
.progress-container {
    background: linear-gradient(135deg, #e5e7eb, #d1d5db);
    position: relative;
    overflow: hidden;
}

.progress-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
    animation: shimmer 3s infinite;
}

/* Floating Elements */
.fab {
    box-shadow:
        0 8px 32px rgba(59, 130, 246, 0.4),
        0 4px 16px rgba(59, 130, 246, 0.2),
        0 0 20px rgba(59, 130, 246, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    background: linear-gradient(135deg, #1e40af, #3b82f6, #60a5fa, #93c5fd);
    background-size: 300% 300%;
    animation: float 3s ease-in-out infinite, gradient-shift 8s ease infinite;
}

/* Responsive Design - Comprehensive */
@media (max-width: 1024px) {
    .booking-card {
        margin: 0 20px;
    }

    .grid.grid-cols-1.lg\\:grid-cols-2 {
        grid-template-columns: 1fr;
        gap: 6;
    }

    .map-container {
        height: 300px;
    }
}

@media (max-width: 768px) {
    .min-h-screen {
        padding-top: 16px;
        padding-bottom: 8px;
    }

    .booking-card {
        margin: 0 16px;
        border-radius: 16px;
        transform: none !important;
        padding: 6;
    }

    .booking-card:hover {
        transform: translateY(-4px) scale(1.01) !important;
    }

    .step-indicator {
        width: 40px;
        height: 40px;
        font-size: 16px;
        margin: 0 8px;
    }

    .fab {
        bottom: 24px;
        right: 24px;
        width: 56px;
        height: 56px;
    }

    .price-display {
        padding: 20px;
        margin: 4 0;
    }

    .map-container {
        height: 250px;
        margin: 4 0;
    }

    .form-input-modern {
        font-size: 15px;
        padding: 14px 16px;
    }

    .text-3xl {
        font-size: 1.75rem;
    }

    .text-4xl {
        font-size: 2rem;
    }

    .text-6xl {
        font-size: 3rem;
    }

    .space-y-6 > * + * {
        margin-top: 1rem;
    }

    .space-y-8 > * + * {
        margin-top: 1.5rem;
    }
}

@media (max-width: 640px) {
    .max-w-7xl {
        max-width: 100%;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .text-center.mb-12 {
        margin-bottom: 2rem;
    }

    .inline-flex {
        flex-direction: column;
        align-items: center;
    }

    .mb-6 {
        margin-bottom: 1rem;
    }

    .text-4xl, .text-5xl, .text-6xl {
        font-size: 2.25rem;
        line-height: 1.1;
    }

    .text-xl {
        font-size: 1.125rem;
    }

    .mb-12 {
        margin-bottom: 2rem;
    }

    .flex.items-center.justify-between {
        flex-direction: column;
        gap: 1rem;
    }

    .step-indicator {
        width: 36px;
        height: 36px;
        font-size: 14px;
        margin: 0 4px;
    }

    .ml-4 {
        margin-left: 0.5rem;
    }

    .progress-container {
        height: 5px;
    }

    .booking-card {
        margin: 0 12px;
        padding: 5;
    }

    .grid.grid-cols-1.md\\:grid-cols-2 {
        grid-template-columns: 1fr;
    }

    .map-container {
        height: 200px;
    }

    .grid.grid-cols-2 {
        grid-template-columns: 1fr;
        gap: 3;
    }

    .price-display {
        padding: 16px;
        margin: 3 0;
    }

    .text-2xl {
        font-size: 1.25rem;
    }

    .text-4xl {
        font-size: 1.75rem;
    }

    .fab {
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
    }

    .form-input-modern {
        font-size: 14px;
        padding: 12px 14px;
    }

    .w-16 {
        width: 3rem;
        height: 3rem;
    }

    .text-3xl {
        font-size: 1.5rem;
    }

    .flex.justify-between {
        flex-direction: column;
        gap: 1rem;
    }

    .px-10 {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    .px-12 {
        padding-left: 2rem;
        padding-right: 2rem;
    }

    .py-4 {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }
}

@media (max-width: 480px) {
    .step-indicator {
        width: 32px;
        height: 32px;
        font-size: 12px;
    }

    .booking-card {
        margin: 0 8px;
        border-radius: 12px;
    }

    .fab {
        bottom: 16px;
        right: 16px;
        width: 48px;
        height: 48px;
    }

    .map-container {
        height: 180px;
        border-radius: 12px;
    }

    .price-display {
        padding: 14px;
        border-radius: 12px;
    }

    .form-input-modern {
        font-size: 13px;
        padding: 10px 12px;
        border-radius: 10px;
    }

    .text-lg {
        font-size: 0.95rem;
    }

    .text-base {
        font-size: 0.9rem;
    }

    .text-sm {
        font-size: 0.8rem;
    }

    .w-8 {
        width: 1.5rem;
        height: 1.5rem;
    }

    .w-10 {
        width: 2rem;
        height: 2rem;
    }

    .p-4 {
        padding: 0.75rem;
    }

    .p-6 {
        padding: 1rem;
    }

    .p-8 {
        padding: 1.25rem;
    }

    .p-10 {
        padding: 1.5rem;
    }
}

/* Touch Device Optimizations */
@media (hover: none) and (pointer: coarse) {
    .booking-card:hover,
    .service-card:hover,
    .fab:hover,
    .map-container:hover {
        transform: none !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
    }

    .form-input-modern:focus {
        transform: none;
    }

    .button:active {
        transform: scale(0.98);
    }
}

/* High DPI Display Support */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .booking-card,
    .service-card,
    .fab {
        box-shadow:
            0 1px 3px rgba(0, 0, 0, 0.12),
            0 1px 2px rgba(0, 0, 0, 0.24);
    }

    .booking-card:hover,
    .service-card:hover {
        box-shadow:
            0 3px 6px rgba(0, 0, 0, 0.16),
            0 3px 6px rgba(0, 0, 0, 0.23);
    }
}

/* Print Styles */
@media print {
    .fab,
    .animate-fade-in-up,
    .animate-slide-in-left,
    .animate-slide-in-right,
    .animate-bounce-in {
        animation: none !important;
        transform: none !important;
    }

    .booking-card,
    .service-card {
        box-shadow: none !important;
        border: 1px solid #e5e7eb !important;
    }

    .bg-dynamic-gradient {
        background: white !important;
    }
}

/* Loading States */
.loading {
    position: relative;
    overflow: hidden;
}

.loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
    animation: shimmer 1.5s infinite;
}

/* Success States */
.success-checkmark {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #10b981;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    animation: bounceIn 0.6s ease-out;
}
</style>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAo0mPC9-SNbSuZ8Z69sI0OMn7gzQ5Tx-o&libraries=places,geometry&callback=initMap"></script>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 pt-20 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Hero Section --}}
        <div class="text-center mb-12 animate-fade-in-up">
            <br><br><br><br>
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full mb-6 shadow-lg">
              

               <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10m0 0l-2-2m2 2l2-2m4-6v2a2 2 0 01-2 2H8a2 2 0 01-2-2v-2a2 2 0 012-2h8a2 2 0 012 2z"></path>
            </svg>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">
                Réservez votre <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">VTC </span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Voyagez en toute sérénité vers les aéroports parisiens avec nos chauffeurs professionnels
            </p>
        </div>

        {{-- Progress Bar --}}
        <div class="mb-12 animate-fade-in-up">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="step-indicator active" id="step-1">1</div>
                    <span class="ml-4 text-base font-semibold text-gray-900">Trajet</span>
                </div>
                <div class="flex items-center">
                    <div class="step-indicator" id="step-2">2</div>
                    <span class="ml-4 text-base font-semibold text-gray-600">Détails</span>
                </div>
                <div class="flex items-center">
                    <div class="step-indicator" id="step-3">3</div>
                    <span class="ml-4 text-base font-semibold text-gray-600">Confirmation</span>
                </div>
            </div>
            <div class="progress-container">
                <div class="progress-bar" id="progress-bar" style="width: 33%"></div>
            </div>
        </div>

        {{-- Floating Action Button --}}
        <button type="button" class="fab ripple" onclick="scrollToTop()" title="Retour en haut">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        </button>

        {{-- Booking Form --}}
        <form method="POST" action="{{ route('booking.store') }}" class="space-y-8 perspective-1000 transform-3d bg-dynamic-gradient" id="booking-form">
            @csrf
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- Step 1: Route Selection --}}
            <div class="booking-card p-10 animate-slide-in-left step-transition" id="step-1-content">
                <div class="flex items-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl flex items-center justify-center mr-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Sélectionnez votre trajet</h2>
                        <p class="text-gray-600">Choisissez vos points de départ et d'arrivée</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        {{-- Pickup Address --}}
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                Adresse de prise en charge *
                            </label>
                            <div class="relative">
                                <input id="pickup_address" name="pickup_address" type="text"
                                    class="form-input-modern w-full pl-12"
                                    :value="old('pickup_address')"
                                    placeholder="Ex: 123 Avenue des Champs-Élysées, Paris"
                                    required />
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('pickup_address')" class="mt-2" />
                        </div>

                        {{-- Dropoff Address --}}
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                Adresse de destination *
                            </label>
                            <div class="relative">
                                <input id="dropoff_address" name="dropoff_address" type="text"
                                    class="form-input-modern w-full pl-12"
                                    :value="old('dropoff_address')"
                                    placeholder="Ex: Aéroport Charles de Gaulle, Terminal 2"
                                    required />
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('dropoff_address')" class="mt-2" />
                        </div>

                        {{-- Date & Time --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="relative">
                                <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10m0 0l-2-2m2 2l2-2m4-6v2a2 2 0 01-2 2H8a2 2 0 01-2-2v-2a2 2 0 012-2h8a2 2 0 012 2z"></path>
                                        </svg>
                                    </div>
                                    Date et heure *
                                </label>
                                <div class="relative">
                                <input id="pickup_datetime" name="pickup_time" type="datetime-local"
                                    class="form-input-modern w-full pl-12"
                                    :value="old('pickup_time')"
                                    min="{{ now()->addHour()->format('Y-m-d\TH:i') }}"
                                    required />
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('pickup_datetime')" class="mt-2" />
                            </div>

                            <div class="relative">
                                <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                        </svg>
                                    </div>
                                    Passagers *
                                </label>
                                <div class="relative">
                                    <select id="pax" name="pax" class="form-input-modern w-full pl-12 appearance-none" required>
                                        <option value="">Sélectionner</option>
                                        @for($i = 1; $i <= 8; $i++)
                                            <option value="{{ $i }}" {{ old('pax') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('pax')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- Map --}}
                    <div class="animate-slide-in-right space-y-6">
                        <div class="map-container">
                            <div id="map" class="w-full h-80 rounded-2xl"></div>
                        </div>

                        {{-- Route Info Cards --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide">Distance</p>
                                            <p class="text-lg font-bold text-gray-900" id="distance-display">À calculer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide">Durée</p>
                                            <p class="text-lg font-bold text-gray-900" id="duration-display">À calculer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-10">
                    <button type="button" onclick="nextStep(2)" class="group relative px-10 py-4 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold rounded-xl shadow-xl hover:shadow-2xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                        <span class="relative z-10 flex items-center">
                            Suivant
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-blue-900 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                </div>
            </div>

            {{-- Step 3: Review & Confirm --}}
            <div class="booking-card p-10 animate-slide-in-right step-transition hidden" id="step-3-content">
                <div class="flex items-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl flex items-center justify-center mr-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Confirmation de réservation</h2>
                        <p class="text-gray-600">Vérifiez vos informations avant de confirmer</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        {{-- Booking Summary --}}
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-2xl border border-blue-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                Détails du trajet
                            </h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-blue-100">
                                    <span class="text-gray-600 font-medium">Départ:</span>
                                    <span class="text-gray-900 font-semibold" id="summary-pickup">À définir</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-blue-100">
                                    <span class="text-gray-600 font-medium">Destination:</span>
                                    <span class="text-gray-900 font-semibold" id="summary-dropoff">À définir</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-blue-100">
                                    <span class="text-gray-600 font-medium">Date & heure:</span>
                                    <span class="text-gray-900 font-semibold" id="summary-datetime">À définir</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-blue-100">
                                    <span class="text-gray-600 font-medium">Passagers:</span>
                                    <span class="text-gray-900 font-semibold" id="summary-passengers">À définir</span>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600 font-medium">Bagages:</span>
                                    <span class="text-gray-900 font-semibold" id="summary-luggage">À définir</span>
                                </div>
                            </div>
                        </div>

                        {{-- Vehicle & Services --}}
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-2xl border border-green-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                Véhicule & Services
                            </h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-green-100">
                                    <span class="text-gray-600 font-medium">Véhicule:</span>
                                    <span class="text-gray-900 font-semibold" id="summary-vehicle">À définir</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-green-100">
                                    <span class="text-gray-600 font-medium">Prix véhicule:</span>
                                    <span class="text-gray-900 font-semibold" id="summary-vehicle-price">À définir</span>
                                </div>
                                <div class="py-2">
                                    <span class="text-gray-600 font-medium">Services supplémentaires:</span>
                                    <ul class="mt-2 space-y-1" id="summary-extras">
                                        <li class="text-gray-900">À définir</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        {{-- Customer Information --}}
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-6 rounded-2xl border border-purple-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                Informations client
                            </h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-purple-100">
                                    <span class="text-gray-600 font-medium">Nom:</span>
                                    <span class="text-gray-900 font-semibold" id="summary-customer">À définir</span>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-600 font-medium">Statut:</span>
                                    <span class="text-green-600 font-semibold flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Informations validées
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Final Price & Confirmation --}}
                        <div class="price-display animate-bounce-in">
                            <div class="text-center">
                                <div class="text-sm text-blue-200 mb-2">Prix total</div>
                                <div class="text-4xl font-bold mb-2" id="summary-total">À calculer</div>
                                <div class="text-sm text-blue-200">TVA incluse • Paiement sécurisé</div>
                            </div>
                        </div>

                        {{-- Terms & Conditions --}}
                        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <input type="checkbox" id="terms" name="terms" class="w-5 h-5 rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-600 focus:ring-blue-600" required>
                                </div>
                                <div class="ml-3">
                                    <label for="terms" class="text-sm text-gray-700 cursor-pointer">
                                        J'accepte les <a href="#" class="text-blue-600 hover:text-blue-800 underline">conditions générales de vente</a> et la <a href="#" class="text-blue-600 hover:text-blue-800 underline">politique de confidentialité</a>.
                                        Je confirme que toutes les informations fournies sont exactes.
                                    </label>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('terms')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="flex justify-between mt-10">
                    <button type="button" onclick="prevStep(2)" class="group relative px-10 py-4 bg-gray-200 text-gray-700 font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                        <span class="relative z-10 flex items-center">
                            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Précédent
                        </span>
                        <div class="absolute inset-0 bg-gray-300 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                    <button type="submit" class="group relative px-12 py-4 bg-gradient-to-r from-green-600 to-green-800 text-white font-bold rounded-xl shadow-xl hover:shadow-2xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                        <span class="relative z-10 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Confirmer la réservation
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-green-700 to-green-900 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                </div>
            </div>

            {{-- Step 2: Details --}}
            <div class="booking-card p-10 animate-slide-in-right step-transition hidden" id="step-2-content">
                <div class="flex items-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl flex items-center justify-center mr-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Détails de la réservation</h2>
                        <p class="text-gray-600">Choisissez votre véhicule et vos options</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        {{-- Luggage --}}
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                Nombre de bagages *
                            </label>
                            <div class="relative">
                                <select id="luggage" name="luggage" class="form-input-modern w-full pl-12 appearance-none" required>
                                    <option value="">Sélectionner</option>
                                    @for($i = 0; $i <= 8; $i++)
                                        <option value="{{ $i }}" {{ old('luggage') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('luggage')" class="mt-2" />
                        </div>

                        {{-- Vehicle Selection --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                Catégorie de véhicule *
                            </label>
                            <div class="grid grid-cols-1 gap-4">
                                @foreach($vehicles as $vehicle)
                                <div class="service-card p-5 cursor-pointer transition-all duration-300" onclick="selectVehicle('{{ $vehicle->class }}')">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-14 h-14 bg-gradient-to-r from-blue-100 to-blue-200 rounded-xl flex items-center justify-center mr-5 shadow-sm">
                                                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 text-lg">{{ $vehicle->name }}</h4>
                                                <p class="text-sm text-gray-600">{{ $vehicle->class_label }}</p>
                                                <div class="flex items-center mt-1">
                                                    <div class="flex text-yellow-400">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <svg class="w-4 h-4 {{ $i <= 4 ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 24 24">
                                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                            </svg>
                                                        @endfor
                                                    </div>
                                                    <span class="text-xs text-gray-500 ml-2">(4.8)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-2xl font-bold text-blue-600">{{ $vehicle->base_price }}€</div>
                                            <div class="text-sm text-gray-500">+{{ $vehicle->per_km }}€/km</div>
                                        </div>
                                    </div>
                                    <input type="radio" name="vehicle_class" value="{{ $vehicle->class }}" {{ old('vehicle_class') == $vehicle->class ? 'checked' : '' }} class="hidden vehicle-radio" required />
                                </div>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('vehicle_class')" class="mt-2" />
                        </div>

                        {{-- Extras --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-6 flex items-center">
                                <div class="w-8 h-8 bg-teal-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                    </svg>
                                </div>
                                Services supplémentaires
                            </label>
                            <div class="space-y-4">
                                <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl hover:border-blue-300 cursor-pointer transition-all duration-300 hover:shadow-md">
                                    <div class="flex-shrink-0">
                                <input type="checkbox" name="child_seat_count" value="1" {{ old('child_seat_count') ? 'checked' : '' }}
                                    class="w-5 h-5 rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-600 focus:ring-blue-600">
                                    </div>
                                    <div class="ml-4 flex items-center justify-between w-full">
                                        <div>
                                            <span class="text-base font-semibold text-gray-900">Siège enfant</span>
                                            <p class="text-sm text-gray-500">Sécurité optimale pour vos enfants</p>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="text-lg font-bold text-blue-600 mr-2">+15€</span>
                                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl hover:border-blue-300 cursor-pointer transition-all duration-300 hover:shadow-md">
                                    <div class="flex-shrink-0">
                                        <input type="checkbox" name="meet_greet" value="1" {{ old('meet_greet') ? 'checked' : '' }}
                                            class="w-5 h-5 rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-600 focus:ring-blue-600">
                                    </div>
                                    <div class="ml-4 flex items-center justify-between w-full">
                                        <div>
                                            <span class="text-base font-semibold text-gray-900">Accueil personnalisé</span>
                                            <p class="text-sm text-gray-500">Votre chauffeur vous attend avec une pancarte</p>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="text-lg font-bold text-blue-600 mr-2">+10€</span>
                                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        {{-- Price Summary --}}
                        <div class="price-display animate-bounce-in">
                            <div class="text-center">
                                <div class="text-sm text-blue-200 mb-2">Prix estimé</div>
                                <div class="text-4xl font-bold mb-2" id="price-estimate">À calculer</div>
                                <div class="text-sm text-blue-200">TVA incluse</div>
                            </div>
                        </div>

                        {{-- Customer Details --}}
                        @guest
                        <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-8 rounded-2xl border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                Vos coordonnées
                            </h3>
                            <div class="space-y-6">
                                <div class="relative">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        Nom complet *
                                    </label>
                                    <div class="relative">
                                        <input id="customer_name" name="customer_name" type="text"
                                            class="form-input-modern w-full pl-12"
                                            :value="old('customer_name')"
                                            placeholder="Ex: Jean Dupont"
                                            required />
                                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('customer_name')" class="mt-1" />
                                </div>
                            </div>
                        </div>
                        @endguest
                    </div>

                    <div class="flex justify-end mt-10">
                        <button type="button" onclick="prevStep(1)" class="group relative px-10 py-4 bg-gray-200 text-gray-700 font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                            <span class="relative z-10 flex items-center">
                                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Précédent
                            </span>
                            <div class="absolute inset-0 bg-gray-300 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </button>
                        <button type="button" onclick="nextStep(3)" class="group relative px-10 py-4 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold rounded-xl shadow-xl hover:shadow-2xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                            <span class="relative z-10 flex items-center">
                                Suivant
                                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-blue-900 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection

@section('scripts')
<script>
let map;
let directionsService;
let directionsRenderer;
let pickupMarker;
let dropoffMarker;
let currentDistance = 0;
let currentDuration = 0;
let currentStep = 1;

// Step Navigation Functions
function nextStep(step) {
    if (validateCurrentStep()) {
        showStep(step);
    }
}

function prevStep(step) {
    showStep(step);
}

function showStep(step) {
    // Hide all steps
    document.querySelectorAll('.step-transition').forEach(el => {
        el.classList.add('hidden');
    });

    // Show target step
    const targetStep = document.getElementById(`step-${step}-content`);
    if (targetStep) {
        targetStep.classList.remove('hidden');
        targetStep.classList.add('step-enter-active');
    }

    // Update step indicators
    document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
        const stepNumber = index + 1;
        indicator.classList.remove('active', 'completed');
        if (stepNumber === step) {
            indicator.classList.add('active');
        } else if (stepNumber < step) {
            indicator.classList.add('completed');
        }
    });

    // Update progress bar
    const progressBar = document.getElementById('progress-bar');
    const progressPercent = (step / 3) * 100;
    progressBar.style.width = `${progressPercent}%`;

    currentStep = step;

    // Update summary if on step 3
    if (step === 3) {
        updateBookingSummary();
    }
}

function validateCurrentStep() {
    const step = currentStep;
    let isValid = true;

    if (step === 1) {
        const pickup = document.getElementById('pickup_address').value.trim();
        const dropoff = document.getElementById('dropoff_address').value.trim();
        const datetime = document.getElementById('pickup_datetime').value;
        const pax = document.getElementById('pax').value;

        if (!pickup || !dropoff || !datetime || !pax) {
            isValid = false;
            alert('Veuillez remplir tous les champs obligatoires.');
        }
    } else if (step === 2) {
        const luggage = document.getElementById('luggage').value;
        const vehicle = document.querySelector('input[name="vehicle_class"]:checked');

        if (!luggage || !vehicle) {
            isValid = false;
            alert('Veuillez sélectionner un véhicule et indiquer le nombre de bagages.');
        }
    }

    return isValid;
}

function updateBookingSummary() {
    // Update route info
    document.getElementById('summary-pickup').textContent = document.getElementById('pickup_address').value;
    document.getElementById('summary-dropoff').textContent = document.getElementById('dropoff_address').value;
    document.getElementById('summary-datetime').textContent = new Date(document.getElementById('pickup_datetime').value).toLocaleString('fr-FR');
    document.getElementById('summary-passengers').textContent = document.getElementById('pax').value;
    document.getElementById('summary-luggage').textContent = document.getElementById('luggage').value;

    // Update vehicle info
    const selectedVehicle = document.querySelector('input[name="vehicle_class"]:checked');
    if (selectedVehicle) {
        const vehicleCard = selectedVehicle.closest('.service-card');
        const vehicleName = vehicleCard.querySelector('h4').textContent;
        const vehiclePrice = vehicleCard.querySelector('.text-2xl').textContent;
        document.getElementById('summary-vehicle').textContent = vehicleName;
        document.getElementById('summary-vehicle-price').textContent = vehiclePrice;
    }

    // Update extras
    const childSeat = document.querySelector('input[name="child_seat"]').checked;
    const meetGreet = document.querySelector('input[name="meet_greet"]').checked;
    const extrasList = document.getElementById('summary-extras');
    extrasList.innerHTML = '';

    if (childSeat) {
        const li = document.createElement('li');
        li.textContent = 'Siège enfant (+15€)';
        extrasList.appendChild(li);
    }
    if (meetGreet) {
        const li = document.createElement('li');
        li.textContent = 'Accueil personnalisé (+10€)';
        extrasList.appendChild(li);
    }
    if (!childSeat && !meetGreet) {
        const li = document.createElement('li');
        li.textContent = 'Aucun service supplémentaire';
        extrasList.appendChild(li);
    }

    // Update total price
    const totalPrice = document.getElementById('price-estimate').textContent;
    document.getElementById('summary-total').textContent = totalPrice;

    // Update customer info
    const customerName = document.getElementById('customer_name');
    if (customerName) {
        document.getElementById('summary-customer').textContent = customerName.value;
    }
}

function selectVehicle(vehicleClass) {
    // Remove selected class from all cards
    document.querySelectorAll('.service-card').forEach(card => {
        card.classList.remove('selected');
    });

    // Add selected class to clicked card
    event.currentTarget.classList.add('selected');

    // Check the radio button
    const radio = event.currentTarget.querySelector('.vehicle-radio');
    radio.checked = true;

    // Update price
    updatePrice();
}

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Enhanced animations on page load
document.addEventListener('DOMContentLoaded', function() {
    // Add staggered animations to cards
    const cards = document.querySelectorAll('.booking-card, .service-card');
    cards.forEach((card, index) => {
        card.classList.add(`animate-stagger-${(index % 4) + 1}`);
    });

    // Add ripple effect to buttons
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.classList.add('ripple');
    });
});

// Smooth scrolling for navigation
function smoothScrollToStep(stepNumber) {
    const stepElement = document.getElementById(`step-${stepNumber}-content`);
    if (stepElement) {
        stepElement.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

function initMap() {
    // Initialize map
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 48.8566, lng: 2.3522 }, // Paris
        zoom: 10,
    });

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({
        suppressMarkers: true // We'll add custom markers
    });
    directionsRenderer.setMap(map);

    // Initialize autocomplete for addresses
    const pickupInput = document.getElementById('pickup_address');
    const dropoffInput = document.getElementById('dropoff_address');

    const pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput, {
        componentRestrictions: { country: 'fr' },
        fields: ['formatted_address', 'geometry', 'name']
    });

    const dropoffAutocomplete = new google.maps.places.Autocomplete(dropoffInput, {
        componentRestrictions: { country: 'fr' },
        fields: ['formatted_address', 'geometry', 'name']
    });

    pickupAutocomplete.addListener('place_changed', function() {
        const place = pickupAutocomplete.getPlace();
        if (place.geometry) {
            pickupInput.value = place.formatted_address;
            updateRoute();
        }
    });

    dropoffAutocomplete.addListener('place_changed', function() {
        const place = dropoffAutocomplete.getPlace();
        if (place.geometry) {
            dropoffInput.value = place.formatted_address;
            updateRoute();
        }
    });

    // Update route on input change (with debounce)
    let routeTimeout;
    function debouncedUpdateRoute() {
        clearTimeout(routeTimeout);
        routeTimeout = setTimeout(updateRoute, 1000);
    }

    pickupInput.addEventListener('input', debouncedUpdateRoute);
    dropoffInput.addEventListener('input', debouncedUpdateRoute);

    // Update price on form changes
    const form = document.getElementById('booking-form');
    form.addEventListener('change', updatePrice);
    form.addEventListener('input', updatePrice);
}

function updateRoute() {
    const pickupAddress = document.getElementById('pickup_address').value.trim();
    const dropoffAddress = document.getElementById('dropoff_address').value.trim();

    if (!pickupAddress || !dropoffAddress) {
        // Clear route if addresses are empty
        directionsRenderer.setDirections({ routes: [] });
        currentDistance = 0;
        currentDuration = 0;
        updatePrice();
        return;
    }

    const request = {
        origin: pickupAddress,
        destination: dropoffAddress,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC
    };

    directionsService.route(request, (result, status) => {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsRenderer.setDirections(result);

            // Store distance and duration
            const route = result.routes[0];
            const leg = route.legs[0];
            currentDistance = leg.distance.value / 1000; // km
            currentDuration = leg.duration.value / 60; // minutes

            // Add custom markers
            if (pickupMarker) pickupMarker.setMap(null);
            if (dropoffMarker) dropoffMarker.setMap(null);

            pickupMarker = new google.maps.Marker({
                position: leg.start_location,
                map: map,
                title: 'Point de départ',
                icon: {
                    url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10" fill="#10B981" stroke="white" stroke-width="2"/>
                            <text x="12" y="16" text-anchor="middle" fill="white" font-size="12" font-weight="bold">A</text>
                        </svg>
                    `),
                    scaledSize: new google.maps.Size(24, 24)
                }
            });

            dropoffMarker = new google.maps.Marker({
                position: leg.end_location,
                map: map,
                title: 'Destination',
                icon: {
                    url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10" fill="#EF4444" stroke="white" stroke-width="2"/>
                            <text x="12" y="16" text-anchor="middle" fill="white" font-size="12" font-weight="bold">B</text>
                        </svg>
                    `),
                    scaledSize: new google.maps.Size(24, 24)
                }
            });

            // Fit map to route bounds
            map.fitBounds(route.bounds);

            updatePrice();
        } else {
            console.error('Directions request failed:', status);
            currentDistance = 0;
            currentDuration = 0;
            updatePrice();
        }
    });
}

function updatePrice() {
    const vehicleSelect = document.getElementById('vehicle_class');
    const vehicleClass = vehicleSelect.value;
    const childSeat = document.querySelector('input[name="child_seat"]').checked;
    const meetGreet = document.querySelector('input[name="meet_greet"]').checked;

    let basePrice = 0;
    let perKm = 0;

    // Get pricing based on selected vehicle
    if (vehicleClass) {
        // These should match your vehicle pricing from the database
        switch(vehicleClass) {
            case 'sedan':
                basePrice = 60;
                perKm = 1.50;
                break;
            case 'business':
                basePrice = 80;
                perKm = 2.00;
                break;
            case 'van':
                basePrice = 100;
                perKm = 2.50;
                break;
            default:
                basePrice = 60;
                perKm = 1.50;
        }
    }

    let total = basePrice;

    // Add distance-based pricing if we have a route
    if (currentDistance > 0) {
        total += currentDistance * perKm;
    }

    // Add extras
    if (childSeat) total += 15;
    if (meetGreet) total += 10;

    const priceElement = document.getElementById('price-estimate');
    if (total > 0) {
        priceElement.textContent = `${Math.round(total)}€`;
    } else {
        priceElement.textContent = 'À calculer';
    }
}

// Initialize map when Google Maps API loads
window.initMap = initMap;
</script>
@endsection
