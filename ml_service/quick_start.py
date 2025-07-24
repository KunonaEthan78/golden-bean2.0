#!/usr/bin/env python3
"""
Quick test to verify Flask app can start
"""

import sys
import os

# Add current directory to path
sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))

print("🧪 Testing Flask App Startup...")
print("=" * 40)

try:
    # Import the app
    from app import app
    print("✅ Flask app imported successfully")
    
    # Test basic route existence
    with app.app_context():
        print("✅ App context working")
    
    print("✅ Ready to start server!")
    print("\n🚀 Starting Flask server...")
    print("📊 Open dashboard.html in your browser to use the analytics")
    print("⏹️  Press Ctrl+C to stop\n")
    
    # Start the server
    app.run(host='127.0.0.1', port=5001, debug=False)
    
except ImportError as e:
    print(f"❌ Import error: {e}")
    print("Make sure all dependencies are installed")
except Exception as e:
    print(f"❌ Error: {e}")
    print("Check the app.py file for issues")
