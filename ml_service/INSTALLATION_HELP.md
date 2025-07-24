# Alternative installation methods for Windows

## Method 1: Use the automated installer
Run: `install_dependencies.bat`

## Method 2: Install via conda (recommended for Windows)
```bash
conda create -n golden-bean python=3.9
conda activate golden-bean
conda install -c conda-forge flask pandas scikit-learn matplotlib seaborn numpy joblib
```

## Method 3: Install specific versions that work well on Windows
```bash
pip install flask==2.0.3
pip install pandas==1.5.3
pip install scikit-learn==1.2.2
pip install matplotlib==3.6.3
pip install seaborn==0.12.2
pip install numpy==1.24.3
pip install joblib==1.2.0
```

## Method 4: Use precompiled wheels only
```bash
pip install --only-binary=all flask pandas scikit-learn matplotlib seaborn numpy joblib
```

## If you still get errors:
1. Make sure you have Microsoft Visual C++ 14.0 or greater installed
2. Install Visual Studio Build Tools
3. Or use Anaconda/Miniconda instead of pip

## Quick Start (if conda is available):
```bash
conda install anaconda
conda create -n ml-analytics python=3.9
conda activate ml-analytics
conda install flask pandas scikit-learn matplotlib seaborn
python app.py
```
