@echo off
:: Project Name
set /p project_name="Enter your Flask project name: "

:: Create the project folder
mkdir %project_name%
cd %project_name%

:: Create the necessary files and folders
echo. > app.py
mkdir templates
mkdir static
mkdir static\css
mkdir static\js
mkdir static\images

:: Notify completion
echo Project structure created for %project_name%.
