@echo off
echo Installing Golden Bean ML Analytics Dependencies...
echo.

REM Upgrade pip first
echo Upgrading pip...
python -m pip install --upgrade pip

REM Install packages one by one with fallback options
echo.
echo Installing core dependencies...
python -m pip install flask

echo.
echo Installing numpy (this may take a moment)...
python -m pip install numpy

echo.
echo Installing pandas (using precompiled wheel)...
python -m pip install pandas --only-binary=all

echo.
echo Installing scikit-learn...
python -m pip install scikit-learn

echo.
echo Installing matplotlib...
python -m pip install matplotlib

echo.
echo Installing seaborn...
python -m pip install seaborn

echo.
echo Installing joblib...
python -m pip install joblib

echo.
echo Installation complete!
echo.
echo Testing imports...
python -c "import flask, pandas, sklearn, matplotlib, seaborn, numpy, joblib; print('✅ All packages imported successfully!')"

if %errorlevel% neq 0 (
    echo.
    echo ❌ Some packages failed to import. Trying alternative installation...
    echo.
    echo Installing from conda-forge (if conda is available)...
    conda install -c conda-forge flask pandas scikit-learn matplotlib seaborn numpy joblib -y
) else (
    echo.
    echo 🎉 Ready to run ML Analytics!
    echo Run: python app.py
)

pause
