@echo off
REM Royal Signature - XAMPP Apache Server Launcher
REM This script uses Apache via XAMPP Control Panel

echo.
echo ========================================
echo Royal Signature Platform
echo ========================================
echo.
echo To run this application, please:
echo.
echo 1. Open XAMPP Control Panel
echo    Location: C:\xampp\xampp-control.exe
echo.
echo 2. Click "Start" button for MySQL
echo    (if not already running)
echo.
echo 3. Click "Start" button for Apache
echo.
echo 4. Open your browser and go to:
echo    http://localhost/Royal-Signature/
echo.
echo 5. You will see the login page
echo.
echo 6. Login with:
echo    Username: testuser
echo    Password: password123
echo.
echo ========================================
echo.
REM Try to start XAMPP Control Panel
start "" "C:\xampp\xampp-control.exe"

REM Also show this message
timeout /t 3 /nobreak
cls
echo XAMPP Control Panel should have opened.
echo.
echo If it didn't, manually run: C:\xampp\xampp-control.exe
echo.
pause
