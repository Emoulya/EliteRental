@echo off
setlocal

:: Path project Laravel (folder ini tempat file .bat berada)
set "BASE_FOLDER=%~dp0"

:: File output
set "OUTPUT_FILE=%BASE_FOLDER%struktur_folder.txt"

:: Kosongkan isi file output
> "%OUTPUT_FILE%" echo Struktur Folder Laravel:

:: Daftar folder penting Laravel
for %%F in (
    "app"
    "routes"
    "resources"
    "public"
    "database"
    "config"
) do (
    if exist "%BASE_FOLDER%%%~F" (
        echo.>>"%OUTPUT_FILE%"
        echo ==== Struktur folder %%F ====>>"%OUTPUT_FILE%"
        tree "%BASE_FOLDER%%%~F" /F >>"%OUTPUT_FILE%"
    ) else (
        echo Folder %%F tidak ditemukan, dilewati.>>"%OUTPUT_FILE%"
    )
)

echo.
echo Struktur folder Laravel telah disimpan di:
echo %OUTPUT_FILE%
pause
