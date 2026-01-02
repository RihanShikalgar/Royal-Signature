@echo off
cls
color 0B
echo.
echo ╔════════════════════════════════════════════════════════════════╗
echo ║                                                                ║
echo ║        ROYAL SIGNATURE - E-COMMERCE PLATFORM                 ║
echo ║        Luxury Perfume Store                                   ║
echo ║                                                                ║
echo ╚════════════════════════════════════════════════════════════════╝
echo.
echo.
echo This website requires XAMPP Apache and MySQL to run.
echo.
echo Please follow these steps:
echo.
echo ┌────────────────────────────────────────────────────────────────┐
echo │ STEP 1: Open XAMPP Control Panel                              │
echo │         Double-click: C:\xampp\xampp-control.exe              │
echo └────────────────────────────────────────────────────────────────┘
echo.
echo ┌────────────────────────────────────────────────────────────────┐
echo │ STEP 2: Start MySQL Service                                   │
echo │         Click the green "Start" button next to MySQL          │
echo │         Wait until it says "Running" (green light)            │
echo └────────────────────────────────────────────────────────────────┘
echo.
echo ┌────────────────────────────────────────────────────────────────┐
echo │ STEP 3: Start Apache Service                                  │
echo │         Click the green "Start" button next to Apache         │
echo │         Wait until it says "Running" (green light)            │
echo └────────────────────────────────────────────────────────────────┘
echo.
echo ┌────────────────────────────────────────────────────────────────┐
echo │ STEP 4: Open Your Browser                                     │
echo │         Navigate to: http://localhost/Royal-Signature/        │
echo └────────────────────────────────────────────────────────────────┘
echo.
echo ┌────────────────────────────────────────────────────────────────┐
echo │ STEP 5: Login to the Platform                                 │
echo │         Username: testuser                                    │
echo │         Password: password123                                 │
echo └────────────────────────────────────────────────────────────────┘
echo.
echo ┌────────────────────────────────────────────────────────────────┐
echo │ ALTERNATIVE: Check System Status                              │
echo │         http://localhost/Royal-Signature/status.php           │
echo │         http://localhost/Royal-Signature/dashboard.php        │
echo └────────────────────────────────────────────────────────────────┘
echo.
echo.
echo ✓ Features Ready:
echo   • User Registration & Login
echo   • Browse Products
echo   • Shopping Cart
echo   • Order Management
echo   • User Profiles
echo   • Feedback System
echo.
echo ✓ Test Account:
echo   Username: testuser
echo   Password: password123
echo.
echo.
echo Would you like to open XAMPP Control Panel now? (Y/N)
set /p choice=Enter your choice: 
if /i "%choice%"=="Y" (
    start "" "C:\xampp\xampp-control.exe"
    echo.
    echo Opening XAMPP Control Panel...
    timeout /t 2 /nobreak
) else if /i "%choice%"=="N" (
    echo.
    echo Please open XAMPP manually when ready.
    echo Location: C:\xampp\xampp-control.exe
)

echo.
pause
