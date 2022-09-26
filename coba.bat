:check
timeout 10 > nul
tasklist /fi "imagename eq notepad.exe" /nh |find /i /c "notepad.exe" > "%temp%\variable.txt"
set /p value=<"%temp%\variable.txt"

if %value% equ 0 goto none
if %value% geq 2 goto more
if %value% equ 1 goto check

:more
for /f "tokens=2" %%x in ('tasklist ^| findstr notepad.exe') do set PIDTOKILL=%%x
taskkill /F /PID %PIDTOKILL%
goto check

:none
start notepad.exe
goto check