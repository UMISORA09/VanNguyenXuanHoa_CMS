@echo off
:: Tu dong yeu cau quyen Administrator neu chua co
net session >nul 2>&1
if %errorlevel% neq 0 (
    echo Dang yeu cau quyen Administrator de cap nhat file hosts...
    powershell -Command "Start-Process '%~f0' -Verb RunAs"
    exit /b
)

findstr /i "wordpress.local" "%windir%\system32\drivers\etc\hosts" >nul
if %errorlevel% equ 0 (
    echo [OK] wordpress.local da co trong file hosts!
) else (
    echo.>>"%windir%\system32\drivers\etc\hosts"
    echo 127.0.0.1       wordpress.local>>"%windir%\system32\drivers\etc\hosts"
    echo [THANH CONG] Da them "127.0.0.1 wordpress.local" vao file hosts!
)
ipconfig /flushdns >nul
echo Hoan tat! Ban co the truy cap http://wordpress.local tren trinh duyet.
pause
