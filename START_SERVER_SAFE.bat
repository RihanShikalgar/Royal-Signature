@echo off
setlocal enabledelayedexpansion

echo.
echo ========================================
echo Royal Signature - E-Commerce Platform
echo ========================================
echo.

REM Set explicit paths
set PHPEXE=C:\xampp\php\php.exe
set PHPINI=C:\xampp\php\php.ini

REM Verify PHP exists
if not exist "%PHPEXE%" (
    echo ERROR: PHP not found at %PHPEXE%
    echo Please ensure XAMPP is properly installed.
    pause
    exit /b 1
)

echo Starting MySQL first...
REM Try to verify MySQL is running
C:\xampp\mysql\bin\mysql.exe -u root -e "SELECT 1;" >nul 2>&1
if errorlevel 1 (
    echo WARNING: MySQL may not be running!
    echo Please start MySQL from XAMPP Control Panel before continuing.
    echo Press any key to continue anyway...
    pause
)

echo.
echo Starting PHP Development Server...
echo ========================================
echo Server: http://localhost:8080
echo Database: royal_signature (MySQL)
echo Test User: testuser / password123
echo ========================================
echo.
echo Press Ctrl+C to stop the server.
echo.

cd /D "%~dp0"

REM Disable loading problematic extensions by using only required ones
set PHP_INI_SCAN_DIR=
"%PHPEXE%" -c "%PHPINI%" -S localhost:8080 -t .

echo.
echo Server stopped.
pause
