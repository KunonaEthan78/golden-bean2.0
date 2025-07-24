import sys
import os

# Add the current directory to Python path
sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))

print("🧪 Testing ML Analytics Dependencies...")
print("=" * 50)

try:
    import flask
    print("✅ Flask:", flask.__version__)
except ImportError as e:
    print("❌ Flask not found:", e)

try:
    import pandas as pd
    print("✅ Pandas:", pd.__version__)
except ImportError as e:
    print("❌ Pandas not found:", e)

try:
    import sklearn
    print("✅ Scikit-learn:", sklearn.__version__)
except ImportError as e:
    print("❌ Scikit-learn not found:", e)

try:
    import matplotlib
    print("✅ Matplotlib:", matplotlib.__version__)
except ImportError as e:
    print("❌ Matplotlib not found:", e)

try:
    import seaborn as sns
    print("✅ Seaborn:", sns.__version__)
except ImportError as e:
    print("❌ Seaborn not found:", e)

try:
    import numpy as np
    print("✅ Numpy:", np.__version__)
except ImportError as e:
    print("❌ Numpy not found:", e)

try:
    import joblib
    print("✅ Joblib:", joblib.__version__)
except ImportError as e:
    print("❌ Joblib not found:", e)

print("=" * 50)

# Test basic functionality
try:
    print("\n🔬 Testing basic ML functionality...")
    
    # Test pandas DataFrame creation
    sample_data = pd.DataFrame({
        'user_id': [1, 2, 3],
        'quantity': [10, 15, 8],
        'price': [50.0, 75.0, 40.0],
        'order_date': ['2024-01-15', '2024-01-16', '2024-01-17']
    })
    print("✅ Pandas DataFrame creation works")
    
    # Test matplotlib
    import matplotlib.pyplot as plt
    plt.switch_backend('Agg')
    fig, ax = plt.subplots()
    ax.plot([1, 2, 3], [1, 4, 2])
    plt.close(fig)
    print("✅ Matplotlib plotting works")
    
    # Test sklearn
    from sklearn.cluster import KMeans
    from sklearn.preprocessing import StandardScaler
    kmeans = KMeans(n_clusters=2, random_state=42)
    scaler = StandardScaler()
    print("✅ Scikit-learn imports work")
    
    print("\n🎉 All tests passed! Your ML analytics environment is ready!")
    print("\nTo start the analytics service, run:")
    print("   start_analytics.bat")
    print("\nOr manually:")
    print("   C:/xampp/htdocs/git/golden-bean2.0/.venv/Scripts/python.exe app.py")
    
except Exception as e:
    print(f"❌ Test failed: {e}")
    print("\nThere might be an issue with the installation.")
