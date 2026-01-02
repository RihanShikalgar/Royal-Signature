@echo off
echo.
echo ========================================
echo Royal Signature - E-Commerce Platform
echo ========================================
echo.
echo Checking for PHP configuration...
echo.
setlocal enabledelayedexpansion

REM Check if correct PHP path exists
if exist "C:\xampp\php.exe" (
    echo Starting PHP Server from correct path...
    cd /D "%~dp0"
    C:\xampp\php.exe -S localhost:8080 -t .
) else if exist "C:\xampp\php\php.exe" (
    echo Starting PHP Server...
    cd /D "%~dp0"
    C:\xampp\php\php.exe -S localhost:8080 -t .
) else (
    echo ERROR: PHP executable not found!
    echo.
    echo Please ensure XAMPP is properly installed.
    echo.
    pause
    exit /b 1
)

echo.
echo Server stopped.
pause
