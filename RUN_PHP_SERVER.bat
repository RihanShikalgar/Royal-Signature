@echo off
setlocal enabledelayedexpansion

echo.
echo ========================================
echo   ROYAL SIGNATURE - PHP SERVER
echo ========================================
echo.

cd /d "C:\xampp\htdocs\Royal-Signature"

echo [1] Checking PHP installation...
if not exist "C:\xampp\php\php.exe" (
    echo ERROR: PHP not found at C:\xampp\php\php.exe
    echo.
    pause
    exit /b 1
)

echo [2] Checking MySQL connection...
cd "C:\xampp\mysql\bin"
mysql -u root -e "SELECT 1" > nul 2>&1
if errorlevel 1 (
    echo ERROR: MySQL not running!
    echo Please start MySQL before running the website.
    echo.
    pause
    exit /b 1
) else (
    echo    ✓ MySQL is running
)

echo.
echo [3] Starting PHP Built-in Server...
cd /d "C:\xampp\htdocs\Royal-Signature"

echo.
echo    Starting on: http://localhost:8888
echo    Press Ctrl+C to stop the server
echo.
timeout /t 2 /nobreak > nul

:: Start PHP Server
"C:\xampp\php\php.exe" -S localhost:8888

pause
