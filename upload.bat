REM Script to upload files to webserver
REM Uses a private "transfer.ftp" file that contains login

@setlocal enableextensions enabledelayedexpansion
FTP -n -i -s:transfer.ftp jemfixnet.dk
ENDLOCAL
TIMEOUT 10 >NUL
