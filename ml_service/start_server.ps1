#!/usr/bin/env pwsh
# PowerShell script to start ML Analytics

Write-Host "🚀 Starting Golden Bean ML Analytics..." -ForegroundColor Green
Write-Host "=========================================" -ForegroundColor Yellow

# Check if we're in the right directory
if (!(Test-Path "app.py")) {
    Write-Host "❌ Error: app.py not found in current directory" -ForegroundColor Red
    Write-Host "Please navigate to the ml_service directory first:" -ForegroundColor Yellow
    Write-Host "cd C:\xampp\htdocs\git\golden-bean2.0\ml_service" -ForegroundColor Cyan
    exit 1
}

Write-Host "✅ Found app.py - Starting server..." -ForegroundColor Green
Write-Host ""
Write-Host "🌐 Server will be available at: http://localhost:5001" -ForegroundColor Cyan
Write-Host "📊 Dashboard: Open dashboard.html in your browser" -ForegroundColor Cyan
Write-Host "⏹️  Press Ctrl+C to stop the server" -ForegroundColor Yellow
Write-Host ""

# Start the Flask application
& "C:\xampp\htdocs\git\golden-bean2.0\.venv\Scripts\python.exe" app.py
