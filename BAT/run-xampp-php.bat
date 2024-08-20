@echo off

echo Starting Apache in a new Command Prompt window...
start cmd /k "cd C:\xampp && apache_start.bat"

echo Starting MySQL in a new Command Prompt window...
start cmd /k "cd C:\xampp && mysql_start.bat"

pause
