@echo off
setlocal enabledelayedexpansion

echo.
echo ========================================
echo   ROYAL SIGNATURE - SYSTEM STARTUP
echo ========================================
echo.

:: Check if XAMPP is installed
if not exist "C:\xampp\xampp-control.exe" (
    echo ERROR: XAMPP not found at C:\xampp
    echo.
    echo Please install XAMPP from: https://www.apachefriends.org/
    echo.
    pause
    exit /b 1
)

echo [1] Checking XAMPP services...
timeout /t 1 /nobreak > nul

:: Start MySQL
echo.
echo [2] Starting MySQL service...
cd /d "C:\xampp\mysql\bin"

:: Check if MySQL is already running
tasklist | findstr /i "mysqld" > nul
if errorlevel 1 (
    echo   MySQL is not running. Starting...
    start "" "C:\xampp\mysql\bin\mysqld.exe"
    timeout /t 3 /nobreak > nul
    echo   ✓ MySQL started
) else (
    echo   ✓ MySQL already running
)

:: Start Apache
echo.
echo [3] Starting Apache service...
cd /d "C:\xampp\apache\bin"

:: Check if Apache is already running
tasklist | findstr /i "httpd" > nul
if errorlevel 1 (
    echo   Apache is not running. Starting...
    start "" "C:\xampp\apache\bin\httpd.exe"
    timeout /t 3 /nobreak > nul
    echo   ✓ Apache started
) else (
    echo   ✓ Apache already running
)

:: Wait for services to fully start
echo.
echo [4] Waiting for services to be ready...
timeout /t 2 /nobreak > nul

:: Test MySQL connection
echo.
echo [5] Testing database connection...
cd /d "C:\xampp\mysql\bin"
mysql -u root -e "SELECT 1" > nul 2>&1
if errorlevel 0 (
    echo   ✓ Database connection successful
) else (
    echo   ⚠ Database connection delayed (may take a moment)
)

:: Open website in browser
echo.
echo [6] Opening website...
timeout /t 1 /nobreak > nul
start http://localhost/Royal-Signature/

:: Status check
echo.
echo ========================================
echo ✓ System Started Successfully!
echo ========================================
echo.
echo Website URL: http://localhost/Royal-Signature/
echo.
echo Login Credentials:
echo   Username: testuser
echo   Password: password123
echo.
echo Setup Page: http://localhost/Royal-Signature/setup.php
echo.
echo Press any key to close this window...
echo.
pause > nul

exit /b 0
